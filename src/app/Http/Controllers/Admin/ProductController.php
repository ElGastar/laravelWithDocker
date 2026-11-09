<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return  view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 'active')->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Товар успешно добавлен.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
          $product->load('category');

    return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $categories = Category::where('status', 'active')->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        // Запоминаем путь к старой фотографии
        $oldImage = $product->image;

        // Если пользователь загрузил новую фотографию
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        // Удаляем старую фотографию, если была загружена новая
        if (isset($validated['image']) && $oldImage) {
            Storage::disk('public')->delete($oldImage);
        }


        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Товар успешно обновлён.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $image = $product->image;

        $product->delete();

        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Товар успешно удалён.');
    }
}
