<?php
declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

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

    public function getKomponentenart(): string
    {
        return $this->komponentenart;
    }

    public function setKomponentenart(int $komponentenart)
    {
        $this->komponentenart = $komponentenart;
    }

    public function getWirdBeschriebenDurch(): PersistentCollection
    {
        return $this->wirdBeschriebenDurch;
    }

    public function setWirdBeschriebenDurch(PersistentCollection $wirdBeschriebenDurch): void
    {
        $this->wirdBeschriebenDurch = $wirdBeschriebenDurch;
    }
}
