<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Entity\Trajet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DestinationController extends AbstractController
{
    /**
     * @Route("/destination/{dep}/{arr}", name="destination.filtre.trajet")
     */
    function trajetsParcours(Destination $dep, Destination $arr)
    {
        $trajets = $this->getDoctrine()->getRepository(Trajet::class)->getTrajetsDepartArrivee($dep, $arr);
        return $this->render("/destination/parcours.html.twig",
        ['trajets' => $trajets, 'dep' => $dep, 'arr' => $arr]);
    }

    /**
     * @Route("/destination/{date}", name="destination.filtre.date")
     */
    function trajetsDate($date)
    {
        $datetime = new \DateTime($date);
        $trajets = $this->getDoctrine()->getRepository(Trajet::class)->getTrajetsDateEq($datetime);
        return $this->render("/destination/date.html.twig",
        ['trajets' => $trajets, 'date' => $date]);
    }

}
