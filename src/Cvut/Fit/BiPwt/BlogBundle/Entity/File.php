<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table(name="blog_file")
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({"file" = "File", "img" = "Image"})
 */
class File implements FileInterface
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \stdClass
     * @ORM\ManyToOne(targetEntity="Cvut\Fit\BiPwt\BlogBundle\Entity\Post",
     * inversedBy="files")
     */
    private $post;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Cvut\Fit\BiPwt\BlogBundle\Entity\Comment",
     * inversedBy="files")
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="internetMediaType", type="string", length=255)
     */
    private $internetMediaType;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="blob")
     */
    private $data;


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
     * @return File
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
     * Set created
     *
     * @param \DateTime $created
     * @return File
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
     * Set internetMediaType
     *
     * @param string $internetMediaType
     * @return File
     */
    public function setInternetMediaType($internetMediaType)
    {
        $this->internetMediaType = $internetMediaType;

        return $this;
    }

    /**
     * Get internetMediaType
     *
     * @return string 
     */
    public function getInternetMediaType()
    {
        return $this->internetMediaType;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return File
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Nastavi unikatni identifikator souboru
     *
     * @param number $id
     * @return FileInterface $this
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    /**
     * Set post
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\Post $post
     * @return File
     */
    public function setPost(\Cvut\Fit\BiPwt\BlogBundle\Entity\PostInterface $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \Cvut\Fit\BiPwt\BlogBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set comment
     *
     * @param \Cvut\Fit\BiPwt\BlogBundle\Entity\Comment $comment
     * @return File
     */
    public function setComment(\Cvut\Fit\BiPwt\BlogBundle\Entity\CommentInterface $comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return \Cvut\Fit\BiPwt\BlogBundle\Entity\Comment 
     */
    public function getComment()
    {
        return $this->comment;
    }
}
