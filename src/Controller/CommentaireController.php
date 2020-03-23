<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Trajet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AjoutCommType;
use \DateTime;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="commentaire")
     */
    public function listeUser()
    {
        $usr = $this->get('security.token_storage')->getToken()->getUser();
        $comms = $this->getDoctrine()->getRepository(Commentaire::class)->listeUser($usr->getId());

        return $this->render('commentaire/listeself.html.twig', [
            'comms' => $comms
        ]);
    }

    /**
     * @Route("/commentaire/ajout/{trajetid}", name="commentaire.ajout")
     */
    public function ajout(Request $request , EntityManagerInterface $em, $trajetid) : Response
    {
        $com = new Commentaire();
        $usr = $this->get('security.token_storage')->getToken()->getUser();
        $trajet = $this->getDoctrine()->getRepository(Trajet::class)->getTrajetParSonId($trajetid);

        if($trajet->getConducteur()->getId() != $usr->getId()
            && array_key_exists($usr->getId(), $trajet->getPassagers()))
        {
            $com->setPosteur($usr);
            $com->setTrajet($trajet);
            $com->setDatePost(new DateTime(date('Y-m-d h:i:s')));

            $form = $this->createform(AjoutCommType::class, $com);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $em->persist($com);
                $em->flush();
                $id = $com->getTrajet()->getId();
                return $this->redirectToRoute("trajet.detail", ['id' => $id]);
            }
            return $this->render('trajet/ajout.html.twig', [
                'form' => $form->createView()
            ]);
        }
        else
        {
            return $this->render("commentaire/listeself.html.twig");
        }
    }

    /**
     * @Route("/commentaire/{id}/supprimer", name="commentaire.supprimer")
     * @param Request $request
     * @param Commentaire $com
     * @param EntityManagerInterface $em
     * @return Response|RedirectResponse
    */   
    public function supprimer(Request $request, Commentaire $com, EntityManagerInterface $em) : Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($com);
        $em->flush();
        return $this->redirectToRoute("commentaire");
    }

}
