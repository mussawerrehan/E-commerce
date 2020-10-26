<?php

namespace App\Controller;

use App\Form\ProductsType;
use App\Entity\Products;
use App\Repository\ProductsRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products_index")
     */
    public function index(ProductsRepository $productsRepository)
    {
        $products = $productsRepository->findAll();
        return $this->render('products/index.html.twig', [
            'controller_name' => 'ProductsController',
            'products' => $products
        ]);
    }

    /**
     * @Route("/products/new", name="products_new", methods={"GET"})
     */
    public function createNew()
    {
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product);
        return $this->render('products/new.html.twig' , [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/new", name="products_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('products_index');
        }

        return $this->render('products/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="products_show", methods={"GET"})
     */
    public function show(Products $product,LoggerInterface $logger): Response
    {
        $serializer = SerializerBuilder::create()->build();
        $reponse = $serializer->serialize($product, 'json');
        $reponse = json_decode($reponse);
        $logger->info($reponse);
        return new JsonResponse($reponse);
    }

    /**
     * @Route("/{id}/edit", name="products_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Products $product): Response
    {
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('products_index', [
                'id' => $product->getId(),
            ]);
        }

        return $this->render('products/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="products_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Products $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token')) || true) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('products_index');
    }
}
