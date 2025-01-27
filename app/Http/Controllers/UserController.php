<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserChangeRoleRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserUploadProfilePictureRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function index(): JsonResponse
    {
        try {
            $users = $this->userRepositoryInterface->index();
            return ApiResponseClass::sendResponse($users, 'Users retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function store(UserStoreRequest $request)
    {
        //
    }

    public function show($id): JsonResponse
    {
        try {
            $user = $this->userRepositoryInterface->show($id);
            return ApiResponseClass::sendResponse($user, 'User retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        try {
            $user = $this->userRepositoryInterface->update($request, $id);
            return ApiResponseClass::sendResponse($user, 'User updated successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function uploadProfilePicture(UserUploadProfilePictureRequest $request, $id): JsonResponse
    {
        try {
            $user = $this->userRepositoryInterface->uploadProfilePicture($request, $id);
            return ApiResponseClass::sendResponse($user, 'Profile picture updated successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function changePassword(UserChangePasswordRequest $request, $id): JsonResponse
    {
        try {
            $user = $this->userRepositoryInterface->changePassword($request, $id);
            return ApiResponseClass::sendResponse($user, 'Password changed successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function changeRole(UserChangeRoleRequest $request, $id): JsonResponse
    {
        try {
            $user = $this->userRepositoryInterface->changeRole($request, $id);
            return ApiResponseClass::sendResponse($user, 'Role changed successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function requestPasswordReset($id)
    {
        // TODO: Implement requestPasswordReset() method.
    }

    public function destroy($id)
    {
        //
    }
}
