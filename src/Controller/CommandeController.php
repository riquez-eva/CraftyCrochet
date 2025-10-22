<?php

namespace App\Controller;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CommandeController extends AbstractController
{
    #[Route('/commander', name: 'app_commander')]
    public function commander(
        SessionInterface $session,
        ArticleRepository $repo,
        EntityManagerInterface $manager,
        Request $request
    ): Response
    {
        $panier = $session->get('panier', []);

        if (empty($panier)){
            $this->addFlash('warning', 'Votre panier est vide.');
            return $this->redirectToRoute('app_panier');
        }

        //Cacul total du panier

        $total = 0;
        foreach ($panier as $id_article => $quantite) {
            $article = $repo->find($id_article);
            if ($article){
                $total += $article->getPrix() * $quantite;
            }
        }

        //Si on soumet le formulaire (on fera le vrai formulaire plus tard)
        /** @var \App\Entity\Commande|null $commande */
        if ($request->isMethod('POST')) {
            $commande = new Commande();
            $commande->setDateDeCommande(new \DateTime());
            $commande->setTotal($total);
            $commande->setEtat(0);

            $manager->persist($commande);
            $manager->flush();

            $session->remove('panier');

            $this->addFlash('success', 'Votre commande a été enregistrée avec succès!');

            return $this->redirectToRoute('app_panier');
        }

        return $this->render('commande/commander.html.twig', [
            'total' => $total,
        ]);
    }
}
