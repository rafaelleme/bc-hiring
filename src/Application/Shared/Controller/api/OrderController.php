<?php

namespace App\Application\Shared\Controller\api;

use App\Infrastructure\Order\Repository\DoctrineOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @property DoctrineOrderRepository repository
 * @Route("/api", name="api_")
 */
class OrderController extends AbstractController
{
    private DoctrineOrderRepository $repository;

    public function __construct(DoctrineOrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/order", name="order_index", methods={"GET"})
     */
    public function index(Request $request)
    {
        $orders = $this->repository->findAll();

        return $this->json($orders, 200);
    }
}
