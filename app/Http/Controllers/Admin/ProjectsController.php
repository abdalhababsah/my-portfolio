<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Http\Resources\ProjectResource;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Exception;

class ProjectsController extends Controller
{
    public function index()
    {
        try {
            $excluded = [
                'meta_title_en',
                'meta_title_ar',
                'meta_description_en',
                'meta_description_ar',
                'meta_keywords_en',
                'meta_keywords_ar',
                'category_id',
                'created_at',
                'updated_at',
            ];

            $columnsRaw = array_diff(
                Schema::getColumnListing((new Project)->getTable()),
                $excluded
            );

            // Add virtual fields for category names
            $columnsRaw[] = 'category_name_en';
            $columnsRaw[] = 'category_name_ar';

            $columnLabels = [
                'id' => 'ID',
                'slug' => 'Slug',
                'title_en' => 'Title (EN)',
                'title_ar' => 'Title (AR)',
                'category_name_en' => 'Category (EN)', // ✅ New virtual column
                'category_name_ar' => 'Category (AR)', // ✅ New virtual column
                'short_description_en' => 'Short Desc (EN)',
                'short_description_ar' => 'Short Desc (AR)',
                'full_description_en' => 'Full Desc (EN)',
                'full_description_ar' => 'Full Desc (AR)',
                'role_en' => 'Role (EN)',
                'role_ar' => 'Role (AR)',
                'duration' => 'Duration',
                'client_name' => 'Client Name',
                'location' => 'Location',
                'year' => 'Year',
                'cover_image' => 'Cover Image',
                'featured' => 'Featured',

                'github_url' => 'Github URL',
                'demo_url' => 'Demo URL',
            ];

            $columns = collect($columnsRaw)->map(function ($col) use ($columnLabels) {
                return ['name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))];
            })->values();

            // Eager load category
            $projects = ProjectResource::collection(Project::with('category')->get())
                ->map(function ($resource) use ($columnsRaw) {
                    $data = $resource->toArray(request());
                    return collect($columnsRaw)->map(fn($col) => $data[$col] ?? '')->values()->toArray();
                });
            return view('dashboard.projects.index', [
                'columns' => $columns,
                'data' => $projects,
            ]);
        } catch (Exception $e) {
            Log::error('Error loading projects index: ' . $e->getMessage());
            return back()->with('error', 'Failed to load projects.');
        }
    }


    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard.projects.create-edit', compact('categories', 'tags'));
    }

    public function store(StoreProjectRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = $request->file('cover_image')->store('projects', 'public');
            }

            $data['featured'] = $request->has('featured');

            Project::create($data);
            $data->tags()->sync($request->input('tags', []));

            return redirect()->route('projects.index')->with('success', 'Project created successfully.');
        } catch (Exception $e) {
            Log::error('Error creating project: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create project.');
        }
    }


    public function edit($id)
    {
        try {
            $project = Project::with('tags')->findOrFail($id);
            $categories = Category::all();
            $tags = Tag::all();

            return view('dashboard.projects.create-edit', compact('project', 'categories', 'tags'));
        } catch (Exception $e) {
            Log::error("Error editing project [ID: $id]: " . $e->getMessage());
            return redirect()->route('projects.index')->with('error', 'Project not found.');
        }
    }

    public function update(StoreProjectRequest $request, $id)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = $request->file('cover_image')->store('projects', 'public');
            }

            $data['featured'] = $request->has('featured');

            $project = Project::findOrFail($id);
            $project->update($data);
            $project->tags()->sync($request->input('tags', []));

            return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
        } catch (Exception $e) {
            Log::error("Error updating project [ID: $id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update project.');
        }
    }

    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
        } catch (Exception $e) {
            Log::error("Error deleting project [ID: {$project->id}]: " . $e->getMessage());
            return redirect()->route('projects.index')->with('error', 'Failed to delete project.');
        }
    }
}
