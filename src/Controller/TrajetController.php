<?php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrajetController extends AbstractController
{

       /**
     * @Route("/", name="Accueil")
     */
    public function index()
    {
        return $this->render("base.html.twig");
    }

}


?>

