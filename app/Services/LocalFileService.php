<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class LocalFileService
{
    public function uploadFile(UploadedFile $file, $folder = 'images', $disk = null): string
    {
        $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

        Storage::disk($disk)->putFileAs($folder, $file, $fileName);

        return Storage::url($folder . '/' . $fileName);
    }

    public function deleteFile(string $url): void
    {
        $path = str_replace(Storage::url(''), '', $url);

        Storage::delete($path);
    }
}
