<?php

namespace AppBundle\Entity;

class Wird_beschrieben_durch
{
    /**
     * @var int
     */
    private $komponentenartenId;

    /**
     * @var Komponentenattribute
     */
    private $komponentenattributId;

    /**
     * @return int
     */
    public function getKomponentenartenId(): Komponentenarten
    {
        return $this->komponentenartenId;
    }

    /**
     * @param int $komponentenartenId
     */
    public function setKomponentenartenId(Komponentenarten $komponentenartenId)
    {
        $this->komponentenartenId = $komponentenartenId;
    }

    /**
     * @return Komponentenattribute
     */
    public function getKomponentenattributId(): Komponentenattribute
    {
        return $this->komponentenattributId;
    }

    /**
     * @param Komponentenattribute $komponentenattributId
     */
    public function setKomponentenattributId(Komponentenattribute $komponentenattributId)
    {
        $this->komponentenattributId = $komponentenattributId;
    }
}

