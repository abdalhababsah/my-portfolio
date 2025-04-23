<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectVideoRequest;
use App\Models\ProjectVideo;
use App\Models\Project;
use App\Http\Resources\ProjectVideoResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Exception;

class ProjectVideoController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];

            $columnsRaw = array_diff(
                Schema::getColumnListing((new ProjectVideo)->getTable()),
                $excluded
            );

            $columnsRaw[] = 'project_title_en';
            $columnsRaw[] = 'project_title_ar';

            $columnLabels = [
                'id' => 'ID',
                'project_id' => 'Project ID',
                'project_title_en' => 'Project Title (EN)',
                'project_title_ar' => 'Project Title (AR)',
                'video_url' => 'Video URL',
                'caption_en' => 'Caption (EN)',
                'caption_ar' => 'Caption (AR)',
                'thumbnail_path' => 'Thumbnail Path',
                'thumbnail_alt_en' => 'Thumbnail Alt (EN)',
                'thumbnail_alt_ar' => 'Thumbnail Alt (AR)',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => [
                'name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))
            ])->values();

            $videos = ProjectVideo::with('project')->get()->map(function ($video) use ($columnsRaw) {
                $data = $video->toArray();
                $data['project_title_en'] = $video->project->title_en ?? '-';
                $data['project_title_ar'] = $video->project->title_ar ?? '-';
                return collect($columnsRaw)->map(fn($col) => $data[$col] ?? '')->values()->toArray();
            });

            return view('dashboard.project-videos.index', [
                'columns' => $columns,
                'data' => $videos,
            ]);
        } catch (Exception $e) {
            Log::error("ProjectVideo Index Error: " . $e->getMessage());
            return back()->with('error', 'Failed to load project videos.');
        }
    }

    public function create()
    {
        $projects = Project::all();
        return view('dashboard.project-videos.create-edit', compact('projects'));
    }

    public function store(StoreProjectVideoRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('video_file')) {
                $data['video_url'] = $request->file('video_file')->store('videos', 'public');
            }

            if ($request->hasFile('thumbnail_path')) {
                $data['thumbnail_path'] = $request->file('thumbnail_path')->store('thumbnails', 'public');
            }

            ProjectVideo::create($data);

            return redirect()->route('project-videos.index')->with('success', 'Video added successfully.');
        } catch (Exception $e) {
            Log::error("ProjectVideo Store Error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create video.');
        }
    }

    public function edit($id)
    {
        try {
            $video = ProjectVideo::findOrFail($id);
            $projects = Project::all();
            return view('dashboard.project-videos.create-edit', compact('video', 'projects'));
        } catch (Exception $e) {
            Log::error("Edit Video Error: " . $e->getMessage());
            return redirect()->route('project-videos.index')->with('error', 'Video not found.');
        }
    }

    public function update(StoreProjectVideoRequest $request, $id)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('video_file')) {
                $data['video_url'] = $request->file('video_file')->store('videos', 'public');
            }

            if ($request->hasFile('thumbnail_path')) {
                $data['thumbnail_path'] = $request->file('thumbnail_path')->store('thumbnails', 'public');
            }

            $video = ProjectVideo::findOrFail($id);
            $video->update($data);

            return redirect()->route('project-videos.index')->with('success', 'Video updated successfully.');
        } catch (Exception $e) {
            Log::error("Update Video Error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update video.');
        }
    }

    public function destroy(ProjectVideo $projectVideo)
    {
        try {
            $projectVideo->delete();
            return redirect()->route('project-videos.index')->with('success', 'Video deleted successfully.');
        } catch (Exception $e) {
            Log::error("Delete Video Error: " . $e->getMessage());
            return redirect()->route('project-videos.index')->with('error', 'Failed to delete video.');
        }
    }
}
