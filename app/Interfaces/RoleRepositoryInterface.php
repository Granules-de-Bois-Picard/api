<?php

namespace App\Interfaces;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;

interface RoleRepositoryInterface
{
    public function index();
    public function store(RoleStoreRequest $request);
    public function show($id);

    public function update(RoleUpdateRequest $request, $id);

    public function destroy($id);
}
