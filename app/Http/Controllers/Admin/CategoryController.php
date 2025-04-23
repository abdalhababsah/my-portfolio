<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Exception;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];
            $columnsRaw = array_diff(Schema::getColumnListing((new Category)->getTable()), $excluded);

            $columnLabels = [
                'id' => 'ID',
                'name_en' => 'Name (EN)',
                'name_ar' => 'Name (AR)',
                'meta_title_en' => 'Meta Title (EN)',
                'meta_title_ar' => 'Meta Title (AR)',
                'meta_description_en' => 'Meta Description (EN)',
                'meta_description_ar' => 'Meta Description (AR)',
                'meta_keywords_en' => 'Meta Keywords (EN)',
                'meta_keywords_ar' => 'Meta Keywords (AR)',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => [
                'name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))
            ]);

            $data = CategoryResource::collection(Category::all())
                ->map(fn($item) => collect($columnsRaw)->map(fn($col) => $item[$col] ?? '')->values()->toArray());

            return view('dashboard.categories.index', compact('columns', 'data'));
        } catch (Exception $e) {
            Log::error("Category index error: " . $e->getMessage());
            return back()->with('error', 'Failed to load categories.');
        }
    }

    public function create()
    {
        return view('dashboard.categories.create-edit');
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            Category::create($request->validated());
            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        } catch (Exception $e) {
            Log::error("Category store error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create category.');
        }
    }

    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('dashboard.categories.create-edit', compact('category'));
        } catch (Exception $e) {
            Log::error("Category edit error [ID: $id]: " . $e->getMessage());
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }
    }

    public function update(StoreCategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update($request->validated());
            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        } catch (Exception $e) {
            Log::error("Category update error [ID: $id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update category.');
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category deleted.');
        } catch (Exception $e) {
            Log::error("Category delete error [ID: {$category->id}]: " . $e->getMessage());
            return redirect()->route('categories.index')->with('error', 'Failed to delete category.');
        }
    }
}
