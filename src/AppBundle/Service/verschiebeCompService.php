<?php

namespace AppBundle\Service;

use AppBundle\Entity\Komponenten;
use AppBundle\Entity\Raeume;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Entity\Header;

class verschiebeCompService
{   
    private $em;
    public function __construct(EntityManager $em)
    {
        $this->em = $em; 
    }
    public function verschiebeComp(integer $id, integer $raeume_id)
    {
        $komponenten = $this->em->getRepository(Komponenten::class)->find($id);
        $raeume = $this->em->getRepository(Raeume::class)->find($raeume_id);
        $komponenten->setraeume_id1($raeume);
        $this->em->flush();
    }
}