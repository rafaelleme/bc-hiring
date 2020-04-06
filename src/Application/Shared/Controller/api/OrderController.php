<?php

namespace App\Application\Shared\Controller\api;

use App\Application\Order\Service\ListCostService;
use App\Infrastructure\Order\Repository\DoctrineOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
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

    /**
     * @param ListCostService $service
     * @return JsonResponse
     * @Route("/order/cost-list", name="order_listCosts", methods={"GET"})
     */
    public function listCosts(ListCostService $service)
    {
        $list = new ArrayCollection();

        if (is_callable($service))
            $list = $service();

        return $this->json($list, 200);
    }
}
