<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Controller;

use Cvut\Fit\BiPwt\BlogBundle\Entity\Comment;
use Cvut\Fit\BiPwt\BlogBundle\Entity\Post;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Field;


class DefaultController extends Controller
{

    const DEFAULT_POST_TITLE = "Untitled Post";


    /**
     * @Route("/{filterAuthorId}/{filterTagId}",
     * requirements={"filterAuthorId" = "\d+",
     * "filterTagId" = "\d+"}, name="index")
     * @Template()
     *
     * @return array
     */
    public function postsListAction($filterAuthorId = NULL, $filterTagId = NULL)
    {
        if ($filterAuthorId != NULL){
            #filter by author
            $posts = $this->container->get('cvut_fit_ict_bipwt_user_service')
                ->find($filterAuthorId)->getPosts();
        } elseif ($filterTagId != NULL){
            #filter by tag
            $posts = $this->container->get('cvut_fit_ict_bipwt_blog_service')
                ->findTag($filterTagId)->getPosts();
        } else {
            $posts = $this->container->get('cvut_fit_ict_bipwt_blog_service')
                ->findAllPosts();
        }

        return [
            "posts" => $posts
        ];
    }

    /**
     * @Route("/newPost", name="newPost")
     * @Template()
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
            $post->setAuthor($this->get('cvut_fit_ict_bipwt_user_service')->create(0,
                "Anonymous"));
            $this->get('cvut_fit_ict_bipwt_blog_service')->createPost($post);
            return $this->redirectToRoute('index');
        }
        return[
            'form' => $form->createView()
        ];

    }

    /**
     * @Route("/removePost/{id}", requirements={"id" = "\d+"}, name="remove")
     * @Template()
     */
    public function removePostAction($id){
        $post = $this->get('cvut_fit_ict_bipwt_blog_service')->findPost($id);
        $this->get('cvut_fit_ict_bipwt_blog_service')->deletePost($post);
        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/post/{id}", requirements={"id" = "\d+"}, name="post")
     * @Template()
     */
    public function detailAction($id, Request $request){

        $post = $this->container
            ->get('cvut_fit_ict_bipwt_blog_service')
            ->findPost($id);

        $newComment = new Comment();
        $newComment->setAuthor($this->get('cvut_fit_ict_bipwt_user_service')->create(0,
            "Anonymous"));
        $newCommentForm = $this->createFormBuilder($newComment)
            ->add("text", "textarea", array(
                'label' => 'Your Comment: '
            ))
            ->add('Comment', 'submit')
            ->getForm();

        $newCommentForm->handleRequest($request);

        if ($newCommentForm->isSubmitted()){
            $this->get('cvut_fit_ict_bipwt_blog_service')->addComment($post, $newComment);
            #return $this->redirectToRoute('post', array('id' => $id));
        }


        return[
            'post' => $post,
            'datetime_fmt' => 'd.m. Y @ h:m:s T',
            'newCommentForm' => $newCommentForm->createView()
        ];

    }

}
