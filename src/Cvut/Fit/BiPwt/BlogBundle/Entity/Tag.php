<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="blog_tag")
 * @ORM\Entity
 */
class Tag implements TagInterface
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Cvut\Fit\BiPwt\BlogBundle\Entity\Post",
     * mappedBy="tags")
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
     * Set tithle
     *
     * @param string $title
     * @return Tag
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Set posts
     *
     * @param \stdClass $posts
     * @return Tag
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;

        return $this;
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
     * @return Tag
     */
    public function addPost(\Cvut\Fit\BiPwt\BlogBundle\Entity\PostInterface $posts)
    {
        $this->posts[] = $posts;
        if(!$posts->getTags()->contains($this)) {
            $posts->addTag($this);
        }

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

    /**
     * Nastavi ID tagu
     *
     * @param number $id
     * @return TagInterface $this
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}
