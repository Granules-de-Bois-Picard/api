<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class LocalFileService
{
    public function uploadFile(UploadedFile $file, $disk = ''): string
    {
        $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

        Storage::disk($disk)->put($fileName, file_get_contents($file));

        // it should work but if the disk is not a folder it will not work
        // TODO : refactor this
        return Storage::url($disk . '/' . $fileName);
    }

    public function deleteFile(string $url): void
    {
        $path = str_replace(Storage::url(''), '', $url);

        Storage::delete($path);
    }
}
