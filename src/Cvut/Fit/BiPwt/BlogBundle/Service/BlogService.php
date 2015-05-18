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
        return $this->doctrine->update($post);
    }

    /**
     * Smaze prispevek
     *
     * @param PostInterface $post
     * @return PostInterface
     */
    public function deletePost(PostInterface $post)
    {
        #eliminating 1:n
        foreach ($post->getFiles() as $file){
            $this->deleteFile($file);
        }
        foreach ($post->getComments() as $comment){
            $this->deleteComment($comment);
        }
        #eliminating n:*
        return $this->doctrine->delete($post, array(
            getAuthor() => removePost($post),
            getTags() => removePost($post),
        ));
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