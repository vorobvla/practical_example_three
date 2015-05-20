<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface as CoreUserInterface;

/**
 * User
 *
 * @ORM\Table(name="blog_user")
 * @ORM\Entity
 */
class User implements UserInterface, CoreUserInterface
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Cvut\Fit\BiPwt\BlogBundle\Entity\Post",
     * mappedBy="author")
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

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }



    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials(){}


    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        return [
            'ROLE_USER'   #autentizovany uzivatel
        ];
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {

    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->name;
    }

    /**
     * Nastavi unikatni ID uzivatele
     * @param number $id
     * @return UserInterface $this
     */
    public function setId($id){
        $this->id = $id;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add posts
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\Post $posts
     * @return User
     */
    public function addPost(\Cvut\Fit\BiPwt\BlogBundle\Entity\PostInterface $posts)
    {
        $this->posts[] = $posts;
        $posts->setAuthor($this);

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\Post $posts
     */
    public function removePost(\Cvut\Fit\BiPwt\BlogBundle\Entity\PostInterface $posts)
    {
        $this->posts->removeElement($posts);
    #    $posts->setAuthor(NULL);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
