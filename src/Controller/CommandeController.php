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
    ): Response {
        $panier = $session->get('panier', []);

        // 🚨 Vérification : panier vide
        if (empty($panier)) {
            $this->addFlash('warning', 'Votre panier est vide.');
            return $this->redirectToRoute('app_panier');
        }

        // 🧾 Préparation du récapitulatif et calcul du total
        $articles = [];
        $total = 0;

        foreach ($panier as $id_article => $quantite) {
            $article = $repo->find($id_article);
            if ($article) {
                $articles[] = [
                    'libelle' => $article->getLibelle(),
                    'prix' => $article->getPrix(),
                    'quantite' => $quantite,
                    'sous_total' => $article->getPrix() * $quantite,
                ];
                $total += $article->getPrix() * $quantite;
            }
        }

        // 📨 Soumission du formulaire
        if ($request->isMethod('POST')) {
            $nom = trim($request->request->get('nom'));
            $adresse = trim($request->request->get('adresse'));
            $email = trim($request->request->get('email'));

            // ⚙️ Création de la commande
            $commande = new Commande();
            $commande->setDateDeCommmande(new \DateTime());
            $commande->setTotal($total);
            $commande->setEtat(0);
            $commande->setNom($nom);
            $commande->setAdresse($adresse);
            $commande->setEmail($email);

            // 💾 Enregistrement
            $manager->persist($commande);
            $manager->flush();

            // 🧹 Nettoyage du panier
            $session->remove('panier');

            $this->addFlash('success', 'Votre commande a été enregistrée avec succès !');

            return $this->redirectToRoute('app_home');
        }

        // 🖥️ Affichage du template
        return $this->render('commande/commander.html.twig', [
            'total' => $total,
            'panier' => $articles,
        ]);
    }
}
