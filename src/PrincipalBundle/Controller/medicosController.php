<?php

namespace PrincipalBundle\Controller;

use PrincipalBundle\Entity\medicos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PrincipalBundle\Entity\centrosmedicos;

/**
 * Medico controller.
 *
 */
class medicosController extends Controller
{
    /**
     * Lists all medico entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $medicos = $em->getRepository('PrincipalBundle:medicos')->findAll();

        return $this->render('medicos/index.html.twig', array(
            'medicos' => $medicos,
        ));
    }

    /**
     * Creates a new medico entity.
     *
     */
    public function newAction(Request $request)
    {
        $medico = new Medicos();
        $form = $this->createForm('PrincipalBundle\Form\medicosType', $medico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medico);
            $em->flush();

            return $this->redirectToRoute('medicos_show', array('id' => $medico->getId()));
        }

        return $this->render('medicos/new.html.twig', array(
            'medico' => $medico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a medico entity.
     *
     */
    public function showAction(medicos $medico)
    {
        $deleteForm = $this->createDeleteForm($medico);


        return $this->render('medicos/show.html.twig', array(
            'medico' => $medico,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing medico entity.
     *
     */
    public function editAction(Request $request, medicos $medico)
    {
        $deleteForm = $this->createDeleteForm($medico);
        $editForm = $this->createForm('PrincipalBundle\Form\medicosType', $medico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medicos_edit', array('id' => $medico->getId()));
        }

        return $this->render('medicos/edit.html.twig', array(
            'medico' => $medico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a medico entity.
     *
     */
    public function deleteAction(Request $request, medicos $medico)
    {
        $form = $this->createDeleteForm($medico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($medico);
            $em->flush();
        }

        return $this->redirectToRoute('medicos_index');
    }

    /**
     * Creates a form to delete a medico entity.
     *
     * @param medicos $medico The medico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(medicos $medico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('medicos_delete', array('id' => $medico->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
