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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class RoomListController extends Controller
{
    /**
     * @Route("/listRoom", name="list_room")
     * @todo umgang mit Fehlermeldungen einbauen
     */
    public function showRoomsAction(Request $request): Response
    {
        $roomHeader = [];
        $rooms = $this->getAllRooms();
        if (!empty($rooms)) {
            $roomHeader = $this->getRoomHeader();
        }
        return $this->render('rooms/room_list.html.twig', [
            'rooms' => $rooms,
            'roomHeader' => $roomHeader
        ]);
    }
    /**
     * @Route("/delete/room/{id}", name="delete_room", requirements  = { "id" = "\d+" })
     */
    public function deleteRoomAction(string $id): Response
    {
        try {
            $this->deleteRoom($id);
            $this->addFlash('success', 'Raum wurde erfolgreich gelöscht');
        } catch (\Exception $err) {
            $this->addFlash('danger', 'Raum konnte nicht gelöscht werden! (Eventuell wird dieser noch wo anders Referenziert?)');
        }

        return $this->redirectToRoute('list_room');
    }
    /**
     * @param Room[] $rooms
     */
    private function getRoomHeader(): array
    {
        return ['id', 'nr', 'bezeichnung', 'notiz'];
    }
    /**
     * @return Room[]
     */
    private function getAllRooms(): array
    {
        $roomRepository = $this->getDoctrine()->getRepository('AppBundle:Raeume');
        return $roomRepository->findAll();
    }
    /**
     * @param string $id
     */
    private function deleteRoom(string $id)
    {
        $room = $this->getDoctrine()->getRepository(Raeume::class)->find($id);
        $roomManager = $this->getDoctrine()->getManager();
        $roomManager->remove($room);
        $roomManager->flush();
    }
}