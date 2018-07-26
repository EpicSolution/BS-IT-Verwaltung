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
use AppBundle\Entity\Wird_beschrieben_durch;
use AppBundle\Entity\Komponentenattribute;
use AppBundle\Entity\Raeume;
use AppBundle\Entity\Lieferant;
use AppBundle\Entity\Komponente_hat_attribute;
use AppBundle\Repository\KomponentenattributeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
        $attributes = [];
        $form = $this->getForm();

        if ($request->getMethod() === "POST") {
            $content = $request->request->all()["form"];
            $attributes = $content["attribute["];
            unset($content["attribute["]);
            unset($content["submit"]);
            $request->request->set("form", $content);
        }

        $form->handleRequest($request);
        if ($request->getMethod() === "POST" && $form->isValid()) {
            /** @var Komponenten $component */
            $component = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($component);
            $manager->flush();
            $attributeRep = $this->getDoctrine()->getRepository(Komponentenattribute::class);
            foreach ($attributes as $attributeID => $value) {
                $attributeValues = new Komponente_hat_attribute();
                $attributeValues->setKomponentenId($component);
                $attribute = $attributeRep->find($attributeID);
                $attributeValues->setKomponentenattributeId($attribute);
                $attributeValues->setWert($value);
                $manager->persist($attributeValues);
                $manager->flush();
            }
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

    /**
    * @Route("/getCompAttr/{id}", name="get_CompAttr", requirements  = { "id" = "\d+" })
    */
    public function getCompAttr(Request $request, string $id): Response
    {
        $attrs = $this->getDoctrine()->getRepository(Wird_beschrieben_durch::class)->findBy(["komponentenartenId" => $id]);

        $inputs = "";

        foreach ($attrs as $attr) {

            $attr = $attr->getKomponentenattributId();

            $inputs .= "<input name='form[attribute[][".$attr->getId()."]]' placeholder='".$attr->getBezeichnung()."'></input>";
        }

        $response = new Response($inputs);
        $response->headers->set('Content-Type', 'text');
        return $response;
    }

    private function getForm($component = null): FormInterface
    {
        if ($component == null) {
            $component = new Komponenten();
        }
        $form = $this->createFormBuilder($component)
            ->add('Ident', TextType::class, [
                'required' => true
            ])
            ->add('komponentenarten_id', EntityType::class, [
                'class' => Komponentenarten::class,
                'label' => 'Art',
                'required' => true
            ])
            /*->add('software_in_raum', EntityType::class, [
                'class' => Raeume::class,
                'label' => 'Raum',
                'required' => true
                ,'multiple' => true
            ])*/
            ->add('raeume_id', EntityType::class, [
                'class' => Raeume::class,
                'label' => 'Raum',
                'required' => true
            ])
            ->add('lieferanten_id', EntityType::class, [
                'class' => Lieferant::class,
                'label' => 'Lieferant',
                'required' => true
            ])
            ->add('einkaufsdatum', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('gewaehrleistungsdauer', NumberType::class, [
                'required' => false,
                'label' => 'Gewährleistungsdauer',
            ])
            ->add('hersteller', TextType::class, [
                'required' => false
            ])
            ->add('notiz', TextareaType::class, [
                'required' => false
            ])
            ->getForm();
        return $form;
    }
}
