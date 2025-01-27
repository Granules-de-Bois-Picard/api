<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\FaqStoreRequest;
use App\Http\Requests\FaqUpdateRequest;
use App\Interfaces\FaqRepositoryInterface;
use Illuminate\Http\JsonResponse;

class FaqController extends Controller
{
    private FaqRepositoryInterface $faqRepositoryInterface;

    public function __construct(FaqRepositoryInterface $faqRepositoryInterface)
    {
        $this->faqRepositoryInterface = $faqRepositoryInterface;
    }

    public function index(): JsonResponse
    {
        try {
            $faqs = $this->faqRepositoryInterface->index();
            return ApiResponseClass::sendResponse($faqs, 'Faqs retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $faq = $this->faqRepositoryInterface->show($id);
            return ApiResponseClass::sendResponse($faq, 'Faq retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function store(FaqStoreRequest $request): JsonResponse
    {
        try {
            $faq = $this->faqRepositoryInterface->store($request);
            return ApiResponseClass::sendResponse($faq, 'Faq created successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function update(FaqUpdateRequest $request, $id): JsonResponse
    {
        try {
            $faq = $this->faqRepositoryInterface->update($request, $id);
            return ApiResponseClass::sendResponse($faq, 'Faq updated successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->faqRepositoryInterface->destroy($id);
            return ApiResponseClass::sendResponse(null, 'Faq deleted successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }
}
