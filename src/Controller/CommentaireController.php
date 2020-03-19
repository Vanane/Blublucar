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
        $usr = $this->get('security.token_storage')->getToken()->getUser();
        $trajet = $this->getDoctrine()->getRepository(Trajet::class)->getTrajetParSonId($trajetid);
        $com = new Commentaire();
        $com->setPosteur($usr);
        $com->setTrajet($trajet);

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
