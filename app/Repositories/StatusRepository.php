<?php

namespace App\Repositories;

use App\Interfaces\StatusRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class StatusRepository implements StatusRepositoryInterface
{
    private string $backofficeUrl;
    private string $websiteUrl;
    private Client $httpClient;

    public function __construct()
    {
        $this->backofficeUrl = config('services.backoffice.url');
        $this->websiteUrl = config('services.website.url');
        $this->httpClient = new Client([
            'timeout' => 5,
            'connect_timeout' => 3,
        ]);
    }

    public function checkApiStatus(): true
    {
        return true;
    }

    /**
     * @throws GuzzleException
     */
    public function checkBackofficeStatus(): ?array
    {
        return $this->checkUrl($this->backofficeUrl);
    }

    /**
     * @throws GuzzleException
     */
    public function checkWebsiteStatus(): ?array
    {
        return $this->checkUrl($this->websiteUrl);
    }

    /**
     * @throws GuzzleException
     */
    private function checkUrl(string $url): array
    {
        $response = $this->httpClient->get($url);
        $statusCode = $response->getStatusCode();

        if ($statusCode >= 200 && $statusCode < 300) {
            return ['status' => 'running'];
        }

        return ['status' => 'stopped'];
    }
}
