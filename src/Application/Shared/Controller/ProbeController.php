<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProbeController
 * @package App\Controller
 * @Route("/", name="probe_")
 */
class ProbeController extends AbstractController
{
    /**
     * @return JsonResponse
     * @Route("/probe", methods={"GET"})
     */
    public function probe()
    {
        return $this->json([],200);
    }
}
