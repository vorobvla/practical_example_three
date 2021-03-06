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
use Symfony\Component\Validator\Constraints\DateTime;

#use Symfony\Component\Validator\Constraints\DateTime;

class BlogService implements BlogInterface {

    /**
     * @var DoctrineDecorators
     */
    protected $doctrine;

    /**
     * @param $em
     */
    function __construct($em)
    {
        DoctrineDecorators::getInstance()->setEm($em);
        $this->doctrine = DoctrineDecorators::getInstance();
    }

    /**
     * Vytvori novy prispevek
     *
     * @param PostInterface $post
     * @return PostInterface
     */
    public function createPost(PostInterface $post)
    {
        $ts = new \DateTime("now");
        $post->setCreated($ts);
        $post->setModified($ts);
        return $this->doctrine->create($post);
    }

    /**
     * Aktualizuje prispevek
     *
     * @param PostInterface $post
     * @return PostInterface
     */
    public function updatePost(PostInterface $post)
    {
        $post->setModified(new \DateTime("now"));
        return $this->doctrine->update($post);
    }

    /**
     * update comment
     * @param CommentInterface $comment
     * @return mixed
     */
    public function updateComment(CommentInterface $comment)
    {
        $comment->setModified(new \DateTime("now"));
        return $this->doctrine->update($comment);
    }

    //Bad, not safe implementation
    /**
     * Smaze prispevek
     *
     * @param PostInterface $post
     * @return PostInterface
     */
    public function deletePost(PostInterface $post)
    {
        #eliminating 1:n
        $files = $post->getFiles();
        #if ($files != NULL) {
        foreach ($files as $file) {
            $this->deleteFile($file);
        }
       # }

        $comments = $post->getComments();
        if (count($comments) > 0) {
            foreach ($comments as $comment) {
                $this->deleteComment($comment);
            }
        }
        #eliminating n:*
        $post->getAuthor()->removePost($post);
        foreach ($post->getTags() as $tag){
            $tag->removePost($post);
        }
        return $this->doctrine->delete($post);
    }
    //TODO: remove flush when it is not needed

    /**
     * Najde prispevek podle ID a vrati
     *
     * @param $id
     * @return PostInterface
     */
    public function findPost($id)
    {
        return $this->doctrine->find('Cvut\Fit\BiPwt\BlogBundle\Entity\Post', $id);
    }

    /**
     * Vrati vsechny prispevky
     *
     * @return Collection<PostInterface>
     */
    public function findAllPosts()
    {
        return $this->doctrine->findAll('Cvut\Fit\BiPwt\BlogBundle\Entity\Post');
    }

    /**
     * Najde prispevky podle kriterii a vrati
     *
     * @param Criteria $criteria
     * @return Collection<PostInterface>
     */
    public function findPostBy(Criteria $criteria)
    {
        return $this->doctrine->findBy('Cvut\Fit\BiPwt\BlogBundle\Entity\Post', $criteria);
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
        $comment->setPost($post);
        $post->addComment($comment);

        $comment->setParent($parentComment);
        if ($parentComment != NULL){
            $parentComment->addChild($comment);
        }

        $ts = new \DateTime("now");
        $comment->setCreated($ts);
        $comment->setModified($ts);
        $comment->setSpam(false);

        $this->doctrine->create($comment);
        return $post;
    }

    /**
     * Odebere od prispevku komentar
     *
     * @param CommentInterface $comment
     * @return PostInterface
     */
    public function deleteComment(CommentInterface $comment)
    {
        $comment->getPost()->removeComment($comment);
        foreach ($comment->getFiles() as $file){
            $this->deleteFile($file);
        }
        $parent = $comment->getParent();
        foreach ($comment->getChildren() as $child){
            $child->setParent($parent);
        }

        $this->doctrine->delete($comment);
        return $comment->getPost();
    }

    /**
     * Vytvori novy tag, pokud neexistuje
     *
     * @param TagInterface $tag
     * @return TagInterface
     */
    public function createTag(TagInterface $tag)
    {
        return $this->doctrine->create($tag);
    }

    /**
     * Upravi stavajici tag
     *
     * @param TagInterface $tag
     * @return TagInterface
     */
    public function updateTag(TagInterface $tag)
    {
        return $this->doctrine->update($tag);
    }

    /**
     * Smaze tag
     *
     * @param TagInterface $tag
     * @return TagInterface
     */
    public function deleteTag(TagInterface $tag)
    {
        return $this->doctrine->delete($tag);
    }

    /**
     * Nalezne tag podle ID a vrati
     *
     * @param $id
     * @return TagInterface
     */
    public function findTag($id)
    {
        return $this->doctrine->find('Cvut\Fit\BiPwt\BlogBundle\Entity\Tag', $id);
    }

    /**
     * @return Collection<TagInterface>
     */
    public function findAllTags()
    {
        return $this->doctrine->findAll('Cvut\Fit\BiPwt\BlogBundle\Entity\Tag');
    }

    /**
     * Najde a vrati tagy podle kriterii
     *
     * @param Criteria $criteria
     * @return Collection<TagInterface>
     */
    public function findTagBy(Criteria $criteria)
    {
        return $this->doctrine->findBy('Cvut\Fit\BiPwt\BlogBundle\Entity\Tag', $criteria);
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
        $file->setPost($post);
        $post->addFile($file);

        $file->setComment($comment);
        if ($comment != NULL){
            $comment->addFile($file);
        }

        $this->doctrine->create($file);
        return $post;
    }

    /**
     * Odebere od prispevku soubor
     *
     * @param FileInterface $file
     * @return PostInterface
     */
    public function deleteFile(FileInterface $file)
    {
        $file->getPost()->removeFile($file);
        if ($file->getComment() != NULL) {
            $file->getComment()->removeFile($file);
        }

        $this->doctrine->delete($file);
        return $file->getPost();
    }

}