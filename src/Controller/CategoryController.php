<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category')]
    public function index(CategoryRepository $categoryRepository): Response {

        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }


    #[Route('/category/create', name: 'category_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response {

        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Category created.');
            return $this->redirectToRoute('category');
        }

        $formView = $form->createView();

        return $this->render('category/create.html.twig', [
            'formView' => $formView,
        ]);
    }

    #[Route('/category/{id}/update', name: 'category_update')]
    public function update(int $id, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository, Request $request): Response {

        $category = $categoryRepository->find($id);

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('category');
        }

        $formView = $form->createView();

        return $this->render('category/update.html.twig', [
            'formView' => $formView, 'category' => $category
        ]);
    }


    #[Route('/category/{id}/delete', name: 'category_delete')]
    public function delete(int $id, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository): Response {

        $category = $categoryRepository->find($id);

        $entityManager->remove($category);

        $entityManager->flush();

        return $this->redirectToRoute('category');
    }
}
