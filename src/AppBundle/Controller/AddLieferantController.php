<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Lieferant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Doctrine\DBAL\Types\TextType;

class AddLieferantController extends Controller
{
    /**
     * @Route("/add/lieferant", name="add_lieferant")
     */
    public function addLieferantAction(Request $request): Response
    {
        $form = $this->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Lieferant $user */
            $lieferant = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($lieferant);
            $manager->flush();
            $this->addFlash('success', 'Lieferant wurde hinzugefügt');
        }

        return $this->render('lieferant/add_lieferant.html.twig', [
            'form'  => $form->createView()
        ]);
    }

    private function getForm(): FormInterface
    {
        $lieferant = new Lieferant();

        $form = $this->createFormBuilder($lieferant)
        ->add('Firmenname', TextType::class, [
                'label' => 'Firmenname',
            ])
        ->add('Strasse', TextType::class, [
            'required' => false,
            'label' => 'Straße',
            'empty_data' => ''
        ])
        ->add('Plz', TextType::class, [
            'required' => false,
            'label' => 'PLZ',
            'empty_data' => ''
        ])
        ->add('Ort', TextType::class, [
            'required' => false,
            'label' => 'Ort',
            'empty_data' => ''
        ])
        ->add('Tel', TextType::class, [
            'required' => false,
            'label' => 'Telefon-Nr.',
            'empty_data' => ''
        ])
        ->add('Mobil', TextType::class, [
            'required' => false,
            'label' => 'Mobiltelefon Nr.',
            'empty_data' => ''
        ])
        ->add('Fax', TextType::class, [
            'required' => false,
            'label' => 'Fax',
            'empty_data' => ''
        ])
        ->add('Email', EmailType::class, [
            'required' => false,
            'label' => 'Email',
            'empty_data' => ''
        ])
        ->add('Anlegen', SubmitType::class, [
            'attr' => [
                    'class' => 'btn btn-primary'
            ],
            'label' => 'Lieferant anlegen',
        ])
        ->getForm();

        return $form;
    }
}
