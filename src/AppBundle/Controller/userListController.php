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

class userListController extends Controller
{
    /**
     * @Route("/listUser", name="list_user")
     */
    public function indexAction(Request $request)
    {
        $userRepository = $this->getDoctrine()->getRepository('AppBundle:User');
        $users = $userRepository->findAll();
        var_dump($users);
        die();
    }
}
