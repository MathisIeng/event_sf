<?php

namespace App\Controller;

use App\Entity\Room;
use App\Form\RoomType;
use App\Repository\EstablishmentRepository;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RoomController extends AbstractController
{
    #[Route('/room', name: 'room')]
    public function index(RoomRepository $roomRepository): Response {

        $rooms = $roomRepository->findAll();

        return $this->render('room/index.html.twig', [
            'rooms' => $rooms,
        ]);
    }

    #[Route('/room/create', name: 'room_create')]
    public function create(Request $request, RoomRepository $roomRepository, EntityManagerInterface $entityManager, EstablishmentRepository $establishmentRepository): Response {

        $room = new Room();

        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($room);
            $entityManager->flush();

            $this->addFlash('success', 'Room created.');
            return $this->redirectToRoute('room');
        }

        $formView = $form->createView();

        return $this->render('room/create.html.twig', [
            'formView' => $formView,
        ]);
    }

    #[Route('/room/{id}/update', name: 'room_update')]
    public function update(int $id, Request $request, RoomRepository $roomRepository, EntityManagerInterface $entityManager): Response {

        $room = $roomRepository->find($id);

        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            return $this->redirectToRoute('room');
        }

        $formView = $form->createView();

        return $this->render('room/update.html.twig', [
            'formView' => $formView, 'room' => $room
        ]);
    }

    #[Route('/room/{id}/delete', name: 'room_delete')]
    public function delete(int $id, RoomRepository $roomRepository, EntityManagerInterface $entityManager): Response {

        $room = $roomRepository->find($id);

        $entityManager->remove($room);

        $entityManager->flush();

        return $this->redirectToRoute('room');
    }
}
