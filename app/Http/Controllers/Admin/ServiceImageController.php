<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceImageRequest;
use App\Models\ServiceImage;
use App\Models\Service;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ServiceImageResource;
use Exception;

class ServiceImageController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];
            $columnsRaw = array_diff(Schema::getColumnListing((new ServiceImage)->getTable()), $excluded);

            $columnLabels = [
                'id' => 'ID',
                'service_id' => 'Service ID',
                'image_path' => 'Image Path',
                'alt_text_en' => 'Alt Text (EN)',
                'alt_text_ar' => 'Alt Text (AR)',
                'is_main' => 'Main Image',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => ['name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))]);

            $data = ServiceImageResource::collection(ServiceImage::all())
                ->map(fn($item) => collect($columnsRaw)->map(fn($col) => $item[$col] ?? '')->values()->toArray());

            return view('dashboard.service-images.index', compact('columns', 'data'));
        } catch (Exception $e) {
            Log::error("ServiceImage index error: " . $e->getMessage());
            return back()->with('error', 'Failed to load service images.');
        }
    }

    public function create()
    {
        $services = Service::all();
        return view('dashboard.service-images.create-edit', compact('services'));
    }

    public function store(StoreServiceImageRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image_path')) {
                $data['image_path'] = $request->file('image_path')->store('services', 'public');
            }

            ServiceImage::create($data);
            return redirect()->route('service-images.index')->with('success', 'Image added successfully.');
        } catch (Exception $e) {
            Log::error("ServiceImage store error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create service image.');
        }
    }

    public function edit($id)
    {
        try {
            $image = ServiceImage::findOrFail($id);
            $services = Service::all();
            return view('dashboard.service-images.create-edit', compact('image', 'services'));
        } catch (Exception $e) {
            Log::error("ServiceImage edit error: " . $e->getMessage());
            return redirect()->route('service-images.index')->with('error', 'Image not found.');
        }
    }

    public function update(StoreServiceImageRequest $request, $id)
    {
        try {
            $image = ServiceImage::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('image_path')) {
                $data['image_path'] = $request->file('image_path')->store('services', 'public');
            }

            $image->update($data);
            return redirect()->route('service-images.index')->with('success', 'Image updated successfully.');
        } catch (Exception $e) {
            Log::error("ServiceImage update error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update service image.');
        }
    }

    public function destroy(ServiceImage $serviceImage)
    {
        try {
            $serviceImage->delete();
            return redirect()->route('service-images.index')->with('success', 'Image deleted successfully.');
        } catch (Exception $e) {
            Log::error("ServiceImage delete error: " . $e->getMessage());
            return redirect()->route('service-images.index')->with('error', 'Failed to delete image.');
        }
    }
}
