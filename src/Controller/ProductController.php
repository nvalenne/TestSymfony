<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;
use App\Form\ProductType;

class ProductController extends AbstractController
{
    #[Route('admin/products', name: 'app_product')]
    public function index(ProductRepository $repository): Response
    {
        $products = $repository->findAll();
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('admin/products/create', name: 'app_product_create')]
    public function create(Request $request, ProductRepository $repository, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ProductType::class);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Product created successfully');
            return $this->redirectToRoute('app_product');
        }
        return $this->render('product/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('admin/products/{id}', name: 'app_product_show')]
    public function show(ProductRepository $repository, int $id): Response
    {
        $product = $repository->find($id);
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
    #[Route('admin/products/{id}/edit', name: 'app_product_edit')]
    public function edit(Request $request, ProductRepository $repository, EntityManagerInterface $em, int $id): Response
    {
        $product = $repository->find($id);
        $form = $this->createForm(ProductType::class, $product);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Product updated successfully');
            return $this->redirectToRoute('app_product');
        }
        return $this->render('product/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
