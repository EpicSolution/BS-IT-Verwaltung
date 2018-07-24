<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * raeume
 */
class raeume
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $Nr;

    /**
     * @var string
     */
    private $Bezeichnung;

    /**
     * @var string
     */
    private $Notiz;

    /** @var ArrayCollection */
    private $raeume;

    /** @var ArrayCollection */
    private $software_in_raum;

    public function __construct()
    {
        $this->raeume = new ArrayCollection();
        $this->software_in_raum = new ArrayCollection();
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
     * Set Nr
     *
     * @param string $Nr
     *
     * @return raeume
     */
    public function setNr($Nr)
    {
        $this->Nr = $Nr;

        return $this;
    }

    /**
     * Get Nr
     *
     * @return string
     */
    public function getNr()
    {
        return $this->Nr;
    }

    /**
     * Set Bezeichnung
     *
     * @param string $Bezeichnung
     *
     * @return raeume
     */
    public function setBezeichnung($Bezeichnung)
    {
        $this->Bezeichnung = $Bezeichnung;

        return $this;
    }

    /**
     * Get Bezeichnung
     *
     * @return string
     */
    public function getBezeichnung()
    {
        return $this->Bezeichnung;
    }

    /**
     * Set Notiz
     *
     * @param string $Notiz
     *
     * @return raeume
     */
    public function seNotiz($Notiz)
    {
        $this->Notiz = $Notiz;

        return $this;
    }

    /**
     * Get Notiz
     *
     * @return string
     */
    public function getNotiz()
    {
        return $this->Notiz;
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
    public function getsoftware_in_raum(): ArrayCollection
    {
        return $this->software_in_raum;
    }

    /**
     * @param ArrayCollection $software_in_raum
     */
    public function setsoftware_in_raum(ArrayCollection $software_in_raum): void
    {
        $this->software_in_raum = $software_in_raum;
    }
}

