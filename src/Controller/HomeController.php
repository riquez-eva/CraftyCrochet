<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ContactFormType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(ArticleRepository $articleRepository): Response
    {
        //On récupère tout les articles actifs
        $articles = $articleRepository->findBy(['active' => true], ['id' => 'ASC']);
        // le "1" à la fun limite à un seul article (le best-seller)

        //Le carousel randomisé
         $allArticles = $articleRepository->findby(['active' => true]);

         //mélange le tableau en PHP (fonctionne avec toute les bases de données)
        shuffle($allArticles);

        //prends les 2 premières lignes après mélange 
        $randomArticles = array_slice($allArticles, 0, 2);

        return $this->render('home/home.html.twig', [
            'articles' => $articles,
            'randomArticles' => $randomArticles,
        ]);
    }

    #[Route('/details/{id}', name: 'app_details')]
    public function details(Article $article): Response
    {
        return $this->render('home/details.html.twig', [
            'article' => $article,
        ]);
    }

  /*  #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {

       $form = $this->createForm(ContactFormType::class);

        return $this->render('home/contact.html.twig', [
            "form" => $form    
        ]);
    }*/
}
