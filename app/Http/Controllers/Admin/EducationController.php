<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEducationRequest;
use App\Models\Education;
use App\Http\Resources\EducationResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Exception;

class EducationController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];

            $columnsRaw = array_diff(Schema::getColumnListing((new Education)->getTable()), $excluded);

            $columnLabels = [
                'id' => 'ID',
                'institution_en' => 'Institution (EN)',
                'institution_ar' => 'Institution (AR)',
                'degree_en' => 'Degree (EN)',
                'degree_ar' => 'Degree (AR)',
                'start_date' => 'Start Date',
                'end_date' => 'End Date',
                'description_en' => 'Description (EN)',
                'description_ar' => 'Description (AR)',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => [
                'name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))
            ]);

            $data = EducationResource::collection(Education::all())
                ->map(function ($resource) use ($columnsRaw) {
                    $data = $resource->toArray(request());
                    return collect($columnsRaw)->map(fn($col) => $data[$col] ?? '')->values()->toArray();
                });

            return view('dashboard.education.index', compact('columns', 'data'));
        } catch (Exception $e) {
            Log::error('Error loading education index: ' . $e->getMessage());
            return back()->with('error', 'Failed to load education records.');
        }
    }

    public function create()
    {
        return view('dashboard.education.create-edit');
    }

    public function store(StoreEducationRequest $request)
    {
        try {
            Education::create($request->validated());
            return redirect()->route('education.index')->with('success', 'Education entry created.');
        } catch (Exception $e) {
            Log::error('Error storing education: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create education entry.');
        }
    }

    public function edit($id)
    {
        try {
            $education = Education::findOrFail($id);
            return view('dashboard.education.create-edit', compact('education'));
        } catch (Exception $e) {
            Log::error("Error editing education [$id]: " . $e->getMessage());
            return redirect()->route('admin.education.index')->with('error', 'Education entry not found.');
        }
    }

    public function update(StoreEducationRequest $request, $id)
    {
        try {
            $education = Education::findOrFail($id);
            $education->update($request->validated());
            return redirect()->route('education.index')->with('success', 'Education entry updated.');
        } catch (Exception $e) {
            Log::error("Error updating education [$id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update education entry.');
        }
    }

    public function destroy(Education $education)
    {
        try {
            $education->delete();
            return redirect()->route('education.index')->with('success', 'Education entry deleted.');
        } catch (Exception $e) {
            Log::error("Error deleting education [{$education->id}]: " . $e->getMessage());
            return redirect()->route('admin.education.index')->with('error', 'Failed to delete education entry.');
        }
    }
}
