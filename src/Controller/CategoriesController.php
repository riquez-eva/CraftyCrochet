<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function categories(): Response
    {
        return $this->render('categories/categories.html.twig', [
            'controller_name' => 'CategoriesController',
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
