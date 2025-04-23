<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFaqRequest;
use App\Models\Faq;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\FaqResource;
use Exception;

class FaqsController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];

            $columnsRaw = array_diff(Schema::getColumnListing((new Faq)->getTable()), $excluded);

            $columnLabels = [
                'id' => 'ID',
                'question_en' => 'Question (EN)',
                'question_ar' => 'Question (AR)',
                'answer_en' => 'Answer (EN)',
                'answer_ar' => 'Answer (AR)',
                'display_order' => 'Display Order',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => [
                'name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))
            ])->values();

            $faqs = FaqResource::collection(Faq::all())
                ->map(function ($resource) use ($columnsRaw) {
                    $data = $resource->toArray(request());
                    return collect($columnsRaw)->map(fn($col) => $data[$col] ?? '')->values()->toArray();
                });

            return view('dashboard.faqs.index', [
                'columns' => $columns,
                'data' => $faqs
            ]);
        } catch (Exception $e) {
            Log::error('Error loading FAQs index: ' . $e->getMessage());
            return back()->with('error', 'Failed to load FAQs.');
        }
    }

    public function create()
    {
        return view('dashboard.faqs.create-edit');
    }

    public function store(StoreFaqRequest $request)
    {
        try {
            Faq::create($request->validated());
            return redirect()->route('faqs.index')->with('success', 'FAQ created successfully.');
        } catch (Exception $e) {
            Log::error('Error creating FAQ: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create FAQ.');
        }
    }

    public function edit($id)
    {
        try {
            $faq = Faq::findOrFail($id);
            return view('dashboard.faqs.create-edit', compact('faq'));
        } catch (Exception $e) {
            Log::error("Error editing FAQ [ID: $id]: " . $e->getMessage());
            return redirect()->route('faqs.index')->with('error', 'FAQ not found.');
        }
    }

    public function update(StoreFaqRequest $request, $id)
    {
        try {
            $faq = Faq::findOrFail($id);
            $faq->update($request->validated());
            return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
        } catch (Exception $e) {
            Log::error("Error updating FAQ [ID: $id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update FAQ.');
        }
    }

    public function destroy(Faq $faq)
    {
        try {
            $faq->delete();
            return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully.');
        } catch (Exception $e) {
            Log::error("Error deleting FAQ [ID: {$faq->id}]: " . $e->getMessage());
            return redirect()->route('faqs.index')->with('error', 'Failed to delete FAQ.');
        }
    }
}
