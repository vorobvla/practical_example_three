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
     * Nastavi ID tagu
     *
     * @param number $id
     * @return TagInterface $this
     */
    public function setId($id)
    {
        // TODO: Implement setId() method.
    }

    /**
     * Prida prispevek ke znacce
     *
     * @param PostInterface $post
     * @return TagInterface $this
     */
    public function addPost(PostInterface $post)
    {
        // TODO: Implement addPost() method.
    }

    /**
     * Vrati prispevky prirazene ke znacce
     *
     * @return Collection<PostInterface>
     */
    public function getPosts()
    {
        // TODO: Implement getPosts() method.
    }

    /**
     *
     * Odstrani prispevek od znacky
     *
     * @param PostInterface $post
     * @return TagInterface $this
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="posts", type="object")
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

}
