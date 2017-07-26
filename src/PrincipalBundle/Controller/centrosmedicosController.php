<?php

namespace PrincipalBundle\Controller;

use PrincipalBundle\Entity\centrosmedicos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Centrosmedico controller.
 *
 */
class centrosmedicosController extends Controller
{
    /**
     * Lists all centrosmedico entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $centrosmedicos = $em->getRepository('PrincipalBundle:centrosmedicos')->findAll();

        return $this->render('centrosmedicos/index.html.twig', array(
            'centrosmedicos' => $centrosmedicos,
        ));
    }

    /**
     * Creates a new centrosmedico entity.
     *
     */
    public function newAction(Request $request)
    {
        $centrosmedico = new Centrosmedicos();
        $form = $this->createForm('PrincipalBundle\Form\centrosmedicosType', $centrosmedico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($centrosmedico);
            $em->flush();

            return $this->redirectToRoute('centrosmedicos_show', array('id' => $centrosmedico->getId()));
        }

        return $this->render('centrosmedicos/new.html.twig', array(
            'centrosmedico' => $centrosmedico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a centrosmedico entity.
     *
     */
    public function showAction(centrosmedicos $centrosmedico)
    {
        $deleteForm = $this->createDeleteForm($centrosmedico);

        return $this->render('centrosmedicos/show.html.twig', array(
            'centrosmedico' => $centrosmedico,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing centrosmedico entity.
     *
     */
    public function editAction(Request $request, centrosmedicos $centrosmedico)
    {
        $deleteForm = $this->createDeleteForm($centrosmedico);
        $editForm = $this->createForm('PrincipalBundle\Form\centrosmedicosType', $centrosmedico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('centrosmedicos_edit', array('id' => $centrosmedico->getId()));
        }

        return $this->render('centrosmedicos/edit.html.twig', array(
            'centrosmedico' => $centrosmedico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a centrosmedico entity.
     *
     */
    public function deleteAction(Request $request, centrosmedicos $centrosmedico)
    {
        $form = $this->createDeleteForm($centrosmedico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($centrosmedico);
            $em->flush();
        }

        return $this->redirectToRoute('centrosmedicos_index');
    }

    /**
     * Creates a form to delete a centrosmedico entity.
     *
     * @param centrosmedicos $centrosmedico The centrosmedico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(centrosmedicos $centrosmedico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('centrosmedicos_delete', array('id' => $centrosmedico->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
