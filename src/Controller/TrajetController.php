<?php

namespace App\Controller;

use App\Entity\Trajet;
use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
        $trajets = $this->getDoctrine()->getRepository(Trajet::class)->list();
        

        return $this->render('trajet/liste.html.twig', [
            'trajets' => $trajets
        ]);
    }

    /** 
     * @Route("/trajet/detail/{id}", name="trajet.detail")
     * 
    */
    public function detail($id)
    {
        $trajet = $this->getDoctrine()->getRepository(Trajet::class)->getTrajetParSonId($id);
        
        $resas = $this->getDoctrine()->getRepository(Reservation::class)->getPlacesTrajet($id);

        return $this->render('trajet/detail.html.twig', [
            'trajet' => $trajet,
            'resastrajet' => $resas
        ]);
    }
}
