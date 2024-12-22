<?php

namespace App\Interfaces;

use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

interface UserRepositoryInterface
{
    public function index();
    public function store(UserStoreRequest $request);
    public function show($id);
    public function update(UserUpdateRequest $request, $id);
    public function changePassword(UserChangePasswordRequest $request, $id);
    public function destroy($id);
}
