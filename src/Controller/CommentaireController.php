<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="commentaire")
     */
    public function index()
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }

    /**
     * @Route("/commentaire/voir", name="commentaire.voir")
     */
    public function voirCommentaires()
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'ajoutCommentaire',
        ]);
    }

    /**
     * @Route("/commentaire/{id}/supprimer", name="commentaire.supprimer")
     * @param Request $request
     * @param Commentaire $com
     * @param EntityManagerInterface $em
     * @return Response|RedirectResponse
    */
    public function ajoutCommentaire(Request $request, Commentaire $com, EntityManagerInterface $em)
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'ajoutCommentaire',
        ]);
    }

     
    public function supprimerCommentaire()
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'supprimerCommentaire',
        ]);
    }

}
