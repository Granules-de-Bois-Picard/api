<?php

namespace App\Interfaces;

use App\Http\Requests\PermissionStoreRequest;
use App\Http\Requests\PermissionUpdateRequest;

interface PermissionRepositoryInterface
{
    public function all();
    public function index();
    public function store(PermissionStoreRequest $request);
    public function show($id);
}
