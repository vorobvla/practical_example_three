<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Controller;

use Cvut\Fit\BiPwt\BlogBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Request;

class loginController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            '@Blog/login/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error' => $error,
            )
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction(){
        //overeni hesla zarizuje symphony
    }

    /**
     * @Route("/register", name='user_register')
     *
     */
    public function registerAction(Request $request){
        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        $form -> handleRequest($request);

        if($form->isSubmitted()){
            $em = $this->get('doctrine')->getManager();

            $encoder = $this->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $user->getPassword());


            $user->setPasword($encoded);

            $em->persist($user);
            $em->flush();
        }

        return [
            'formular' => $form->createView()
        ];
    }
}
