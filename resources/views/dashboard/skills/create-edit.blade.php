@extends('layouts.vertical', ['subtitle' => 'skills'])

@section('content')

@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($skill) ? 'Edit Skill' : 'Create Skill'
])

<div class="card">
    <div class="card-body">
        @if (isset($skill))
            <form class="row g-3" method="POST" action="{{ route('skills.update', $skill->id) }}" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form class="row g-3" method="POST" action="{{ route('skills.store') }}" enctype="multipart/form-data">
        @endif
            @csrf

            <div class="col-md-6">
                <label for="name_en" class="form-label">Name (EN)</label>
                <input type="text" name="name_en" id="name_en"
                       class="form-control @error('name_en') is-invalid @enderror"
                       value="{{ old('name_en', $skill->name_en ?? '') }}">
                @error('name_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="name_ar" class="form-label">Name (AR)</label>
                <input type="text" name="name_ar" id="name_ar"
                       class="form-control @error('name_ar') is-invalid @enderror"
                       value="{{ old('name_ar', $skill->name_ar ?? '') }}">
                @error('name_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="description_en" class="form-label">Description (EN)</label>
                <textarea name="description_en" id="description_en"
                          class="form-control @error('description_en') is-invalid @enderror"
                          rows="4">{{ old('description_en', $skill->description_en ?? '') }}</textarea>
                @error('description_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="description_ar" class="form-label">Description (AR)</label>
                <textarea name="description_ar" id="description_ar"
                          class="form-control @error('description_ar') is-invalid @enderror"
                          rows="4">{{ old('description_ar', $skill->description_ar ?? '') }}</textarea>
                @error('description_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="level" class="form-label">Level (1–100)</label>
                <input type="number" name="level" id="level"
                       class="form-control @error('level') is-invalid @enderror"
                       value="{{ old('level', $skill->level ?? '') }}" min="1" max="100">
                @error('level')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="category_id" class="form-label">Category ID</label>
                <input type="number" name="category_id" id="category_id"
                       class="form-control @error('category_id') is-invalid @enderror"
                       value="{{ old('category_id', $skill->category_id ?? '') }}">
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="icon" class="form-label">Icon</label>
                <input type="file" name="icon" id="icon"
                       class="form-control @error('icon') is-invalid @enderror">
                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror

                @if (isset($skill) && $skill->icon)
                    <div class="mt-2">
                        <strong>Current Icon:</strong><br>
                        <img src="{{ asset('storage/' . $skill->icon) }}" alt="Icon" style="max-height: 50px;">
                    </div>
                @endif
            </div>


            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($skill) ? 'Update Skill' : 'Create Skill' }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script></script>
@vite(['resources/js/pages/table-gridjs.js'])
@endsection
