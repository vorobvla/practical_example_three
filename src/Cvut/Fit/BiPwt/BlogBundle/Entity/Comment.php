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
class Comment #implements CommentInterface
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
     * @ORM\OneToMany(targetEntity="Cvut\Fit\BiPwt\BlogBundle\Entity\Comment",
     * mappedBy="children")
     */
    private $parent;

    /**
     * @var array
     *
     * @ORM\ManyToOne(targetEntity="Cvut\Fit\BiPwt\BlogBundle\Entity\Comment",
     * inversedBy="parent")
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set author
     *
     * @param \stdClass $author
     * @return Comment
     */
    public function setAuthor(UserInterface $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \stdClass 
     */
    public function getAuthor()
    {
        return $this->author;
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
     * Set parent
     *
     * @param \stdClass $parent
     * @return Comment
     */
    public function setParent(CommentInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \stdClass 
     */
    public function getParent()
    {
        return $this->parent;
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
     * Set children
     *
     * @param array $children
     * @return Comment
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Set files
     *
     * @param array $files
     * @return Comment
     */
    public function setFiles($files)
    {
        $this->files = $files;

        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parent = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get files
     *
     * @return array 
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Add parent
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\Comment $parent
     * @return Comment
     */
    public function addParent(\Cvut\Fit\BiPwt\BlogBundle\Entity\Comment $parent)
    {
        $this->parent[] = $parent;

        return $this;
    }

    /**
     * Remove parent
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\Comment $parent
     */
    public function removeParent(\Cvut\Fit\BiPwt\BlogBundle\Entity\Comment $parent)
    {
        $this->parent->removeElement($parent);
    }

    /**
     * Get children
     *
     * @return \Cvut\Fit\BiPwt\BlogBundle\Entity\Comment 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Nastavi ID komentare
     *
     * @param mixed $id
     * @return CommentInterface $this
     */
    public function setId($id)
    {
        // TODO: Implement setId() method.
    }



    /**
     * Add files
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\File $files
     * @return Comment
     */
    public function addFile(\Cvut\Fit\BiPwt\BlogBundle\Entity\File $files)
    {
        $this->files[] = $files;

        return $this;
    }

    /**
     * Remove files
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\File $files
     */
    public function removeFile(\Cvut\Fit\BiPwt\BlogBundle\Entity\File $files)
    {
        $this->files->removeElement($files);
    }
}
