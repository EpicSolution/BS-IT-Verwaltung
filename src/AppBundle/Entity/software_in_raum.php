<?php

namespace AppBundle\Entity;

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
}

