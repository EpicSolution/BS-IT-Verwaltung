<?php
declare(strict_types=1);

namespace AppBundle\Entity;

class Komponenten
{
    /** @var int */
    protected $id;
    
    /** @var int */
    protected $raeume_id;

    /** @var int */
    protected $lieferant_id;

    /** @var int */
    protected $einkaufsdatum;

    /** @var int */
    protected $gewaehrleistungsdauer;

    /** @var string */
    protected $notiz;

    /** @var string */
    protected $hersteller;

    /** @var Komponentenarten */
    protected $komponentenarten_id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getRaeume_id(): int
    {
        return $this->raeume_id;
    }

    public function setRaeume_id(int $raeume_id)
    {
        $this->raeume_id = $raeume_id;
    }

    public function getLieferant_id(): int
    {
        return $this->lieferant_id;
    }

    public function setLieferant_id(int $lieferant_id)
    {
        $this->lieferant_id = $lieferant_id;
    }

    public function getEinkaufsdatum(): int
    {
        return $this->einkaufsdatum;
    }

    public function setEinkaufsdatum(int $einkaufsdatum)
    {
        $this->einkaufsdatum = $einkaufsdatum;
    }

    public function getGewaehrleistungsdauer(): int
    {
        return $this->gewaehrleistungsdauer;
    }

    public function setGewaehrleistungsdauer(int $gewaehrleistungsdauer)
    {
        $this->gewaehrleistungsdauer = $id;
    }

    public function getNotiz(): int
    {
        return $this->notiz;
    }

    public function setNotiz(int $notiz)
    {
        $this->notiz = $notiz;
    }

    public function getHersteller(): int
    {
        return $this->hersteller;
    }

    public function setHersteller(int $hersteller)
    {
        $this->hersteller = $hersteller;
    }    

    public function getKomponentenartenId(): Komponentenarten
    {
        return $this->komponentenarten_id;
    }

    public function setKomponentenartenId(Komponentenarten $komponentenarten_id)
    {
        $this->komponentenarten_id = $komponentenarten_id;
    }
}
