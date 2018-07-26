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

class AddUserController extends Controller
{
    /**
     * @Route("/add/user", name="add_user")
     * @todo umgang mit Fehlermeldungen einbauen
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
            $this->addFlash('success', 'Benutzer wurde erfolgreich hinzugefügt');
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
                'label' => 'Benutzer anlegen',
            ])
            ->getForm();

        return $form;
    }
}
