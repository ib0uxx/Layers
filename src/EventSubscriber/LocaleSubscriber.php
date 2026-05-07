<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LocaleSubscriber implements EventSubscriberInterface
{
    private $defaultLocale = 'fr';

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        // use session locale if set
        $session = $request->getSession();
        if ($session instanceof SessionInterface && $session->has('_locale')) {
            $request->setLocale($session->get('_locale'));
            return;
        }

        // otherwise use default
        $request->setLocale($this->defaultLocale);
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }
}
