<?php

namespace App\Controller;

use App\Document\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="app_product", methods={"GET"})
     */
    public function index(ProductRepository $ProductRepository): Response
    {
        $products = $ProductRepository->findAllOrderedByName();
        // $products = $ProductRepository->Native();
        $i =0;
        $results = [];
        foreach($products as $product)
        {
            $results []= ['id'=>$product->getId(),
                          "name"=>$product->getName(),
                          "price"=>$product->getPrice()];
        }
        return $this->json( $results);
        
        
    }
    /**
     * @Route("/product/{id}", name="app_product_edit", methods={"GET"})
     */
    public function edit(ProductRepository $ProductRepository,$id): Response
    {
        $product = $ProductRepository->find($id);
        $i =0;
        $result = [];
        $result []= ['id'=>$product->getId(),
                      "name"=>$product->getName(),
                      "price"=>$product->getPrice()
                    ];
        return $this->json( $result);
        
        
    }
    /**
     * @Route("/product_add", name="add_product")
     */
    public function createAction(DocumentManager $dm)
    {
        $product = new Product();
        $product->setName('aaliz');
        $product->setPrice('56.88');
        $dm->persist($product);
        $dm->flush();
        return new Response('Created product id ' . $product->getId());
    }
    /**
     * @Route("/native", name="app_native", methods={"GET"})
     */
    public function naves(ProductRepository $ProductRepository , DocumentManager $dm): Response
    {
        $products = $ProductRepository->natives($dm);
        $i =0;
        $results = [];
        foreach($products as $product)
        {
            $results []= ['product',$product];
        }
        return $this->json( $results);
        
        
    }
}
