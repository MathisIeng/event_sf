<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\EstablishmentRepository;
use App\Repository\EventRepository;
use App\Repository\AnimatorRepository;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    class SearchController extends AbstractController {
        #[Route('/search', name: 'search', methods: ['GET'])]

        public function search(
            Request $request,
            CategoryRepository $categoryRepository,
            EventRepository $eventRepository,
            AnimatorRepository $animatorRepository,
            RoomRepository $roomRepository,
            EstablishmentRepository $establishmentRepository,
            ): Response {

                $query = $request->query->get('search', '');

                $room = $roomRepository->findBySearch($query);
                $establishment = $establishmentRepository->findBySearch($query);
                $categories = $categoryRepository->findBySearch($query);
                $events = $eventRepository->findBySearch($query);
                $animators = $animatorRepository->findBySearch($query);

                return $this->render('search/index.html.twig', [
                    'query' => $query,
                    'categories' => $categories,
                    'events' => $events,
                    'animators' => $animators,
                    'establishment' => $establishment,
                    'room' => $room,
                ]);
                }
                }