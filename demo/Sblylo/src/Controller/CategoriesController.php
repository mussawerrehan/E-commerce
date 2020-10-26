<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
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
//        $categories = $categoriesRepository->findAll();
//        $serializer = SerializerBuilder::create()->build();
//        $reponse = $serializer->serialize($categories, 'json');
//        $reponse = json_decode($reponse);
//        return new JsonResponse($reponse);
        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }

    /**
     * @Route("/categories", name="categories_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $category = new Categories();

        $title = $request->request->get('_title');
        $picture = $request->request->get('_picture');

        $category->setTitle($title);
        $category->setPicture($picture);

        $em->persist($category);
        $em->flush();

        return new JsonResponse(['success' => 'Categorie created']);
    }

    /**
     * @Route("/categories/{id}", name="categories_show", methods={"GET"})
     */
    public function show(Categories $category): Response
    {
        $serializer = SerializerBuilder::create()->build();
        $reponse = $serializer->serialize($category, 'json');
        $reponse = json_decode($reponse);
        return new JsonResponse($reponse);
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

        return new JsonResponse(['success' => 'Categorie edited']);
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