<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\TechnologyResource;
use Exception;

class TechnologyController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];
            $columnsRaw = array_diff(Schema::getColumnListing((new Technology)->getTable()), $excluded);

            $columnLabels = [
                'id' => 'ID',
                'name_en' => 'Name (EN)',
                'name_ar' => 'Name (AR)',
                'logo' => 'Logo',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => [
                'name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))
            ])->values();

            $data = TechnologyResource::collection(Technology::all())
                ->map(fn($resource) => collect($columnsRaw)->map(fn($col) => $resource[$col] ?? '')->values()->toArray());

            return view('dashboard.technologies.index', compact('columns', 'data'));
        } catch (Exception $e) {
            Log::error("Technology Index Error: " . $e->getMessage());
            return back()->with('error', 'Failed to load technologies.');
        }
    }

    public function create()
    {
        return view('dashboard.technologies.create-edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:100',
            'name_ar' => 'required|string|max:100',
            'logo' => 'nullable|image|max:2048',
        ]);

        try {
            $data = $request->only(['name_en', 'name_ar']);

            if ($request->hasFile('logo')) {
                $data['logo'] = $request->file('logo')->store('technologies/logos', 'public');
            }

            Technology::create($data);

            return redirect()->route('technologies.index')->with('success', 'Technology created successfully.');
        } catch (Exception $e) {
            Log::error("Technology Store Error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create technology.');
        }
    }

    public function edit($id)
    {
        try {
            $technology = Technology::findOrFail($id);
            return view('dashboard.technologies.create-edit', compact('technology'));
        } catch (Exception $e) {
            Log::error("Technology Edit Error [ID: $id]: " . $e->getMessage());
            return redirect()->route('technologies.index')->with('error', 'Technology not found.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_en' => 'required|string|max:100',
            'name_ar' => 'required|string|max:100',
            'logo' => 'nullable|image|max:2048',
        ]);

        try {
            $technology = Technology::findOrFail($id);
            $data = $request->only(['name_en', 'name_ar']);

            if ($request->hasFile('logo')) {
                if ($technology->logo && Storage::disk('public')->exists($technology->logo)) {
                    Storage::disk('public')->delete($technology->logo);
                }

                $data['logo'] = $request->file('logo')->store('technologies/logos', 'public');
            }

            $technology->update($data);

            return redirect()->route('technologies.index')->with('success', 'Technology updated successfully.');
        } catch (Exception $e) {
            Log::error("Technology Update Error [ID: $id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update technology.');
        }
    }

    public function destroy(Technology $technology)
    {
        try {
            if ($technology->logo && Storage::disk('public')->exists($technology->logo)) {
                Storage::disk('public')->delete($technology->logo);
            }

            $technology->delete();

            return redirect()->route('technologies.index')->with('success', 'Technology deleted successfully.');
        } catch (Exception $e) {
            Log::error("Technology Delete Error [ID: {$technology->id}]: " . $e->getMessage());
            return redirect()->route('technologies.index')->with('error', 'Failed to delete technology.');
        }
    }
}
