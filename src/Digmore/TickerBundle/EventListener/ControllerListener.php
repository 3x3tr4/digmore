<?php

namespace Digmore\TickerBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Digmore\TickerBundle\DependencyInjection\TickerExtension;

class ControllerListener
{
    protected $extension;

    public function __construct(TickerExtension $extension)
    {
        $this->extension = $extension;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        /*if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) {
            $this->extension->setController($event->getController());
        }*/
    }
}
