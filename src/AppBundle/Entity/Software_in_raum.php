<?php

namespace AppBundle\Entity;

class Software_in_raum
{
    /**
     * @var Komponenten
     */
    private $komponentenId;

    /**
     * @var Raeume
     */
    private $raeumeId;

    public function setKomponentenId(Komponenten $komponentenId): self
    {
        $this->komponentenId = $komponentenId;

        return $this;
    }


    public function getKomponentenId(): Komponenten
    {
        return $this->komponentenId;
    }

    public function setRaeumeId(Raeume $raeumeId): self
    {
        $this->raeumeId = $raeumeId;

        return $this;
    }

    public function getRaeumeId(): Raeume
    {
        return $this->raeumeId;
    }
}

