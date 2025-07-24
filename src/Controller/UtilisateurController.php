<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

final class UtilisateurController extends AbstractController
{
    #[Route('/employees', name: 'app_utilisateur')]
    public function users(UserRepository $userRepository): Response
    {
        $users = $userRepository -> findall();
        return $this->render('utilisateur/listeUtilisateur.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/employees/{id}/delete', name: 'app_supprimer_utilisateur', methods: ['POST'])]
public function delete(Request $request, User $user, EntityManagerInterface $em): Response
{
    if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
        $em->remove($user);
        $em->flush();
    }

    return $this->redirectToRoute('app_utilisateur');
}

}
