<?php
declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;


class Komponentenarten
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $komponentenart;

    protected $komponenten;



    public function __construct()
    {
        $this->komponenten = new ArrayCollection();
    }

    public function getKomponenten(): int
    {
        return $this->komponenten;
    }

    public function setKomponenten(int $komponenten)
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

    public function getKomponentenart(): int
    {
        return $this->komponentenart;
    }

    public function setKomponentenart(int $komponentenart)
    {
        $this->komponentenart = $komponentenart;
    }
}
