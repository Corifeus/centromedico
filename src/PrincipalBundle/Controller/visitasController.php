<?php

namespace PrincipalBundle\Controller;

use PrincipalBundle\Entity\visitas;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Visita controller.
 *
 */
class visitasController extends Controller
{
    /**
     * Lists all visita entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $visitas = $em->getRepository('PrincipalBundle:visitas')->findAll();

        return $this->render('visitas/index.html.twig', array(
            'visitas' => $visitas,
        ));
    }

    /**
     * Creates a new visita entity.
     *
     */
    public function newAction(Request $request)
    {
        $visita = new Visitas();
        $form = $this->createForm('PrincipalBundle\Form\visitasType', $visita);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($visita);
            $em->flush();

            return $this->redirectToRoute('visitas_show', array('id' => $visita->getId()));
        }

        return $this->render('visitas/new.html.twig', array(
            'visita' => $visita,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a visita entity.
     *
     */
    public function showAction(visitas $visita)
    {
        $deleteForm = $this->createDeleteForm($visita);

        return $this->render('visitas/show.html.twig', array(
            'visita' => $visita,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing visita entity.
     *
     */
    public function editAction(Request $request, visitas $visita)
    {
        $deleteForm = $this->createDeleteForm($visita);
        $editForm = $this->createForm('PrincipalBundle\Form\visitasType', $visita);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('visitas_edit', array('id' => $visita->getId()));
        }

        return $this->render('visitas/edit.html.twig', array(
            'visita' => $visita,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a visita entity.
     *
     */
    public function deleteAction(Request $request, visitas $visita)
    {
        $form = $this->createDeleteForm($visita);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($visita);
            $em->flush();
        }

        return $this->redirectToRoute('visitas_index');
    }

    /**
     * Creates a form to delete a visita entity.
     *
     * @param visitas $visita The visita entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(visitas $visita)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('visitas_delete', array('id' => $visita->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
