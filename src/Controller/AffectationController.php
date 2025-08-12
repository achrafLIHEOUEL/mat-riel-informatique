<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Affectation;
use App\Form\AffectationFormType;
use App\Repository\AffectationRepository;
use Doctrine\ORM\EntityManagerInterface;



final class AffectationController extends AbstractController
{
    #[Route('/affectation', name: 'app_affectation')]
   public function affectations(AffectationRepository $affectationRepository): Response
{
$affectations = $affectationRepository -> findall();
return $this->render('affectation/listeAffectation.html.twig', [
        'affectations' => $affectations,
    ]);
}


    #[Route('/ajouteraffectation', name: 'app_new_affectation')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $affectation = new Affectation();
        $form = $this->createForm(AffectationFormType::class, $affectation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($affectation);
            $em->flush();

            $this->addFlash('success', 'Matériel affecté avec succès !');
            return $this->redirectToRoute('app_new_affectation'); 
        }

        return $this->render('affectation/affectationForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

#[Route('/materiel/{id}/modifier', name: 'app_modifier_affectation')]
public function modifier (Request $request, Affectation $affectation, EntityManagerInterface $em): Response
{
    $form = $this->createForm(AffectationFormType::class, $affectation);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush(); 
        return $this->redirectToRoute('app_affectation'); 
    }

    return $this->render('affectation/editAffectation.html.twig', [
        'form' => $form->createView(),
        'editMode' => true
    ]);
}

    
    #[Route('/materiel/{id}/delete', name: 'app_supprimer_affectation', methods: ['POST'])]
public function delete(Request $request, Affectation $Affectation, EntityManagerInterface $em): Response
{
    if ($this->isCsrfTokenValid('delete' . $Affectation->getId(), $request->request->get('_token'))) {
        $em->remove($Affectation);
        $em->flush();
    }

    return $this->redirectToRoute('app_affectation');
}
}
