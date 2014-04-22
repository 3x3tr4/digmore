<?php

namespace Digmore\MinerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Digmore\MinerBundle\Entity\Miner;
use Digmore\MinerBundle\Form\MinerType;

/**
 * Miner controller.
 *
 */
class MinerController extends Controller
{
    /**
     * Lists all Miner entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $miners = $em
            ->getRepository('MinerBundle:Miner')
            ->findAll();

        /*return $this->render(
            'MinerBundle:Miner:miner-set.html.twig',
            array(
                'miners' => $miners
            )
        );*/
        return $this->render(
            'MinerBundle:Miner:index.html.twig',
            array(
                'miners' => $miners
            )
        );
    }

    /**
     * Creates a new Miner entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Miner();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('miner_show', array('id' => $entity->getId())));
        }

        return $this->render(
            'MinerBundle:Miner:new.html.twig',
            array(
                'entity' => $entity,
                'form'   => $form->createView()
            )
        );
    }

    /**
    * Creates a form to create a Miner entity.
    *
    * @param Miner $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Miner $entity)
    {
        $form = $this->createForm(new MinerType(), $entity, array(
            'action' => $this->generateUrl('miner_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Finds and displays a Miner entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MinerBundle:Miner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Miner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'MinerBundle:Miner:show.html.twig',
            array(
                'entity'      => $entity,
                'delete_form' => $deleteForm->createView()
            )
        );
    }

    /**
    * Creates a form to edit a Miner entity.
    *
    * @param Miner $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Miner $entity)
    {
        $form = $this->createForm(new MinerType(), $entity, array(
            'action' => $this->generateUrl('miner_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Miner entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MinerBundle:Miner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Miner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('miner_update', array('id' => $id)));
        }

        return $this->render(
            'MinerBundle:Miner:edit.html.twig',
            array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView()
            )
        );
    }

    /**
     * Deletes a Miner entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $entity = $em
                ->getRepository('MinerBundle:Miner')
                ->find($id);

            if (!$entity)
            {
                throw $this->createNotFoundException('Unable to find Miner entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('miner'));
    }

    /**
     * Creates a form to delete a Miner entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction(
                    $this->generateUrl(
                        'miner_delete',
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
}
