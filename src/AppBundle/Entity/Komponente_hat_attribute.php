<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Komponente_hat_attribute
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
    private $komponentenattributeId;

    /**
     * @var string
     */
    private $wert;

    /** @var ArrayCollection */
    private $komponentenattribut;

    /** @var ArrayCollection */
    private $komponentenid;

    public function __construct()
    {
        $this->komponentenattribut = new ArrayCollection();
        $this->komponentenid = new ArrayCollection();
    }

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

    public function setKomponentenattributeId(int $komponentenattributeId): self
    {
        $this->komponentenattributeId = $komponentenattributeId;

        return $this;
    }

    public function getKomponentenattributeId(): int
    {
        return $this->komponentenattributeId;
    }

    public function setWert(string $wert): self
    {
        $this->wert = $wert;

        return $this;
    }

    public function getWert(): string
    {
        return $this->wert;
    }
    
    public function getkomponentenattribut(): ArrayCollection
    {
        return $this->komponentenattribut;
    }

    public function setkomponentenattribut(ArrayCollection $komponentenattribut): void
    {
        $this->komponentenattribut = $komponentenattribut;
    }

    public function getkomponentenid1(): ArrayCollection
    {
        return $this->komponentenid;
    }

    public function setkomponentenid1(ArrayCollection $komponentenid): void
    {
        $this->komponentenid = $komponentenid;
    }
}

