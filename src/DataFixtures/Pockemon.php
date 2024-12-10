<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\PokemonFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ApiClient;
use Symfony\Component\HttpFoundation\JsonResponse;

class Pockemon extends Fixture
{
    private ApiClient $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $data = $this->apiClient->get('/pokemon/ditto', ['param' => 'value']);

        dd($data);

//        return $this->render('api_client/index.html.twig', [
//            'controller_name' => 'ApiClientController',
//        ]);

        //PokemonFactory::createMany(20);

        //$manager->flush();
    }
}
