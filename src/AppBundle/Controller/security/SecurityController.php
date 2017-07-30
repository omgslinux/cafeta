<?php
namespace AppBundle\Controller\security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
      $authUtils = $this->get('security.authentication_utils');

      // get the login error if there is one
       $error = $authUtils->getLastAuthenticationError();

       // last username entered by the user
       $lastUsername = $authUtils->getLastUsername();


        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
        $this->get('security.context')->setToken(null);
        $this->get('request')->getSession()->invalidate();

        $response = new RedirectResponse($this->generateUrl('dn_send_me_the_bundle_confirm', array(
                    'token' => $token
                    )));
    }
}
