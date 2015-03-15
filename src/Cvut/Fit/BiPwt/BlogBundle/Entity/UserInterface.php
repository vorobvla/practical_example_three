<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Entity;

/**
 * Rozhrani entity uzivatele
 *
 * Interface UserInterface
 * @package Cvut\Fit\BiPwt\BlogBundle\Entity
 */
interface UserInterface
{
    /**
     * Vrati unikatni ID uzivatele

     * @return number
     */
    public function getId();

    /**
     * Nastavi unikatni ID uzivatele

     * @param number $id
     * @return UserInterface $this
     */
    public function setId($id);

    /**
     * Vrati jmeno uzivatele
     *
     * @return string
     */
    public function getName();

    /**
     * Nastavi jmeno uzivatele
     *
     * @param string $name
     * @return UserInterface $this
     */
    public function setName($name);

    /**
     * Prida prispevek uzivatele
     *
     * @param PostInterface $post
     * @return UserInterface $this
     */
    public function addPost(PostInterface $post);

    /**
     * Vrati prispevky uzivatele
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts();

    /**
     * Odstrani prispevek uzivatele
     *
     * @param PostInterface $post
     * @return UserInterface $this
     */
    public function removePost(PostInterface $post);
}