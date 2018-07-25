<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace AppBundle\Model;


class ComponentTypeModel
{
    /** @var string $komponentenart */
    private $komponentenart;

    /** @var string $bezeichnung */
    private $bezeichnung;

    public function getKomponentenart(): ?string
    {
        return $this->komponentenart;
    }

    public function setKomponentenart(string $komponentenart): void
    {
        $this->komponentenart = $komponentenart;
    }

    public function getBezeichnung(): ?string
    {
        return $this->bezeichnung;
    }

    public function setBezeichnung(string $bezeichnung): void
    {
        $this->bezeichnung = $bezeichnung;
    }
}
