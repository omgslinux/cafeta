<?php

namespace AppBundle\Controller\admin;

use AppBundle\Entity\Calendario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Calendario controller.
 *
 * @Route("/admin/calendario")
 */
class CalendarioController extends Controller
{
    /**
     * Lists all calendario entities.
     *
     * @Route("/", name="calendario_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $calendarios = $em->getRepository('AppBundle:Calendario')->findAll();

        return $this->render('calendario/index.html.twig', array(
            'calendarios' => $calendarios,
        ));
    }

    /**
     * Creates a new calendario entity.
     *
     * @Route("/new", name="calendario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $calendario = new Calendario();
        $form = $this->createForm('AppBundle\Form\CalendarioType', $calendario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($calendario);
            $em->flush();

            return $this->redirectToRoute('calendario_show', array('id' => $calendario->getId()));
        }

        return $this->render('calendario/new.html.twig', array(
            'calendario' => $calendario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a calendario entity.
     *
     * @Route("/{id}", name="calendario_show")
     * @Method("GET")
     */
    public function showAction(Calendario $calendario)
    {
        $deleteForm = $this->createDeleteForm($calendario);

        return $this->render('calendario/show.html.twig', array(
            'calendario' => $calendario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing calendario entity.
     *
     * @Route("/{id}/edit", name="calendario_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Calendario $calendario)
    {
        $deleteForm = $this->createDeleteForm($calendario);
        $editForm = $this->createForm('AppBundle\Form\CalendarioType', $calendario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('calendario_edit', array('id' => $calendario->getId()));
        }

        return $this->render('calendario/edit.html.twig', array(
            'calendario' => $calendario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a calendario entity.
     *
     * @Route("/{id}", name="calendario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Calendario $calendario)
    {
        $form = $this->createDeleteForm($calendario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($calendario);
            $em->flush();
        }

        return $this->redirectToRoute('calendario_index');
    }

    /**
     * Creates a form to delete a calendario entity.
     *
     * @param Calendario $calendario The calendario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Calendario $calendario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('calendario_delete', array('id' => $calendario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
