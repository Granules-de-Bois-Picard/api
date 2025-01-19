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

        // return : /storage/$disk/$fileName
        // TODO : refactor this
        return Storage::url($disk . '/' . $fileName);
    }

    public function deleteFile(string $url, $disk = ''): void
    {
        $url = str_replace('/storage/' . $disk, '', $url);

        if (Storage::disk($disk)->exists($url)) {
            Storage::disk($disk)->delete($url);
        }
    }
}
