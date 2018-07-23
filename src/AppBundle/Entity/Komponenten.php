<?php
declare(strict_types=1);

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
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

    /** @var ArrayCollection */
    private $komponentenarten_id;
    
    /** @var ArrayCollection */
    private $lieferanten_id;
    
    /** @var ArrayCollection */
    private $raeume_id1;    
    
    /** @var ArrayCollection */
    private $komponente_hat_attribute;
    
    /** @var ArrayCollection */
    private $software_in_raum;

    public function __construct()
    {
        $this->komponentenarten_id = new ArrayCollection();
        $this->lieferanten_id = new ArrayCollection();
        $this->raeume_id = new ArrayCollection();
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

        /**
     * @return ArrayCollection
     */
    public function getkomponentenarten_id(): ArrayCollection
    {
        return $this->komponentenarten_id;
    }

    /**
     * @param ArrayCollection $komponentenarten_id
     */
    public function setkomponentenarten_id(ArrayCollection $komponentenarten_id): void
    {
        $this->komponentenarten_id = $komponentenarten_id;
    }

        /**
     * @return ArrayCollection
     */
    public function getlieferanten_id(): ArrayCollection
    {
        return $this->lieferanten_id;
    }

    /**
     * @param ArrayCollection $lieferanten_id
     */
    public function setlieferanten_id(ArrayCollection $lieferanten_id): void
    {
        $this->lieferanten_id = $lieferanten_id;
    }

        /**
     * @return ArrayCollection
     */
    public function getraeume_id1(): ArrayCollection
    {
        return $this->raeume_id1;
    }

    /**
     * @param ArrayCollection $raeume_id1
     */
    public function setraeume_id1(ArrayCollection $raeume_id1): void
    {
        $this->raeume_id1 = $raeume_id1;
    }

        /**
     * @return ArrayCollection
     */
    public function getkomponente_hat_attribute(): ArrayCollection
    {
        return $this->komponente_hat_attribute;
    }

    /**
     * @param ArrayCollection $komponente_hat_attribute
     */
    public function setkomponente_hat_attribute(ArrayCollection $komponente_hat_attribute): void
    {
        $this->komponente_hat_attribute = $komponente_hat_attribute;
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
