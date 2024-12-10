<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 12/10/24
 * Time: 9:57 AM
 */

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ApiClient
{
private HttpClientInterface $httpClient;
private string $apiBaseUrl;
private string $apiToken;

    public function __construct(HttpClientInterface $httpClient, string $apiBaseUrl, string $apiToken)
    {

        $this->httpClient = $httpClient;
        $this->apiBaseUrl = rtrim($apiBaseUrl, '/'); // Ensure no trailing slash
        $this->apiToken = $apiToken;
    }

    public function get(string $endpoint, array $queryParams = []): array
    {
        $url = $this->apiBaseUrl . '/' . ltrim($endpoint, '/');

        $response = $this->httpClient->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiToken,
            ],
            'query' => $queryParams,
        ]);

        return $this->handleResponse($response);
    }

    public function post(string $endpoint, array $data = []): array
    {
        $url = $this->apiBaseUrl . '/' . ltrim($endpoint, '/');

        $response = $this->httpClient->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ]);

        return $this->handleResponse($response);
    }

    private function handleResponse(ResponseInterface $response): array
    {
        try {
            return $response->toArray(); // Automatically decodes JSON
        } catch (\Exception $e) {
            // Handle error response
            throw new \RuntimeException('API request failed: ' . $e->getMessage());
        }
    }
}