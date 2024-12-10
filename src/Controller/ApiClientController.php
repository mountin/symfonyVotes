<?php

namespace App\Controller;

use App\DataFixtures\Pockemon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ApiClient;
use App\Entity\Pokemon;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

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
        $data = $this->apiClient->get('/pokemon/ditto', ['param' => 'value']);


        return $this->render('api_client/index.html.twig', [
            'controller_name' => 'ApiClientController',
        ]);

    }


    #[Route('/api/test', name: 'api_test')]
    public function testApi(EntityManagerInterface $entityManager): JsonResponse
    {
        //https://pokeapi.co/api/v2/pokemon
//        $data = $this->apiClient->get('/pokemon/ditto', ['param' => 'value']);

        $data = $this->apiClient->get('/pokemon/'.rand(1, 1000));

        $pokemon = new Pokemon();

        $pokemon->setNom($data['name']);
        $pokemon->setTaille($data['weight']);
        $pokemon->setNumero($data['height']);
        $pokemon->setImage($data['sprites']['front_default']);
        $pokemon->setType(1);

        // Persist the User entity
        $entityManager->persist($pokemon);

        // Save the changes to the database
        $entityManager->flush();

        return new JsonResponse(true);
    }

}
