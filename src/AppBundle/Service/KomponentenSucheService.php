<?php

namespace AppBundle\Service;

use AppBundle\Entity\Komponenten as Komponenten;

use AppBundle\Enum\KomponentenSuche as Suche;

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
    public function findByBezeichnung(string $bez = null, int $raum_nr = null, int $komp_art = null, int $mode = Suche::loose) : ?array
    {
        if ($bez == null && $raum_nr == null && $komp_art == null) {
            return null;
        }
        
        $qb = $this->em->createQueryBuilder()
        ->select('k')
        ->from(Komponenten::class, 'k');

        if ($bez != null) {
            $qb->setParameter('ident', $bez);
            switch($mode){
                case Suche::loose:
                    $qb->andWhere('REGEXP(k.Ident, :ident) = 1');
                    break;
                case Suche::exact:
                    $qb->andWhere('k.Ident = :ident');
                    break;
            }
        }

        if ($raum_nr != null) {
            $qb->setParameter('raum', $raum_nr);
            switch($mode) {
                case Suche::loose:
                    $qb->andWhere('REGEXP(IDENTITY(k.raeume_id), :raum) = 1');
                    break;
                case Suche::exact:
                    $qb->andWhere('k.raeume_id = :raum');
                    break;
            }
        }
        
        if ($komp_art != null) {
            $qb->setParameter('komp_art', $komp_art);
            switch($mode) {
                case Suche::loose:
                    $qb->andWhere('REGEXP(IDENTITY(k.komponentenarten_id), :komp_art) = 1');
                    break;
                case Suche::exact:
                    $qb->andWhere('k.komponentenarten_id = :komp_art');
                    break;
            }
        }
        return $qb->getQuery()->getArrayResult();
    }

    /**
     * @Return Komponenten[]
     */
    public function findByHersteller(string $hersteller, int $mode = Suche::exact) : array
    {
        $qb = $this->em->createQueryBuilder()
        ->select('k')
        ->from(Komponenten::class, 'k');

        switch ($mode) {
            case Suche::exact:
                $qb->andWhere('k.hersteller = :hersteller');
                break;
            case Suche::loose:
                $qb->andWhere('REGEXP(k.hersteller, :hersteller) = 1');
                break;
        }

        $qb->setParameter('hersteller', $hersteller);
        return $qb->getQuery()->getArrayResult();
    }

    /**
     * @Return Komponenten[]
     */
    public function findByHerstellerOrNotiz(string $bezeichnung, int $mode = Suche::exact): array
    {

        $qb = $this->em->createQueryBuilder()
        ->select('k')
        ->from(Komponenten::class, 'k');

        switch($mode) {
            case Suche::exact:
                $qb->orWhere('k.hersteller = :suchwort')
                ->orWhere('k.notiz = :suchwort');  
                break;
            case Suche::loose:
                $qb->orWhere('REGEXP(k.hersteller, :suchwort) = 1')
                ->orWhere('REGEXP(k.notiz, :suchwort) = 1');   
                break;           
        }

        $qb->setParameter('suchwort', $bezeichnung);

        return $qb->getQuery()->getArrayResult();
    }
}