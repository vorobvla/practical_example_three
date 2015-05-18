<?php
/**
 * Created by PhpStorm.
 * User: vova
 * Date: 5/18/15
 * Time: 1:09 PM
 */

namespace Cvut\Fit\BiPwt\BlogBundle\Service;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Log\InvalidArgumentException;

/**
 * Contains entity manager and template methods
 */
class DoctrineDecorators {


    const INVERSED_BY_ONE = 1;
    const INVERSED_BY_MANY = 0;

    /**
     * @var DoctrineDecorators
     */
    protected static $instance = NULL;
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @param EntityManager $em
     */
    public function setEm($em)
    {
        $this->em = $em;
    }


    function __construct(){
    }

    /**
     * @return DoctrineDecorators
     */
    public static function getInstance()
    {
        if(self::$instance == NULL){
            self::$instance = new DoctrineDecorators();
        }
        return self::$instance;
    }

    /**
     * Create entity
     * @param $entity
     * @return mixed
     */
    public function create($entity){
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    /**
     * Updates user
     * @param UserEntityInterface $user
     */
    public function update($entity)
    {
        $this->em->merge($entity);
        $this->em->flush();
        return $entity;
    }

    /**
     * Delete  Entity
     * @param $entity
     * @param array $removeAssociation   val = other side entity getter, key = method to be ran by other side,
     * @return mixed
     */
    public function delete($entity, array $removeAssociation = NULL)
    {
        #elomonating associations bef
        if ($removeAssociation != NULL) {
            foreach ($removeAssociation as $getOtherSide => $doOnThis) {
                $entity->$getOtherSide->$doOnThis;
            }
        }
        $this->em->remove($entity);
        $this->em->flush();
        return $entity;
    }

    /**
     * Finds entity by id
     * @param $id
     * @param $repository
     * @return \Cvut\Fit\BiPwt\BlogBundle\Entity\User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function find($repository, $id)
    {
        return $this->em->find($repository, $id);
    }

    /**
     * Finds all entities
     * @param $repository
     * @return ArrayCollection
     */
    public function findAll($repository)
    {
        return new ArrayCollection($this->em->getRepository($repository)
            ->findAll());
    }

    /**
     * Finds all enteties by criteria
     *
     * @param Criteria $criteria
     * @return Collection<UserEntityInterface>
     */
    public function findBy($repostiorty, Criteria $criteria)
    {
        return $this->em->getRepository($repostiorty)
            ->matching($criteria);
    }



}