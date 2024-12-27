<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Interfaces\ArticleRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    private ArticleRepositoryInterface $articleRepositoryInterface;

    public function __construct(ArticleRepositoryInterface $articleRepositoryInterface)
    {
        $this->articleRepositoryInterface = $articleRepositoryInterface;
    }

    public function index(): JsonResponse
    {
        try {
            $articles = $this->articleRepositoryInterface->index();
            return ApiResponseClass::sendResponse($articles, 'Articles retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function show($identifier): JsonResponse
    {
        try {
            $articles = $this->articleRepositoryInterface->show($identifier);
            return ApiResponseClass::sendResponse($articles, 'Articles retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function store(ArticleStoreRequest $request): JsonResponse
    {
        try {
            $article = $this->articleRepositoryInterface->store($request);
            return ApiResponseClass::sendResponse($article, 'Article created successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function update(ArticleUpdateRequest $request, $id): JsonResponse
    {
        try {
            $article = $this->articleRepositoryInterface->update($request, $id);
            return ApiResponseClass::sendResponse($article, 'Article updated successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->articleRepositoryInterface->destroy($id);
            return ApiResponseClass::sendResponse(null, 'Article deleted successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function lastArticle(): JsonResponse
    {
        try {
            $article = $this->articleRepositoryInterface->lastArticle();
            return ApiResponseClass::sendResponse($article, 'Last article retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }
}
