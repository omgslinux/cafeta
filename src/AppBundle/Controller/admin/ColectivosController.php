<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Colectivos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Colectivo controller.
 *
 * @Route("colectivos")
 */
class ColectivosController extends Controller
{
    /**
     * Lists all colectivo entities.
     *
     * @Route("/", name="colectivos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $colectivos = $em->getRepository('AppBundle:Colectivos')->findAll();

        return $this->render('colectivos/index.html.twig', array(
            'colectivos' => $colectivos,
        ));
    }

    /**
     * Creates a new colectivo entity.
     *
     * @Route("/new", name="colectivos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $colectivo = new Colectivo();
        $form = $this->createForm('AppBundle\Form\ColectivosType', $colectivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($colectivo);
            $em->flush();

            return $this->redirectToRoute('colectivos_show', array('id' => $colectivo->getId()));
        }

        return $this->render('colectivos/new.html.twig', array(
            'colectivo' => $colectivo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a colectivo entity.
     *
     * @Route("/{id}", name="colectivos_show")
     * @Method("GET")
     */
    public function showAction(Colectivos $colectivo)
    {
        $deleteForm = $this->createDeleteForm($colectivo);

        return $this->render('colectivos/show.html.twig', array(
            'colectivo' => $colectivo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing colectivo entity.
     *
     * @Route("/{id}/edit", name="colectivos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Colectivos $colectivo)
    {
        $deleteForm = $this->createDeleteForm($colectivo);
        $editForm = $this->createForm('AppBundle\Form\ColectivosType', $colectivo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('colectivos_edit', array('id' => $colectivo->getId()));
        }

        return $this->render('colectivos/edit.html.twig', array(
            'colectivo' => $colectivo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a colectivo entity.
     *
     * @Route("/{id}", name="colectivos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Colectivos $colectivo)
    {
        $form = $this->createDeleteForm($colectivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($colectivo);
            $em->flush();
        }

        return $this->redirectToRoute('colectivos_index');
    }

    /**
     * Creates a form to delete a colectivo entity.
     *
     * @param Colectivos $colectivo The colectivo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Colectivos $colectivo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('colectivos_delete', array('id' => $colectivo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
