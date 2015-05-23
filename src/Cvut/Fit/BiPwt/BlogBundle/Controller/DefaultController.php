<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Controller;

use Cvut\Fit\BiPwt\BlogBundle\Entity\Comment;
use Cvut\Fit\BiPwt\BlogBundle\Entity\CommentInterface;
use Cvut\Fit\BiPwt\BlogBundle\Entity\Post;
use Cvut\Fit\BiPwt\BlogBundle\Form\Type\PostType;
use Cvut\Fit\BiPwt\BlogBundle\Form\Type\AnyDateTimePeriod;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Field;
use Symfony\Component\Validator\Constraints\DateTime;



class DefaultController extends Controller
{

    const DATETIME_FMT = 'd.m. Y @ h:m:s T';

    protected function getAnyDateTimeForm(){
        return new AnyDateTimePeriod();
    }

    protected function getPostForm($post){
        $builder = $this->createFormBuilder($post);
        $type = new PostType();
        $type->buildForm($builder, array());
        return $builder->getForm();
    }


    /**
     * @Route("/{filterAuthorId}/{filterTagId}/{filterPublishedFrom}/{filterPublishedTill}",
     * requirements={"filterAuthorId" = "\d+","filterTagId" = "\d+",
     * "filterPublishedFrom" = "\datetime", "filterPublishedTill" = "\datetime"},
     * name="index")
     * @Template()
     *
     * @return array
     */
    public function postsListAction(Request $request,
                                    $filterAuthorId = NULL,
                                    $filterTagId = NULL, $filterPublishedFrom = NULL,
                                    $filterPublishedTill = NULL)
    {
        //TODO: finish one critetia where author and tags?


        $criteria = new Criteria();
        $criteria->orderBy(array('created'=>Criteria::DESC));
        if ($filterAuthorId != NULL){
            #filter by author
            #$posts = $this->container->get('cvut_fit_ict_bipwt_user_service')
            #    ->find($filterAuthorId)->getPosts();
            $criteria->where(Criteria::expr()->eq(
                'author',
                $this->container->get('cvut_fit_ict_bipwt_user_service')
                ->find($filterAuthorId)
            ));
        }
        if ($filterTagId != NULL){
            #filter by tag
            #$posts = $this->container->get('cvut_fit_ict_bipwt_blog_service')
            #    ->getPosts();
            $criteria->andWhere(Criteria::expr()->contains(
                'tags',
                $this->container->get('cvut_fit_ict_bipwt_user_service')
                ->findTag($filterTagId)
            ));
        }
        /*
        if ($filterPublishedFrom != NULL){
            $criteria->andWhere(Criteria::expr()->gte('publishFrom', new \DateTime($filterPublishedFrom)));
        }
        if ($filterPublishedTill != NULL){
            $criteria->andWhere(Criteria::expr()->lte('publishTo', new \DateTime($filterPublishedTill)));
        }*/

        $now = new \DateTime('now');
        $then = new \DateTime('+ 1 month');
        $intervalFormTo = $this->createFormBuilder()
            ->add('fromAny', 'checkbox', array('label'=>'From any date '))
            ->add('fromDatetime', 'datetime', array(
                'label'=>'From date: ', 'data'=>$now))
            ->add('tillAny', 'checkbox', array('label'=>'Till any date '))
            ->add('tillDatetime', 'datetime', array(
                'label'=>'Till date: ', 'data'=>$then))
            ->add('submit', 'submit', array('label'=>'Filter'))
            ->getForm();

        $intervalFormTo->handleRequest($request);
        $data = $intervalFormTo->getData();
        //TODO add validation of date (from date < till date)
        if ($intervalFormTo->isSubmitted()){
            if (!$data['fromAny']){
                #add  from
                $criteria->andWhere(Criteria::expr()->lte('publishFrom', $data['fromDatetime']));
            };
            if (!$data['tillAny']){
                #add to
                $criteria->andWhere(Criteria::expr()->gte('publishTo', $data['tillDatetime']));
            }
        };


        $posts = $this->container->get('cvut_fit_ict_bipwt_blog_service')->findPostBy($criteria);

        return [
            'posts' => $posts,
            'datetime_fmt' => self::DATETIME_FMT,
            'publishFromTo' => $intervalFormTo->createView(),
        ];
    }

