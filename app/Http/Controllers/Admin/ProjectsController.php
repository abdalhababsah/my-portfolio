<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Http\Request;

use App\Models\Project;
use Illuminate\Support\Facades\Schema;

class ProjectsController extends Controller
{


    public function index()
    {
        $excluded = [
            'meta_title_en',
            'meta_title_ar',
            'meta_description_en',
            'meta_description_ar',
            'meta_keywords_en',
            'meta_keywords_ar',
            'created_at',
            'updated_at'
        ];

        $columnsRaw = array_diff(
            Schema::getColumnListing((new Project)->getTable()),
            $excluded
        );

        // ✅ Define label mappings
        $columnLabels = [
            'id' => 'ID',
            'slug' => 'Slug',
            'title_en' => 'Title (EN)',
            'title_ar' => 'Title (AR)',
            'short_description_en' => 'Short Desc (EN)',
            'short_description_ar' => 'Short Desc (AR)',
            'full_description_en' => ['name' => 'Full Desc (EN)', 'width' => '250px'],
            'full_description_ar' => ['name' => 'Full Desc (AR)', 'width' => '250px'],
            'role_en' => 'Role (EN)',
            'role_ar' => 'Role (AR)',
            'duration' => 'Duration',
            'client_name' => 'Client Name',
            'location' => 'Location',
            'year' => 'Year',
        ];

        // ✅ Map raw column names to labels
        $columns = collect($columnsRaw)->map(function ($col) use ($columnLabels) {
            return $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col));
        });

        // ✅ Prepare row data in same order
        $projects = Project::all()->map(function ($project) use ($columnsRaw) {
            return collect($columnsRaw)->map(fn($col) => $project->{$col})->values();
        });

        return view('dashboard.projects.index', [
            'columns' => $columns,
            'data' => $projects
        ]);
    }



    public function create()
    {
        return view('dashboard.projects.create-edit'); // ✅ this is correct
    }
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('projects', 'public');
        }

        $data['featured'] = $request->has('featured');

        // Use slug as unique key or fallback to ID
        Project::updateOrCreate(
            ['id' => $request->input('project_id')], // if null, will create
            $data
        );


        return redirect()->route('admin.projects.index')->with('success', 'Project created or updated successfully.');
    }
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('dashboard.projects.create-edit', [
            'project' => $project
        ]);
    }
}
