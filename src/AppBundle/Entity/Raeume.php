<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

class Raeume
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

    public function getId(): int
    {
        return $this->id;
    }

    public function setNr(int $Nr): self
    {
        $this->Nr = $Nr;

        return $this;
    }

    public function getNr(): ?string
    {
        return $this->Nr;
    }

    public function setBezeichnung(string $Bezeichnung): self
    {
        $this->Bezeichnung = $Bezeichnung;

        return $this;
    }

    public function getBezeichnung(): ?string
    {
        return $this->Bezeichnung;
    }

    public function setNotiz(string $Notiz): self
    {
        $this->Notiz = $Notiz;

        return $this;
    }

    public function getNotiz(): ?string
    {
        return $this->Notiz;
    }

    public function getraeume(): ArrayCollection
    {
        return $this->raeume;
    }

    public function setraeume(ArrayCollection $raeume): self
    {
        $this->raeume = $raeume;

        return $this;
    }

    public function getsoftware_in_raum(): ArrayCollection
    {
        return $this->software_in_raum;
    }

    public function setsoftware_in_raum(ArrayCollection $software_in_raum): self
    {
        $this->software_in_raum = $software_in_raum;
    }
}

