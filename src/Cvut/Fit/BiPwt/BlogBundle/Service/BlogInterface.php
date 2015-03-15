<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Service;

use Cvut\Fit\BiPwt\BlogBundle\Entity\CommentInterface;
use Cvut\Fit\BiPwt\BlogBundle\Entity\FileInterface;
use Cvut\Fit\BiPwt\BlogBundle\Entity\PostInterface;
use Cvut\Fit\BiPwt\BlogBundle\Entity\TagInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * Rozhrani sluzby pro obsluhu blogu
 *
 * Interface BlogInterface
 * @package Cvut\Fit\BiPwt\BlogBundle\Service
 */
interface BlogInterface {

    /* ### Post ### */

    /**
     * Vytvori novy prispevek
     *
     * @param PostInterface $post
     * @return PostInterface
     */
    public function createPost(PostInterface $post);

    /**
     * Aktualizuje prispevek
     *
     * @param PostInterface $post
     * @return PostInterface
     */
    public function updatePost(PostInterface $post);

    /**
     * Smaze prispevek
     *
     * @param PostInterface $post
     * @return PostInterface
     */
    public function deletePost(PostInterface $post);

    /**
     * Najde prispevek podle ID a vrati
     *
     * @param $id
     * @return PostInterface
     */
    public function findPost($id);

    /**
     * Vrati vsechny prispevky
     *
     * @return Collection<PostInterface>
     */
    public function findAllPost();

    /**
     * Najde prispevky podle kriterii a vrati
     *
     * @param Criteria $criteria
     * @return Collection<PostInterface>
     */
    public function findPostBy(Criteria $criteria);

    /* ### Comment ### */

    /**
     * Prida k prispevku komentar
     *
     * @param PostInterface $post
     * @param CommentInterface $comment
     * @param CommentInterface $parentComment
     * @return PostInterface
     */
    public function addComment(PostInterface $post, CommentInterface $comment,
                               CommentInterface $parentComment = NULL);

    /**
     * Odebere od prispevku komentar
     *
     * @param CommentInterface $comment
     * @return PostInterface
     */
    public function deleteComment(CommentInterface $comment);

    /* ### Tag ### */

    /**
     * Vytvori novy tag, pokud neexistuje
     *
     * @param TagInterface $tag
     * @return TagInterface
     */
    public function createTag(TagInterface $tag);

    /**
     * Upravi stavajici tag
     *
     * @param TagInterface $tag
     * @return TagInterface
     */
    public function updateTag(TagInterface $tag);

    /**
     * Smaze tag
     *
     * @param TagInterface $tag
     * @return TagInterface
     */
    public function deleteTag(TagInterface $tag);

    /**
     * Nalezne tag podle ID a vrati
     *
     * @param $id
     * @return TagInterface
     */
    public function findTag($id);

    /**
     * @return Collection<TagInterface>
     */
    public function findAllTags();

    /**
     * Najde a vrati tagy podle kriterii
     *
     * @param Criteria $criteria
     * @return Collection<TagInterface>
     */
    public function findTagBy(Criteria $criteria);

    /* ### File ### */

    /**
     * Prida k prispevku a pripadne komentari soubor
     *
     * @param FileInterface $file
     * @param PostInterface $post
     * @param CommentInterface $comment
     * @return PostInterface
     */
    public function addPostFile(FileInterface $file, PostInterface $post,
                                CommentInterface $comment = NULL);

    /**
     * Odebere od prispevku soubor
     *
     * @param $file
     * @return PostInterface
     */
    public function deleteFile($file);

}