<?php

namespace App\Controller\api;

use App\Domain\Carrier\Carrier;
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
        $custom = new Carrier('Custom carrier', 10.50,0.05);

        return $this->json($custom, 200);
    }
}
