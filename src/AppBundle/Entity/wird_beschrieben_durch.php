<?php

namespace AppBundle\Entity;

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
}

