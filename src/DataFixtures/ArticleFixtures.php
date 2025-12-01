<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Config\Security\ProviderConfig\Memory\UserConfig;

class ArticleFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $hasher) {}


    public function load(ObjectManager $manager): void
    {
        //Users
        $users = [];


        $admin = new Utilisateur();
        $admin->setUsername('Administrateur de Crafty Crochet')
            ->setEmail('admin@craftyCrochet.fr')
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN']);

        $password_hash = $this->hasher->hashPassword($admin, "123456");

        $admin->setPassword($password_hash);

        $users[] = $admin;
        $manager->persist($admin);

        //categories
        $categories = [];

        // Tableau clé = nom humain / valeur = slug
        $nomsCategories = [
            'Accessoires' => [
                'slug' => 'accessoires',
                'image' => 'TitreAccessoires.svg',
                'imagePreview' => 'PreviewAccessoires.svg',
            ],
            'Vetements' => [
                'slug' => 'vetements',
                'image' => 'TitreVetements.svg',
                'imagePreview' => 'PreviewVetements.svg',
            ],
            'Decorations' => [
                'slug' => 'decorations',
                'image' => 'TitreDecorations.svg',
                'imagePreview' => 'PreviewDecorations.svg',

            ]
        ];

        foreach ($nomsCategories as $nom => $data) {
            $categorie = new Categorie();
            $categorie->setLibelle($nom);
            $categorie->setSlug($data['slug']);
            $categorie->setImage($data['image']);
            $categorie->setImagePreview($data['imagePreview']);
            $categorie->setActive(true);

            $manager->persist($categorie);
            $categories[$nom] = $categorie;
        }

        // Articles
        $article1 = new Article();
        $article1->setLibelle('e-chat-rpe');
        $article1->setDescription('Vous aimez les chats? Vous avez froid? Optez pour cette écharpe trop mimi!');
        $article1->setPrix(30.00);
        $article1->setImage('Accecharpechat.jpeg');
        $article1->setActive(true);
        $article1->setCategorie($categories['Accessoires']); // ✅ correspond bien à la clé ci-dessus
        $manager->persist($article1);

        $article2 = new Article();
        $article2->setLibelle('Cardigan Fleuri');
        $article2->setDescription('Petit cardigan en 100% mohair, tout doux');
        $article2->setPrix(60.00);
        $article2->setImage('Wearcardiganfleurjaune.jpeg');
        $article2->setActive(true);
        $article2->setCategorie($categories['Vetements']); // ✅ sans accent
        $manager->persist($article2);

        $article3 = new Article();
        $article3->setLibelle('Coussin Miffy');
        $article3->setDescription('Coussin Miffy en fil chenille doux au toucher');
        $article3->setPrix(20.00);
        $article3->setImage('Decomiffycushion.jpeg');
        $article3->setActive(true);
        $article3->setCategorie($categories['Decorations']); // ✅ sans accent
        $manager->persist($article3);

        $article4 = new Article();
        $article4->setLibelle('Echarpe Magic Ball');
        $article4->setDescription('Une écharpe XXL pour vous tenir chaud tout l\'hiver. Et être stylé en plus');
        $article4->setPrix(34.95);
        $article4->setImage('Accecharphemagicball.jpeg');
        $article4->setActive(true);
        $article4->setCategorie($categories['Accessoires']); // ✅ sans accent
        $manager->persist($article4);

        $article5 = new Article();
        $article5->setLibelle('Heart Bag');
        $article5->setDescription('un petit sac pour vous accompagner lors de vos sorties!');
        $article5->setPrix(49.95);
        $article5->setImage('Accheartbag.jpeg');
        $article5->setActive(true);
        $article5->setCategorie($categories['Accessoires']); // ✅ sans accent
        $manager->persist($article5);

        $article6 = new Article();
        $article6->setLibelle('Porte Lunette');
        $article6->setDescription('Une place toute mimi pour vos lunettes. PLus de raison de les perdre!');
        $article6->setPrix(49.95);
        $article6->setImage('Decoportelunette.jpeg');
        $article6->setActive(true);
        $article6->setCategorie($categories['Decorations']); // ✅ sans accent
        $manager->persist($article6);

        $article7 = new Article();
        $article7->setLibelle('Pull oversized');
        $article7->setDescription('Pull parfait pour se sentir confortable et au chaud cet hiver');
        $article7->setPrix(49.95);
        $article7->setImage('Wearoversizepull.jpeg');
        $article7->setActive(true);
        $article7->setCategorie($categories['Vetements']); // ✅ sans accent
        $manager->persist($article7);

        $manager->flush();
    }
}
