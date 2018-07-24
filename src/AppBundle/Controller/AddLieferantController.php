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
        }

        return $this->render('lieferant/add_lieferant.html.twig', [
            'form'  => $form->createView()
        ]);
    }

    private function getForm(): FormInterface
    {
        $lieferant = new Lieferant();

        $form = $this->createFormBuilder($lieferant)
        ->add('Firmenname', TextType::class)
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
