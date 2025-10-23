<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        $user = $this->getUser();

            if (!$user) {
        // Redirige vers la page de login si personne n'est connecté
        return $this->redirectToRoute('app_login');
    }


        return $this->render('profil/profil.html.twig', [
            'user' => $user,
        ]);
    }
}
