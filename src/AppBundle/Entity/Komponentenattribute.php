<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Komponentenarten;

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
    private $komponentenarten;

    public function __construct()
    {
        $this->komponentenattribute_hat = new ArrayCollection();
        $this->komponentenarten = new ArrayCollection();
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

    public function setKomponentenattributeHat(ArrayCollection $komponentenattribute_hat): self
    {
        $this->komponentenattribute_hat = $komponentenattribute_hat;

        return $this;
    }

    public function getKomponentenarten(): ArrayCollection
    {
        return $this->komponentenarten;
    }

    public function addKomponentenarten(Komponentenarten $komponentenarten)
    {
        if (!$this->komponentenarten->contains($komponentenarten)) {
            $this->komponentenarten->add($komponentenarten);
        }
    }
}

