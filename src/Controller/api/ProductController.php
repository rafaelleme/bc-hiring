<?php

namespace App\Controller\api;

use App\Domain\Product\Product;
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
        $custom = new Product('Custom product', 15.4,14.4);

        return $this->json($custom, 200);
    }
}
