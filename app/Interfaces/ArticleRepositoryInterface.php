<?php

namespace App\Interfaces;

use App\Http\Requests\ArticleStoreRequest;

interface ArticleRepositoryInterface
{
    public function store(ArticleStoreRequest $request);
}
