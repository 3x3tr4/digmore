<?php

namespace Digmore\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'MainBundle:Security:login.html.twig',
            array(
                'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }

    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }

    /**
     */
    public function helloAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function helloadminAction($name)
    {
        return array('name' => $name);
    }
}
