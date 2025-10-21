<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
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

        $manager->flush();
    }
}
