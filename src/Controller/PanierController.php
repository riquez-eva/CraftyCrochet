<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

final class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(SessionInterface $session, ArticleRepository $repo): Response
    {
        $panier = $session->get("panier", []);

        dump($panier);

        $panier_pour_twig = [];

        foreach($panier as $id_article => $quantite){
            $article = $repo->find($id_article);
            $panier_pour_twig[] = [
                "article" => $article,
                "quantite" => $quantite
            ];
        }

        dump($panier_pour_twig);

        return $this->render('panier/index.html.twig', [
            'panier' =>  $panier_pour_twig,
        ]);
    }

    #[Route('/panier/add/{article}', name: 'app_add_panier')]
    public function panier_add(Article $article, SessionInterface $session): Response
    {
       $panier = $session->get("panier", []);

        if(isset($panier[$article->getId()])){
            $panier[$article->getId()]++; 
        }else{
            $panier[$article->getId()] = 1;
        }


       $session->set("panier", $panier);
        return $this->redirect("/panier");
    }

     #[Route('/panier/del/{article}', name: 'app_del_panier')]
    public function panier_del(Article $article, SessionInterface $session): Response
    {
       $panier = $session->get("panier", []);

        if(isset($panier[$article->getId()])){
            $panier[$article->getId()]--; 
            if($panier[$article->getId()] ==0){
                unset($panier[$article->getId()]);
            }
        }

       $session->set("panier", $panier);
        return $this->redirect("/panier");
    }
}
