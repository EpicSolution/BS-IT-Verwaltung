<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace AppBundle\Controller;


use AppBundle\Form\ComponentAttributeType;
use AppBundle\Model\ComponentTypeModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class AddComponentController extends Controller
{
    /**
     * @Route("/add/component_type", name="add_component_type")
     */
    public function addComponentTypeAction(Request $request)
    {
        $componentTypeModel = new ComponentTypeModel();
        $form = $this->createForm(FormType::class, $componentTypeModel)
            ->add('komponentenart', TextType::class)
            ->add('bezeichnunge', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => true
            ])
            ->add('submit', SubmitType::class)
        ;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
        }
        return $this->render('componentType/add_component_type.html.twig', [
           'form'   => $form->createView()
        ]);
    }

    public function getExtraFieldAction()
    {
    }
}
