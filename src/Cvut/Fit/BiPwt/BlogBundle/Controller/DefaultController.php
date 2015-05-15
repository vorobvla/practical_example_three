<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    protected function  getField(){
        return new Field();
    }
    /**
     * @Route("/", name="default_index")
     * @Template()
     *z
     * @return array
     */
    public function indexAction()
    {
        $fields = $this->getField()->getFileds();
        return ["fields" => $fields];
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
     * @Route("/insert")
     * @Template
     */
    public function detailAction($id){
        $em = $this->get("doctrine")->getManager();

        $post = $em->getRepository("BiPwtCv04Bundle:Post")->find($id);

        return[
            'post' => $post
        ];

    }
}
