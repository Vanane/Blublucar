<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegisterUserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        
    }

    /**
     * @Route("/theme/{theme}", name="theme") 
     */
    public function theme(Request $request, $theme) : Response
    {
        $response = $this->redirectToRoute('trajet');
        $response->headers->setcookie(new Cookie('user_theme', $theme));
        return $response;
    }
    
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request , EntityManagerInterface $em) : Response
    {
        $usr = new User();
        $form = $this->createform(RegisterUserType::class, $usr);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $usr->setPassword($this->passwordEncoder->encodePassword($usr, $usr->getPassword()));
            $em->persist($usr);
            $em->flush();
            return $this->redirectToRoute("trajet");
        }
        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/profil/{id}", name="profil")
    */
    public function profil($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->getUserParSonId($id);
        $note = $this->getDoctrine()->getRepository(Commentaire::class)->getNoteMoyenneUser($id);
        $comms = $this->getDoctrine()->getRepository(Commentaire::class)->getCommentairesUser($id);
        return $this->render('user/profil.html.twig', [
            'user' => $user,
            'note' => $note[1],
            'comms' => $comms
        ]);
    }

    /**
     * @Route("/profil", name="profil")
    */
    public function self()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $note = $this->getDoctrine()->getRepository(Commentaire::class)->getNoteMoyenneUser($user->getId())[1];
        $comms = $this->getDoctrine()->getRepository(Commentaire::class)->getCommentairesUser($user->getId());

        return $this->render('user/self.html.twig', [
            'user' => $user,
            'note' => $note,
            'comms' => $comms
        ]);
    }
}