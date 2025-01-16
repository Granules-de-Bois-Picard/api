<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private RoleRepositoryInterface $roleRepositoryInterface;

    public function __construct(RoleRepositoryInterface $roleRepositoryInterface)
    {
        $this->roleRepositoryInterface = $roleRepositoryInterface;
    }

    public function index(): JsonResponse
    {
        try {
            $roles = $this->roleRepositoryInterface->index();
            return ApiResponseClass::sendResponse($roles, 'Roles retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function store(RoleStoreRequest $request): JsonResponse
    {
        try {
            $role = $this->roleRepositoryInterface->store($request);
            return ApiResponseClass::sendResponse($role, 'Role created successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $role = $this->roleRepositoryInterface->show($id);
            return ApiResponseClass::sendResponse($role, 'Role retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function update(RoleUpdateRequest $request, $id): JsonResponse
    {
        try {
            $role = $this->roleRepositoryInterface->update($request, $id);
            return ApiResponseClass::sendResponse($role, 'Role updated successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $role = $this->roleRepositoryInterface->destroy($id);
            return ApiResponseClass::sendResponse($role, 'Role deleted successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }
}
