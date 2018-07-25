<?php
declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Komponentenattribute;
use Doctrine\Common\Collections\Collection;

class Komponentenarten
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $komponentenart;

    /** @var ArrayCollection  */
    protected $komponenten;

    /** @var ArrayCollection  */
    protected $komponentenattribute;

    public function __construct()
    {
        $this->komponenten = new ArrayCollection();
        $this->komponentenattribute = new ArrayCollection();
    }

    public function getKomponenten(): ArrayCollection
    {
        return $this->komponenten;
    }

    public function setKomponenten(ArrayCollection $komponenten)
    {
        $this->komponenten = $komponenten;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getKomponentenart(): ?string
    {
        return $this->komponentenart;
    }

    public function setKomponentenart(string $komponentenart)
    {
        $this->komponentenart = $komponentenart;
    }

    public function getComponentAttributes(): Collection
    {
        return $this->komponentenattribute;
    }

    public function addComponentAttribute(Komponentenattribute $komponentenattribute)
    {
        $this->komponentenattribute->add($komponentenattribute);
    }

    public function removeComponentAttribute(Komponentenattribute $komponentenattribute)
    {
        $this->komponentenattribute->remove($komponentenattribute);
    }
}
