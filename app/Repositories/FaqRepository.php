<?php

namespace App\Repositories;

use App\Http\Requests\FaqStoreRequest;
use App\Http\Requests\FaqUpdateRequest;
use App\Interfaces\FaqRepositoryInterface;
use App\Models\Faq;
use App\Transformers\FaqTransformer;
use Spatie\QueryBuilder\QueryBuilder;

class FaqRepository implements FaqRepositoryInterface
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
        $faqs = QueryBuilder::for(Faq::class)
            ->orderBy('created_at', 'desc')
            ->paginate(11);

        return fractal($faqs, new FaqTransformer())->toArray();
    }

    public function show($id): ?array
    {
        $faq = Faq::findOrFail($id);

        return fractal($faq, new FaqTransformer())->toArray();
    }

    public function store(FaqStoreRequest $request) : ?array
    {
        $faq = Faq::create($request->validated());

        return fractal($faq, new FaqTransformer())->toArray();
    }

    public function update(FaqUpdateRequest $request, $id): ?array
    {
        $faq = Faq::findOrFail($id);

        $faq->update($request->validated());

        return fractal($faq, new FaqTransformer())->toArray();
    }

    public function destroy($id): void
    {
        $faq = Faq::findOrFail($id);

        $faq->delete();
    }
}
