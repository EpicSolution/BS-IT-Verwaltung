<?php
declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

class Komponenten
{
    /** @var int */
    protected $id;
    
    /** @var string */
    protected $Ident;

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
    private $komponentenarten_id;
    
    /** @var Lieferant */
    private $lieferanten_id;
    
    /** @var Raeume */
    private $raeume_id1;    
    
    /** @var PersistentCollection */
    private $komponente_hat_attribute;
    
    /** @var ArrayCollection */
    private $software_in_raum;

    public function __construct()
    {
        $this->komponente_hat_attribute = new ArrayCollection();
        $this->software_in_raum = new ArrayCollection();
    }

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
        $this->gewaehrleistungsdauer = $gewaehrleistungsdauer;
    }

    public function getNotiz(): string
    {
        return $this->notiz;
    }

    public function setNotiz(string $notiz)
    {
        $this->notiz = $notiz;
    }

    public function getHersteller(): string
    {
        return $this->hersteller;
    }

    public function setHersteller(string $hersteller)
    {
        $this->hersteller = $hersteller;
    }    

    public function getIdent(): string
    {
        return $this->Ident;
    }

    public function setIdent(string $Ident)
    {
        $this->Ident = $Ident;
    }  

    public function getKomponentenartenId(): Komponentenarten
    {
        return $this->komponentenarten_id;
    }

    public function setKomponentenartenId(Komponentenarten $komponentenarten_id)
    {
        $this->komponentenarten_id = $komponentenarten_id;
    }

    public function getlieferanten_id(): Lieferant
    {
        return $this->lieferanten_id;
    }

    public function setlieferanten_id(Lieferant $lieferanten_id): void
    {
        $this->lieferanten_id = $lieferanten_id;
    }

    public function getraeume_id1(): Raeume
    {
        return $this->raeume_id1;
    }

    public function setraeume_id1(Raeume $raeume_id1): void
    {
        $this->raeume_id1 = $raeume_id1;
    }

    public function getkomponente_hat_attribute(): PersistentCollection
    {
        return $this->komponente_hat_attribute;
    }

    public function setkomponente_hat_attribute(PersistentCollection $komponente_hat_attribute): void
    {
        $this->komponente_hat_attribute = $komponente_hat_attribute;
    }

    public function getsoftware_in_raum(): ArrayCollection
    {
        return $this->software_in_raum;
    }

    public function setsoftware_in_raum(ArrayCollection $software_in_raum): void
    {
        $this->software_in_raum = $software_in_raum;
    }
}
