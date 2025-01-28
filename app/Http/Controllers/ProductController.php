<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepositoryInterface;
    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function index(): JsonResponse
    {
        try {
            $products = $this->productRepositoryInterface->index();
            return ApiResponseClass::sendResponse($products, 'Products retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $product = $this->productRepositoryInterface->show($id);
            return ApiResponseClass::sendResponse($product, 'Product retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        try {
            $product = $this->productRepositoryInterface->store($request);
            return ApiResponseClass::sendResponse($product, 'Product created successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function update(ProductUpdateRequest $request, $id): JsonResponse
    {
        try {
            $product = $this->productRepositoryInterface->update($request, $id);
            return ApiResponseClass::sendResponse($product, 'Product updated successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $product = $this->productRepositoryInterface->destroy($id);
            return ApiResponseClass::sendResponse($product, 'Product deleted successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }
}
