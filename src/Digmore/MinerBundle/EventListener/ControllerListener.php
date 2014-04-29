<?php

namespace Digmore\MinerBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Digmore\MinerBundle\Twig\Extension\MinerExtension;

class ControllerListener
{
    protected $extension;

    public function __construct(MinerExtension $extension)
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
