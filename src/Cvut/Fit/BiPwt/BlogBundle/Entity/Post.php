<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity
 */
class Post implements PostInterface
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
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="author", type="object")
     */
    private $author;

    /**
     * @var boolean
     *
     * @ORM\Column(name="private", type="boolean")
     */
    private $private;

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
     * @var \DateTime
     *
     * @ORM\Column(name="publishFrom", type="datetime")
     */
    private $publishFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishTo", type="datetime")
     */
    private $publishTo;

    /**
     * @var array
     *
     * @ORM\Column(name="comments", type="array")
     */
    private $comments;

    /**
     * @var array
     *
     * @ORM\Column(name="files", type="array")
     */
    private $files;

    /**
     * @var array
     *
     * @ORM\Column(name="tags", type="array")
     */
    private $tags;


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
     * Set title
     *
     * @param string $title
     * @return Post
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
     * Set text
     *
     * @param string $text
     * @return Post
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
     * Set author
     *
     * @param \stdClass $author
     * @return Post
     */
    public function setAuthor($author)
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
     * Set private
     *
     * @param boolean $private
     * @return Post
     */
    public function setPrivate($private)
    {
        $this->private = $private;

        return $this;
    }

    /**
     * Get private
     *
     * @return boolean 
     */
    public function getPrivate()
    {
        return $this->private;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Post
     */
    public function setCreated($created)
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
     * @return Post
     */
    public function setModified($modified)
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
     * Set publishFrom
     *
     * @param \DateTime $publishFrom
     * @return Post
     */
    public function setPublishFrom($publishFrom)
    {
        $this->publishFrom = $publishFrom;

        return $this;
    }

    /**
     * Get publishFrom
     *
     * @return \DateTime 
     */
    public function getPublishFrom()
    {
        return $this->publishFrom;
    }

    /**
     * Set publishTo
     *
     * @param \DateTime $publishTo
     * @return Post
     */
    public function setPublishTo($publishTo)
    {
        $this->publishTo = $publishTo;

        return $this;
    }

    /**
     * Get publishTo
     *
     * @return \DateTime 
     */
    public function getPublishTo()
    {
        return $this->publishTo;
    }

    /**
     * Set comments
     *
     * @param array $comments
     * @return Post
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return array 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set files
     *
     * @param array $files
     * @return Post
     */
    public function setFiles($files)
    {
        $this->files = $files;

        return $this;
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
     * Set tags
     *
     * @param array $tags
     * @return Post
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return array 
     */
    public function getTags()
    {
        return $this->tags;
    }
}
