<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MaterielFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Materiel;
use App\Repository\MaterielRepository;


final class MaterielController extends AbstractController
{
        #[Route('admin/materiels', name: 'app_materiels')]
public function materiels(MaterielRepository $materielRepository): Response
{

$materiels = $materielRepository -> findall();
return $this->render('materiel/admin/listeMateriel.html.twig', [
        'materiels' => $materiels,
    ]);
}

  #[Route('/materiels', name: 'app_user_materiels')]
public function Usermateriels(MaterielRepository $materielRepository): Response
{

$materiels = $materielRepository -> findall();
return $this->render('materiel/UserlisteMateriel.html.twig', [
        'materiels' => $materiels,
    ]);
}


    #[Route('admin/ajouterMateriel', name: 'app_ajouter_materiel')]
    public function nouveau(Request $request, EntityManagerInterface $entityManager): Response
    {
      $materiel = new Materiel();
      $form = $this->createForm(MaterielFormType::class, $materiel);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManager->persist($materiel);
            $entityManager->flush();

    
            return $this->redirectToRoute('app_materiels');
        }



        return $this->render('materiel/admin/materielForm.html.twig', [
            'controller_name' => 'MaterielController',
            'form' => $form->createView(),
        ]);
    }



#[Route('/materiel/{id}/modifier', name: 'app_modifier_materiel')]
public function modifier (Request $request, Materiel $materiel, EntityManagerInterface $em): Response
{
    $form = $this->createForm(MaterielFormType::class, $materiel);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush(); 
        return $this->redirectToRoute('app_materiels'); 
    }

    return $this->render('materiel/admin/editMateriel.html.twig', [
        'form' => $form->createView(),
        'editMode' => true
    ]);
}

#[Route('/materiel/{id}/delete', name: 'app_supprimer_materiel', methods: ['POST'])]
public function delete(Request $request, Materiel $materiel, EntityManagerInterface $em): Response
{
    if ($this->isCsrfTokenValid('delete' . $materiel->getId(), $request->request->get('_token'))) {
        $em->remove($materiel);
        $em->flush();
    }

    return $this->redirectToRoute('app_materiels');
}


    
}
