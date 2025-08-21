<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Materiel;
use App\Repository\MaterielRepository;
use App\Entity\Affectation;
use App\Repository\AffectationRepository;
use App\Entity\Intervention;
use App\Repository\InterventionRepository;
use App\Entity\Alerte;
use App\Repository\AlerteRepository;
use App\Entity\Reclamation;
use App\Repository\ReclamationRepository;


class HomeController extends AbstractController
{
    #[Route('/acceuil', name: 'app_acceuil')]
    public function acceuil(): Response
    {
        return $this->render('acceuil.html.twig');
    }

#[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard( MaterielRepository $materielRepository ,
    AffectationRepository $affectationRepository, UserRepository $userRepository,
    InterventionRepository $interventionRepository,
    AlerteRepository $alerteRepository,
    ReclamationRepository $reclamationRepository ): Response
    {
      $totalMateriels = $materielRepository->countMateriels();
      $totalAffectations = $affectationRepository->countAffectations();
      $totalUsers = $userRepository->countUsers();
      $totalInterventions = $interventionRepository->countInterventions();
      $totalAlertes = $alerteRepository->countAlertes();
      $totalReclamations = $reclamationRepository->countReclamations();


        return $this->render('dashboard.html.twig' , [
        'totalMateriels' => $totalMateriels,
        'totalAffectations' => $totalAffectations,
        'totalUsers' => $totalUsers,
        'totalInterventions' => $totalInterventions,
        'totalAlertes' => $totalAlertes,
        'totalReclamations' => $totalReclamations,
    ]);
    }


   #[Route('/profile', name: 'app_profile')]
public function profil(UserRepository $userRepository): Response
{
    $user = $this->getUser(); 
    $users = $userRepository->findBy(['id' => $user]);

    return $this->render('utilisateur/profile.html.twig', [
        'users' => $users
    ]);
}

    

   

   
}

