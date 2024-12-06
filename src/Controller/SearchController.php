<?php

namespace App\Controller;

use App\Repository\AnimatorRepository;
use App\Repository\CategoryRepository;
use App\Repository\EstablishmentRepository;
use App\Repository\EventRepository;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController {

    #[Route('/search', name: 'search')]
    public function search(
        AnimatorRepository $animatorRepository,
        CategoryRepository $categoryRepository,
        EstablishmentRepository $establishmentRepository,
        EventRepository $eventRepository,
        RoomRepository $roomRepository,
        Request $request,
    ) {

        $search = $request->query->get('search');

        $animators = $animatorRepository->search($search);
        $events = $eventRepository->search($search);
        $rooms = $roomRepository->search($search);
        $establishments = $establishmentRepository->search($search);
        $categories = $categoryRepository->search($search);



        return $this->render('search/index.html.twig', [
            'animators' => $animators, 'categories' => $categories, 'establishments' => $establishments,
            'rooms' => $rooms, 'search' => $search, 'events' => $events,
        ]);
    }
}