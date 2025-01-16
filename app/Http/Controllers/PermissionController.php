<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\PermissionStoreRequest;
use App\Interfaces\PermissionRepositoryInterface;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    private PermissionRepositoryInterface $permissionRepositoryInterface;

    public function __construct(PermissionRepositoryInterface $permissionRepositoryInterface)
    {
        $this->permissionRepositoryInterface = $permissionRepositoryInterface;
    }

    public function all(): JsonResponse
    {
        try {
            $permissions = $this->permissionRepositoryInterface->all();
            return ApiResponseClass::sendResponse($permissions, 'Permissions retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function index(): JsonResponse
    {
        try {
            $permissions = $this->permissionRepositoryInterface->index();
            return ApiResponseClass::sendResponse($permissions, 'Permissions retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function store(PermissionStoreRequest $request): JsonResponse
    {
        try {
            $permission = $this->permissionRepositoryInterface->store($request);
            return ApiResponseClass::sendResponse($permission, 'Permission created successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $permission = $this->permissionRepositoryInterface->show($id);
            return ApiResponseClass::sendResponse($permission, 'Permission retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }
}
