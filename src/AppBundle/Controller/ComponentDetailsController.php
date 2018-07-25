<?php
declare(strict_types=1);
/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
namespace AppBundle\Controller;
use AppBundle\Entity\Komponenten;
use AppBundle\Entity\Komponentenarten;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ComponentDetailsController extends Controller
{
    /**
     * @Route("/addComponent", name="add_component")
     */
    public function addComponentAction(Request $request): Response
    {
        $form = $this->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Component $component */
            $component = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($component);
            $manager->flush();
            $this->addFlash('success', 'Komponente wurde erfolgreich hinzugefügt');
        }
        return $this->render('component/component_details.html.twig', [
            'form'  => $form->createView(), 'action' => 'hinzufügen'
        ]);
    }

    /**
    * @Route("/editComponent/{id}", name="edit_component", requirements  = { "id" = "\d+" })
    */
    public function updateComponentAction(Request $request, string $id): Response
    {
        $component = $this->getDoctrine()->getRepository(Komponenten::class)->find($id);
        $form = $this->getForm($component);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Component $component */
            $component = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->merge($component);
            $manager->flush();
            $this->addFlash('success', 'Komponente wurde erfolgreich geändert');
        }
        return $this->render('component/component_details.html.twig', [
            'form'  => $form->createView(), 'action' => 'ändern'
        ]);
    }

    private function getForm($component = null): FormInterface
    {
        if ($component == null) {
            $component = new Komponenten();
        }
        $form = $this->createFormBuilder($component)
            ->add('komponentenarten_id', EntityType::class, [
                'class' => Komponentenarten::class,
                'label' => 'Art',
                'required' => true
            ])
            ->add('notiz', TextareaType::class, [
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
            ->getForm();
        return $form;
    }
}
