<?php

namespace AppBundle\Controller\admin;

use AppBundle\Entity\Diario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Doctrine\ORM\QueryBuilder;

/**
 * Diario controller.
 *
 * @Route("/admin/diario")
 */
class DiarioController extends Controller
{
    /**
     * Lists all diario entities.
     *
     * @Route("/", name="admin_diario_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repo=$em->getRepository(Diario::class);
        $minDate=$repo->getMinDate();
        $maxDate=$repo->getMaxDate();

        //$diario = new Diario();
        $defaultData=['message' => 'Selecciona las fechas para filtrar'];
        $form = $this->createFormBuilder($defaultData)
          ->add('startDate', DateType::class,
          [
            'label' => 'Fecha inicio',
            'data' => $minDate[0]->getFecha(),
            'widget' => 'single_text'
          ])
          ->add('dueDate', DateType::class,
          [
            'label' => 'Fecha final',
            'data' => $maxDate[0]->getFecha(),
            'widget' => 'single_text'
          ])
          ->add('Buscar', SubmitType::class, array('label' => 'Buscar'))
          ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $data=$form->getData();
          $qb=$em->createQueryBuilder();
          $qb->select('d')
            ->from('AppBundle:Diario','d')
            ->add('where', $qb->expr()->between(
                'd.fecha',
                ':from',
                ':to'
              )
            )
            ->setParameters(array('from' => $data['startDate'], 'to' => $data['dueDate']));
            $diarios=$qb->getQuery()->getResult();
        } else {
          $diarios=$repo->findAll();
        }


        return $this->render('diario/admin/index.html.twig', array(
            'diarios' => $diarios,
          'form' => $form->createView(),
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
        $em = $this->getDoctrine()->getManager();

        $diario = new Diario();
        $form = $this->createForm('AppBundle\Form\DiarioType', $diario, ['activo' => false]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $em->persist($diario);
          $em->flush();

        }

        return $this->render('diario/admin/new.html.twig', array(
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
        // $deleteForm = $this->createDeleteForm($diario);

        return $this->render('diario/admin/show.html.twig', array(
            'diario' => $diario,
            //'delete_form' => $deleteForm->createView(),
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
        $editForm = $this->createForm('AppBundle\Form\DiarioType', $diario, ['admin' => true]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $diario->setActivo(false);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('diario_edit', array('id' => $diario->getId()));
        }

        return $this->render('diario/admin/edit.html.twig', array(
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

        return $this->redirectToRoute('admin_diario_index');
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
