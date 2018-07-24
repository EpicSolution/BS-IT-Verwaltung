<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * wird_beschrieben_durch
 */
class wird_beschrieben_durch
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

    /** @var ArrayCollection */
    private $komponentenattribut;

    /** @var ArrayCollection */
    private $komponentenarten;

    public function __construct()
    {
        $this->komponentenattribut = new ArrayCollection();
        $this->komponentenarten = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set komponentenartenId
     *
     * @param integer $komponentenartenId
     *
     * @return wird_beschrieben_durch
     */
    public function setKomponentenartenId($komponentenartenId)
    {
        $this->komponentenartenId = $komponentenartenId;

        return $this;
    }

    /**
     * Get komponentenartenId
     *
     * @return int
     */
    public function getKomponentenartenId()
    {
        return $this->komponentenartenId;
    }

    /**
     * Set komponentenattributeId
     *
     * @param integer $komponentenattributeId
     *
     * @return wird_beschrieben_durch
     */
    public function setKomponentenattributeId($komponentenattributeId)
    {
        $this->komponentenattributeId = $komponentenattributeId;

        return $this;
    }

    /**
     * Get komponentenattributeId
     *
     * @return int
     */
    public function getKomponentenattributeId()
    {
        return $this->komponentenattributeId;
    }

                /**
     * @return ArrayCollection
     */
    public function getkomponentenattribut(): ArrayCollection
    {
        return $this->komponentenattribut;
    }

    /**
     * @param ArrayCollection $komponentenattribut
     */
    public function setkomponentenattribut(ArrayCollection $komponentenattribut): void
    {
        $this->komponentenattribut = $komponentenattribut;
    }

                /**
     * @return ArrayCollection
     */
    public function getkomponentenarten(): ArrayCollection
    {
        return $this->komponentenarten;
    }

    /**
     * @param ArrayCollection $komponenten
     */
    public function setkomponentenarten(ArrayCollection $komponentenarten): void
    {
        $this->komponentenarten = $komponentenarten;
    }
}

