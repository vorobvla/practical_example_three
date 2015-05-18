<?php
/**
 * Created by PhpStorm.
 * User: vova
 * Date: 5/18/15
 * Time: 1:09 AM
 */

namespace Cvut\Fit\BiPwt\BlogBundle\Service;

use Cvut\Fit\BiPwt\BlogBundle\Entity\User;
use Cvut\Fit\BiPwt\BlogBundle\Entity\UserInterface as UserEntityInterface;
use Cvut\Fit\BiPwt\BlogBundle\Service\UserInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

use Doctrine\ORM\EntityManager;

class UserService implements  UserInterface{

    /**
     * @var EntityManager
     */
    protected $em;
    protected $defPasswd = "1111";

    function __construct($em)
    {
        $this->em = $em;
    }


    /**
     * Vytvori a vrati uzivatele
     *
     * @param $id
     * @param $name
     * @return UserEntityInterface
     */
    public function create($id, $name)
    {
        $newUser = new User();
        //$newUser->setId($id);
        $newUser->setName($name);
        $newUser->setPassword($this->defPasswd);
        $this->em->persist($newUser);
        $this->em->flush();
        return $newUser;
    }

    /**
     * Aktualizuje uzivatele a vrati
     *
     * @param UserEntityInterface $user
     * @return UserEntityInterface
     */
    public function update(UserEntityInterface $user)
    {
        $this->em->flush();
    }

    /**
     * Odstrani uzivatele a vrati jej
     *
     * @param UserEntityInterface $user
     * @return UserEntityInterface
     */
    public function delete(UserEntityInterface $user)
    {
        $this->em->remove($user);
        $this->em->flush();
        return $user;
    }

    /**
     * Najde uzivatele podle ID
     *
     * @param $id
     * @return UserEntityInterface
     */
    public function find($id)
    {
        return $this->em->find('Cvut\Fit\BiPwt\BlogBundle\Entity\User', $id);

    }

    /**
     * Najde a vrati vsechny uzivatele
     *
     * @return Collection<UserInterface>
     */
    public function findAll()
    {
        return $this->em->getRepository('Cvut\Fit\BiPwt\BlogBundle\Entity\User')
            ->findAll();
    }

    /**
     * Najde uzivatele podle kriterii
     *
     * @param Criteria $criteria
     * @return Collection<UserEntityInterface>
     */
    public function findBy(Criteria $criteria)
    {
        return $this->em->getRepository('Cvut\Fit\BiPwt\BlogBundle\Entity\User')
            ->findBy($criteria);
    }



}