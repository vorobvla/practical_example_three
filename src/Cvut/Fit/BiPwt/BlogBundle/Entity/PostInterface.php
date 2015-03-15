<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * Rozhrani entity pro prispevek
 *
 * Interface PostInterface
 * @package Cvut\Fit\BiPwt\BlogBundle\Entity
 */
interface PostInterface
{
    /**
     * Vrati id prispevku
     *
     * @return number
     */
    public function getId();

    /**
     * Nastavi unikatni ID
     *
     * @param number $id
     * @return PostInterface $this
     */
    public function setId($id);

    /**
     * Vrati titulek prispevku
     *
     * @return string
     */
    public function getTitle();

    /**
     * Nastavi nazev prispevku
     *
     * @param string $title
     * @return PostInterface $this
     */
    public function setTitle($title);

    /**
     * Vrati text prispevku
     *
     * @return string
     */
    public function getText();

    /**
     * Nastavi text prispevku
     *
     * @param string $text
     * @return PostInterface $this
     */
    public function setText($text);

    /**
     * Vrati autora prispevku
     *
     * @return UserInterface
     */
    public function getAuthor();

    /**
     * Nastavi autora prispevku
     *
     * @param UserInterface $author
     * @return PostInterface $this
     */
    public function setAuthor(UserInterface $author);

    /**
     * Vrati datum vytvoreni
     *
     * @return \DateTime
     */
    public function getCreated();

    /**
     * Nastavi daum vytvoreni prispevku
     *
     * @param \DateTime $created
     * @return PostInterface $this
     */
    public function setCreated(\DateTime $created);

    /**
     * Vrati datum posledni modifikace
     *
     * @return \DateTime
     */
    public function getModified();

    /**
     * Nastavi datum posledni modifikace
     *
     * @param \DateTime $modified
     * @return PostInterface $this
     */
    public function setModified(\DateTime $modified);

    /**
     * Vrati datum, od kdy ma byt prispevek publikovan
     *
     * @return \DateTime
     */
    public function getPublishFrom();

    /**
     * Nastavi datum od kdy publikovat
     *
     * @param \DateTime $publishFrom
     * @return PostInterface $this
     */
    public function setPublishFrom(\DateTime $publishFrom);

    /**
     * Vrati datum, do kdy ma byt prispevek publikovan
     *
     * @return \DateTime
     */
    public function getPublishTo();

    /**
     * Nastavi datum, do kdy se ma prispevek publikovat
     *
     * @param \DateTime $publishTo
     * @return PostInterface $this
     */
    public function setPublishTo(\DateTime $publishTo);

    /**
     * Vrati priznak, zda je prispevek verejny ci nikoliv
     *
     * @return true|false
     */
    public function getPrivate();

    /**
     * Nastavi priznak, zda je prispevek
     *
     * @param bool $private
     * @return PostInterface $this
     */
    public function setPrivate($private);

    /**
     * Prida soubor k prispevku
     *
     * @param FileInterface $file
     * @return PostInterface $this
     */
    public function addFile(FileInterface $file);

    /**
     * Vrati kolekci souboru prislusejicich k prispevku
     *
     * @return Collection<FileInterface>
     */
    public function getFiles();

    /**
     * Odebere soubor od prispevku
     *
     * @param FileInterface $file
     * @return PostInterface $this
     */
    public function removeFile(FileInterface $file);

    /**
     * Prida komentar k prispevku
     *
     * @param CommentInterface $comment
     * @return PostInterface
     */
    public function addComment(CommentInterface $comment);

    /**
     * Vrati kolekci komentaru prislusejicich k prispevku
     *
     * @return Collection<CommentInterface>
     */
    public function getComments();

    /**
     * Odebere komentar od prispevku
     *
     * @param CommentInterface $comment
     * @return PostInterface
     */
    public function removeComment(CommentInterface $comment);

    /**
     * Prida znacku k prispevku
     *
     * @param TagInterface $tag
     * @return PostInterface
     */
    public function addTag(TagInterface $tag);

    /**
     * Vrati kolekci znacek prislusejicih k prispevku
     *
     * @return Collection<TagInterface>
     */
    public function getTags();

    /**
     * Odebere znacku od prispevku
     *
     * @param TagInterface $tag
     * @return PostInterface
     */
    public function removeTag(TagInterface $tag);
}