<?php
// app/Http/Controllers/Admin/TestimonialController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Exception;

class TestimonialController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];
            $columnsRaw = array_diff(Schema::getColumnListing((new Testimonial)->getTable()), $excluded);

            $columnLabels = [
                'id' => 'ID',
                'name' => 'Name',
                'role' => 'Role',
                'image' => 'Image',
                'rating' => 'Rating',
                'message_en' => 'Message (EN)',
                'message_ar' => 'Message (AR)',
                'date_given' => 'Date Given',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => ['name' => $columnLabels[$col] ?? ucfirst($col)]);
            $data = TestimonialResource::collection(Testimonial::all())
                ->map(function ($resource) use ($columnsRaw) {
                    $data = $resource->toArray(request());
                    return collect($columnsRaw)->map(fn($col) => $data[$col] ?? '')->values()->toArray();
                });

            return view('dashboard.testimonials.index', compact('columns', 'data'));
        } catch (Exception $e) {
            Log::error('Testimonials Index Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to load testimonials.');
        }
    }

    public function create()
    {
        return view('dashboard.testimonials.create-edit');
    }

    public function store(StoreTestimonialRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('testimonials', 'public');
            }

            Testimonial::create($data);
            return redirect()->route('testimonials.index')->with('success', 'Testimonial added successfully.');
        } catch (Exception $e) {
            Log::error('Testimonials Store Error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to add testimonial.');
        }
    }

    public function edit($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            return view('dashboard.testimonials.create-edit', compact('testimonial'));
        } catch (Exception $e) {
            Log::error("Testimonial Edit Error [ID: $id]: " . $e->getMessage());
            return redirect()->route('testimonials.index')->with('error', 'Testimonial not found.');
        }
    }

    public function update(StoreTestimonialRequest $request, $id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('image')) {
                if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                    Storage::disk('public')->delete($testimonial->image);
                }
                $data['image'] = $request->file('image')->store('testimonials', 'public');
            }

            $testimonial->update($data);
            return redirect()->route('testimonials.index')->with('success', 'Testimonial updated.');
        } catch (Exception $e) {
            Log::error("Testimonial Update Error [ID: $id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update testimonial.');
        }
    }

    public function destroy(Testimonial $testimonial)
    {
        try {
            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }

            $testimonial->delete();
            return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted.');
        } catch (Exception $e) {
            Log::error("Testimonial Delete Error [ID: {$testimonial->id}]: " . $e->getMessage());
            return redirect()->route('testimonials.index')->with('error', 'Failed to delete testimonial.');
        }
    }
}
