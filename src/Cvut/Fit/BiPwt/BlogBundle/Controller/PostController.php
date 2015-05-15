<?php
/**
 * Created by PhpStorm.
 * User: vova
 * Date: 4/10/15
 * Time: 9:58 AM
 */

namespace Cvut\Fit\BiPwt\BlogBundle\Controller;


use Cvut\Fit\BiPwt\BlogBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends  Controller{


    /**
     * @param Request $request
     * @Template()
     */
    public function newAction(Request $request){
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);

        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $blogService = $this->get('cvut_fit_bipwt_blogbundle.service.blogservice');
            $blogService->createPost($post);
        }
    }
}