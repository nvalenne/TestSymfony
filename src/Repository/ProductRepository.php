<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

   public function getAllProducts(): array
   {
       return $this->findAll();
   }

   public function createProduct(Product $product, EntityManager $em): void
   {
       $em->persist($product);
       $em->flush();
   }

    public function updateProduct(Product $product): void
    {
         $this->_em->persist($product);
         $this->_em->flush();
    }

    public function deleteProduct(Product $product): void
    {
        $this->_em->remove($product);
        $this->_em->flush();
    }
}
