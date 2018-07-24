<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * komponentenattribute
 */
class komponentenattribute
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

    /**
     * Set bezeichnung
     *
     * @param string $bezeichnung
     *
     * @return komponentenattribute
     */
    public function setBezeichnung(string $bezeichnung)
    {
        $this->bezeichnung = $bezeichnung;

        return $this;
    }

    /**
     * Get bezeichnung
     *
     * @return string
     */
    public function getBezeichnung(): string
    {
        return $this->bezeichnung;
    }

    /**
     * @return ArrayCollection
     */
    public function getKomponentenattributeHat(): ArrayCollection
    {
        return $this->komponentenattribute_hat;
    }

    /**
     * @param ArrayCollection $komponentenattribute_hat
     */
    public function setKomponentenattributeHat(ArrayCollection $komponentenattribute_hat): void
    {
        $this->komponentenattribute_hat = $komponentenattribute_hat;
    }

    /**
     * @return ArrayCollection
     */
    public function getKomponentenattributeBeschr(): ArrayCollection
    {
        return $this->komponentenattribute_beschr;
    }

    /**
     * @param ArrayCollection $komponentenattribute_beschr
     */
    public function setKomponentenattributeBeschr(ArrayCollection $komponentenattribute_beschr): void
    {
        $this->komponentenattribute_beschr = $komponentenattribute_beschr;
    }
}

