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

class DeleteLieferantController extends Controller
{
    /**
     * @Route("/delete/lieferant/{id}", name="delete_Lieferant", requirements  = { "id" = "\d+" })
     * @todo umgang mit Fehlermeldungen einbauen
     */
    public function editAction(Request $request, string $id)
    {
        $lieferant = $this->getDoctrine()->getRepository(Lieferant::class)->find($id);
        $form = $this->getForm($lieferant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $lieferant = $form->getData();
            $lieferantManager = $this->getDoctrine()->getManager();
            $lieferantManager->remove($lieferant);
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
        ->add('Strasse', TextType::class)
        ->add('Plz', TextType::class)
        ->add('Ort', TextType::class)
        ->add('Tel', TextType::class)
        ->add('Mobil', TextType::class)
        ->add('Fax', TextType::class)
        ->add('Email', TextType::class)
        ->add('submit', SubmitType::class)
        ->getForm();

        return $form;
    }
}
