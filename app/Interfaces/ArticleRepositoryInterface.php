<?php

namespace App\Interfaces;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;

interface ArticleRepositoryInterface
{
    public function index();
    public function store(ArticleStoreRequest $request);
    public function show($identifier);
    public function update(ArticleUpdateRequest $request, $id);
    public function destroy($id);

    public function lastArticle();
}
