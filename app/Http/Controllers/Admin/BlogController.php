<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Exception;

class BlogController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];
            $columnsRaw = array_diff(Schema::getColumnListing((new Blog)->getTable()), $excluded);

            $labels = [
                'id' => 'ID',
                'slug' => 'Slug',
                'title_en' => 'Title (EN)',
                'title_ar' => 'Title (AR)',
                'summary_en' => 'Summary (EN)',
                'summary_ar' => 'Summary (AR)',
                'content_en' => 'Content (EN)',
                'content_ar' => 'Content (AR)',
                'cover_image' => 'Cover Image',
                'reading_time' => 'Reading Time',
                'meta_title_en' => 'Meta Title (EN)',
                'meta_title_ar' => 'Meta Title (AR)',
                'meta_description_en' => 'Meta Desc (EN)',
                'meta_description_ar' => 'Meta Desc (AR)',
                'meta_keywords_en' => 'Meta Keywords (EN)',
                'meta_keywords_ar' => 'Meta Keywords (AR)',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => ['name' => $labels[$col] ?? ucfirst(str_replace('_', ' ', $col))])->values();

            $data = BlogResource::collection(Blog::all())
                ->map(fn($resource) => collect($columnsRaw)->map(fn($col) => $resource[$col] ?? '')->values()->toArray());

            return view('dashboard.blogs.index', compact('columns', 'data'));
        } catch (Exception $e) {
            Log::error("Blog Index Error: " . $e->getMessage());
            return back()->with('error', 'Failed to load blogs.');
        }
    }

    public function create()
    {
        $tags = Tag::all();
        return view('dashboard.blogs.create-edit', compact('tags'));
    }

    public function store(StoreBlogRequest $request)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = $request->file('cover_image')->store('blogs', 'public');
            }

            Blog::create($data);
            // Attach tags (many-to-many)
            if ($request->has('tags')) {
                $data->tags()->attach($request->input('tags'));
            }
            return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
        } catch (Exception $e) {
            Log::error("Blog Store Error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create blog.');
        }
    }

    public function edit($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $tags = Tag::all();
            return view('dashboard.blogs.create-edit', compact('blog', 'tags'));
        } catch (Exception $e) {
            Log::error("Blog Edit Error [ID: $id]: " . $e->getMessage());
            return redirect()->route('blogs.index')->with('error', 'Blog not found.');
        }
    }

    public function update(StoreBlogRequest $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = $request->file('cover_image')->store('blogs', 'public');
            }

            $blog->update($data);
            $blog->tags()->sync($request->input('tags', []));

            return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
        } catch (Exception $e) {
            Log::error("Blog Update Error [ID: $id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update blog.');
        }
    }

    public function destroy(Blog $blog)
    {
        try {
            $blog->delete();
            return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
        } catch (Exception $e) {
            Log::error("Blog Delete Error [ID: {$blog->id}]: " . $e->getMessage());
            return redirect()->route('blogs.index')->with('error', 'Failed to delete blog.');
        }
    }
}
