<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrajetController extends AbstractController
{
    /**
     * @Route("/trajet", name="trajet")
     */
    public function index()
    {
        return $this->render('trajet/index.html.twig', [
            'controller_name' => 'TrajetController',
        ]);
    }
}
