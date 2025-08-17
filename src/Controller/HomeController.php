<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/acceuil', name: 'app_acceuil')]
    public function index(): Response
    {
        return $this->render('acceuil.html.twig');
    }


    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('utilisateur/profile.html.twig');
    }

    #[Route('/dashboard', name: 'app_dashboard')]
    public function nav(): Response
    {
        return $this->render('dashboard.html.twig');
    }

   

   
}

