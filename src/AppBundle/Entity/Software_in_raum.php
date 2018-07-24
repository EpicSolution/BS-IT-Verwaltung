<?php

namespace AppBundle\Entity;

class Software_in_raum
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $komponentenId;

    /**
     * @var int
     */
    private $raeumeId;
    
    /** @var Raeume */
    private $raeume;

    /** @var Komponenten */
    private $komponenten;

    public function getId(): int
    {
        return $this->id;
    }

    public function setKomponentenId(int $komponentenId): self
    {
        $this->komponentenId = $komponentenId;

        return $this;
    }


    public function getKomponentenId(): int
    {
        return $this->komponentenId;
    }

    public function setRaeumeId(int $raeumeId): self
    {
        $this->raeumeId = $raeumeId;

        return $this;
    }

    public function getRaeumeId(): int
    {
        return $this->raeumeId;
    }

    public function getraeume(): Raeume
    {
        return $this->raeume;
    }

    public function setraeume(Raeume $raeume): void
    {
        $this->raeume = $raeume;
    }

    public function getkomponenten(): Komponenten
    {
        return $this->komponenten;
    }

    public function setkomponenten(Komponenten $komponenten): void
    {
        $this->komponenten = $komponenten;
    }
}

