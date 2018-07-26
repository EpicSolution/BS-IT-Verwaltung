<?php
declare(strict_types=1);
/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */
namespace AppBundle\Controller;
use AppBundle\Entity\Raeume;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomDetailsController extends Controller
{
    /**
     * @Route("/add/Room", name="add_room")
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

    /**
    * @Route("/edit/Room/{id}", name="edit_room", requirements  = { "id" = "\d+" })
    */
    public function updateRoomAction(Request $request, string $id): Response
    {
        $room = $this->getDoctrine()->getRepository(Raeume::class)->find($id);
        $form = $this->getForm($room);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Room $room */
            $room = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->merge($room);
            $manager->flush();
            $this->addFlash('success', 'Raum wurde erfolgreich geändert');
        }
        return $this->render('rooms/room_details.html.twig', [
            'form'  => $form->createView(), 'action' => 'ändern'
        ]);
    }

    private function getForm($user = null): FormInterface
    {
        if ($user == null) {
            $user = new Raeume();
        }
        $form = $this->createFormBuilder($user)
            ->add('nr', TextType::class, [
                'required' => true,
                'label' => 'Raum-Nr.',
            ])
            ->add('bezeichnung', TextType::class, [
                'required' => true,
                'label' => 'Raumbezeichnung',
            ])
            ->add('notiz', TextareaType::class, [
                'required' => false,
                'label' => 'Notiz',
            ])
            ->add('Speichern', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
                'label' => 'Raum Hinzufügen',
            ])
            ->getForm();
        return $form;
    }
}