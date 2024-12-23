<?php

namespace App\Repositories;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use App\Transformers\ArticleTransformer;
use Exception;
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
        $query = QueryBuilder::for(Article::class)
            ->orderBy('created_at', 'desc');

        if (!auth('sanctum')->check()) {
            $query->where('is_published', true);
        }

        $articles = $query->paginate(11);

        return fractal($articles, new ArticleTransformer())->toArray();
    }

    /**
     * @throws Exception
     */
    public function show($identifier): ?array
    {
        if (preg_match('/^[0-9a-fA-F\-]{36}$/', $identifier)) {
            $article = Article::findOrFail($identifier);
        } else {
            $article = Article::where('slug', $identifier)->firstOrFail();
        }

        if (!$article->is_published && !auth('sanctum')->check()) {
            throw new Exception('Article not found');
        }

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
