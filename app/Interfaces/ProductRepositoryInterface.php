<?php

namespace App\Interfaces;

use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ProductStoreRequest;

interface ProductRepositoryInterface
{
    public function index();
    public function store(ProductStoreRequest $request);
    public function show($id);
    public function update(ProductUpdateRequest $request, $id);
    public function destroy($id);
}
