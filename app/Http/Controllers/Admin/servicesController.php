<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class servicesController extends Controller
{
    public function index()
    {
        $excluded = [
            'meta_title_en',
            'meta_title_ar',
            'meta_description_en',
            'meta_description_ar',
            'meta_keywords_en',
            'meta_keywords_ar',
            'created_at',
            'updated_at'
        ];

        $columnsRaw = array_diff(
            Schema::getColumnListing((new Service)->getTable()),
            $excluded
        );

        // ✅ Define label mappings
        $columnLabels = [
            'id' => 'ID',
            'slug' => 'Slug',
            'title_en' => 'Title (EN)',
            'title_ar' => 'Title (AR)',
            'description_en' => 'Description en',
            'description_ar' => 'Description ar',
            'price' => 'Price',
            'currency' => 'Currency',
            'unit_en' => 'Unit en',
            'unit_ar' => 'Unit ar',
            'cover_image' => 'Cover image',
        ];

        // ✅ Map raw column names to labels
        $columns = collect($columnsRaw)->map(function ($col) use ($columnLabels) {
            return $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col));
        });
        // dd($columns);
        // ✅ Prepare row data in same order
        $services = Service::all()->map(function ($project) use ($columnsRaw) {
            return collect($columnsRaw)->map(fn($col) => $project->{$col})->values();
        });

        return view('dashboard.projects.index', [
            'columns' => $columns,
            'data' => $services
        ]);
    }
}
