<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Komponentenarten;
use Doctrine\Common\Collections\Collection;

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
    private $componentTypes;

    public function __construct()
    {
        $this->komponentenattribute_hat = new ArrayCollection();
        $this->componentTypes = new ArrayCollection();
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

    public function getBezeichnung(): ?string
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

    public function getComponentTypes(): Collection
    {
        return $this->componentTypes;
    }

    public function addComponentType(Komponentenarten $komponentenart)
    {
        if (!$this->componentTypes->contains($komponentenart)) {
            $this->componentTypes->add($komponentenart);
        }
    }
}

