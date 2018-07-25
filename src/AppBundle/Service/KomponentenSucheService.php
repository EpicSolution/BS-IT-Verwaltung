<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\AST\WhereClause;


class KomponentenSucheService
{
    /**@var EntityManager $em */
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }
    /**
     * @Return Komponenten[]
     */
    public function findByBezeichnung(string $bez) 
    {
        $qb = $this->em->createQueryBuilder('k')
            ->andWhere('k.hersteller = :hersteller')
            ->setParameter('hersteller', $bez)
            //->orderBy('p.price', 'ASC')
            ->getQuery();

        return $qb->execute();
    }
}