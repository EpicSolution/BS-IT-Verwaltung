<?php
declare(strict_types=1);


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Lieferant
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $firmenname;

    /** @var string */
    protected $strasse;

    /** @var string */
    protected $plz;

    /** @var string */
    protected $ort;

    /** @var string */
    protected $tel;

    /** @var string */
    protected $mobil;

    /** @var string */
    protected $fax;

    /** @var string */
    protected $email;

    /** @var ArrayCollection */
    private $komponenten;

    public function __construct()
    {
        $this->komponenten = new ArrayCollection();
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setFirmenname(string $firmenname)
    {
        $this->firmenname = $firmenname;
    }

    public function getFirmenname(): ?string
    {
        return $this->firmenname;
    }

    public function setStrasse(?string $strasse)
    {
        $this->strasse = $strasse;
    }

    public function getStrasse(): ?string
    {
        return $this->strasse;
    }

    public function setPlz(?string $plz)
    {
        $this->plz = $plz;
    }

    public function getPlz(): ?string
    {
        return $this->plz;
    }

    public function setOrt(?string $ort)
    {
        $this->ort = $ort;
    }

    public function getOrt(): ?string
    {
        return $this->ort;
    }

    public function setTel(?string $tel)
    {
        $this->tel = $tel;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setMobil(?string $mobil)
    {
        $this->mobil = $mobil;
    }

    public function getMobil(): ?string
    {
        return $this->mobil;
    }

    public function setFax(?string $fax)
    {
        $this->fax = $fax;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setEmail(?string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
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

    public function __toString(): string
    {
        return $this->getFirmenname();
    }
}
