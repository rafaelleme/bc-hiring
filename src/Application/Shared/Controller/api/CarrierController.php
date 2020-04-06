<?php

namespace App\Application\Shared\Controller\api;

use App\Application\Carrier\Request\CarrierRequest;
use App\Application\Carrier\Service\CreateCarrierService;
use App\Application\Carrier\Service\RemoveCarrierService;
use App\Application\Carrier\Service\UpdateCarrierService;
use App\Domain\Shared\Vo\Id;
use App\Infrastructure\Carrier\Repository\DoctrineCarrierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CarrierController
 * @package App\Controller\api
 * @Route("/api", name="api_")
 * @property DoctrineCarrierRepository repository
 */
class CarrierController extends AbstractController
{
    /** @var DoctrineCarrierRepository $repository */
    private $repository;

    public function __construct(DoctrineCarrierRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/carrier", name="carrier_index", methods={"GET"})
     */
    public function index(Request $request)
    {
        $carriers = $this->repository->findAll();

        return $this->json($carriers, 200);
    }

    /**
     * @param string $id
     * @return JsonResponse
     * @Route("/carrier/{id}", name="carrier_find", methods={"GET"})
     */
    public function find(string $id)
    {
        $carrier = $this->repository->findById(new Id($id));

        return $this->json($carrier, 200);
    }

    /**
     * @param Request $request
     * @param CreateCarrierService $service
     * @return JsonResponse
     * @Route("/carrier", name="carrier_store", methods={"POST"})
     */
    public function store(Request $request, CreateCarrierService $service)
    {
        $carrier = null;

        $data = CarrierRequest::fromBody($request);

        if (is_callable($service))
            $carrier = call_user_func($service, $data);

        return $this->json($carrier, 201);
    }

    /**
     * @param string $id
     * @param RemoveCarrierService $service
     * @return JsonResponse
     * @Route("/carrier/{id}", name="carrier_remove", methods={"DELETE"})
     */
    public function remove(string $id, RemoveCarrierService $service)
    {
        if (is_callable($service))
            call_user_func($service, new Id($id));

        return $this->json('Carrier removed successfully', 204);
    }

    /**
     * @param string $id
     * @param Request $request
     * @param UpdateCarrierService $service
     * @return JsonResponse
     * @Route("/carrier/{id}", name="carrier_update", methods={"PUT"})
     */
    public function update(string $id, Request $request, UpdateCarrierService $service)
    {
        $carrier = null;

        $data = CarrierRequest::fromBody($request);

        if (is_callable($service))
            $carrier = call_user_func($service, new Id($id), $data);

        return $this->json($carrier, 200);
    }
}
