<?php
namespace Digmore\PoolBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
//use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Digmore\PoolBundle\DependencyInjection\PoolExtension;

class ControllerListener
{
    protected $extension;

    public function __construct(PoolExtension $extension)
    {
        $this->extension = $extension;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        //$controller = $event->getController();

        $message = sprintf(
            'Event of class%s request type is %s.',
            $event->getName(),
            $event->getRequestType()
        );

        /*if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType())
        {
            $this->extension->setController(
                $event->getController()
            );
        }

        $response = new Response();
        $response->setContent($message);

        if ($event instanceof HttpKernelInterface) {
            $response->setStatusCode(
                $event->getStatusCode()
            );
            $response->headers->replace(
                $event->getHeaders()
            );
        } else {
            $response->setStatusCode(
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }*/

        // Send the modified response object to the event
        //$event->setResponse($response);
    }
}
