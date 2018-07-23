<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserListController extends Controller
{
    /**
     * @Route("/listUser", name="list_user")
     */
    public function showUsersAction(Request $request): Response
    {
        $userHeader = [];
        $users = $this->getAllUsers();

        if (!empty($users)) {
            $userHeader = $this->getUserHeader();
        }

        return $this->render('user/user_list.html.twig', [
            'users' => $users,
            'userHeader' => $userHeader
        ]);
    }

    /**
     * @Route("/delete/user/{id}", name="delete_user", requirements  = { "id" = "\d+" })
     */
    public function deleteUserAction(Request $request, string $id)
    {
        $this->deleteUser($id);
        $userHeader = [];
        $users = $this->getAllUsers();
        if (!empty($users)) {
            $userHeader = $this->getUserHeader();
        }

        return $this->render('user/user_list.html.twig', [
            'users' => $users,
            'userHeader' => $userHeader
        ]);
    }

    /**
     * @param User[] $users
     */
    private function getUserHeader(): array
    {
        return ['id', 'username', 'email', 'roles'];
    }

    /**
     * @return User[]
     */
    private function getAllUsers(): array
    {
        $userRepository = $this->getDoctrine()->getRepository('AppBundle:User');

        return $userRepository->findAll();
    }

    /**
     * @param string $id
     */
    private function deleteUser(string $id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $userManager = $this->get('fos_user.user_manager');
        $userManager->deleteUser($user);
    }
}
