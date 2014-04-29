<?php

namespace Digmore\PoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Digmore\PoolBundle\Form\PoolType;

class PoolController extends Controller
{
    /**
     */
    public function listAction()
    {
        return $this->render('PoolBundle:Pool:index.html.twig');
    }

    public function addAction()
    {
    }

    public function viewAction($id = false)
    {
        return $this->render(
            'PoolBundle:Pool:view.html.twig',
            array('name' => $id)
        );
    }

    public function editAction($id = false)
    {
    }

    public function removeAction($id = false)
    {
    }

    /**
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(new ContactType());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $mailer = $this->get('mailer');

            // .. setup a message and send it
            // http://symfony.com/doc/current/cookbook/email.html

            $request->getSession()->getFlashBag()->set('notice', 'Message sent!');

            return new RedirectResponse($this->generateUrl('_demo'));
        }

        return array('form' => $form->createView());
    }
}
