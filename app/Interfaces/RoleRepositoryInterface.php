<?php

namespace App\Interfaces;

use App\Http\Requests\RoleStoreRequest;

interface RoleRepositoryInterface
{
    public function index();
    public function store(RoleStoreRequest $request);
    public function show($id);
}
