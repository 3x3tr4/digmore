<?php

namespace Digmore\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Digmore\MinerBundle\Entity\Miner;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */
        return $this->render('MainBundle:Default:index.html.twig');
    }

    public function homeAction()
    {
        $miners = $this->getDoctrine()
            ->getRepository('MinerBundle:Miner')
            //->findAllOrderedByName();
            ->findAll();

        if (! count($miners))
        {
            throw $this->createNotFoundException('No miners found!');
        }

        return $this->render(
            'MainBundle:Default:home.html.twig',
            array(
                'miners' => $miners
            )
        );
    }
}
