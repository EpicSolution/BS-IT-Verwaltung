<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Komponentenattribute
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $bezeichnung;

    /** @var ArrayCollection */
    private $komponentenattribute_hat;

    /** @var ArrayCollection */
    private $komponentenattribute_beschr;

    public function __construct()
    {
        $this->komponentenattribute_hat = new ArrayCollection();
        $this->komponentenattribute_beschr = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setBezeichnung(string $bezeichnung): self
    {
        $this->bezeichnung = $bezeichnung;

        return $this;
    }

    public function getBezeichnung(): string
    {
        return $this->bezeichnung;
    }

    public function getKomponentenattributeHat(): ArrayCollection
    {
        return $this->komponentenattribute_hat;
    }

    public function setKomponentenattributeHat(ArrayCollection $komponentenattribute_hat): void
    {
        $this->komponentenattribute_hat = $komponentenattribute_hat;
    }

    public function getKomponentenattributeBeschr(): ArrayCollection
    {
        return $this->komponentenattribute_beschr;
    }

    public function setKomponentenattributeBeschr(ArrayCollection $komponentenattribute_beschr): void
    {
        $this->komponentenattribute_beschr = $komponentenattribute_beschr;
    }
}

