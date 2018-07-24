<?php
declare(strict_types=1);
/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
namespace AppBundle\Controller;
use AppBundle\Entity\Komponenten;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class RoomDetailsController extends Controller
{
    /**
     * @Route("/get_Komponente", name="get_Komponente")
     */
    public function addRoomAction(Request $request): Response
    {
        $form = $this->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Room $room */
            $room = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($room);
            $manager->flush();
            $this->addFlash('success', 'Raum wurde erfolgreich hinzugefügt');
        }
        return $this->render('rooms/room_details.html.twig', [
            'form'  => $form->createView(), 'action' => 'hinzufügen'
        ]);
    }
   
    private function getForm($user = null): FormInterface
    {
        if ($user == null) {
            //$user = new Raeume();
        }
        $form = $this->createFormBuilder($user)
            ->add('nr', TextType::class, [
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
            ->getForm();
        return $form;
    }
}