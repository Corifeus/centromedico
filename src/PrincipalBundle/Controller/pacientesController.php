<?php

namespace PrincipalBundle\Controller;

use PrincipalBundle\Entity\pacientes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PrincipalBundle\Service\Helpers;

/**
 * Paciente controller.
 *
 */
class pacientesController extends Controller
{
    /**
     * Lists all paciente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pacientes = $em->getRepository('PrincipalBundle:pacientes')->findAll();

        return $this->render('pacientes/index.html.twig', array(
            'pacientes' => $pacientes,
        ));
    }

    /**
     * Creates a new paciente entity.
     *
     */
    public function newAction(Request $request)
    {
        $paciente = new Pacientes();
        $form = $this->createForm('PrincipalBundle\Form\pacientesType', $paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($paciente);
            $em->flush();

            /*NO FUNCIONA ENVIAR EL CORREO AL CREAR UN PACIENTE
            $helpers = $this->get("app.helpers");
            $helpers->sendmail($paciente->getEmail());
            */

            return $this->redirectToRoute('pacientes_show', array('id' => $paciente->getId()));
        }

        return $this->render('pacientes/new.html.twig', array(
            'paciente' => $paciente,
            'form' => $form->createView(),
        ));
    }

    public function pdfAction($id)
    {
        $html = "";

        $repository= $this->getDoctrine()->getRepository('PrincipalBundle:pacientes');
        $paciente = $repository->findOneById($id);        
        
        foreach ($paciente->getVisitas() as $key => $value) {
            $html = $html . "Visita->  " . $value->getFecha()->format("H:i Y-m-d") . "<br>";
        }

        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $helpers = $this->get("app.helpers");
        $helpers->generatePDF($html,$pdf);

    }

    /**
     * Finds and displays a paciente entity.
     *
     */
    public function showAction(pacientes $paciente)
    {
        $deleteForm = $this->createDeleteForm($paciente);

        return $this->render('pacientes/show.html.twig', array(
            'paciente' => $paciente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paciente entity.
     *
     */
    public function editAction(Request $request, pacientes $paciente)
    {
        $deleteForm = $this->createDeleteForm($paciente);
        $editForm = $this->createForm('PrincipalBundle\Form\pacientesType', $paciente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pacientes_edit', array('id' => $paciente->getId()));
        }

        return $this->render('pacientes/edit.html.twig', array(
            'paciente' => $paciente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paciente entity.
     *
     */
    public function deleteAction(Request $request, pacientes $paciente)
    {
        $form = $this->createDeleteForm($paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paciente);
            $em->flush();
        }

        return $this->redirectToRoute('pacientes_index');
    }

    /**
     * Creates a form to delete a paciente entity.
     *
     * @param pacientes $paciente The paciente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(pacientes $paciente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pacientes_delete', array('id' => $paciente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
