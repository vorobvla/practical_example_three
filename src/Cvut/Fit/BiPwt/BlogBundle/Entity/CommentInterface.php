<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * Rozhrani entity komentar k prispevku
 *
 * Interface CommentInterface
 * @package Cvut\Fit\BiPwt\BlogBundle\Entity
 */
interface CommentInterface
{
    /**
     * Vrati ID komentare
     *
     * @return mixed
     */
    public function getId();

    /**
     * Nastavi ID komentare
     *
     * @param mixed $id
     * @return CommentInterface $this
     */
    public function setId($id);

    /**
     * Vratui autora
     *
     * @return UserInterface
     */
    public function getAuthor();

    /**
     * Nastavi autora
     *
     * @param UserInterface $author
     * @return CommentInterface $this
     */
    public function setAuthor(UserInterface $author);

    /**
     * Vrati prispevek, ke kteremu komentar prislusi
     *
     * @return PostInterface
     */
    public function getPost();

    /**
     * Nastavi prispevek, ke kteremu komentar prislusi
     *
     * @param PostInterface $post
     * @return CommentInterface $this
     */
    public function setPost(PostInterface $post);

    /**
     * Vrati text komentare
     *
     * @return string
     */
    public function getText();

    /**
     * Nastavi text komentare
     *
     * @param string $text
     * @return CommentInterface $this
     */
    public function setText($text);

    /**
     * Vrati datum vytvoreni
     *
     * @return \DateTime
     */
    public function getCreated();

    /**
     * Nastavi datum vytvoreni
     *
     * @param \DateTime $created
     * @return CommentInterface $this
     */
    public function setCreated(\DateTime $created);

    /**
     * @return \DateTime
     */
    public function getModified();

    /**
     * @param \DateTime $modified
     * @return CommentInterface $this
     */
    public function setModified(\DateTime $modified);

    /**
     * Vrati rodicovsky komentar (na ktery tento reaguje), pokud existuje
     *
     * @return CommentInterface|null
     */
    public function getParent();

    /**
     * Nastavi rodicovsky komentar. Museji byt ke stejnemu prispevku
     *
     * @param CommentInterface $parent
     * @return CommentInterface $this
     */
    public function setParent(CommentInterface $parent);

    /**
     * Prida potomka tohoto komentare
     *
     * @param CommentInterface $comment
     * @return CommentInterface $this
     */
    public function addChild(CommentInterface $comment);

    /**
     * Vrati potomky komentare (ktere na tento reaguji)
     *
     * @return Collection<CommentInterface>
     */
    public function getChildren();

    /**
     * Odebere potomka tohoto komentare
     *
     * @param CommentInterface $comment
     * @return CommentInterface $this
     */
    public function removeChild(CommentInterface $comment);

    /**
     * Prida soubor k tomuto komentari
     *
     * @param FileInterface $file
     * @return CommentInterface $this
     */
    public function addFile(FileInterface $file);

    /**
     * Vrati kolekci souboru prislusejicich tomuto komentari
     *
     * @return Collection<FileInterface>
     */
    public function getFiles();

    /**
     * Odebere soubor od tohoto komentare
     *
     * @param FileInterface $file
     * @return CommentInterface $this
     */
    public function removeFile(FileInterface $file);

    /**
     * Vrati priznak, zda se jedna o spam
     *
     * @return true|false
     */
    public function getSpam();

    /**
     * Nastavi priznak, zda se jedna o spam
     *
     * @param boolean $spam
     * @return CommentInterface $this
     */
    public function setSpam($spam);
}