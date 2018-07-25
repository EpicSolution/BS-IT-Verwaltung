<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace AppBundle\Controller;


use AppBundle\Form\ComponentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddComponentType extends Controller
{
    public function addComponentTypeAction(Request $request)
    {
        $componentType = new ComponentType();
        $form = $this->createForm(ComponentType::class, $componentType);
    }
}