    /**
     * @Route("/postNew", name="newPost")
     * @Template()
     */
    public function newPostAction(Request $request){
        $post = new Post();
        $form = $this->getPostForm($post);
        /*
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
            ->getForm();*/

        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if ($post->getAuthor() == NULL) {
                $post->setAuthor($this->get('cvut_fit_ict_bipwt_user_service')->create(0,
                    "Anonymous"));
            }
            $this->get('cvut_fit_ict_bipwt_blog_service')->createPost($post);
            return $this->redirectToRoute('index');
        }
        return[
            'form' => $form->createView()
        ];

    }

    /**
     * @Route("/postEdit/{postId}", requirements={"postId" = "\d+"},
     * name = "editPost")
     * @Template()
     * @param Request $request
     * @param $postId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editPostAction(Request $request, $postId){
        $post = $this->get('cvut_fit_ict_bipwt_blog_service')->findPost($postId);
        $form = $this->getPostForm($post);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $this->get('cvut_fit_ict_bipwt_blog_service')->updatePost($post);
            return $this->redirectToRoute('index');
        }
        return $this->render('@Blog/Default/newPost.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/postRemove/{removeId}", requirements={"removeId" = "\d+"},
     * name="removePost")
     * @Template()
     */
    public function removePostAction($removeId){
        $post = $this->get('cvut_fit_ict_bipwt_blog_service')->findPost($removeId);
        $this->get('cvut_fit_ict_bipwt_blog_service')->deletePost($post);
        return $this->redirectToRoute('index');
    }

    private function commentCmp(CommentInterface $c1, CommentInterface $c2){
        if($c1->getCreated() < $c2->getCreated()){
            return -1;
        } elseif ($c1->getCreated() > $c2->getCreated()){
            return 1;
        } else{
            return 0;
        }
    }

    /**
     * @Route("/postDetails/{id}/{commentOption}/{commentIdx}",
     * requirements={"id" = "\d+", "commentOption"="answer|edit|remove", "commentIdx"="\d+"}, name="postDetails")
     * @Template()
     */
    public function detailAction(Request $request, $id, $commentOption = NULL,
                                 $commentIdx = NULL){

        $post = $this->container
            ->get('cvut_fit_ict_bipwt_blog_service')
            ->findPost($id);

        $comments = $post->getComments()->toArray();
        uasort($comments, array($this, "commentCmp"));

        #edit commet or create new?
        $newComment = ($commentOption == 'edit')?($comments[$commentIdx]):(new Comment());
        $newComment->setAuthor($this->get('cvut_fit_ict_bipwt_user_service')->create(0,
            "Anonymous"));
        $newCommentForm = $this->createFormBuilder($newComment)
            ->add("text", "textarea", array(
                'label' => 'Text: '
            ))
            ->add('comment', 'submit', array(
                'label' => 'Comment'))
            ->getForm();


        $newCommentForm->handleRequest($request);
        $parent = ($commentOption == 'answer')?($comments[$commentIdx]):(NULL);

        if ($newCommentForm->isSubmitted()){
            if($commentOption == 'edit'){
                $this->get('cvut_fit_ict_bipwt_blog_service')->updateComment($newComment);
            } else {
                $this->get('cvut_fit_ict_bipwt_blog_service')->addComment($post, $newComment, $parent);
            }
            return $this->redirectToRoute('post', array('id' => $id));
        }

        if ($commentOption == 'remove'){
            $this->get('cvut_fit_ict_bipwt_blog_service')->deleteComment($comments[$commentIdx]);
            return $this->redirectToRoute('post', array('id' => $id));
        }

        return[
            'post' => $post,
            'comments' => $comments,
            'datetime_fmt' => self::DATETIME_FMT,
            'newCommentForm' => $newCommentForm->createView(),
            'answerTo' => $parent,
            //edit or not edit? if yes, where?
            'edit' => array('yes' => ($commentOption == 'edit')?(true):(false), 'idx' => $commentIdx)
        ];

    }



}
