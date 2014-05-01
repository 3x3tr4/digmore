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

        $miners = $em->getRepository('MinerBundle:Miner')->findAll();

        /*return $this->render(
            'MinerBundle:Miner:miner-set.html.twig',
            array(
                'miners' => $miners
            )
        );*/
        return $this->render(
            'MinerBundle:Miner:index.html.twig',
            array('miners' => $miners)
        );
    }

    /**
     * Create miner
     *
     */
    public function addAction(Request $request)
    {
        $entity = new Miner();
        $form = $this->createAddForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                $this->generateUrl(
                    'miner_read',
                    array('id' => $entity->getId())
                )
            );
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
    private function getCreateForm(Miner $entity)
    {
        return $this
        ->createForm(
            new MinerType(),
            $entity,
            array(
                'action' => $this->generateUrl('miner_create'),
                'method' => 'POST',
            )
        )
        ->add(
            'submit',
            'submit',
            array('label' => 'Create')
        );
    }


    /**
     * Read miner
     *
     */
    public function viewAction($id = false)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MinerBundle:Miner')->find($id);

        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Miner entity.');
        }

        $deleteForm = $this->getDeleteForm($id);

        return $this->render(
            'MinerBundle:Miner:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView()
            )
        );
    }

    /**
    * Get miner-update form
    *
    * @param Miner $entity miner
    *
    * @return \Symfony\Component\Form\Form miner-update form
    */
    private function getUpdateForm(Miner $entity)
    {
        return $this
        ->createForm(
            new MinerType(),
            $entity,
            array(
                'action' => $this->generateUrl(
                    'miner_update',
                    array('id' => $entity->getId())
                ),
                'method' => 'PUT',
            )
        )
        ->add(
            'submit',
            'submit',
            array('label' => 'Update')
        );
    }

    /**
     * Update miner
     *
     */
    public function editAction(Request $request, $id = false)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MinerBundle:Miner')->find($id);

        if (! $entity) {
            throw $this->createNotFoundException('Unable to find Miner entity.');
        }

        $deleteForm = $this->getDeleteForm($id);

        $updateForm = $this->getUpdateForm($entity);

        $updateForm->handleRequest($request);

        if ($updateForm->isValid()) {
            $em->flush();

            return $this->redirect(
                $this->generateUrl(
                    'miner_update',
                    array('id' => $id)
                )
            );
        }

        return $this->render(
            'MinerBundle:Miner:update.html.twig',
            array(
                'entity' => $entity,
                'update_form' => $updateForm->createView(),
                'delete_form' => $deleteForm->createView()
            )
        );
    }

    /**
     * Get miner-delete form
     *
     * @param mixed $id miner ID
     *
     * @return \Symfony\Component\Form\Form miner-delete form
     */
    private function getDeleteForm($id)
    {
    	return $this
    	->createFormBuilder()
    	->setAction(
			$this->generateUrl(
				'miner_delete',
				array('id' => $id)
			)
	    )
	    ->setMethod(
	        'DELETE'
	    )
	    ->add(
	        'submit',
	        'submit',
	        array('label' => 'Delete')
	    )
	    ->getForm();
    }


    /**
     * Delete miner
     *
     */
    public function removeAction(Request $request, $id = false)
    {
        $form = $this->getDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('MinerBundle:Miner')->find($id);

            if (! $entity)
            {
                throw $this->createNotFoundException('Unable to find Miner entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect(
            $this->generateUrl('miner')
    	);
    }
}
