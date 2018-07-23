<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * komponente_hat_attribute
 */
class komponente_hat_attribute
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $komponentenId;

    /**
     * @var int
     */
    private $komponentenattributeId;

    /**
     * @var string
     */
    private $wert;

    /** @var ArrayCollection */
    private $komponentenattribute;

    /** @var ArrayCollection */
    private $komponentenid;

    public function __construct()
    {
        $this->komponentenattribute = new ArrayCollection();
        $this->komponentenid = new ArrayCollection();
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
     * Set komponentenId
     *
     * @param integer $komponentenId
     *
     * @return komponente_hat_attribute
     */
    public function setKomponentenId($komponentenId)
    {
        $this->komponentenId = $komponentenId;

        return $this;
    }

    /**
     * Get komponentenId
     *
     * @return int
     */
    public function getKomponentenId()
    {
        return $this->komponentenId;
    }

    /**
     * Set komponentenattributeId
     *
     * @param integer $komponentenattributeId
     *
     * @return komponente_hat_attribute
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
     * Set wert
     *
     * @param string $wert
     *
     * @return komponente_hat_attribute
     */
    public function setWert($wert)
    {
        $this->wert = $wert;

        return $this;
    }

    /**
     * Get wert
     *
     * @return string
     */
    public function getWert()
    {
        return $this->wert;
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
    public function getkomponentenid1(): ArrayCollection
    {
        return $this->komponentenid;
    }

    /**
     * @param ArrayCollection $komponentenid
     */
    public function setkomponentenid1(ArrayCollection $komponentenid): void
    {
        $this->komponentenid = $komponentenid;
    }
}

