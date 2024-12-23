<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\ArticleStoreRequest;
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

    public function store(ArticleStoreRequest $request): JsonResponse
    {
        try {
            $article = $this->articleRepositoryInterface->store($request);
            return ApiResponseClass::sendResponse($article, 'Article created successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }
}
