<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Komponenten;
use AppBundle\Entity\Komponentenattribute;
class Komponente_hat_attribute
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Komponenten
     *  */
    private $komponentenId;

    /**
     * @var Komponentenattribute
     */
    private $komponentenattributeId;

    /**
     * @var string
     */
    private $wert;


    public function __construct()
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setKomponentenId(Komponenten $komponentenId): self
    {
        $this->komponentenId = $komponentenId;

        return $this;
    }

    public function getKomponentenId(): Komponenten
    {
        return $this->komponentenId;
    }


    public function setKomponentenattributeId(Komponentenattribute $komponentenattributeId): self

    {
        $this->komponentenattributeId = $komponentenattributeId;

        return $this;
    }

    public function getKomponentenattributeId(): Komponentenattribute
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




}

