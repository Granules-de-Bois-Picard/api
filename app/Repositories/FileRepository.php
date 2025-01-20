<?php

namespace App\Repositories;

use App\Http\Requests\FileUploadRequest;
use App\Interfaces\FileRepositoryInterface;
use App\Models\File;
use App\Services\LocalFileService;
use App\Transformers\FileTransformer;
use Spatie\QueryBuilder\QueryBuilder;

class FileRepository implements FileRepositoryInterface
{
    private LocalFileService $localFileService;

    public function __construct(LocalFileService $localFileService)
    {
        $this->localFileService = $localFileService;
    }

    public function index(): ?array
    {
        $files = QueryBuilder::for(File::class)
            ->orderBy('created_at', 'desc')
            ->paginate(18);

        return fractal($files, new FileTransformer())->toArray();
    }

    public function upload(FileUploadRequest $request): ?array
    {
        $file = $request->file('file');

        $path = $this->localFileService->uploadFile($request->file('file'), 'files');

        $file = File::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'size' => $file->getSize(),
            'extension' => $file->getClientOriginalExtension(),
        ]);

        return fractal($file, new FileTransformer())->toArray();

    }

    public function destroy($id)
    {
        $file = File::findOrFail($id);

        if ($file->is_protected) {
            return false;
        }

        $this->localFileService->deleteFile($file->path, 'files');

        return $file->delete();
    }
}
