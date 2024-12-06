<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    #[Route('/event', name: 'event')]
    public function index(EventRepository $eventRepository): Response
    {

        $events = $eventRepository->findAll();

        return $this->render('event/index.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('event/create', name: 'event_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response {

        $event = new Event();

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($event);
            $entityManager->flush();

            $this->addFlash('success', 'Event created successfully.');
            return $this->redirectToRoute('event');
        }

        $formView = $form->createView();

        return $this->render('event/create.html.twig', [
            'formView' => $formView,
        ]);
    }

    #[Route('/event/{id}/update', name: 'event_update')]
    public function update(int $id, Request $request, EntityManagerInterface $entityManager, EventRepository $eventRepository): Response {

        $event = $eventRepository->find($id);

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('event');
        }

        $formView = $form->createView();

        return $this->render('event/update.html.twig', [
            'formView' => $formView, 'event' => $event
        ]);
    }

    #[Route('/event/{id}/delete', name: 'event_delete')]
    public function delete(int $id, EntityManagerInterface $entityManager, EventRepository $eventRepository): Response {

        $event = $eventRepository->find($id);

        $entityManager->remove($event);

        $entityManager->flush();

        return $this->redirectToRoute('event_index');
    }
}
