<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Entity;

/**
 * Rozhrani entity Image
 *
 * Interface ImageInterface
 * @package Cvut\Fit\BiPwt\BlogBundle\Entity
 */
interface ImageInterface extends FileInterface
{
    /**
     * Vrati rozliseni v ose X
     *
     * @return number
     */
    public function getDimensionX();

    /**
     * Nastavi rozliseni v ose X
     *
     * @param number $dimensionX
     * @return ImageInterface $this
     */
    public function setDimensionX($dimensionX);

    /**
     * Vrati rozliseni v ose Y
     *
     * @return number
     */
    public function getDimensionY();

    /**
     * Nastavi rozliseni v ose Y
     *
     * @param number $dimensionY
     * @return ImageInterface $this
     */
    public function setDimensionY($dimensionY);

    /**
     * Vrati data pro preview
     *
     * @return mixed
     */
    public function getPreview();

    /**
     * Nastavi data pro preview
     *
     * @param mixed
     * @return ImageInterface $this
     */
    public function setPreview($preview);
}