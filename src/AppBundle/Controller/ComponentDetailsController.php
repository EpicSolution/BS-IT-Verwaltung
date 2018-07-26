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
use AppBundle\Entity\User;
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
        return $this->render('component/component_add.html.twig', [
            'form'  => $form->createView(), 'action' => 'hinzufügen'
        ]);
    }

    /**
    * @Route("/editComponent/{id}", name="edit_component", requirements  = { "id" = "\d+" })
    */
    public function updateComponentAction(Request $request, string $id): Response
    {
        $component = $this->getDoctrine()->getRepository(Komponenten::class)->find($id);
        $attributes = [];
        $form = $this->getForm($component);

        if ($request->getMethod() === "POST") {
            $content = $request->request->all()["form"];
            $attributes = $content["attribute["];
            unset($content["attribute["]);
            unset($content["submit"]);
            $request->request->set("form", $content);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Component $component */
            $component = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->merge($component);
            $manager->flush();

            $attributeRep = $this->getDoctrine()->getRepository(Komponentenattribute::class);
            $valRep = $this->getDoctrine()->getRepository(Komponente_hat_attribute::class);

            $vals = $valRep->findBy(["komponentenId" => $component]);
            foreach ($vals as $val) {
                $manager->remove($val);
                $manager->flush();
            }

            foreach ($attributes as $attributeID => $value) {
                $attributeValues = new Komponente_hat_attribute();
                $attributeValues->setKomponentenId($component);
                $attribute = $attributeRep->find($attributeID);
                $attributeValues->setKomponentenattributeId($attribute);
                $attributeValues->setWert($value);
                $manager->persist($attributeValues);
                $manager->flush();
            }

            $this->addFlash('success', 'Komponente wurde erfolgreich geändert');
        }
        return $this->render('component/component_edit.html.twig', [
            'form'  => $form->createView(), 'action' => 'ändern', 'ID' => $id
        ]);
    }

    /**
    * @Route("/getAttr/{id}", name="get_Attr", requirements  = { "id" = "\d+" })
    */
    public function getAttr(Request $request, string $id): Response
    {
        $attrs = $this->getDoctrine()->getRepository(Wird_beschrieben_durch::class)->findBy(["komponentenartenId" => $id]);

        $inputs = "";

        foreach ($attrs as $attr) {

            $attr = $attr->getKomponentenattributId();

            $inputs .= "<div class='form-group'><label for='attr".$attr->getId()."'>".$attr->getBezeichnung()."</label><input type='text' class='form-control' id='attr".$attr->getId()."' name='form[attribute[][".$attr->getId()."]]'></input></div>";
        }

        $response = new Response($inputs);
        $response->headers->set('Content-Type', 'text');
        return $response;
    }


    /**
    * @Route("/getCompAttr/{id}/{compID}", name="get_CompAttr", requirements  = { "id" = "\d+" })
    */
    public function getCompAttr(Request $request, string $id, string $compID): Response
    {
        $attrs = $this->getDoctrine()->getRepository(Wird_beschrieben_durch::class)->findBy(["komponentenartenId" => $id]);
        $comp_attrs_rep = $this->getDoctrine()->getRepository(Komponente_hat_attribute::class);
        /** @var User $user */
        $user = $this->getUser();
        $disabled = (in_array('ROLE_ADMINISTRATOR', $user->getRoles()) || in_array('ROLE_TEACHER', $user->getRoles())) ? "disabled" : "";
        $inputs = "";

        foreach ($attrs as $attr) {

            $attr = $attr->getKomponentenattributId();

            $value = "";

            if ($compID != -1) {
                $obj = $comp_attrs_rep->findOneBy(["komponentenId" => $compID, "komponentenattributeId" => $attr->getId()]);
                if ($obj) {
                    $value = $obj->getWert();
                }
            }

            $inputs .= "<div class='form-group'><label for='attr".$attr->getId()."'>".$attr->getBezeichnung()."</label><input type='text' class='form-control' id='attr".$attr->getId()."' name='form[attribute[][".$attr->getId()."]]' value='$value' $disabled></input></div>";
        }

        $response = new Response($inputs);
        $response->headers->set('Content-Type', 'text');
        return $response;
    }


    private function getForm($component = null): FormInterface
    {
        /** @var User $user */
        $user = $this->getUser();
        $user->getRoles();
        $disabled = in_array('ROLE_ADMINISTRATOR', $user->getRoles()) || in_array('ROLE_TEACHER', $user->getRoles());
        if ($component == null) {
            $component = new Komponenten();
        }
        $form = $this->createFormBuilder($component)
            ->add('Ident', TextType::class, [
                'label' => 'Bezeichnung',
                'required' => true,
                'disabled' => $disabled
            ])
            ->add('komponentenarten_id', EntityType::class, [
                'class' => Komponentenarten::class,
                'label' => 'Art',
                'required' => true,
                'disabled' => $disabled
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
                'required' => true,
                'disabled' => $disabled
            ])
            ->add('lieferanten_id', EntityType::class, [
                'class' => Lieferant::class,
                'label' => 'Lieferant',
                'required' => true,
                'disabled' => $disabled
            ])
            ->add('einkaufsdatum', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
                'disabled' => $disabled
            ])
            ->add('gewaehrleistungsdauer', NumberType::class, [
                'required' => true,
                'label' => 'Gewährleistungsdauer',
                'disabled' => $disabled
            ])
            ->add('hersteller', TextType::class, [
                'required' => true,
                'disabled' => $disabled
            ])
            ->add('notiz', TextareaType::class, [
                'required' => false,
                'empty_data' => "",
                'disabled' => $disabled
            ])
            ->getForm();
        return $form;
    }
}
