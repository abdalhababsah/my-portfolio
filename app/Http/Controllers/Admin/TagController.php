<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Exception;

class TagController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];
            $columnsRaw = array_diff(Schema::getColumnListing((new Tag)->getTable()), $excluded);

            $columnLabels = [
                'id' => 'ID',
                'name_en' => 'Name (EN)',
                'name_ar' => 'Name (AR)',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => [
                'name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))
            ]);

            $data = TagResource::collection(Tag::all())
                ->map(fn($item) => collect($columnsRaw)->map(fn($col) => $item[$col] ?? '')->values()->toArray());

            return view('dashboard.tags.index', compact('columns', 'data'));
        } catch (Exception $e) {
            Log::error("Tags index error: " . $e->getMessage());
            return back()->with('error', 'Failed to load tags.');
        }
    }

    public function create()
    {
        return view('dashboard.tags.create-edit');
    }

    public function store(StoreTagRequest $request)
    {
        try {
            Tag::create($request->validated());
            return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
        } catch (Exception $e) {
            Log::error("Tag store error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create tag.');
        }
    }

    public function edit($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            return view('dashboard.tags.create-edit', compact('tag'));
        } catch (Exception $e) {
            Log::error("Tag edit error [ID: $id]: " . $e->getMessage());
            return redirect()->route('tags.index')->with('error', 'Tag not found.');
        }
    }

    public function update(StoreTagRequest $request, $id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->update($request->validated());
            return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
        } catch (Exception $e) {
            Log::error("Tag update error [ID: $id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update tag.');
        }
    }

    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            return redirect()->route('tags.index')->with('success', 'Tag deleted.');
        } catch (Exception $e) {
            Log::error("Tag delete error [ID: {$tag->id}]: " . $e->getMessage());
            return redirect()->route('tags.index')->with('error', 'Failed to delete tag.');
        }
    }
}
