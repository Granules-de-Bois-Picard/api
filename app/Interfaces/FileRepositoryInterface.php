<?php

namespace App\Interfaces;
use App\Http\Requests\FileUploadRequest;

interface FileRepositoryInterface
{
    public function index();
    public function upload(FileUploadRequest $request);
    public function destroy($id);
}
