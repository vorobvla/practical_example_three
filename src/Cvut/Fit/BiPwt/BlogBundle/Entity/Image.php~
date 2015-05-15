<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="blog_image")
 * @ORM\Entity
 */
class Image extends File implements ImageInterface
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
     * @var integer
     *
     * @ORM\Column(name="dimensionX", type="integer")
     */
    private $dimensionX;

    /**
     * @var integer
     *
     * @ORM\Column(name="dimensionY", type="integer")
     */
    private $dimensionY;

    /**
     * @var string
     *
     * @ORM\Column(name="preview", type="blob")
     */
    private $preview;


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
     * Set dimensionX
     *
     * @param integer $dimensionX
     * @return Image
     */
    public function setDimensionX($dimensionX)
    {
        $this->dimensionX = $dimensionX;

        return $this;
    }

    /**
     * Get dimensionX
     *
     * @return integer 
     */
    public function getDimensionX()
    {
        return $this->dimensionX;
    }

    /**
     * Set dimensionY
     *
     * @param integer $dimensionY
     * @return Image
     */
    public function setDimensionY($dimensionY)
    {
        $this->dimensionY = $dimensionY;

        return $this;
    }

    /**
     * Get dimensionY
     *
     * @return integer 
     */
    public function getDimensionY()
    {
        return $this->dimensionY;
    }

    /**
     * Set preview
     *
     * @param string $preview
     * @return Image
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * Get preview
     *
     * @return string 
     */
    public function getPreview()
    {
        return $this->preview;
    }
}
