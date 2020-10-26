<?php

namespace App\Controller;

use App\Form\ProductsType;
use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
