<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Komponenten;
use AppBundle\Entity\Komponentenarten;
use AppBundle\Entity\Raeume;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\HttpFoundation\Request;

class ReportingController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function defaultSearchAction( Request $request)
    {
       
        $komponentenartrepo = $this->getDoctrine()->getRepository(Komponentenarten::class);

        $arten = $komponentenartrepo->findAll();
        $artenliste = $this->getArtenListe();
        
        $header = [];
        $values = [];
        $raume =  $this->getRaume();
        foreach($arten as $art){
            $header[$art->getKomponentenart()] = $this->getKomponentenHeaderForArt($art);
            $values[$art->getKomponentenart()] = $this->getKomponentenValuesForArt($art);
        }
        $raumarr = [];
        foreach($raume as $raum){
            $raumarr[$raum->getId()] = $raum;
        }
        $artenarr = [];
        foreach($arten as $art){
            $artenarr[$art->getId()] = $art;
        }
        $form = $this->getForm($raumarr, $artenarr);

        
        return $this->render('reporting/default_search.html.twig',
         array(
            "artenliste" => $artenliste,
            "headers" => $header,
            "values" => $values,
            "form" => $form
         ));

        
    }

    function getRaume() {
        $raumrepo = $this->getDoctrine()->getRepository(Raeume::class);
        return $raumrepo->findAll();
    }
    function getArtenListe() {
        $komponentenartrepo = $this->getDoctrine()->getRepository(Komponentenarten::class);

        $arten = $komponentenartrepo->findAll();
        $artenliste = array_map(function($other){
            return $other->getKomponentenart();
        },$arten );
        return $artenliste;

    }
    /**
     * @Route("/gen", name="genParams")
     */
    public function generateParams(Request $request){

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
     
        $ret = [];
        foreach($komponenten as $komp){
            $id = $komp->getId();
            $ret[$id] =[];
            $ret[$id]['RaumNr'] = $komp->getraeume_id()->getNr();
            $ret[$id]['Notiz'] = $komp->getNotiz();
            $ret[$id]['Komponentenart'] = $art->getKomponentenart();
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
        return [ 'RaumNr' ,'Komponentenart', 'Notiz'];
    }

    private function getForm($raeume, $arten): FormInterface
    {
        $form = $this->createFormBuilder()
        ->add('Raum', ChoiceType::class, array(
            'choices' => $raeume,
            'choice_label' => function ($choiceValue, $key, $value) {
        
                return $value->getBezeichnung();

            },
        ))
        ->add('Komponentenart', ChoiceType::class, array(
            'choices' => $arten,
            'choice_label' => function ($choiceValue, $key, $value) {
        
                return $value->getKomponentenart();

            },
        ))
        ->add("Bezeichnung", TextType::class )
        ->setAction($this->generateUrl("genParams"))
        ->add('Suchen', SubmitType::class)
        ->getForm();

        return $form;
    }



}
