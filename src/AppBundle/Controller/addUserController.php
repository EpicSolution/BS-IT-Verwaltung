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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class addUserController extends Controller
{
    /**
     * @Route("/addUser", name="add_user")
     */
    public function addUserAction(Request $request): Response
    {
        $form = $this->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
        }

        return $this->render('user/add_user.html.twig', [
            'form'  => $form->createView()
        ]);
    }

    private function getForm(): FormInterface
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class, [
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'required' => true,
            ])
            ->add('plainPassword', PasswordType::class, [
                'required' => true
            ])
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'choices' => [
                    'Systembetreuer' => 'ROLE_SYSTEM_ADMINISTRATOR',
                    'Azubi' => 'ROLE_TRAINEE',
                    'Verwalter' => 'ROLE_ADMINISTRATOR',
                    'Lehrer' => 'ROLE_TEACHER'
                ],
            ])
            ->add('submit', SubmitType::class)
            ->getForm();

        return $form;
    }
}
