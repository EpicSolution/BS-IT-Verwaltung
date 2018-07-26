<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Komponenten;
use AppBundle\Entity\Komponentenarten;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ReportingController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function defaultSearchAction( )
    {
       
        $komponentenartrepo = $this->getDoctrine()->getRepository(Komponentenarten::class);

        $arten = $komponentenartrepo->findAll();
        $artenliste = $this->getArtenListe();
        
        $header = [];
        $values = [];

        foreach($arten as $art){
            $header[$art->getKomponentenart()] = $this->getKomponentenHeaderForArt($art);
            $values[$art->getKomponentenart()] = $this->getKomponentenValuesForArt($art);
        }



        return $this->render('AppBundle:Reporting:default_search.html.twig',
         array(
            "artenliste" => $artenliste,
            "headers" => $header,
            "values" => $values
         ));   
    }
    /**
     * @Route("/delete/component", name="delete_component",requirements  = { "id" = "\d+" })
     */
    public function searchActionAusmustern() : Response
    {
        //Service einbinden
        $this->addFlash('success', 'Komponente wurde ausgemustert');
        
        return $this->redirectToRoute('search');
    }

    function getArtenListe() {
        $komponentenartrepo = $this->getDoctrine()->getRepository(Komponentenarten::class);

        $arten = $komponentenartrepo->findAll();
        $artenliste = array_map(function($other){
            return $other->getKomponentenart();
        },$arten );
        return $artenliste;

    }

    function getKomponentenValuesForArt(Komponentenarten $art){
        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->createQueryBuilder();
        $komponenten = $qb->select('k')
                            ->from('AppBundle:Komponenten','k')
                            ->join('k.komponentenarten_id', 'art')
                            ->where('art.id = :id')
                            ->setParameter('id', $art->getId())
                            ->getQuery()->getResult();
        // $komponentenrepo = $this->getDoctrine()->getRepository(Komponenten::class);

        // $komponenten = $komponentenrepo->findAll();
        $ret = [];
        foreach($komponenten as $komp){
            $id = $komp->getId();
            $ret[$id] =[];
            $ret[$id]['id'] = $komp->getId();
            $ret[$id]['raum'] = $komp->getraeume_id()->getId();
            $ret[$id]['notiz'] = $komp->getNotiz();
            $ret[$id]['art'] = $art->getKomponentenart();
            foreach($komp->getkomponente_hat_attribute() as $attr){
                $var = $attr->getKomponentenattributeId();
                $ret[$id][$var->getBezeichnung()] = $attr->getWert();
            }
        }
        return $ret;

    }
    function getKomponentenHeaderForArt(Komponentenarten $art){
      
        $header = $this->getDefaultHeaders();
        $komponentenartrepo = $this->getDoctrine()->getRepository(Komponentenarten::class);
        
        foreach($art->getWirdBeschriebenDurch() as $attr){
            array_push($header,$attr->getKomponentenattributId()->getBezeichnung());
        }
        return $header;
    }

    function getDefaultHeaders(){
        return ['id', 'raum' ,'art', 'notiz'];
    }

}
