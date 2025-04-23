<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCertificateRequest;
use App\Models\Certificate;
use App\Http\Resources\CertificateResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Exception;

class CertificateController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];
            $columnsRaw = array_diff(Schema::getColumnListing((new Certificate)->getTable()), $excluded);

            $columnLabels = [
                'id' => 'ID',
                'title_en' => 'Title (EN)',
                'title_ar' => 'Title (AR)',
                'description_en' => 'Description (EN)',
                'description_ar' => 'Description (AR)',
                'file_path' => 'File',
                'issued_by' => 'Issued By',
                'date_issued' => 'Issued Date',
                'expiry_date' => 'Expiry Date',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => ['name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))]);

            $data = CertificateResource::collection(Certificate::all())
                ->map(function ($resource) use ($columnsRaw) {
                    $data = $resource->toArray(request());
                    return collect($columnsRaw)->map(fn($col) => $data[$col] ?? '')->values()->toArray();
                });

            return view('dashboard.certificates.index', compact('columns', 'data'));
        } catch (Exception $e) {
            Log::error("Certificate index error: " . $e->getMessage());
            return back()->with('error', 'Could not load certificates.');
        }
    }

    public function create()
    {
        return view('dashboard.certificates.create-edit');
    }

    public function store(StoreCertificateRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('file_path')) {
                $data['file_path'] = $request->file('file_path')->store('certificates', 'public');
            }

            Certificate::create($data);
            return redirect()->route('certificates.index')->with('success', 'Certificate created successfully.');
        } catch (Exception $e) {
            Log::error("Certificate store error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create certificate.');
        }
    }

    public function edit($id)
    {
        try {
            $certificate = Certificate::findOrFail($id);
            return view('dashboard.certificates.create-edit', compact('certificate'));
        } catch (Exception $e) {
            Log::error("Certificate edit error [ID: $id]: " . $e->getMessage());
            return redirect()->route('certificates.index')->with('error', 'Certificate not found.');
        }
    }

    public function update(StoreCertificateRequest $request, $id)
    {
        try {
            $certificate = Certificate::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('file_path')) {
                $data['file_path'] = $request->file('file_path')->store('certificates', 'public');
            }

            $certificate->update($data);
            return redirect()->route('certificates.index')->with('success', 'Certificate updated successfully.');
        } catch (Exception $e) {
            Log::error("Certificate update error [ID: $id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update certificate.');
        }
    }

    public function destroy(Certificate $certificate)
    {
        try {
            $certificate->delete();
            return redirect()->route('certificates.index')->with('success', 'Certificate deleted.');
        } catch (Exception $e) {
            Log::error("Certificate delete error [ID: {$certificate->id}]: " . $e->getMessage());
            return redirect()->route('certificates.index')->with('error', 'Failed to delete certificate.');
        }
    }
}
