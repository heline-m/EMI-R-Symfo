<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Fournisseur;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeControlerController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
       // $repository=$this->getDoctrine()->getRepository(Categorie::class);

        return $this->render('home_controler/index.html.twig', [
            'controller_name' => 'HomeControlerController',
        ]);
    }

    #[Route('/register', name: 'register')]
    public function register(Request $request): Response
    {
        $fournisseur = new Fournisseur();
        $form = $this->createFormBuilder($fournisseur);
        $form->handleRequest($request);

//        TODO 9/04/22 j'étais en train de faire le form mais j'ai vu que symfony en a un préfait, à méditer ... (voir doc dans <3)



        return $this->render('home_controler/register.html.twig');
    }
}
