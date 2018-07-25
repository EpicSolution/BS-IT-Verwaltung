<?php
declare(strict_types=1);

namespace AppBundle\Controller;
use AppBundle\Entity\Komponenten;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;

class WartungController extends Controller
{
    /**
     * @Route("/wartung", name="wartung")
     */
    public function showKomponentesAction(Request $request): Response
    {
        $komponenteHeader = [];
        $komponentes = $this->getAllKomponentes();
        dump($komponentes);
        if (!empty($komponentes)) {
            $komponenteHeader = $this->getKomponenteHeader();
        }
        $raeume = $this->getAllRaeume($komponentes);
        return $this->render('wartung/wartung.html.twig', [
            'komponentes' => $komponentes,
            'komponenteHeader' => $komponenteHeader
        ]);
    }

    /**
     * @return Komponente[]
     */
    private function getAllKomponentes(): array
    {
        $komponenteRepository = $this->getDoctrine()->getRepository('AppBundle:Komponenten');
        return $komponenteRepository->findAll();
    }
    /**
     * @param Komponenten[] $komponents
     */
    private function getKomponenteHeader(): array
    {
        return ['Raum', 'Bezeichnung', 'Notiz'];
    }

    private function getAllRaeume(array $komponentes): array
    {
        $raeume = [];
        /**@var Komponenten $komponente */
        foreach ($komponentes as $komponente) {
            dump($komponente);
            $raeume[] = $komponente->getRaeume_id();
        }
        return $raeume;
    }
}