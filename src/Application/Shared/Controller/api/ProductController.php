<?php

namespace App\Application\Shared\Controller\api;

use App\Domain\Product\Product;
use App\Domain\Shared\Vo\Id;
use App\Infrastructure\Product\Repository\DoctrineProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @package App\Controller\api
 * @Route("/api", name="api_")
 * @property DoctrineProductRepository repository
 */
class ProductController extends AbstractController
{
    /** @var DoctrineProductRepository $repository */
    private $repository;

    public function __construct(DoctrineProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/product", name="product_index", methods={"GET"})
     */
    public function index(Request $request)
    {
        $products = $this->repository->findAll();

        return $this->json($products, 200);
    }

    /**
     * @param string $id
     * @return JsonResponse
     * @Route("/product/{id}", name="product_find", methods={"GET"})
     */
    public function find(string $id)
    {
        $product = $this->repository->findById(new Id($id));

        return $this->json($product, 200);
    }

    /**
     * @param string $id
     * @return JsonResponse
     * @Route("/product/{id}", name="product_find", methods={"GET"})
     */
    public function store()
    {

    }
}
