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
    private $komponentenattribute;

    /** @var ArrayCollection */
    private $komponenten;

    public function __construct()
    {
        $this->komponentenattribute = new ArrayCollection();
        $this->raeume = new ArrayCollection();
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
    public function getkomponentenattribute(): ArrayCollection
    {
        return $this->komponentenattribute;
    }

    /**
     * @param ArrayCollection $komponentenattribute
     */
    public function setkomponentenattribute(ArrayCollection $komponentenattribute): void
    {
        $this->komponentenattribute = $komponentenattribute;
    }

                /**
     * @return ArrayCollection
     */
    public function getkomponenten(): ArrayCollection
    {
        return $this->komponenten;
    }

    /**
     * @param ArrayCollection $komponenten
     */
    public function setkomponenten(ArrayCollection $komponenten): void
    {
        $this->komponenten = $komponenten;
    }
}

