<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('objet', TextType::class, [
                'label' => 'Objet',
                'attr' =>[
                'placeholder' => 'Entrez l\'objet de votre message'
                ],
                "constraints" => [
                    new NotBlank([], "Veuillez renseinger l'objet de votre demande'")
                ]
                ])
            ->add('email', EmailType::class, [
                'label' => 'Votre E-mail',
                'attr' => [
                'placeholder' => 'votre.email@ici.com'],
                "constraints" => [
                    new NotBlank([], "Veuillez renseinger votre email")
                ]
                ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre Message',
                'attr' => [
                'placeholder' => 'Ecrivez ici votre message'],
                "constraints" => [
                    new NotBlank([], "Veuillez écrire votre message")
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Envoyer le message',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            "attr" => ["novalidate" => "novalidate"]
        ]);
    }
}
