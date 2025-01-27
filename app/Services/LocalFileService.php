<?php

namespace App\Services;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class LocalFileService
{
    public function uploadFile(UploadedFile $file, $disk = '', $fileName = null): string
    {
        if ($fileName === null) {
            $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        }

        Storage::disk($disk)->put($fileName, file_get_contents($file));

        return Storage::url($disk . '/' . $fileName);
    }

    /**
     * @throws Exception
     */
    public function replaceFile(string $url, UploadedFile $file, $disk = ''): string
    {
        $filePath = str_replace('/storage/' . $disk . '/', '', $url);

        if (Storage::disk($disk)->exists($filePath)) {
            Storage::disk($disk)->put($filePath, file_get_contents($file));
        } else {
            throw new Exception('File not found');
        }

        return $url;
    }

    public function deleteFile(string $url, $disk = ''): void
    {
        $url = str_replace('/storage/' . $disk, '', $url);

        if (Storage::disk($disk)->exists($url)) {
            Storage::disk($disk)->delete($url);
        }
    }
}
