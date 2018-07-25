<?php
declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Komponentenattribute;

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

    public function getKomponentenattribute(): ArrayCollection
    {
        return $this->komponentenattribute;
    }

    public function addKomponentenattribute(ArrayCollection $komponentenattribute): void
    {
        $this->komponentenattribute->add($komponentenattribute);
    }

    public function addKomponentenattribut(Komponentenattribute $komponentenattribute)
    {
        $komponentenattribute->addKomponentenarten($this);
    }
}
