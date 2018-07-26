<?php
declare(strict_types=1);

namespace AppBundle\Controller;
use AppBundle\Entity\Komponenten;
use AppBundle\Entity\Raeume;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;
use Appbundle\Service\verschiebeCompService;

class WartungController extends Controller
{
    /**
     * @Route("/wartung/{id}", name="wartung", requirements  = { "id" = "\d+" })
     */
    public function zuwarten(Request $request, string $id): Response
    {
        $zuwarten = $this->getKomponente($id);
        $raeume = $this->getRaeume($zuwarten);
        $komponenteHeader = [];
        $komponentes = $this->getAllKomponentes();
        if (!empty($komponentes)) {
            $komponenteHeader = $this->getKomponenteHeader();
        }
        $raeume = $this->getAllRaeume($komponentes);
        return $this->render('wartung/wartung.html.twig', [
            'zuwarten' => $zuwarten,
            'komponentes' => $komponentes,
            'komponenteHeader' => $komponenteHeader
        ]);
    }
    public function showKomponentesAction(Request $request): Response
    {
        $komponenteHeader = [];
        $komponentes = $this->getAllKomponentes();
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
     * @return Komponente[]
     */
    private function getKomponente(string $id)
    {
        $komponenteRepository = $this->getDoctrine()->getRepository('AppBundle:Komponenten');
        return $komponenteRepository->find($id);
    }

    /**
     * @param Komponenten[] $komponents
     */
    private function getKomponenteHeader(): array
    {
        return ['Raum', 'Bezeichnung', 'Notiz', 'Aktion'];
    }

    private function getAllRaeume(array $komponentes): array
    {
        $raeume = [];
        /**@var Komponenten $komponente */
        foreach ($komponentes as $komponente) {
            $raeume[] = $komponente->getRaeume_id();
        }
        return $raeume;
    }

    private function getRaeume(Komponenten $komponente)
    {
        $raeume = [];
        /**@var Komponenten $komponente */
        $raeume[] = $komponente->getRaeume_id();
        return $raeume;
    }

    public function __construct(verschiebeCompService $se)
    {
        $this->se = $se; 
    }
    
    public function tauscheComp(string $id_alt, string $raum_alt, string $wartraum, string $id_neu)
    {

        $request = $this->getRequest();
        $searchterm = $request->get('wartung');
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery("SELECT r.id FROM Raeume n WHERE n.bezeichnung LIKE '% :searchterm %'")
                 ->setParameter('searchterm', $searchterm);    
        $wartraum = $query->getResult();

        verschiebe_comp($id_alt,$wartraum);
        verschiebe_comp($id_neu,$raum_alt);        
    }

    private function verschiebe_comp(string $id, string $raeume_id )
    {
        $this->se->verschiebeComp($id,$raeume_id);
    }
}