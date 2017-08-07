<?php

namespace AppBundle\Controller\user;

use AppBundle\Entity\Diario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Diario controller.
 *
 * @Route("/user/diario")
 */
class DiarioController extends Controller
{
    /**
     * Lists all diario entities.
     *
     * @Route("/", name="diario_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $diarios = $em->getRepository('AppBundle:Diario')->findAll();

        return $this->render('diario/index.html.twig', array(
            'diarios' => $diarios,
        ));
    }

    /**
     * Creates a new diario entity.
     *
     * @Route("/new", name="diario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $diario = new Diario();
        $form = $this->createForm('AppBundle\Form\DiarioType', $diario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($diario);
            $em->flush();

            return $this->redirectToRoute('diario_show', array('id' => $diario->getId()));
        }

        return $this->render('diario/new.html.twig', array(
            'diario' => $diario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a diario entity.
     *
     * @Route("/{id}", name="diario_show")
     * @Method("GET")
     */
    public function showAction(Diario $diario)
    {
        $deleteForm = $this->createDeleteForm($diario);

        return $this->render('diario/show.html.twig', array(
            'diario' => $diario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing diario entity.
     *
     * @Route("/{id}/edit", name="diario_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")"
     */
    public function editAction(Request $request, Diario $diario)
    {
        $deleteForm = $this->createDeleteForm($diario);
        $editForm = $this->createForm('AppBundle\Form\DiarioType', $diario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('diario_edit', array('id' => $diario->getId()));
        }

        return $this->render('diario/edit.html.twig', array(
            'diario' => $diario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a diario entity.
     *
     * @Route("/{id}", name="diario_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")"
     */
    public function deleteAction(Request $request, Diario $diario)
    {
        $form = $this->createDeleteForm($diario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($diario);
            $em->flush();
        }

        return $this->redirectToRoute('diario_index');
    }

    /**
     * Creates a form to delete a diario entity.
     *
     * @param Diario $diario The diario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Diario $diario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('diario_delete', array('id' => $diario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
