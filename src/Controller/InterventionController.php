<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\InterventionRepository;
use App\Entity\Intervention;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\InterventionFormType;

final class InterventionController extends AbstractController
{

     #[Route('/intervention', name: 'app_interventions')]
public function materiels(InterventionRepository $interventionRepository): Response
{
$interventions = $interventionRepository -> findall();
return $this->render('intervention/listeIntervention.html.twig', [
        'interventions' => $interventions,
    ]);
}


   #[Route('/ajouterIntervention', name: 'app_ajouter_intervention')]
    public function nouveau(Request $request, EntityManagerInterface $entityManager): Response
    {
      $intervention = new Intervention();
      $form = $this->createForm(InterventionFormType::class, $intervention);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManager->persist($intervention);
            $entityManager->flush();

    
            return $this->redirectToRoute('app_interventions');
        }



        return $this->render('intervention/interventionForm.html.twig', [
            'controller_name' => 'InterventionController',
            'form' => $form->createView(),
        ]);
    }


#[Route('/intervention/{id}/modifier', name: 'app_modifier_intervention')]
public function modifier (Request $request, Intervention $intervention, EntityManagerInterface $em): Response
{
    $form = $this->createForm(InterventionFormType::class, $intervention);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush(); 
        return $this->redirectToRoute('app_interventions'); 
    }

    return $this->render('intervention/editIntervention.html.twig', [
        'form' => $form->createView(),
        'editMode' => true
    ]);
}

#[Route('/intervention/{id}/delete', name: 'app_supprimer_intervention', methods: ['POST'])]
public function delete(Request $request, Intervention $intervention, EntityManagerInterface $em): Response
{
    if ($this->isCsrfTokenValid('delete' . $intervention->getId(), $request->request->get('_token'))) {
        $em->remove($intervention);
        $em->flush();
    }

    return $this->redirectToRoute('app_interventions');
}
}
