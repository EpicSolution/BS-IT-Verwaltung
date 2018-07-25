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

    /** @var array $bezeichnunge */
    private $bezeichnunge;

    public function getKomponentenart(): ?string
    {
        return $this->komponentenart;
    }

    public function setKomponentenart(string $komponentenart): void
    {
        $this->komponentenart = $komponentenart;
    }

    public function getBezeichnunge(): ?array
    {
        return $this->bezeichnunge;
    }

    public function setBezeichnunge(array $bezeichnunge): void
    {
        $this->bezeichnunge = $bezeichnunge;
    }
}
