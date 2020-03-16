<?php

namespace App\Controller;

use App\Entity\Trajet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrajetController extends AbstractController
{
    /**
     * @Route("/trajet", name="trajet")
     */
    public function index()
    {
        $trajets = $this->getDoctrine()->getRepository(Trajet::class)->list();
        return $this->render('trajet/index.html.twig', [
            'trajets' => $trajets
        ]);
    }
}
