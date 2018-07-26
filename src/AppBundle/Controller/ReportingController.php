<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Komponenten;
use AppBundle\Entity\Komponentenarten;
use AppBundle\Service\KomponentenSucheService;
use AppBundle\Entity\Raeume;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\verschiebeCompService;
use AppBundle\Entity\Raeume;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


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
        $komponenten = [];
        $form->handleRequest($request);
        $search = $this->get(KomponentenSucheService::class);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $raum = $data['Raum'];
            $raumid = null;
            if($raum){
                $raumid = $raum->getId();
            }
            $kompart = $data['Komponentenart'];
            $kompartid = null;
            if($kompart){
                $kompartid = $kompart->getId();
            }
            if($kompartid == null && $raumid == null && $data['Bezeichnung'] == null){
                $repo = $this->getDoctrine()->getRepository(Komponenten::class);

                $komponenten = $repo->findAll(); 
            } else {
            $komponenten = $search->findByBezeichnung($data['Bezeichnung'], $raumid,$kompartid );
            }
        } else {
            $repo = $this->getDoctrine()->getRepository(Komponenten::class);

            $komponenten = $repo->findAll(); 
        }
        


        return $this->render('reporting/default_search.html.twig',
         array(
            "artenliste" => $artenliste,
            "headers" => $header,
            "values" => $this->convertKomponentsToValues($komponenten),
            "form" => $form->createView()
         ));
    }

    /**
     * @Route("/delete/component/{id}", name="delete_component",requirements  = { "id" = "\d+" })
     */
    public function searchActionAusmustern(Request $req, int $id) : Response
    {
        $verschiebeService = $this->get(verschiebeCompService::class);
        $verschiebeService->komponentAusmustern($id);
        $this->addFlash('success', 'Komponente wurde ausgemustert');
        
        return $this->redirectToRoute('search');
        //return $this->redirectToRoute('list_lieferant');
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
            $art = $komp->getKomponentenartenId()->getKomponentenart();
            $ret[$id] =[];
            $ret[$id]['RaumNr'] = $komp->getRaeumeId()->getNr();
            $ret[$id]['Notiz'] = $komp->getNotiz();
            $ret[$id]['Komponentenart'] = $art;
            // foreach($komp->getkomponente_hat_attribute() as $attr){
            //     $var = $attr->getKomponentenattributeId();
            //     $ret[$id][$var->getBezeichnung()] = $attr->getWert();
            // }
        }
        return $ret;

    }

    function convertKomponentsToValues($komponenten){
        $ret = [];
        dump($komponenten);
        if(!$komponenten){
            return [];
        }
        foreach($komponenten as $komp){
            $id = $komp->getId();
            $art = $komp->getKomponentenartenId()->getKomponentenart();

            $ret[$art][$id] =[];
            $ret[$art][$id]['RaumNr'] = $komp->getRaeumeId()->getNr();
            $ret[$art][$id]['Notiz'] = $komp->getNotiz();
            $ret[$art][$id]['Komponentenart'] = $art;
            $ret[$art][$id]['Bezeichnung'] = $komp->getIdent();
            // foreach($komp->getkomponente_hat_attribute() as $attr){
            //     $var = $attr->getKomponentenattributeId();
            //     $ret[$id][$var->getBezeichnung()] = $attr->getWert();
            // }
        }
        return $ret;
    }

    function getKomponentenHeaderForArt(Komponentenarten $art){
      
        $header = $this->getDefaultHeaders();
        $komponentenartrepo = $this->getDoctrine()->getRepository(Komponentenarten::class);
        
        // foreach($art->getWirdBeschriebenDurch() as $attr){
        //     array_push($header,$attr->getKomponentenattributId()->getBezeichnung());
        // }
        return $header;
    }

    function getDefaultHeaders(){
        return [ 'RaumNr' ,'Komponentenart', 'Notiz', 'Bezeichnung'];
    }

    private function getForm($raeume, $arten)
    {
        $form = $this->createFormBuilder()
        ->add('Raum', ChoiceType::class, array(
            'choices' => $raeume,
            'required' => false,
            'choice_label' => function ($choiceValue, $key, $value) {
        
                return $value;

            },
        ))
        ->add('Komponentenart', ChoiceType::class, array(
            'choices' => $arten,
            'required' => false,

           'choice_label' => function ($choiceValue, $key, $value) {
        
                return $value;

            },
        ))
        ->add("Bezeichnung", TextType::class, [
            "required" => false
        ] )
        ->add('Suchen', SubmitType::class)
        ->getForm();

        return $form;
    }



}
