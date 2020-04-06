<?php

namespace App\Application\Shared\Controller\api;

use App\Application\Product\Request\ProductRequest;
use App\Application\Product\Service\CreateProductService;
use App\Application\Product\Service\RemoveProductService;
use App\Application\Product\Service\UpdateProductService;
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
     * @param Request $request
     * @param CreateProductService $service
     * @return JsonResponse
     * @Route("/product", name="product_store", methods={"POST"})
     */
    public function store(Request $request, CreateProductService $service)
    {
        $product = null;

        $data = ProductRequest::fromBody($request);

        if (is_callable($service))
            $product = call_user_func($service, $data);

        return $this->json($product, 201);
    }

    /**
     * @param string $id
     * @param RemoveProductService $service
     * @return JsonResponse
     * @Route("/product/{id}", name="product_remove", methods={"DELETE"})
     */
    public function remove(string $id, RemoveProductService $service)
    {
        if (is_callable($service))
            call_user_func($service, new Id($id));

        return $this->json('Product removed successfully', 204);
    }

    /**
     * @param string $id
     * @param Request $request
     * @param UpdateProductService $service
     * @return JsonResponse
     * @Route("/product/{id}", name="product_update", methods={"PUT"})
     */
    public function update(string $id, Request $request, UpdateProductService $service)
    {
        $product = null;

        $data = ProductRequest::fromBody($request);

        if (is_callable($service))
            $product = call_user_func($service, new Id($id), $data);

        return $this->json($product, 200);
    }

}
