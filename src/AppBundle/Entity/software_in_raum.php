<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * software_in_raum
 */
class software_in_raum
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
    private $raeumeId;
    
    /** @var ArrayCollection */
    private $raeume;

    /** @var ArrayCollection */
    private $komponenten;

    public function __construct()
    {
        $this->komponenten = new ArrayCollection();
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
     * Set komponentenId
     *
     * @param integer $komponentenId
     *
     * @return software_in_raum
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
     * Set raeumeId
     *
     * @param integer $raeumeId
     *
     * @return software_in_raum
     */
    public function setRaeumeId($raeumeId)
    {
        $this->raeumeId = $raeumeId;

        return $this;
    }

    /**
     * Get raeumeId
     *
     * @return int
     */
    public function getRaeumeId()
    {
        return $this->raeumeId;
    }
            /**
     * @return ArrayCollection
     */
    public function getraeume(): ArrayCollection
    {
        return $this->raeume;
    }

    /**
     * @param ArrayCollection $raeume
     */
    public function setraeume(ArrayCollection $raeume): void
    {
        $this->raeume = $raeume;
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

