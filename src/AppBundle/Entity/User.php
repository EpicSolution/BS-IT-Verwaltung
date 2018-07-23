<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{
    /** @var int */
    protected $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function __construct()
    {
        parent::__construct();
    }

}
