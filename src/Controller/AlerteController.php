<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AlerteFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Alerte;
use App\Repository\AlerteRepository;

final class AlerteController extends AbstractController
{
    #[Route('/admin/alerte', name: 'app_alerte')]
    public function alerte(AlerteRepository $alerteRepository): Response
    {
        $alertes = $alerteRepository -> findall();
        return $this->render('alerte/admin/listeAlerte.html.twig',[
            "alertes" => $alertes,
        ]);
    }


    #[Route('/admin/ajouteralerte', name: 'app_ajouter_alerte')]
    public function nouveauAlerte(Request $request, EntityManagerInterface $entityManager): Response
    {
      $alerte = new Alerte();
      $form = $this->createForm(AlerteFormType::class, $alerte);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManager->persist($alerte);
            $entityManager->flush();

    
            return $this->redirectToRoute('app_alerte');
        }



        return $this->render('alerte/admin/alerteForm.html.twig', [
            'controller_name' => 'AlerteController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/ajouteralerte', name: 'app_ajouter_alerte_user')]
    public function nouveauAlerteUser(Request $request, EntityManagerInterface $entityManager): Response
    {
      $alerte = new Alerte();
      $form = $this->createForm(AlerteFormType::class, $alerte);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManager->persist($alerte);
            $entityManager->flush();

    
            return $this->redirectToRoute('app_alerte');
        }



        return $this->render('alerte/alerteFormUser.html.twig', [
            'controller_name' => 'AlerteController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/alerte/{id}/modifier', name: 'app_modifier_alerte')]
public function modifier (Request $request, Alerte $alerte, EntityManagerInterface $em): Response
{
    $form = $this->createForm(AlerteFormType::class, $alerte);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush(); 
        return $this->redirectToRoute('app_alerte'); 
    }

    return $this->render('alerte/admin/editAlerte.html.twig', [
        'form' => $form->createView(),
        'editMode' => true
    ]);
}


 #[Route('/alerte/{id}/delete', name: 'app_supprimer_alerte', methods: ['POST'])]
public function delete(Request $request, Alerte $alerte, EntityManagerInterface $em): Response
{
    if ($this->isCsrfTokenValid('delete' . $alerte->getId(), $request->request->get('_token'))) {
        $em->remove($alerte);
        $em->flush();
    }

    return $this->redirectToRoute('app_alerte');
}

}
