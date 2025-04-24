<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Resources\ServiceResource;
use Exception;

class ServicesController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];
            $columnsRaw = array_diff(Schema::getColumnListing((new Service)->getTable()), $excluded);

            $columnLabels = [
                'id' => 'ID',
                'slug' => 'Slug',
                'title_en' => 'Title (EN)',
                'title_ar' => 'Title (AR)',
                'description_en' => 'Description (EN)',
                'description_ar' => 'Description (AR)',
                'price' => 'Price',
                'currency' => 'Currency',
                'unit_en' => 'Unit (EN)',
                'unit_ar' => 'Unit (AR)',
                'cover_image' => 'Cover Image',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => ['name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))]);

            $data = ServiceResource::collection(Service::all())
                ->map(fn($resource) => collect($columnsRaw)->map(fn($col) => $resource[$col] ?? '')->values()->toArray());

            return view('dashboard.services.index', compact('columns', 'data'));
        } catch (Exception $e) {
            Log::error("Services Index Error: " . $e->getMessage());
            return back()->with('error', 'Failed to load services.');
        }
    }

    public function create()
    {
        return view('dashboard.services.create-edit');
    }

    public function store(StoreServiceRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = $request->file('cover_image')->store('services', 'public');
            }

            Service::create($data);
            return redirect()->route('services.index')->with('success', 'Service created successfully.');
        } catch (Exception $e) {
            Log::error("Service Store Error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create service.');
        }
    }

    public function edit($id)
    {
        try {
            $service = Service::findOrFail($id);
            return view('dashboard.services.create-edit', compact('service'));
        } catch (Exception $e) {
            Log::error("Service Edit Error [ID: $id]: " . $e->getMessage());
            return redirect()->route('services.index')->with('error', 'Service not found.');
        }
    }

    public function update(StoreServiceRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $service = Service::findOrFail($id);

            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = $request->file('cover_image')->store('services', 'public');
            }

            $service->update($data);
            return redirect()->route('services.index')->with('success', 'Service updated successfully.');
        } catch (Exception $e) {
            Log::error("Service Update Error [ID: $id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update service.');
        }
    }

    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
        } catch (Exception $e) {
            Log::error("Service Delete Error [ID: {$service->id}]: " . $e->getMessage());
            return redirect()->route('services.index')->with('error', 'Failed to delete service.');
        }
    }
}
