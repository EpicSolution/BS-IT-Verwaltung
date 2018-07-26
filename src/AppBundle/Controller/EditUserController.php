<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditUserController extends Controller
{
    /**
     * @Route("/edit/user/{id}", name="edit_user", requirements  = { "id" = "\d+" })
     * @todo umgang mit Fehlermeldungen einbauen
     */
    public function editAction(Request $request, string $id)
    {
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();
        dump($currentUser);

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->getForm($user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);
            $this->addFlash('success', 'Benutzer wurde erfolgreich geändert');
        }

        return $this->render('user/edit_user.html.twig', [
            'form' => $form->createView()
        ]);
    }

    private function getForm(User $user): FormInterface
    {
        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class, [
                'required' => true,
                'label' => 'Username',
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'E-mail',
            ])
            ->add('plainPassword', PasswordType::class, [
                'required' => true,
                'label' => 'Passwort',
            ])
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'choices' => [
                    'Systembetreuer' => 'ROLE_SYSTEM_ADMINISTRATOR',
                    'Azubi' => 'ROLE_TRAINEE',
                    'Verwalter' => 'ROLE_ADMINISTRATOR',
                    'Lehrer' => 'ROLE_TEACHER'
                ],
                'attr' => [
                    'class' => 'selectpicker'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
                'label' => 'Speichern',
            ])
            ->getForm();

        return $form;
    }
}
