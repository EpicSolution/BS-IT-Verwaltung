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
     * @var int
     */
    private $rId;

    /**
     * @var string
     */
    private $rNr;

    /**
     * @var string
     */
    private $rBezeichnung;

    /**
     * @var string
     */
    private $rNotiz;


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
     * Set rId
     *
     * @param integer $rId
     *
     * @return raeume
     */
    public function setRId($rId)
    {
        $this->rId = $rId;

        return $this;
    }

    /**
     * Get rId
     *
     * @return int
     */
    public function getRId()
    {
        return $this->rId;
    }

    /**
     * Set rNr
     *
     * @param string $rNr
     *
     * @return raeume
     */
    public function setRNr($rNr)
    {
        $this->rNr = $rNr;

        return $this;
    }

    /**
     * Get rNr
     *
     * @return string
     */
    public function getRNr()
    {
        return $this->rNr;
    }

    /**
     * Set rBezeichnung
     *
     * @param string $rBezeichnung
     *
     * @return raeume
     */
    public function setRBezeichnung($rBezeichnung)
    {
        $this->rBezeichnung = $rBezeichnung;

        return $this;
    }

    /**
     * Get rBezeichnung
     *
     * @return string
     */
    public function getRBezeichnung()
    {
        return $this->rBezeichnung;
    }

    /**
     * Set rNotiz
     *
     * @param string $rNotiz
     *
     * @return raeume
     */
    public function setRNotiz($rNotiz)
    {
        $this->rNotiz = $rNotiz;

        return $this;
    }

    /**
     * Get rNotiz
     *
     * @return string
     */
    public function getRNotiz()
    {
        return $this->rNotiz;
    }
}

