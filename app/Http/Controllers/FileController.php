<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\FileUploadRequest;
use App\Interfaces\FileRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileController extends Controller
{
    private FileRepositoryInterface $fileRepositoryInterface;
    public function __construct(FileRepositoryInterface $fileRepositoryInterface)
    {
        $this->fileRepositoryInterface = $fileRepositoryInterface;
    }

    public function index(): JsonResponse
    {
        try {
            $files = $this->fileRepositoryInterface->index();
            return ApiResponseClass::sendResponse($files, 'Files retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function upload(FileUploadRequest $request): JsonResponse
    {
        try {
            $file = $this->fileRepositoryInterface->upload($request);
            return ApiResponseClass::sendResponse($file, 'File uploaded successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $file = $this->fileRepositoryInterface->destroy($id);
            return ApiResponseClass::sendResponse($file, 'File deleted successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }
}
