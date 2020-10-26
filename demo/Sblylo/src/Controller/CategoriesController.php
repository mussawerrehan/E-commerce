<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use AppTestBundle\Entity\UnitTests\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="categories_index", methods={"GET"})
     */
    public function index(CategoriesRepository $categoriesRepository): Response
    {

        $categories = $categoriesRepository->findAll();
        return $this->render('categories/index.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/categories", name="categories_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $title = $request->request->get('_title');
        $picture = $request->request->get('_picture');

        $category->setTitle($title);
        $category->setPicture($picture);

        $em->persist($category);
        $em->flush();

        return $this->redirectToRoute('categories_index');
    }

    /**
     * @Route("/categories/new", name="new_category_form", methods={"GET"})
     */
    public function createNew(CategoriesRepository $categoriesRepository)
    {
//        $form = new CategoriesType();
        $category = new Categories();
        $form = $this->createForm(CategoriesType::class, $category);
        return $this->render('categories/new.html.twig' , [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/categories/{id}", name="categories_show", methods={"GET"})
     */
    public function show(Categories $category): Response
    {
        return $this->render('categories/show.html.twig',[
            'category' => $category
        ]);
    }

    /**
     * @Route("/categories/{id}", name="categories_edit", methods={"PUT"})
     */
    public function edit(Request $request, Categories $category): Response
    {
        $em = $this->getDoctrine()->getManager();

        $title = $request->request->get('_title');
        $picture= $request->request->get('_picture');

        $category->setTitle($title);
        $category->setPicture($picture);
        $em->persist($category);
        $em->flush();

        return $this->render('categories/edit.html.twig', [
           'category' => $category
        ]);
    }

    /**
     * @Route("/categories/{id}", name="categories_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Categories $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token')) || true) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categories_index');
    }
}