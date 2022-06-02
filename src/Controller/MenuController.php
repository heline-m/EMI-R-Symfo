<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'menu')]
    public function index(): Response
    {
        //je vais aller chercher un objet dans le framework symfony
        //pour lister les dossiers qui sont dans /public/photos
//        $finder =new Finder();
//        $finder->directories()->in("../public/photos");
//
//        return $this->render('menu/_menu.html.twig', [
//            "dossier" => $finder
//        ]);
        return $this->render('menu/index.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }
}
