<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

class CartSubscriber implements EventSubscriberInterface
{
    private $requestStack;
    private $twig;

    public function __construct(RequestStack $requestStack, Environment $twig)
    {
        $this->requestStack = $requestStack;
        $this->twig = $twig;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $request = $event->getRequest();

        // Empêcher la session sur les endpoints API (sinon erreur 500)
        if (str_starts_with($request->getPathInfo(), '/api')) {
            return;
        }

        $session = $request->getSession();
        $panier = $session->get('panier', []);
        $cartCount = array_sum($panier);

        $this->twig->addGlobal('cartCount', $cartCount);
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}
