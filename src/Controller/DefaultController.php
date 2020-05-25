<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ODM\MongoDB\DocumentManager as DocumentManager;
use App\Document\Product;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function createProduct(DocumentManager $dm)
    {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');

        $dm->persist($product);
        $dm->flush();

        return new Response('Created product id '.$product->getId());
    }
}