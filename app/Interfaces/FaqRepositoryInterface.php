<?php

namespace App\Interfaces;

use App\Http\Requests\FaqStoreRequest;
use App\Http\Requests\FaqUpdateRequest;

interface FaqRepositoryInterface
{
    public function index();
    public function store(FaqStoreRequest $request);
    public function show($id);
    public function update(FaqUpdateRequest $request, $id);
    public function destroy($id);
}
