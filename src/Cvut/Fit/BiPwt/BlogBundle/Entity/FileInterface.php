<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Entity;

/**
 * Rozhrani entity pro ulozeni souboru
 *
 * Interface FileInterface
 * @package Cvut\Fit\BiPwt\BlogBundle\Entity
 */
interface FileInterface
{
    /**
     * Vrati unikatni identifikator souboru
     *
     * @return number
     */
    public function getId();

    /**
     * Nastavi unikatni identifikator souboru
     *
     * @param number $id
     * @return FileInterface $this
     */
    public function setId($id);

    /**
     * Vrati jmeno souboru
     *
     * @return string
     */
    public function getName();

    /**
     * Nastavi jmeno souboru
     *
     * @param string $name
     * @return FileInterface $this
     */
    public function setName($name);

    /**
     * Vrati prispevek, k nemuz soubor prislusi
     *
     * @return PostInterface
     */
    public function getPost();

    /**
     * Nastavi prispevek, k nemuz soubor prislusi
     *
     * @param PostInterface $post
     * @return FileInterface $this
     */
    public function setPost(PostInterface $post);

    /**
     * Vrati datum a cas vytvoreni souboru
     *
     * @return \DateTime
     */
    public function getCreated();

    /**
     * Nastavi datum a cas vytvoreni souboru
     *
     * @param \DateTime $created
     * @return FileInterface $this
     */
    public function setCreated(\DateTime $created);

    /**
     * Vrati Internet Media Type souboru (drive MIME type)
     *
     * @return string
     */
    public function getInternetMediaType();

    /**
     * Nastavi Internet Media Type souboru (drive MIME type)
     *
     * @param string $internetMediaType
     * @return FileInterface $this
     */
    public function setInternetMediaType($internetMediaType);

    /**
     * Vrati obsah souboru
     *
     * @return mixed
     */
    public function getData();

    /**
     * Nastavi obsah souboru
     *
     * @param mixed $data
     * @return FileInterface $this
     */
    public function setData($data);

    /**
     * Vrati, k jakemu komentari soubor prislusi
     *
     * @return CommentInterface
     */
    public function getComment();


    /**
     * Nastavi, k jakemu komentari soubor prislusi
     *
     * @param CommentInterface $comment
     * @return FileInterface $this
     */
    public function setComment(CommentInterface $comment);
}