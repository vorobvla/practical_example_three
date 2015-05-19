<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DomCrawler\Field;


class DefaultController extends Controller
{
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

        return ["posts" => $this->container->get('cvut_fit_ict_bipwt_blog_service')
            ->findAllPosts()];
    }

    /**
     * @Route("/insert")
     * @Template
     */
    public function insertAction(){
        $post = new Post();
        $post->setTitle("Post Title " . uniqid());
        $post->setText("Post Text " . uniqid());

        $em = $this->get("doctrine.orm.default_entity_manager");

        $comment = new Comment();

        $em->persist($post);
        $em->flush();

        return[
            'post' => $post
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
