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

    #[Route('/alerte', name: 'app_alerte')]
    public function alerte(): Response
    {
        return $this->render('alerte/listeAlerte.html.twig');
    }

    #[Route('/intervention', name: 'app_intervention')]
    public function intervention(): Response
    {
        return $this->render('intervention/listeIntervention.html.twig');
    }

    #[Route('/affectation', name: 'app_affectation')]
    public function affectation(): Response
    {
        return $this->render('affectation/listeAffectation.html.twig');
    }

    #[Route('/reclamation', name: 'app_reclamation')]
    public function reclamation(): Response
    {
        return $this->render('reclamation/listeReclamation.html.twig');
    }
}

