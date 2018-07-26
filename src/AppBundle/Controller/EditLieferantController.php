<?php
declare(strict_types=1);

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

class EditLieferantController extends Controller
{
    /**
     * @Route("/edit/lieferant/{id}", name="edit_lieferant", requirements  = { "id" = "\d+" })
     * @todo umgang mit Fehlermeldungen einbauen
     */
    public function editAction(Request $request, string $id): Response
    {
        $lieferant = $this->getDoctrine()->getRepository(Lieferant::class)->find($id);
        if (empty($lieferant)) {
            $this->addFlash('danger', 'Lieferant existiert nicht');
            return $this->redirectToRoute('list_lieferant');
        }
        $form = $this->getForm($lieferant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $lieferant = $form->getData();
            $lieferantManager = $this->getDoctrine()->getManager();
            $lieferantManager->persist($lieferant);
            $lieferantManager->flush();
            $this->addFlash('success', 'Lieferant wurde bearbeitet');
        }

        return $this->render('lieferant/edit_lieferant.html.twig', [
            'form' => $form->createView()
        ]);
    }

    private function getForm(Lieferant $lieferant): FormInterface
    {
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
            'label' => 'Speichern',
        ])
        ->getForm();

        return $form;
    }
}
