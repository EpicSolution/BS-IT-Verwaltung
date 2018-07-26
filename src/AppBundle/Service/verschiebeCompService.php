<?php

namespace AppBundle\Service;

use AppBundle\Entity\Komponenten;
use AppBundle\Entity\Raeume;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Entity\Header;

class verschiebeCompService
{   
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em; 
    }

    public function verschiebeComp( $id,  $raeume_id)
    {
        $komponenten = $this->em->getRepository(Komponenten::class)->find($id);
        $raeume = $this->em->getRepository(Raeume::class)->find($raeume_id);
        $komponenten->setRaeumeId($raeume);
        $this->em->flush();
    }

    public function komponentAusmustern(string $id)
    {
        $raum = $this->findAusgemustertRaum();
        if ($raum == null)
        {
            $this->createAusgemustertRaum();
            $raum = $this->findAusgemustertRaum();
        }

        if ($raum != null)
        {
            $this->verschiebeComp($id, $raum->getId());
        }
    }

    function findAusgemustertRaum()
    {
        $qb_raum = $this->em->createQueryBuilder()
        ->select('r')
        ->from(Raeume::class, 'r')
        ->setParameter('Nr', 'Ausgemustert')
        ->andWhere('r.Nr = :Nr');

        return $qb_raum->getQuery()->getOneOrNullResult();   
    }

    function createAusgemustertRaum()
    {
        $ausgemustertRaum = new Raeume();
        $ausgemustertRaum->setBezeichnung('Ausgemustert');
        $ausgemustertRaum->setNr('Ausgemustert');

        $this->em->persist($ausgemustertRaum);
        $this->em->flush();
    }

    
}