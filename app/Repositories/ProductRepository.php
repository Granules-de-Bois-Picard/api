<?php

namespace App\Repositories;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Transformers\ProductTransformer;
use Spatie\QueryBuilder\QueryBuilder;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

    public function index(): ?array
    {
        if (!auth('sanctum')->check()) {
            $products = QueryBuilder::for(Product::class)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $products = QueryBuilder::for(Product::class)
                ->orderBy('created_at', 'desc')
                ->paginate(14);
        }

        return fractal($products, new ProductTransformer())->toArray();
    }

    public function show($id): ?array
    {
        $product = Product::findOrFail($id);

        return fractal($product, new ProductTransformer())->toArray();
    }

    public function store(ProductStoreRequest $request): ?array
    {
        $request->merge([
            'availableColors' => json_encode($request->availableColors)
        ]);

        $product = Product::create($request->all());

        return fractal($product, new ProductTransformer())->toArray();
    }

    public function update(ProductUpdateRequest $request, $id): ?array
    {
        $product = Product::findOrFail($id);

        $request->merge([
            'availableColors' => json_encode($request->availableColors)
        ]);

        $product->update($request->all());

        return fractal($product, new ProductTransformer())->toArray();
    }

    public function destroy($id): void
    {
        $product = Product::findOrFail($id);

        $product->delete();
    }
}
