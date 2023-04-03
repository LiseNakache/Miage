<?php

namespace MS\PlatformBundle\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class RedirectAfterRegistration implements EventSubscriberInterface
{

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }


    public function onRegistrationSuccess(FormEvent $event)
    {
        $url = $this->router->generate('fos_user_registration_register');
        $response = new RedirectResponse($url);
        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
        ];
    }
}