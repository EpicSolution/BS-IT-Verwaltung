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
use AppBundle\Entity\Wird_beschrieben_durch;
use Doctrine\ORM\PersistentCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComponentTypeListController extends Controller
{
    /**
     * @Route("/showComponentTypes", name="show_component_types")
     */
    public function showComponentTypesAction(Request $request): Response
    {
        $componentHeader = [];
        $components = $this->getAllComponents();
        $componentAttributes = $this->getAllComponentAttribute($components);

        if (!empty($components)) {
            $componentHeader = $this->getComponentHeader();
        }

        return $this->render('componentType/component_type_list.html.twig', [
            'components' => $components,
            'componentHeader' => $componentHeader,
            'componentAttributes' => $componentAttributes
        ]);
    }

    private function getComponentHeader(): array
    {
        return ['Id', 'Komponentenart', 'Komponentenattribute'];
    }

    private function getAllComponents(): array
    {
        $componentRepository = $this->getDoctrine()->getRepository(Komponentenarten::class);

        return $componentRepository->findAll();
    }

    private function getAllComponentAttribute(array $components): array
    {
        $componentenAttributes = [];
        /** @var Komponentenarten $component */
        foreach ($components as $component) {
            /** @var PersistentCollection $componentEntityCollection */
            $componentEntityCollection = $component->getWirdBeschriebenDurch();

            $componentEntities = $componentEntityCollection->getValues();
            dump($componentEntities);
            /** @var Wird_beschrieben_durch $componentEntity */
            foreach ($componentEntities as $componentEntity) {
                /** @var Komponentenattribute $componentenAttributes */
                $componentenAttributes[] = $componentEntity->getKomponentenattributId();

            }
        }

        return $componentenAttributes;
    }
}
