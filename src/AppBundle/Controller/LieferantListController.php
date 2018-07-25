<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Entity\Lieferant;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Service\KomponentenSucheService;
use AppBundle\Enum\KomponentenSuche as Suche;

class LieferantListController extends Controller
{

    /**
     * @Route("/listLieferant", name="list_lieferant")
     */
    public function showLieferantAction(Request $request): Response
    {
        $lieferantHeader = [];
        $lieferant = $this->getAllLieferanten();
        if (!empty($lieferant)) {
            $lieferantHeader = $this->getLieferantHeader();
        }

        return $this->render('lieferant/lieferant_list.html.twig', [
            'lieferanten' => $lieferant,
            'lieferantHeader' => $lieferantHeader
        ]);
    }

    /**
     * @Route("/delete/lieferant/{id}", name="delete_lieferant", requirements  = { "id" = "\d+" })
     */
    public function deleteLieferantAction(string $id): Response
    {
        $this->deleteLieferant($id);
        $this->addFlash('success', 'Lieferant wurde erfolgreich gelöscht');
        
        return $this->redirectToRoute('list_lieferant');
    }

    /**
     * @param Lieferant[] $lieferant
     */
    private function getLieferantHeader(): array
    {
        return ['Name', 'Strasse', 'Telefon'];
    }

    /**
     * @return Lieferant[]
     */
    private function getAllLieferanten(): array
    {
        $lieferantRepository = $this->getDoctrine()->getRepository('AppBundle:Lieferant');

        return $lieferantRepository->findAll();
    }

    /**
     * @param string $id
     */
    private function deleteLieferant(string $id)
    {
        $lieferant = $this->getDoctrine()->getRepository(Lieferant::class)->find($id);
        $lieferantManager = $this->getDoctrine()->getManager();
        $lieferantManager->remove($lieferant);
        $lieferantManager->flush();
    }
}
