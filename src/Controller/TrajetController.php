<?php

namespace App\Controller;

use App\Entity\Trajet;
use App\Entity\Reservation;
use App\Entity\Destination;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AjoutTrajetType;
use \DateTime;

class TrajetController extends AbstractController
{
    /**
     * @Route("/trajet", name="trajet")
     */
    public function index()
    {
        $trajets = $this->getDoctrine()->getRepository(Trajet::class)->getDerniersTrajets();
        return $this->render('trajet/index.html.twig', [
            'trajets' => $trajets
        ]);
    }
    /**
     * @Route("/trajet/liste", name="trajet.liste")
     */
    public function liste()
    {
        $trajets = $this->getDoctrine()->getRepository(Trajet::class)->getTrajetsDateSup(new DateTime());

        return $this->render('trajet/liste.html.twig', [
            'trajets' => $trajets
        ]);
    }

    /**
     * @Route("/trajet/liste/date/{date}", name="trajet.filtre.date")
     */
    public function listeParDate(DateTime $date)
    {
        $trajets = $this->getDoctrine()->getRepository(Trajet::class)->getTrajetsDateEq($date);

        return $this->render('trajet/liste.html.twig', [
            'trajets' => $trajets
        ]);
    }

    /**
     * @Route("/trajet/liste/trajet/{depart}/{arrivee}", name="trajet.filtre.trajet")
     */
    public function listeParTrajet(Destination $dep, Destination $arr)
    {
        $trajets = $this->getDoctrine()->getRepository(Trajet::class)->getTrajetsDepartArrivee($dep, $arr);

        return $this->render('trajet/liste.html.twig', [
            'trajets' => $trajets
        ]);
    }

    /** 
     * @Route("/trajet/detail/{id}", name="trajet.detail")
    */
    public function detail($id)
    {
        $trajet = $this->getDoctrine()->getRepository(Trajet::class)->getTrajetParSonId($id);
        $resas = $this->getDoctrine()->getRepository(Reservation::class)->getPlacesTrajet($id);

        return $this->render('trajet/detail.html.twig', [
            'trajet' => $trajet,
            'resastrajet' => $resas,
        ]);
    }

    /**
     * @Route("/trajet/self", name="trajet.self")
     */
    public function listeUser()
    {
        $usr = $this->get('security.token_storage')->getToken()->getUser();
        $trajets = $this->getDoctrine()->getRepository(Trajet::class)->listeParUser($usr->getId());

        return $this->render('trajet/listeself.html.twig', [
            'trajets' => $trajets,
            'usr' => $usr
        ]);
    }

    /**
     * @Route("/trajet/ajout", name="trajet.ajout")
     */
    public function ajout(Request $request , EntityManagerInterface $em) : Response
    {
        $trajet = new Trajet();
        $form = $this->createform(AjoutTrajetType::class, $trajet);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $usr = $this->get('security.token_storage')->getToken()->getUser();
            $trajet->setConducteur($usr);
            $em->persist($trajet);
            $em->flush();
            $id = $trajet->getId();
            return $this->redirectToRoute("trajet.detail", ['id' => $id]);
        }
        return $this->render('trajet/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/trajet/supprimer/{id}", name="trajet.supprimer")
     */
    public function supprimer(Request $request, Trajet $trajet, EntityManagerinterface $em) : Response
    {
        $usr = $this->get('security.token_storage')->getToken()->getUser();
        
        if($trajet->getConducteur()->getId() == $usr->getId()
            && $trajet->getDate()->format("Ymdhis") > date("Ymdhis"))
        {
            $em = $this->getDoctrine()->getManager();        
            $em->remove($trajet);
            $em->flush();
        }
        return $this->redirectToRoute("trajet.self");
    }
}
