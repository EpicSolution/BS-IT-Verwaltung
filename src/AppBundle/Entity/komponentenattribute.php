<?php

namespace AppBundle\Entity;

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
     * Set bezeichnung
     *
     * @param string $bezeichnung
     *
     * @return komponentenattribute
     */
    public function setBezeichnung($bezeichnung)
    {
        $this->bezeichnung = $bezeichnung;

        return $this;
    }

    /**
     * Get bezeichnung
     *
     * @return string
     */
    public function getBezeichnung()
    {
        return $this->bezeichnung;
    }
}

