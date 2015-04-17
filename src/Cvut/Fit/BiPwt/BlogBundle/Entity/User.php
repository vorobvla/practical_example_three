<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="blog_user")
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * Nastavi unikatni ID uzivatele
     * @param number $id
     * @return UserInterface $this
     */
    public function setId($id)
    {
        // TODO: Implement setId() method.
    }

    /**
     * Prida prispevek uzivatele
     *
     * @param PostInterface $post
     * @return UserInterface $this
     */
    public function addPost(PostInterface $post)
    {
        // TODO: Implement addPost() method.
    }

    /**
     * Vrati prispevky uzivatele
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        // TODO: Implement getPosts() method.
    }

    /**
     * Odstrani prispevek uzivatele
     *
     * @param PostInterface $post
     * @return UserInterface $this
     */
    public function removePost(PostInterface $post)
    {
        // TODO: Implement removePost() method.
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var array
     *
     * @ORM\Column(name="posts", type="array")
     */
    private $posts;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

}
