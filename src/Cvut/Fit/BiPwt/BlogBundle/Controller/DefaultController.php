<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Controller;

use Cvut\Fit\BiPwt\BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Field;


class DefaultController extends Controller
{

    const DEFAULT_POST_TITLE = "Untitled Post";
    /**
     * @Route("/", name="index")
     * @Template()
     *
     * @return array
     */
    public function postsListAction()
    {
        /*
        $postTitles = "";
        foreach ($this->container->get('cvut_fit_ict_bipwt_blog_service')
                     ->findAllPosts() as $post){
            $postTitles[] = $post->getTitle();
        }*/

        return [
            "posts" => $this->container->get('cvut_fit_ict_bipwt_blog_service')
            ->findAllPosts()
        ];
    }

    /**
     * @Route("/newPost", name="newPost")
     * @Template
     */
    public function newPostAction(Request $request){
        $post = new Post();
        $form = $this->createFormBuilder($post)
            ->add('title', 'text')
            ->add('text', 'textarea')
            ->add('files', 'collection', array(
                'type' => 'file',
                'label' => "Attachment",
                'allow_add' => true,
                'allow_delete' => true)
            )
            ->add('private', 'checkbox', array(
                'label' => "Publish As Private Post")
            )
            ->add('publishFrom', 'datetime')
            ->add('publishTo', 'datetime', array(
                'label' => "Publish Till")
            )
            ->add('Publish', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $this->get('cvut_fit_ict_bipwt_blog_service')->createPost($post);
            return $this->redirectToRoute('index');
        }
        return[
            'form' => $form->createView(),
            'asd' => ''
        ];

    }

    /**
     * @Route("/post/{id}", name="post")
     * @Template
     */
    public function detailAction($id){

        return[
            'post' => $this->container
                ->get('cvut_fit_ict_bipwt_blog_service')
                ->findPost($id),
            'datetime_fmt' => 'd.m. Y @ h:m:s T'
        ];

    }
}
