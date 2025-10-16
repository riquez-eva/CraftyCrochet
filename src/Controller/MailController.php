<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MailController extends AbstractController
{
    #[Route('/mail', name: 'app_mail')]
    public function sendEmail(Request $request, MailerInterface $mailer): Response
    {

        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $data = $form->getData();

            //dd($data);

            $email = (new TemplatedEmail())
                ->from($data->getEmail())
                ->to('admin@site.com')
                ->subject($data->getObjet())
                ->html($data->getMessage())
                ->htmlTemplate('mail/message.html.twig')
                ->context([
                   'message' => $data->getMessage(),
                ]);

                ;
    
            $mailer->send($email);

            $this->addFlash(
                'notice',
                'Votre message a bien été envoyé!'
            );

            return $this->redirect('/home');
        }

        return $this->render('mail/index.html.twig', [
            'form' => $form,
        ]);
    }
}
