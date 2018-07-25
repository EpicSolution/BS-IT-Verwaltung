<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Komponentenarten;
use AppBundle\Entity\Komponentenattribute;
use AppBundle\Form\ComponentType;
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
        $componentType = new Komponentenarten();
        $form = $this->createForm(ComponentType::class, $componentType);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Komponentenarten $formData */
            $formData = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($formData);
            $manager->flush();
            $this->addFlash('success', 'Komponente wurde erfolgreich hinzugefügt');
        }
        dump($form);
        return $this->render('componentType/add_component_type.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
