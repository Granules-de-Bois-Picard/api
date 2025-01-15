<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Interfaces\StatusRepositoryInterface;
use Illuminate\Http\JsonResponse;

class StatusController extends Controller
{
    private StatusRepositoryInterface $statusRepositoryInterface;

    public function __construct(StatusRepositoryInterface $statusRepositoryInterface)
    {
        $this->statusRepositoryInterface = $statusRepositoryInterface;
    }

    public function checkApi(): JsonResponse
    {
        try {
            $data = $this->statusRepositoryInterface->checkApiStatus();
            return ApiResponseClass::sendResponse($data, 'API is working.');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function checkBackoffice(): JsonResponse
    {
        try {
            $data = $this->statusRepositoryInterface->checkBackofficeStatus();
            return ApiResponseClass::sendResponse($data, 'Backoffice is working.');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function checkWebsite(): JsonResponse
    {
        try {
            $data = $this->statusRepositoryInterface->checkWebsiteStatus();
            return ApiResponseClass::sendResponse($data, 'Website is working.');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }
}
