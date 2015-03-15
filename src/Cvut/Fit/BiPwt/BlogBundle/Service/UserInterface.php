<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Service;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Cvut\Fit\BiPwt\BlogBundle\Entity\UserInterface as EntityInterface;

/**
 * Rozhrani pro CRUD operace s uzivateli
 *
 * Interface UserInterface
 * @package Cvut\Fit\BiPwt\BlogBundle\Service
 */
interface UserInterface {

    /**
     * Vytvori a vrati uzivatele
     *
     * @param $id
     * @param $name
     * @return EntityInterface
     */
    public function create($id, $name);

    /**
     * Aktualizuje uzivatele a vrati
     *
     * @param EntityInterface $user
     * @return EntityInterface
     */
    public function update(EntityInterface $user);

    /**
     * Odstrani uzivatele a vrati jej
     *
     * @param EntityInterface $user
     * @return EntityInterface
     */
    public function delete(EntityInterface $user);

    /**
     * Najde uzivatele podle ID
     *
     * @param $id
     * @return EntityInterface
     */
    public function find($id);

    /**
     * Najde a vrati vsechny uzivatele
     *
     * @return Collection<UserInterface>
     */
    public function findAll();

    /**
     * Najde uzivatele podle kriterii
     *
     * @param Criteria $criteria
     * @return Collection<EntityInterface>
     */
    public function findBy(Criteria $criteria);

}