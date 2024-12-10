<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ApiClient;
use Symfony\Component\HttpFoundation\JsonResponse;


class ApiClientController extends AbstractController
{

    private ApiClient $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    #[Route('/api/client', name: 'app_api_client')]
    public function index(): Response
    {

        return $this->render('api_client/index.html.twig', [
            'controller_name' => 'ApiClientController',
        ]);
    }


    #[Route('/api/test', name: 'api_test')]
    public function testApi(): JsonResponse
    {

        $data = $this->apiClient->get('/pokemon/ditto', ['param' => 'value']);

        return new JsonResponse($data);
    }

}
