<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Fournisseur;
use App\Service\APIServiceFournisseur;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeControlerController extends AbstractController
{

    #[Route('/accueil', name: 'accueil')]
    public function index(): Response
    {
       // $repository=$this->getDoctrine()->getRepository(Categorie::class);

        return $this->render('home_controler/index.html.twig', [
            'controller_name' => 'HomeControlerController',
        ]);
    }

}
