<?php

namespace AppBundle\Entity;

class Wird_beschrieben_durch
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $komponentenartenId;

    /**
     * @var int
     */
    private $komponentenattributeId;

    /** @var Komponentenattribute */
    private $komponentenattribut;

    /** @var Komponentenarten */
    private $komponentenarten;

    public function getId(): int
    {
        return $this->id;
    }

    public function setKomponentenartenId(int $komponentenartenId): self
    {
        $this->komponentenartenId = $komponentenartenId;

        return $this;
    }

    public function getKomponentenartenId(): int
    {
        return $this->komponentenarten->getId();
    }

    public function setKomponentenattributeId(int $komponentenattributeId): self
    {
        $this->komponentenattributeId = $komponentenattributeId;

        return $this;
    }

    public function getKomponentenattributeId(): int
    {
        return $this->komponentenattribut->getId();
    }

    public function getkomponentenattribut(): Komponentenattribute
    {
        return $this->komponentenattribut;
    }

    public function setkomponentenattribut(Komponentenattribute $komponentenattribut): void
    {
        $this->komponentenattribut = $komponentenattribut;
    }

    public function getkomponentenarten(): Komponentenarten
    {
        return $this->komponentenarten;
    }

    public function setkomponentenarten(Komponentenarten $komponentenarten): void
    {
        $this->komponentenarten = $komponentenarten;
    }
}

