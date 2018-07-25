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
        }

        return $this->render('lieferant/edit_lieferant.html.twig', [
            'form' => $form->createView()
        ]);
    }

    private function getForm(Lieferant $lieferant): FormInterface
    {
        $form = $this->createFormBuilder($lieferant)
        ->add('Firmenname', TextType::class, [
            'required' => true
        ])
        ->add('Strasse', TextType::class, [
            'required' => false,
            'empty_data' => ''
        ])
        ->add('Plz', TextType::class, [
            'required' => false,
            'empty_data' => ''
        ])
        ->add('Ort', TextType::class, [
            'required' => false,
            'empty_data' => ''
        ])
        ->add('Tel', TextType::class, [
            'required' => false,
            'empty_data' => ''
        ])
        ->add('Mobil', TextType::class, [
            'required' => false,
            'empty_data' => ''
        ])
        ->add('Fax', TextType::class, [
            'required' => false,
            'empty_data' => ''
        ])
        ->add('Email', EmailType::class, [
            'required' => false,
            'empty_data' => ''
        ])
        ->add('submit', SubmitType::class)
        ->getForm();

        return $form;
    }
}
