<?php
/**
 * Created by PhpStorm.
 * User: vova
 * Date: 5/18/15
 * Time: 1:09 AM
 */

namespace Cvut\Fit\BiPwt\BlogBundle\Service;

use Cvut\Fit\BiPwt\BlogBundle\Entity\UserInterface as EntityInterface;
use Cvut\Fit\BiPwt\BlogBundle\Service\UserInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

class UserService implements  UserInterface{
    /**
     * Vytvori a vrati uzivatele
     *
     * @param $id
     * @param $name
     * @return EntityInterface
     */
    public function create($id, $name)
    {
        // TODO: Implement create() method.
    }

    /**
     * Aktualizuje uzivatele a vrati
     *
     * @param EntityInterface $user
     * @return EntityInterface
     */
    public function update(EntityInterface $user)
    {
        // TODO: Implement update() method.
    }

    /**
     * Odstrani uzivatele a vrati jej
     *
     * @param EntityInterface $user
     * @return EntityInterface
     */
    public function delete(EntityInterface $user)
    {
        // TODO: Implement delete() method.
    }

    /**
     * Najde uzivatele podle ID
     *
     * @param $id
     * @return EntityInterface
     */
    public function find($id)
    {
        // TODO: Implement find() method.
    }

    /**
     * Najde a vrati vsechny uzivatele
     *
     * @return Collection<UserInterface>
     */
    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    /**
     * Najde uzivatele podle kriterii
     *
     * @param Criteria $criteria
     * @return Collection<EntityInterface>
     */
    public function findBy(Criteria $criteria)
    {
        // TODO: Implement findBy() method.
    }

}