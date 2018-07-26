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
    public function verschiebeComp(int $id, int $raeume_id)
    {
        $komponenten = $this->em->getRepository(Komponenten::class)->find($id);
        $raeume = $this->em->getRepository(Raeume::class)->find($raeume_id);
        $komponenten->setraeume_id($raeume);
        $this->em->flush();
    }
}