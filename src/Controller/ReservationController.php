<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\User;
use App\Entity\Trajet;
use App\Form\AjoutResaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index()
    {
        $usr = $this->get('security.token_storage')->getToken()->getUser();
        $resas = $this->getDoctrine()->getRepository(Reservation::class)->getResasParUser($usr);
        return $this->render('reservation/index.html.twig',[
            'resas' => $resas
        ]);
    }

    /**
     * @Route("/reservation/ajout/{trajetid}", name="reservation.ajout")
     */    
    public function ajout(Request $request , EntityManagerInterface $em, $trajetid) : Response
    {
        $resa = new Reservation();
        $trajet = $this->getDoctrine()->getRepository(Trajet::class)->getTrajetparSonId($trajetid);
        $usr = $this->get('security.token_storage')->getToken()->getUser();

        if($trajet->getConducteur()->getId() != $usr->getId()
        && !array_key_exists($usr->getId(), $trajet->getPassagers()))
        {
            $resa->setPassager($usr);
            $resa->setPaye(0);
            $resa->setTrajet($trajet);

            $form = $this->createform(AjoutResaType::class, $resa);        
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid())
            {
                $resa->setPassager($usr);
                $resa->setPaye(0);
                $resa->setTrajet($trajet);
        
                $em->persist($resa);
                $em->flush();
                return $this->redirectToRoute("trajet.detail", ['id' => $trajetid]);
            }
            return $this->render('reservation/ajout.html.twig', [
                'form' => $form->createView()
            ]);
        }
        else
        {
            return $this->render("reservation/index.html.twig");
        }
    }

    /**
     * @Route("/reservation/payer/{id}", name="reservation.payer")
     */
    public function payer(Request $request, Reservation $reservation, EntityManagerinterface $em) : Response
    {
        $usr = $this->get('security.token_storage')->getToken()->getUser();        
        if($reservation->getPassager()->getId() == $usr->getId()
            && $reservation->getPaye() == false)
        {
            $em = $this->getDoctrine()->getManager();            
            $reservation->setPaye(true);
            $em->flush();
            return $this->render("reservation/payer.html.twig", [
                "id" => $reservation->getId()
            ]);
        }
        else
        {
            return $this->render("reservation/index.html.twig");
        }        
    }

    /**
     * @Route("/reservation/supprimer/{id}", name="reservation.supprimer")
     */
    public function supprimer(Request $request, Reservation $reservation, EntityManagerinterface $em) : Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute("reservation");
    }


}
