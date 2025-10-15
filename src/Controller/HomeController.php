<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function home(ArticleRepository $articleRepository): Response
    {
        //On récupère tout les articles actifs
        $articles = $articleRepository->findBy(['active' => true], ['id' => 'ASC']);
        // le "1" à la fun limite à un seul article (le best-seller)

        return $this->render('home/home.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/details', name: 'app_details')]
    public function details(): Response
    {
        return $this->render('home/details.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
