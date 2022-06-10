<?php

namespace App\Controller;

use App\Entity\Fournisseur;
use App\Service\APIServiceFournisseur;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, ManagerRegistry $doctrine, APIServiceFournisseur $callAPIService, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        //$repo=$this->getDoctrine()->getRepository(Fournisseur::class);


//         if ($this->getUserIdentifier()) {
//             return $this->redirectToRoute('/accueil');
//         }
        // Je récupère les fournisseurs de l'API et de la base de données de Symfony
        $fournisseursRepo=$doctrine->getRepository(Fournisseur::class);
        $fournisseurAPI=$callAPIService->getData();
        //J'ajoute les nouveaux fournisseurs
        $this->__compare($fournisseurAPI, $fournisseursRepo, $userPasswordHasher, $entityManager);


        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    function __compare($founisseurAPI, $fournisseurRepo, $userPasswordHasher, $entityManager){
        foreach ($founisseurAPI as $item) {
               if (($fournisseurRepo->findOneBy(array('username'=>$item["societe"])))==null)
               {
                   $user = new Fournisseur();
                   $user->setUsername($item['societe']);
                   $user->setPassword(
                       $userPasswordHasher->hashPassword(
                           $user,
                           "123"
                       )
                   );
                   $entityManager->persist($user);
                   $entityManager->flush();
               }



        }
    }
}
