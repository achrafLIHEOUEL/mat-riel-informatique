<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ReclamationRepository;
use App\Entity\Reclamation;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ReclamationFormType;

final class ReclamationController extends AbstractController
{
    #[Route('/reclamation', name: 'app_reclamations')]
    public function reclamation(ReclamationRepository $reclamationRepository): Response
    {
        $reclamations = $reclamationRepository->findAll();
        return $this->render('reclamation/admin/listeReclamation.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }


     #[Route('/mesreclamations', name: 'app_reclamations_user')]
    public function reclamationUser(ReclamationRepository $reclamationRepository): Response
    {
        $user = $this->getUser();
       $reclamations = $reclamationRepository->findBy(['user' => $user]);

        return $this->render('reclamation/listeReclamationUser.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }

    #[Route('/admin/ajouterReclamation', name: 'app_ajouter_reclamation')]
    public function nouveau(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationFormType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setUser($this->getUser());
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamations');
        }

        return $this->render('reclamation/admin/reclamationForm.html.twig', [
            'controller_name' => 'ReclamationController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/ajouterReclamation', name: 'app_ajouter_reclamation_user')]
    public function nouveauReclamationUser(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationFormType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setUser($this->getUser());
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamations_user');
        }

        return $this->render('reclamation/reclamationFormUser.html.twig', [
            'controller_name' => 'ReclamationController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reclamation/{id}/modifier', name: 'app_modifier_reclamation')]
    public function modifier(Request $request, Reclamation $reclamation, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ReclamationFormType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('app_reclamations');
        }

        return $this->render('reclamation/admin/editReclamation.html.twig', [
            'form' => $form->createView(),
            'editMode' => true
        ]);
    }

    #[Route('/reclamation/{id}/delete', name: 'app_supprimer_reclamation', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reclamation->getId(), $request->request->get('_token'))) {
            $em->remove($reclamation);
            $em->flush();
        }

        return $this->redirectToRoute('app_reclamations');
    }
}
