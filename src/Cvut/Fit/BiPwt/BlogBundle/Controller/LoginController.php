<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Controller;

use Cvut\Fit\BiPwt\BlogBundle\Form\Type\RegistrationType;
use Cvut\Fit\BiPwt\BlogBundle\Form\Type\RoleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cvut\Fit\BiPwt\BlogBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Null;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            '@Blog/Login/login.html.twig',
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
     * @Route("/register", name="register")
     * @Template()
     *
     */
    public function registerAction(Request $request){
        $user = new User();
        $form = $this->createForm(new RegistrationType(), $user, array());
     #   $form = $this->createForm(new RoleType());

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
         /*   $data = $form->getData();
            return  $this->render('@Blog/Login/register.html.twig', array(
                'form' => $form->createView(),
                #'dbg' => $data['roles'],
            ));*/
            $this->get('cvut_fit_ict_bipwt_user_service')->register($user);
            return $this->redirectToRoute('index');
        }


        return $this->render('@Blog/Login/register.html.twig', array(
            'form' => $form->createView(),
            'dbg' => $request,
        ));
    }
}
