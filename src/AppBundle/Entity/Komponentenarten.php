<?php
declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class Komponentenarten
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $komponentenart;

    /** @var ArrayCollection  */
    protected $komponenten;

    /** @var PersistentCollection  */
    protected $wirdBeschriebenDurch;

    public function __construct()
    {
        $this->komponenten = new ArrayCollection();
    }

    public function getKomponenten(): Collection
    {
        return $this->komponenten;
    }

    public function setKomponenten(CollectionType $komponenten)
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

    public function getKomponentenart(): string
    {
        return $this->komponentenart;
    }

    public function setKomponentenart(string $komponentenart)
    {
        $this->komponentenart = $komponentenart;
    }

    public function getWirdBeschriebenDurch(): PersistentCollection
    {
        return $this->wirdBeschriebenDurch;
    }

    public function setWirdBeschriebenDurch(PersistentCollection $wirdBeschriebenDurch): self
    {
        $this->wirdBeschriebenDurch = $wirdBeschriebenDurch;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getKomponentenart();

    }
}
