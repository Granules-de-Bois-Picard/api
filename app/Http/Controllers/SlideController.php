<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\SlideStoreRequest;
use App\Http\Requests\SlideUpdateRequest;
use App\Interfaces\SlideRepositoryInterface;
use Illuminate\Http\JsonResponse;

class SlideController extends Controller
{
    private SlideRepositoryInterface $slideRepositoryInterface;

    public function __construct(SlideRepositoryInterface $slideRepositoryInterface)
    {
        $this->slideRepositoryInterface = $slideRepositoryInterface;
    }

    public function index(): JsonResponse
    {
        try {
            $slides = $this->slideRepositoryInterface->index();
            return ApiResponseClass::sendResponse($slides, 'Slides retrieved successfully.');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $slide = $this->slideRepositoryInterface->show($id);
            return ApiResponseClass::sendResponse($slide, 'Slide retrieved successfully.');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function store(SlideStoreRequest $request): JsonResponse
    {
        try {
            $slide = $this->slideRepositoryInterface->store($request);
            return ApiResponseClass::sendResponse($slide, 'Slide created successfully.', 201);
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function update(SlideUpdateRequest $request, $id): JsonResponse
    {
        try {
            $slide = $this->slideRepositoryInterface->update($request, $id);
            return ApiResponseClass::sendResponse($slide, 'Slide updated successfully.');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->slideRepositoryInterface->destroy($id);
            return ApiResponseClass::sendResponse([], 'Slide deleted successfully.');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }
}
