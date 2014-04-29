<?php

namespace Digmore\DeviceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Digmore\DeviceBundle\Entity\Device;
use Digmore\DeviceBundle\Form\DeviceType;

/**
 * Device controller.
 *
 */
class DeviceController extends Controller {
    /**
     * Lists all Device entities.
     *
     */
    public function listAction()
    {
        $entities = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('DeviceBundle:Device')
            ->findAll();

        return $this->render(
            'DeviceBundle:Device:index.html.twig',
            array(
                'entities' => $entities
            )
        );
    }

    /**
     * Creates a form to create a Device entity.
     *
     * @param Device $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createAddForm(Device $entity)
    {
        $form = $this->createForm(
            new DeviceType(),
            $entity,
            array(
                'action' => $this->generateUrl('device_create'),
                'method' => 'POST'
            )
        );

        $form->add(
            'submit',
            'submit',
            array('label' => 'Create')
        );

        return $form;
    }

    /**
     * Creates a new Device entity.
     *
     */
    public function addAction(Request $request)
    {
        $entity = new Device();
        $form = $this->createAddForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                $this->generateUrl(
                    'device_read',
                    array('id' => $entity->getId())
                )
            );
        }

        return $this->render(
            'DeviceBundle:Device:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView()
            )
        );
    }

    /**
     * Finds and displays a Device entity.
     *
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeviceBundle:Device')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Device entity.');
        }

        $deleteForm = $this->createRemoveForm($id);

        return $this->render(
            'DeviceBundle:Device:show.html.twig',
            array(
                'entity'      => $entity,
                'delete_form' => $deleteForm->createView()
            )
        );
    }

    /**
    * Creates a form to edit a Device entity.
    *
    * @param Device $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Device $entity)
    {
        $form = $this->createForm(new DeviceType(), $entity, array(
            'action' => $this->generateUrl('device_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Device entity.
     *
     */
    public function editAction(Request $request, $id = false)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeviceBundle:Device')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Device entity.');
        }

        $deleteForm = $this->createRemoveForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('device_update', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to delete a Device entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createRemoveForm($id = false)
    {
        return $this
            ->createFormBuilder()
            ->setAction(
                $this->generateUrl(
                    'device_delete',
                    array('id' => $id)
                )
            )
            ->setMethod('DELETE')
            ->add(
                'submit',
                'submit',
                array('label' => 'Delete')
            )
            ->getForm();
    }

    /**
     * Deletes a Device entity.
     *
     */
    public function removeAction(Request $request, $id = false)
    {
        $form = $this->createRemoveForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DeviceBundle:Device')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Device entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('device'));
    }
}
