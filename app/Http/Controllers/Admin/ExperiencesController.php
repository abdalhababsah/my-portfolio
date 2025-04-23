<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperienceRequest;
use App\Models\Experience;
use App\Http\Resources\ExperienceResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Exception;

class ExperiencesController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];

            $columnsRaw = array_diff(Schema::getColumnListing((new Experience)->getTable()), $excluded);

            $columnLabels = [
                'id' => 'ID',
                'company_en' => 'Company (EN)',
                'company_ar' => 'Company (AR)',
                'position_en' => 'Position (EN)',
                'position_ar' => 'Position (AR)',
                'start_date' => 'Start Date',
                'end_date' => 'End Date',
                'description_en' => 'Description (EN)',
                'description_ar' => 'Description (AR)',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => [
                'name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))
            ])->values();

            $experiences = ExperienceResource::collection(Experience::all())
                ->map(function ($resource) use ($columnsRaw) {
                    $data = $resource->toArray(request());
                    return collect($columnsRaw)->map(fn($col) => $data[$col] ?? '')->values()->toArray();
                });

            return view('dashboard.experiences.index', [
                'columns' => $columns,
                'data' => $experiences
            ]);
        } catch (Exception $e) {
            Log::error('Error loading experiences index: ' . $e->getMessage());
            return back()->with('error', 'Failed to load experiences.');
        }
    }

    public function create()
    {
        return view('dashboard.experiences.create-edit');
    }

    public function store(StoreExperienceRequest $request)
    {
        try {
            Experience::create($request->validated());
            return redirect()->route('experiences.index')->with('success', 'Experience created successfully.');
        } catch (Exception $e) {
            Log::error('Error creating experience: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create experience.');
        }
    }

    public function edit($id)
    {
        try {
            $experience = Experience::findOrFail($id);
            return view('dashboard.experiences.create-edit', compact('experience'));
        } catch (Exception $e) {
            Log::error("Error editing experience [ID: $id]: " . $e->getMessage());
            return redirect()->route('experiences.index')->with('error', 'Experience not found.');
        }
    }

    public function update(StoreExperienceRequest $request, $id)
    {
        try {
            $experience = Experience::findOrFail($id);
            $experience->update($request->validated());
            return redirect()->route('experiences.index')->with('success', 'Experience updated successfully.');
        } catch (Exception $e) {
            Log::error("Error updating experience [ID: $id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update experience.');
        }
    }

    public function destroy(Experience $experience)
    {
        try {
            $experience->delete();
            return redirect()->route('experiences.index')->with('success', 'Experience deleted successfully.');
        } catch (Exception $e) {
            Log::error("Error deleting experience [ID: {$experience->id}]: " . $e->getMessage());
            return redirect()->route('experiences.index')->with('error', 'Failed to delete experience.');
        }
    }
}
