<?php

namespace App\Repositories;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use App\Transformers\ArticleTransformer;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\QueryBuilder;

class ArticleRepository implements ArticleRepositoryInterface
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
        $articles = QueryBuilder::for(Article::class)
            ->orderBy('created_at', 'desc')
            ->paginate(11);

        return fractal($articles, new ArticleTransformer())->toArray();
    }

    public function show($id): ?array
    {
        $article = Article::findOrFail($id);

        return fractal($article, new ArticleTransformer())->toArray();
    }

    public function store(ArticleStoreRequest $request) : ?array
    {
        $slug = $this->generateUniqueSlug(Str::slug($request->title));

        $data = $request->validated();
        $data['slug'] = $slug;

        $article = Article::create($data);

        return fractal($article, new ArticleTransformer())->toArray();
    }

    public function update(ArticleUpdateRequest $request, $id): ?array
    {
        $article = Article::findOrFail($id);

        $slug = $this->generateUniqueSlug(Str::slug($request->title));

        $data = $request->validated();
        $data['slug'] = $slug;

        $article->update($data);

        return fractal($article, new ArticleTransformer())->toArray();
    }

    public function destroy($id): void
    {
        Article::findOrFail($id)->delete();
    }

    private function generateUniqueSlug(string $baseSlug): string
    {
        $slug = $baseSlug;
        $count = 1;

        while (Article::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
