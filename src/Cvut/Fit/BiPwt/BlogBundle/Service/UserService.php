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
use Cvut\Fit\BiPwt\BlogBundle\Exception\ItemAlreadyExistsException;
use Cvut\Fit\BiPwt\BlogBundle\Service\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class UserService implements  UserInterface{

    protected $defPasswd = "1111";

    /**
     * @var DoctrineDecorators
     */
    protected $doctrine;

    /**
     * @param $em
     */
    function __construct($em)
    {
        DoctrineDecorators::getInstance()->setEm($em);
        $this->doctrine = DoctrineDecorators::getInstance();
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
        $controlUniq = $this->doctrine->getEm()->getRepository('BlogBundle:User')
            ->findBy(array('name' => $name));

        if (count($controlUniq) != 0) {
            return $controlUniq[0];
        }

        $newUser = new User();
        //$newUser->setId($id);
        $newUser->setName($name);
        $newUser->setPassword($this->defPasswd);


        return $this->doctrine->create($newUser);
    }

    /**
     * Aktualizuje uzivatele a vrati
     *
     * @param UserEntityInterface $user
     * @return UserEntityInterface
     */
    public function update(UserEntityInterface $user)
    {
        $controlUniq = $this->doctrine->getEm()->getRepository('BlogBundle:User')
            ->findBy(array('name' => $user->getName()));

        if (count($controlUniq) != 0) {
            $this->delete($controlUniq[0]);
        }
        return $this->doctrine->update($user);
    }

    /**
     * Odstrani uzivatele a vrati jej
     *
     * @param UserEntityInterface $user
     * @return UserEntityInterface
     */
    public function delete(UserEntityInterface $user)
    {
        return $this->doctrine->delete($user);
    }

    /**
     * Najde uzivatele podle ID
     *
     * @param $id
     * @return UserEntityInterface
     */
    public function find($id)
    {
        return $this->doctrine->find('Cvut\Fit\BiPwt\BlogBundle\Entity\User', $id);
    }

    /**
     * Najde a vrati vsechny uzivatele
     *
     * @return Collection<UserInterface>
     */
    public function findAll()
    {
        return $this->doctrine->findAll('Cvut\Fit\BiPwt\BlogBundle\Entity\User');
    }

    /**
     * Najde uzivatele podle kriterii
     *
     * @param Criteria $criteria
     * @return Collection<UserEntityInterface>
     */
    public function findBy(Criteria $criteria)
    {
        return $this->doctrine->findBy('Cvut\Fit\BiPwt\BlogBundle\Entity\User', $criteria);
    }

}