<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectImageRequest;
use App\Models\ProjectImage;
use App\Models\Project;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ProjectImageResource;
use Exception;

class ProjectImageController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];
            $columnsRaw = array_diff(Schema::getColumnListing((new ProjectImage)->getTable()), $excluded);

            $columnLabels = [
                'id' => 'ID',
                'project_id' => 'Project ID',
                'image_path' => 'Image Path',
                'alt_text_en' => 'Alt Text (EN)',
                'alt_text_ar' => 'Alt Text (AR)',
                'is_main' => 'Main Image',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => [
                'name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))
            ])->values();

            $data = ProjectImageResource::collection(ProjectImage::all())
                ->map(fn($resource) => collect($columnsRaw)->map(fn($col) => $resource[$col] ?? '')->values()->toArray());

            return view('dashboard.project-images.index', [
                'columns' => $columns,
                'data' => $data,
            ]);

            return view('dashboard.project-images.index', compact('columns', 'data'));
        } catch (Exception $e) {
            Log::error("ProjectImage Index Error: " . $e->getMessage());
            return back()->with('error', 'Failed to load project images.');
        }
    }

    public function create()
    {
        $projects = Project::all();
        return view('dashboard.project-images.create-edit', compact('projects'));
    }

    public function store(StoreProjectImageRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image_path')) {
                $data['image_path'] = $request->file('image_path')->store('projects', 'public');
            }

            ProjectImage::create($data);
            return redirect()->route('project-images.index')->with('success', 'Image added successfully.');
        } catch (Exception $e) {
            Log::error("ProjectImage Store Error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create image.');
        }
    }

    public function edit($id)
    {
        try {
            $image = ProjectImage::findOrFail($id);
            $projects = Project::all();
            return view('dashboard.project-images.create-edit', compact('image', 'projects'));
        } catch (Exception $e) {
            Log::error("ProjectImage Edit Error: " . $e->getMessage());
            return redirect()->route('project-images.index')->with('error', 'Image not found.');
        }
    }

    public function update(StoreProjectImageRequest $request, $id)
    {
        try {
            $image = ProjectImage::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('image_path')) {
                $data['image_path'] = $request->file('image_path')->store('projects', 'public');
            }

            $image->update($data);
            return redirect()->route('project-images.index')->with('success', 'Image updated successfully.');
        } catch (Exception $e) {
            Log::error("ProjectImage Update Error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update image.');
        }
    }

    public function destroy(ProjectImage $projectImage)
    {
        try {
            $projectImage->delete();
            return redirect()->route('project-images.index')->with('success', 'Image deleted successfully.');
        } catch (Exception $e) {
            Log::error("ProjectImage Delete Error: " . $e->getMessage());
            return redirect()->route('project-images.index')->with('error', 'Failed to delete image.');
        }
    }
}
