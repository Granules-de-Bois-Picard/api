<?php

namespace App\Interfaces;

use App\Http\Requests\SlideStoreRequest;
use App\Http\Requests\SlideUpdateRequest;

interface SlideRepositoryInterface
{
    public function index(): ?array;
    public function store(SlideStoreRequest $request);
    public function show($id): ?array;
    public function update(SlideUpdateRequest $request, $id): ?array;
    public function destroy($id): ?bool;
}
