<?php

namespace AppBundle\Entity;

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
}

