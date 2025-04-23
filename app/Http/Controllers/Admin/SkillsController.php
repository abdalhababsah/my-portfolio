<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Models\Skill;
use App\Http\Resources\SkillResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class SkillsController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];
            $columnsRaw = array_diff(Schema::getColumnListing((new Skill)->getTable()), $excluded);

            $columnLabels = [
                'id' => 'ID',
                'name_en' => 'Name (EN)',
                'name_ar' => 'Name (AR)',
                'description_en' => 'Description (EN)',
                'description_ar' => 'Description (AR)',
                'level' => 'Level',
                'category_id' => 'Category ID',
                'icon' => 'Icon',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => [
                'name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))
            ]);

            $data = SkillResource::collection(Skill::all())
                ->map(fn($item) => collect($columnsRaw)->map(fn($col) => $item[$col] ?? '')->values()->toArray());

            return view('dashboard.skills.index', compact('columns', 'data'));
        } catch (Exception $e) {
            Log::error("Skills index error: " . $e->getMessage());
            return back()->with('error', 'Failed to load skills.');
        }
    }

    public function create()
    {
        return view('dashboard.skills.create-edit');
    }

    public function store(StoreSkillRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('icon')) {
                $data['icon'] = $request->file('icon')->store('skills/icons', 'public');
            }

            Skill::create($data);

            return redirect()->route('skills.index')->with('success', 'Skill created successfully.');
        } catch (Exception $e) {
            Log::error("Skill store error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create skill.');
        }
    }

    public function edit($id)
    {
        try {
            $skill = Skill::findOrFail($id);
            return view('dashboard.skills.create-edit', compact('skill'));
        } catch (Exception $e) {
            Log::error("Skill edit error [ID: $id]: " . $e->getMessage());
            return redirect()->route('skills.index')->with('error', 'Skill not found.');
        }
    }

    public function update(StoreSkillRequest $request, $id)
    {
        try {
            $skill = Skill::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('icon')) {
                // Delete old icon if it exists
                if ($skill->icon && Storage::disk('public')->exists($skill->icon)) {
                    Storage::disk('public')->delete($skill->icon);
                }

                $data['icon'] = $request->file('icon')->store('skills/icons', 'public');
            }

            $skill->update($data);

            return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
        } catch (Exception $e) {
            Log::error("Skill update error [ID: $id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update skill.');
        }
    }

    public function destroy(Skill $skill)
    {
        try {
            if ($skill->icon && Storage::disk('public')->exists($skill->icon)) {
                Storage::disk('public')->delete($skill->icon);
            }

            $skill->delete();
            return redirect()->route('skills.index')->with('success', 'Skill deleted.');
        } catch (Exception $e) {
            Log::error("Skill delete error [ID: {$skill->id}]: " . $e->getMessage());
            return redirect()->route('skills.index')->with('error', 'Failed to delete skill.');
        }
    }
}
