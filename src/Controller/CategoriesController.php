<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')] //ATTENTIOOOONNN ici il y a un S a categorieSSSS
    public function categories(CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findBy(['active' => true]);

        return $this->render('categories/categories.html.twig', [
            'categories' => $categories,
       
        ]);
    }


    #[Route('/categorie/{slug}', name: 'app_categorie')]
    public function Showcategories(
        string $slug,
        CategorieRepository $categorieRepository,
        ArticleRepository $articleRepository
        ): Response
    {
        $categorie = $categorieRepository->findOneBy(['slug' => $slug ]);
        
            if(!$categorie){
                throw $this->createNotFoundException('Catégorie non trouvée');
            }

        $articles = $articleRepository->findBy(['active' => true, 'categorie' => $categorie]);


        return $this->render('categories/showCategories.html.twig', [
            'categorie' => $categorie,
            'articles' => $articles,
        ]);
    }




    #[Route('/accessories', name: 'app_accessories')]
    public function accessories(): Response
    {
        

        return $this->render('categories/accessories.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }

    #[Route('/wearable', name: 'app_wearable')]
    public function wearable(): Response
    {
        return $this->render('categories/wearable.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }
    #[Route('/decorations', name: 'app_decorations')]
    public function decorations(): Response
    {
        return $this->render('categories/decorations.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }
}
