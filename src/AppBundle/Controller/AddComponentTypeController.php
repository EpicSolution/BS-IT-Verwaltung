<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddComponentTypeController extends Controller
{
    public function addComponentTypeAction(Request $request)
    {

        return $this->render('componentType/add_component_type.html.twig');
    }
}
