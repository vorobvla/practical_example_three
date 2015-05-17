<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="blog_comment")
 * @ORM\Entity
 */
class Comment implements CommentInterface
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
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Cvut\Fit\BiPwt\BlogBundle\Entity\User",
     * inversedBy="")
     */
    private $author;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="post", type="object")
     */
    private $post;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Cvut\Fit\BiPwt\BlogBundle\Entity\Comment",
     * inversedBy="children")
     */
    private $parent;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Cvut\Fit\BiPwt\BlogBundle\Entity\Comment",
     * mappedBy="parent")
     */
    private $children;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime")
     */
    private $modified;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Cvut\Fit\BiPwt\BlogBundle\Entity\File",
     * mappedBy="comment")
     */
    private $files;

    /**
     * @var boolean
     *
     * @ORM\Column(name="spam", type="boolean")
     */
    private $spam;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set post
     *
     * @param \stdClass $post
     * @return Comment
     */
    public function setPost(PostInterface $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \stdClass 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Comment
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Comment
     */
    public function setModified(\DateTime $modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set spam
     *
     * @param boolean $spam
     * @return Comment
     */
    public function setSpam($spam)
    {
        $this->spam = $spam;

        return $this;
    }

    /**
     * Get spam
     *
     * @return boolean 
     */
    public function getSpam()
    {
        return $this->spam;
    }

    /**
     * Set author
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\User $author
     * @return Comment
     */
    public function setAuthor(\Cvut\Fit\BiPwt\BlogBundle\Entity\UserInterface $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Cvut\Fit\BiPwt\BlogBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set parent
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\Comment $parent
     * @return Comment
     */
    public function setParent(\Cvut\Fit\BiPwt\BlogBundle\Entity\CommentInterface $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Cvut\Fit\BiPwt\BlogBundle\Entity\Comment 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\Comment $children
     * @return Comment
     */
    public function addChild(\Cvut\Fit\BiPwt\BlogBundle\Entity\CommentInterface $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\Comment $children
     */
    public function removeChild(\Cvut\Fit\BiPwt\BlogBundle\Entity\CommentInterface $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add files
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\File $files
     * @return Comment
     */
    public function addFile(\Cvut\Fit\BiPwt\BlogBundle\Entity\FileInterface $files)
    {
        $this->files[] = $files;

        return $this;
    }

    /**
     * Remove files
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\File $files
     */
    public function removeFile(\Cvut\Fit\BiPwt\BlogBundle\Entity\FileInterface $files)
    {
        $this->files->removeElement($files);
    }

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}
