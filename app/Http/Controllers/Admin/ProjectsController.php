<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Technology;
use App\Models\ProjectImage;
use App\Models\ProjectVideo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Exception;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the projects.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $projects = Project::with(['category', 'tags', 'images', 'videos'])->get();
            return view('dashboard.projects.index', compact('projects'));
        } catch (Exception $e) {
            Log::error('Error loading projects index: ' . $e->getMessage());
            return back()->with('error', 'Failed to load projects.');
        }
    }

    /**
     * Show the form for creating a new project.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $technologies = Technology::all();
        return view('dashboard.projects.create-edit', compact('categories', 'tags', 'technologies'));
    }

    /**
     * Store a newly created project in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            $data = $request->validated();

            // Handle cover image
            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = $request->file('cover_image')->store('projects/covers', 'public');
            }

            // Set featured flag
            $data['featured'] = $request->has('featured');

            // Create the project
            $project = Project::create($data);

            // Sync tags
            $project->tags()->sync($request->input('tags', []));

            // Sync technologies
            $project->technologies()->sync($request->input('technologies', []));

            // Handle multiple project images
            if ($request->hasFile('project_images')) {
                foreach ($request->file('project_images') as $index => $image) {
                    $imagePath = $image->store('projects/images', 'public');
                    
                    // Get alt text for this image if provided
                    $altTextEn = $request->input('image_alt_text_en')[$index] ?? null;
                    $altTextAr = $request->input('image_alt_text_ar')[$index] ?? null;
                    
                    $project->images()->create([
                        'image_path' => $imagePath,
                        'alt_text_en' => $altTextEn,
                        'alt_text_ar' => $altTextAr,
                        'is_main' => ($index === 0) // First image is main by default
                    ]);
                }
            }

            if ($request->hasFile('video_files')) {
                foreach ($request->file('video_files') as $index => $file) {
                    $path = $file->store('projects/videos', 'public');
                    $project->videos()->create([
                        'video_url'  => $path,
                        'title_en'   => $request->input('video_titles_en')[$index] ?? null,
                        'title_ar'   => $request->input('video_titles_ar')[$index] ?? null,
                    ]);
                }
            }

            return redirect()->route('projects.index')->with('success', 'Project created successfully.');
        } catch (Exception $e) {
            Log::error('Error creating project: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create project: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified project.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $project = Project::with(['tags', 'technologies', 'images', 'videos'])->findOrFail($id);
            $categories = Category::all();
            $tags = Tag::all();
            $technologies = Technology::all();

            return view('dashboard.projects.create-edit', compact('project', 'categories', 'tags', 'technologies'));
        } catch (Exception $e) {
            Log::error("Error editing project [ID: $id]: " . $e->getMessage());
            return redirect()->route('projects.index')->with('error', 'Project not found.');
        }
    }

    /**
     * Update the specified project in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreProjectRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $project = Project::findOrFail($id);

            // Handle cover image
            if ($request->hasFile('cover_image')) {
                // Delete old cover image if exists
                if ($project->cover_image && Storage::disk('public')->exists($project->cover_image)) {
                    Storage::disk('public')->delete($project->cover_image);
                }
                $data['cover_image'] = $request->file('cover_image')->store('projects/covers', 'public');
            }

            // Set featured flag
            $data['featured'] = $request->has('featured');

            // Update the project
            $project->update($data);

            // Sync tags
            $project->tags()->sync($request->input('tags', []));

            // Sync technologies
            $project->technologies()->sync($request->input('technologies', []));

            // Handle existing images that should be removed
            if ($request->has('remove_images')) {
                foreach ($request->input('remove_images') as $imageId) {
                    $image = ProjectImage::find($imageId);
                    if ($image) {
                        // Delete the image file
                        if (Storage::disk('public')->exists($image->image_path)) {
                            Storage::disk('public')->delete($image->image_path);
                        }
                        $image->delete();
                    }
                }
            }

            // Handle new project images
            if ($request->hasFile('project_images')) {
                foreach ($request->file('project_images') as $index => $image) {
                    $imagePath = $image->store('projects/images', 'public');
                    
                    // Get alt text for this image if provided
                    $altTextEn = $request->input('image_alt_text_en')[$index] ?? null;
                    $altTextAr = $request->input('image_alt_text_ar')[$index] ?? null;
                    
                    $project->images()->create([
                        'image_path' => $imagePath,
                        'alt_text_en' => $altTextEn,
                        'alt_text_ar' => $altTextAr,
                        'is_main' => false // New images are never main by default
                    ]);
                }
            }

            // Update existing images alt text
            if ($request->has('existing_image_ids')) {
                foreach ($request->input('existing_image_ids') as $index => $imageId) {
                    $image = ProjectImage::find($imageId);
                    if ($image) {
                        $image->update([
                            'alt_text_en' => $request->input('existing_image_alt_text_en')[$index] ?? $image->alt_text_en,
                            'alt_text_ar' => $request->input('existing_image_alt_text_ar')[$index] ?? $image->alt_text_ar,
                            'is_main' => $request->input('main_image') == $imageId
                        ]);
                    }
                }
            }

            // Remove videos marked for removal
            if ($request->has('remove_videos')) {
                $project->videos()->whereIn('id', $request->input('remove_videos'))->delete();
            }

            // Update existing videos
            if ($request->has('existing_video_ids')) {
                foreach ($request->input('existing_video_ids') as $index => $videoId) {
                    $video = $project->videos()->find($videoId);
                    if ($video) {
                        $video->update([
                            'video_url' => $request->input('existing_video_urls')[$index],
                            'title_en' => $request->input('existing_video_titles_en')[$index] ?? $video->title_en,
                            'title_ar' => $request->input('existing_video_titles_ar')[$index] ?? $video->title_ar,
                        ]);
                    }
                }
            }

            if ($request->hasFile('video_files')) {
                foreach ($request->file('video_files') as $index => $file) {
                    $path = $file->store('projects/videos', 'public');
                    $project->videos()->create([
                        'video_url'  => $path,
                        'title_en'   => $request->input('video_titles_en')[$index] ?? null,
                        'title_ar'   => $request->input('video_titles_ar')[$index] ?? null,
                    ]);
                }
            }

            return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
        } catch (Exception $e) {
            Log::error("Error updating project [ID: $id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update project: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified project from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project)
    {
        try {
            // Delete associated images
            foreach ($project->images as $image) {
                if (Storage::disk('public')->exists($image->image_path)) {
                    Storage::disk('public')->delete($image->image_path);
                }
            }

            // Delete cover image
            if ($project->cover_image && Storage::disk('public')->exists($project->cover_image)) {
                Storage::disk('public')->delete($project->cover_image);
            }

            // Delete the project (this will cascade delete images and videos due to foreign keys)
            $project->delete();

            return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
        } catch (Exception $e) {
            Log::error("Error deleting project [ID: {$project->id}]: " . $e->getMessage());
            return redirect()->route('projects.index')->with('error', 'Failed to delete project: ' . $e->getMessage());
        }
    }

    /**
     * Update the main image for a project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setMainImage(Request $request, $id)
    {
        try {
            $project = Project::findOrFail($id);
            $imageId = $request->input('image_id');
            
            // First reset all images to not be main
            $project->images()->update(['is_main' => false]);
            
            // Then set the selected image as main
            $image = $project->images()->findOrFail($imageId);
            $image->is_main = true;
            $image->save();
            
            return redirect()->back()->with('success', 'Main image updated successfully.');
        } catch (Exception $e) {
            Log::error("Error setting main image for project [ID: $id]: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update main image.');
        }
    }

    /**
     * Delete a specific image from a project.
     *
     * @param  int  $id
     * @param  int  $imageId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteImage($id, $imageId)
    {
        try {
            $project = Project::findOrFail($id);
            $image = $project->images()->findOrFail($imageId);
            
            // Delete the image file
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            
            // Delete the image record
            $image->delete();
            
            return redirect()->back()->with('success', 'Image deleted successfully.');
        } catch (Exception $e) {
            Log::error("Error deleting image [ID: $imageId] for project [ID: $id]: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete image.');
        }
    }

    /**
     * Delete a specific video from a project.
     *
     * @param  int  $id
     * @param  int  $videoId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteVideo($id, $videoId)
    {
        try {
            $project = Project::findOrFail($id);
            $video = $project->videos()->findOrFail($videoId);
            
            // Delete the video record
            $video->delete();
            
            return redirect()->back()->with('success', 'Video deleted successfully.');
        } catch (Exception $e) {
            Log::error("Error deleting video [ID: $videoId] for project [ID: $id]: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete video.');
        }
    }

    /**
     * Toggle the featured status of a project.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleFeatured($id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->featured = !$project->featured;
            $project->save();
            
            $status = $project->featured ? 'featured' : 'unfeatured';
            return redirect()->back()->with('success', "Project has been $status.");
        } catch (Exception $e) {
            Log::error("Error toggling featured status for project [ID: $id]: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update featured status.');
        }
    }
}