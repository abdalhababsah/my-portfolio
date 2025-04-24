<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSocialLinkRequest;
use App\Models\SocialLink;
use App\Http\Resources\SocialLinkResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Exception;

class SocialLinkController extends Controller
{
    public function index()
    {
        try {
            $excluded = ['created_at', 'updated_at'];
            $columnsRaw = array_diff(Schema::getColumnListing((new SocialLink)->getTable()), $excluded);

            $columnLabels = [
                'id' => 'ID',
                'platform' => 'Platform',
                'url' => 'URL',
                'icon_class' => 'Icon Class',
            ];

            $columns = collect($columnsRaw)->map(fn($col) => ['name' => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col))])->values();

            $data = SocialLinkResource::collection(SocialLink::all())
                ->map(fn($item) => collect($columnsRaw)->map(fn($col) => $item[$col] ?? '')->values()->toArray());

            return view('dashboard.social-links.index', compact('columns', 'data'));
        } catch (Exception $e) {
            Log::error("SocialLink index error: " . $e->getMessage());
            return back()->with('error', 'Failed to load social links.');
        }
    }

    public function create()
    {
        return view('dashboard.social-links.create-edit');
    }

    public function store(StoreSocialLinkRequest $request)
    {
        try {
            SocialLink::create($request->validated());
            return redirect()->route('social-links.index')->with('success', 'Social link created successfully.');
        } catch (Exception $e) {
            Log::error("SocialLink store error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create social link.');
        }
    }

    public function edit($id)
    {
        try {
            $socialLink = SocialLink::findOrFail($id);
            return view('dashboard.social-links.create-edit', compact('socialLink'));
        } catch (Exception $e) {
            Log::error("SocialLink edit error [ID: $id]: " . $e->getMessage());
            return redirect()->route('social-links.index')->with('error', 'Social link not found.');
        }
    }

    public function update(StoreSocialLinkRequest $request, $id)
    {
        try {
            $socialLink = SocialLink::findOrFail($id);
            $socialLink->update($request->validated());
            return redirect()->route('social-links.index')->with('success', 'Social link updated successfully.');
        } catch (Exception $e) {
            Log::error("SocialLink update error [ID: $id]: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update social link.');
        }
    }

    public function destroy(SocialLink $socialLink)
    {
        try {
            $socialLink->delete();
            return redirect()->route('social-links.index')->with('success', 'Social link deleted successfully.');
        } catch (Exception $e) {
            Log::error("SocialLink delete error [ID: {$socialLink->id}]: " . $e->getMessage());
            return redirect()->route('social-links.index')->with('error', 'Failed to delete social link.');
        }
    }
}
