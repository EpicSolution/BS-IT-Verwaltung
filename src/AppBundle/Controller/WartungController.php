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
use AppBundle\Service\verschiebeCompService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\AST\WhereClause;
use Symfony\Component\PropertyAccess\PropertyAccess;


class WartungController extends Controller
{
    private $se;
    /**@var EntityManager $em */
    public $em;
    /**
     * @Route("/wartung/{id}", name="wartung", requirements  = { "id" = "\d+" })
     */
    public function zuwarten(Request $request, string $id): Response
    {
        $zuwarten = $this->getKomponente($id);
        $raeume = $this->getRaeume($zuwarten);
        $komponenteHeader = [];
        $komponentes = $this->getAllKomponentes($id);
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
    

    /**
     * @return Komponente[]
     */
    private function getAllKomponentes(string $id): array
    {
        $list = [];
        $komponenteRepository = $this->getDoctrine()->getRepository('AppBundle:Komponenten');
        $repo_art = $this->getDoctrine()->getRepository(Komponenten::class);
        $komp_art = $repo_art->find($id);
        $art = $komp_art->getKomponentenartenId();
        $array = $komponenteRepository->findBy(["komponentenarten_id"=>$art]);

        foreach($array as $a)
        {
            if ($a->getId() != $id)
            {
                $list[] = $a;
            }
        }
        return $list;
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
            $raeume[] = $komponente->getraeume_id();
        }
        return $raeume;
    }

    private function getRaeume(Komponenten $komponente)
    {
        /**@var Komponenten $komponente */
        $raeume = $komponente->getraeume_id();
        return $raeume;
    }
    /**
     * @Route("tauscheComp/{id_alt}/{id_neu}", name="tauscheComp", requirements  = { "id_alt" = "\d+", "id_neu" = "\d+" })
     */
    public function tauscheComp(string $id_alt, string $id_neu)
    {
        $repo = $this->getDoctrine()->getRepository(Komponenten::class);
        $komp = $repo->find($id_alt);
        $raum = $komp->getraeume_id();
        $raum_alt = $raum->getId();

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQueryBuilder()
                    ->select('r.id')
                    ->from(Raeume::class, 'r')
                    ->andWhere('r.Bezeichnung LIKE :searchTerm')
                    ->setParameter('searchTerm', '%wartung%')
                    ; 
        $wartraum =$query->getQuery()->getOneOrNullResult();
        if (empty($wartraum)) {
            $r = new Raeume();
            $r->setNr(0);
            $r->setBezeichnung('wartung');
            $r->setNotiz('Raum für zu wartende Komponenten');
            $em->persist($r);
            $em->flush();
            $this->addFlash('success', 'Wartungsraum wurde hinzugefügt');
 
            $query = $em->createQueryBuilder()
                            ->select('r.id')
                            ->from(Raeume::class, 'r')
                            ->andWhere('r.Bezeichnung LIKE :searchTerm')
                            ->setParameter('searchTerm', '%wartung%')
            ; 
            $wartraum =$query->getQuery()->getOneOrNullResult();
        }

        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $wartraum = $propertyAccessor->getValue($wartraum, '[id]');
        $id_alt = intval($id_alt);
        $wartraum = intval($wartraum);
        $id_neu = intval($id_neu);
        $raum_alt = intval($raum_alt    );

        $this->verschiebe_comp($id_alt,$wartraum);
        $this->verschiebe_comp($id_neu,$raum_alt);    
        
        return $this->redirectToRoute('wartung',array('id' => $id_alt));
    }

    private function verschiebe_comp(int $id, int $raeume_id )
    {
        $this->se = $this->get(verschiebeCompService::class);
        $this->se->verschiebeComp($id,$raeume_id);
    }     
}