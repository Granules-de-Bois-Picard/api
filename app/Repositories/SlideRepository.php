<?php

namespace App\Repositories;

use App\Interfaces\SlideRepositoryInterface;
use App\Models\Slide;
use App\Transformers\SlideTransformer;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\SlideStoreRequest;
use App\Http\Requests\SlideUpdateRequest;


class SlideRepository implements SlideRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index(): ?array
    {
        $slides = QueryBuilder::for(Slide::class)
            ->orderBy('order')
            ->get();

        return fractal($slides, new SlideTransformer())->toArray();
    }

    public function store(SlideStoreRequest $request) : ?array
    {
        $slide = Slide::create($request->validated());

        return fractal($slide, new SlideTransformer())->toArray();
    }

    public function show($id): ?array
    {
        $slide = Slide::findOrFail($id);

        return fractal($slide, new SlideTransformer())->toArray();
    }

    public function update(SlideUpdateRequest $request, $id): ?array
    {
        $slide = Slide::findOrFail($id);
        $slide->update($request->validated());

        return fractal($slide, new SlideTransformer())->toArray();
    }

    public function destroy($id): ?bool
    {
        $slide = Slide::findOrFail($id);
        $slide->delete();

        return true;
    }
}
