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
        $fecha=new \DateTime();

        $diario=$em->getRepository(Diario::class)->findOneByFecha($fecha);

        if ($diario) {
          // La caja está abierta, hay que modificarla o cerrarla
            return $this->redirectToRoute('diario_close', array('id' => $diario->getId()));
        }

        // Comprobamos si está pendiente de cerrar la del día anterior
        $fecha->modify('-1 day');
        $diario=$em->getRepository(Diario::class)->findOneBy(
          [
            'fecha' => $fecha,
            'activo' => 1
          ], ['fecha' => 'ASC']
        );

        if ($diario) {
          // La caja del día anterio está abierta, hay que cerrarla
            return $this->redirectToRoute('diario_close', array('id' => $diario->getId()));
        }

        // Hay que abrir caja

        return $this->redirectToRoute('diario_open');
/*        return $this->render('diario/index.html.twig', array(
            'diarios' => $diarios,
        ));
*/    }

    /**
     * Creates a new diario entity.
     *
     * @Route("/open", name="diario_open")
     * @Method({"GET", "POST"})
     */
    public function openAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $fecha=new \DateTime();

        $diario=$em->getRepository(Diario::class)->findOneByFecha($fecha);

        if ($diario) {
            return $this->redirectToRoute('diario_close', array('id' => $diario->getId()));
        }

        $diario = new Diario();
        $form = $this->createForm('AppBundle\Form\DiarioType', $diario, ['activo' => false]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $diario->setObservaciones('--');
          $em->persist($diario);
          $em->flush();

          //return $this->redirectToRoute('diario_new');

          return $this->redirectToRoute('diario_close', array('id' => $diario->getId()));
        }

        return $this->render('diario/open.html.twig', array(
          'diario' => $diario,
          'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to close the current diario entity.
     *
     * @Route("/{id}/close", name="diario_close")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")"
     */
    public function closeAction(Request $request, Diario $diario)
    {
        if ($diario->getObservaciones()=='--') {
          $diario->setObservaciones('');
        }
        $editForm = $this->createForm('AppBundle\Form\DiarioType', $diario, ['activo' => true]);
        $editForm->handleRequest($request);
        $stillOpen=true;

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $diario->setActivo(false);
            $this->getDoctrine()->getManager()->flush();
            $stillOpen=false;
            return $this->redirectToRoute('diario_send_close', [ 'id' => $diario->getId()]);
        }
        return $this->render('diario/close.html.twig', array(
          'diario' => $diario,
          'edit_form' => $editForm->createView(),
          'stillOpen' => $stillOpen
        ));

    }

    /**
     * Sends en email al cerrar la caja
     *
     * @Route("/{id}/sendclose", name="diario_send_close")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")"
     */
    public function sendCloseAction(\Swift_Mailer $mailer, Diario $diario)
    {
      $subject="Cierre de cafeta del turno " . $diario->getFecha()->format('d/m/Y');
      $sender="cafeta@ingobernable.net";
      $recipient="caja@localhost"; // Alias que hay que crear en /etc/aliases
      $body="La caja ha cerrado con " . $diario->getFinal() . " euros, dejando " . $diario->getSobre() . " euros en el sobre";
      $message = \Swift_Message::newInstance()
      ->setSubject($subject)
      ->setFrom($sender)
      ->setTo($recipient)
      ->setBody($body)
      ;

      $mailer->send($message);
        return $this->render('diario/close.html.twig', array(
          'diario' => $diario,
          'stillOpen' => false
        ));

    }

}
