<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddComponentTypeController extends Controller
{
    /**
     * @Route("/add/component_type", name="add_component_type")
     */
    public function addComponentTypeAction(Request $request)
    {
        if ($request->getMethod() === 'POST') {
            $content = $request->request->all();

        }
        return $this->render('componentType/add_component_type.html.twig');
    }
}
