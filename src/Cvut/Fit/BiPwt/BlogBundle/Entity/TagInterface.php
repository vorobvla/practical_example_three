<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * Rozhrani entity Tag
 *
 * Interface TagInterface
 * @package Cvut\Fit\BiPwt\BlogBundle\Entity
 */
interface TagInterface
{
    /**
     * Vrati ID tagu
     *
     * @return number
     */
    public function getId();

    /**
     * Nastavi ID tagu
     *
     * @param number $id
     * @return TagInterface $this
     */
    public function setId($id);

    /**
     * Vrati nazev tagu
     *
     * @return string
     */
    public function getTitle();

    /**
     * Nastavi nazev tagu
     *
     * @param string $title
     * @return TagInterface $this
     */
    public function setTitle($title);

    /**
     * Prida prispevek ke znacce
     *
     * @param PostInterface $post
     * @return TagInterface $this
     */
    public function addPost(PostInterface $post);

    /**
     * Vrati prispevky prirazene ke znacce
     *
     * @return Collection<PostInterface>
     */
    public function getPosts();

    /**
     *
     * Odstrani prispevek od znacky
     *
     * @param PostInterface $post
     * @return TagInterface $this
     */
    public function removePost(PostInterface $post);
}