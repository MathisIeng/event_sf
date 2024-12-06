<?php

namespace App\Controller;

use App\Entity\Animator;
use App\Form\AnimatorType;
use App\Repository\AnimatorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnimatorController extends AbstractController
{
    #[Route('/animator', name: 'animator')]
    public function index(AnimatorRepository $animatorRepository): Response
    {

        $animators = $animatorRepository->findAll();

        return $this->render('animator/index.html.twig', [
            'animators' => $animators,
        ]);
    }


    #[Route('/animator/create', name: 'animator_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response {

        $animator = new Animator();

        $form = $this->createForm(AnimatorType::class, $animator);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($animator);
            $entityManager->flush();

            $this->addFlash('success', 'Animator created.');
            return $this->redirectToRoute('animator');
        }

        $formView = $form->createView();

        return $this->render('animator/create.html.twig', [
            'formView' => $formView,
        ]);
    }

    #[Route('/animator/{id}/update', name: 'animator_update')]
    public function update(int $id, EntityManagerInterface $entityManager, Request $request, AnimatorRepository $animatorRepository): Response {

        $animator = $animatorRepository->find($id);

        $form = $this->createForm(AnimatorType::class, $animator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('animator');
        }

        $formView = $form->createView();

        return $this->render('animator/update.html.twig', [
            'formView' => $formView, 'animator' => $animator
        ]);
    }

    #[Route('/animator/{id}/delete', name: 'animator_delete')]
    public function delete(int $id, EntityManagerInterface $entityManager, AnimatorRepository $animatorRepository): Response {

        $animator = $animatorRepository->find($id);

        $entityManager->remove($animator);

        $entityManager->flush();

        return $this->redirectToRoute('animator');
    }
}
