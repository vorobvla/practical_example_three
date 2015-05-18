<?php
/**
 * Created by PhpStorm.
 * User: vova
 * Date: 4/17/15
 * Time: 9:24 AM
 */

namespace Cvut\Fit\BiPwt\BlogBundle\Service;


use Cvut\Fit\BiPwt\BlogBundle\Entity\CommentInterface;
use Cvut\Fit\BiPwt\BlogBundle\Entity\FileInterface;
use Cvut\Fit\BiPwt\BlogBundle\Entity\PostInterface;
use Cvut\Fit\BiPwt\BlogBundle\Entity\TagInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;

class BlogService implements BlogInterface {

    /**
     * @var EntityManager
     */
    protected $em;

    function __construct($em)
    {
        $this->em = $em;
    }

    /**
     * @param mixed $em
     */
    public function setEntityManager($em)
    {
        $this->em = $em;
    }




    /**
     * Vytvori novy prispevek
     *
     * @param PostInterface $post
     * @return PostInterface
     */
    public function createPost(PostInterface $post)
    {
        $this->em->persist($post);
        $this->em->flush();
        return $post;
    }

    /**
     * Aktualizuje prispevek
     *
     * @param PostInterface $post
     * @return PostInterface
     */
    public function updatePost(PostInterface $post)
    {

        //return $post;
    }

    /**
     * Smaze prispevek
     *
     * @param PostInterface $post
     * @return PostInterface
     */
    public function deletePost(PostInterface $post)
    {
        $this->em->remove($post);
        $this->em->flush();
        return $post;
    }

    /**
     * Najde prispevek podle ID a vrati
     *
     * @param $id
     * @return PostInterface
     */
    public function findPost($id)
    {
        return $this->em->getRepository('Cvut\Fit\BiPwt\BlogBundle\Entity\Post')
            ->find($id);
    }

    /**
     * Vrati vsechny prispevky
     *
     * @return Collection<PostInterface>
     */
    public function findAllPosts()
    {
        // TODO: Implement findAllPosts() method.
    }

    /**
     * Najde prispevky podle kriterii a vrati
     *
     * @param Criteria $criteria
     * @return Collection<PostInterface>
     */
    public function findPostBy(Criteria $criteria)
    {
        // TODO: Implement findPostBy() method.
    }

    /**
     * Prida k prispevku komentar
     *
     * @param PostInterface $post
     * @param CommentInterface $comment
     * @param CommentInterface $parentComment
     * @return PostInterface
     */
    public function addComment(PostInterface $post, CommentInterface $comment,
                               CommentInterface $parentComment = NULL)
    {
        // TODO: Implement addComment() method.
    }

    /**
     * Odebere od prispevku komentar
     *
     * @param CommentInterface $comment
     * @return PostInterface
     */
    public function deleteComment(CommentInterface $comment)
    {
        // TODO: Implement deleteComment() method.
    }

    /**
     * Vytvori novy tag, pokud neexistuje
     *
     * @param TagInterface $tag
     * @return TagInterface
     */
    public function createTag(TagInterface $tag)
    {
        /*$this->em->persist($tag);
        $this->em->flush();
        return $tag;*/
    }

    /**
     * Upravi stavajici tag
     *
     * @param TagInterface $tag
     * @return TagInterface
     */
    public function updateTag(TagInterface $tag)
    {
        // TODO: Implement updateTag() method.
    }

    /**
     * Smaze tag
     *
     * @param TagInterface $tag
     * @return TagInterface
     */
    public function deleteTag(TagInterface $tag)
    {
        // TODO: Implement deleteTag() method.
    }

    /**
     * Nalezne tag podle ID a vrati
     *
     * @param $id
     * @return TagInterface
     */
    public function findTag($id)
    {
        // TODO: Implement findTag() method.
    }

    /**
     * @return Collection<TagInterface>
     */
    public function findAllTags()
    {
        // TODO: Implement findAllTags() method.
    }

    /**
     * Najde a vrati tagy podle kriterii
     *
     * @param Criteria $criteria
     * @return Collection<TagInterface>
     */
    public function findTagBy(Criteria $criteria)
    {
        // TODO: Implement findTagBy() method.
    }

    /**
     * Prida k prispevku a pripadne komentari soubor
     *
     * @param FileInterface $file
     * @param PostInterface $post
     * @param CommentInterface $comment
     * @return PostInterface
     */
    public function addPostFile(FileInterface $file, PostInterface $post,
                                CommentInterface $comment = NULL)
    {
        // TODO: Implement addPostFile() method.
    }

    /**
     * Odebere od prispevku soubor
     *
     * @param FileInterface $file
     * @return PostInterface
     */
    public function deleteFile(FileInterface $file)
    {
        // TODO: Implement deleteFile() method.
    }

}