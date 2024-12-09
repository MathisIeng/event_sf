<?php

namespace App\Controller;

use App\Entity\Establishment;
use App\Form\EstablishmentType;
use App\Repository\EstablishmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EstablishmentController extends AbstractController {

    #[Route('/establishment', name: 'establishment')]
    public function index(EstablishmentRepository $establishmentRepository): Response {

        $establishments = $establishmentRepository->findAll();

        return $this->render('establishment/index.html.twig', [
            'establishments' => $establishments,
        ]);
    }

    #[Route('/establishment/create', name: 'establishment_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response {

        $establishment = new Establishment();

        $form = $this->createForm(EstablishmentType::class, $establishment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($establishment);
            $entityManager->flush();

            $this->addFlash('success', 'Establishment created.');
            return $this->redirectToRoute('establishment');
        }

            $formView = $form->createView();

            return $this->render('establishment/create.html.twig', [
            'formView' => $formView,
        ]);
    }

    #[Route('/establishment/{id}/update', name: 'establishment_update')]
    public function update(int $id, Request $request, EstablishmentRepository $establishmentRepository, EntityManagerInterface $entityManager): Response {

        $establishment = $establishmentRepository->find($id);

        $form = $this->createForm(EstablishmentType::class, $establishment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('establishment');
        }

        $formView = $form->createView();

        return $this->render('establishment/update.html.twig', [
            'formView' => $formView, 'establishment' => $establishment
        ]);
    }

    #[Route('/establishment/{id}/delete', name: 'establishment_delete')]
    public function delete(int $id, EstablishmentRepository $establishmentRepository, EntityManagerInterface $entityManager, Request $request): Response {

        $establishment = $establishmentRepository->find($id);

        // Récupérer les salles liées à l'établissement
        $rooms = $establishment->getRooms();

        foreach ($rooms as $room) {
            // Récupérer les images de chaque salle
            foreach ($room->getImages() as $image) {
                // Construire le chemin de l'image
                $imagePath = $this->getParameter('uploads_directory') . '/' . $image->getPath();

                unlink($imagePath);  // Supprimer l'image du système de fichiers

                // Supprimer l'image de la base de données
                $entityManager->remove($image);
            }
            // Supprimer la salle de la base de données
            $entityManager->remove($room);
        }

        $entityManager->remove($establishment);

        $entityManager->flush();

        return $this->redirectToRoute('establishment');
    }
}
