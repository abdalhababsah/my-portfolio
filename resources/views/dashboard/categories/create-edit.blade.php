@extends('layouts.vertical', ['subtitle' => 'categories'])

@section('content')

@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($category) ? 'Edit Category' : 'Create Category'
])

<div class="card">
    <div class="card-body">
        @if (isset($category))
            <form class="row g-3" method="POST" action="{{ route('categories.update', $category->id) }}">
                @method('PUT')
        @else
            <form class="row g-3" method="POST" action="{{ route('categories.store') }}">
        @endif
            @csrf

            <div class="col-md-6">
                <label for="name_en" class="form-label">Name (EN)</label>
                <input type="text" name="name_en" id="name_en"
                       class="form-control @error('name_en') is-invalid @enderror"
                       value="{{ old('name_en', $category->name_en ?? '') }}">
                @error('name_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="name_ar" class="form-label">Name (AR)</label>
                <input type="text" name="name_ar" id="name_ar"
                       class="form-control @error('name_ar') is-invalid @enderror"
                       value="{{ old('name_ar', $category->name_ar ?? '') }}">
                @error('name_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="meta_title_en" class="form-label">Meta Title (EN)</label>
                <input type="text" name="meta_title_en" id="meta_title_en"
                       class="form-control @error('meta_title_en') is-invalid @enderror"
                       value="{{ old('meta_title_en', $category->meta_title_en ?? '') }}">
                @error('meta_title_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="meta_title_ar" class="form-label">Meta Title (AR)</label>
                <input type="text" name="meta_title_ar" id="meta_title_ar"
                       class="form-control @error('meta_title_ar') is-invalid @enderror"
                       value="{{ old('meta_title_ar', $category->meta_title_ar ?? '') }}">
                @error('meta_title_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="meta_description_en" class="form-label">Meta Description (EN)</label>
                <textarea name="meta_description_en" id="meta_description_en"
                          class="form-control @error('meta_description_en') is-invalid @enderror"
                          rows="3">{{ old('meta_description_en', $category->meta_description_en ?? '') }}</textarea>
                @error('meta_description_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="meta_description_ar" class="form-label">Meta Description (AR)</label>
                <textarea name="meta_description_ar" id="meta_description_ar"
                          class="form-control @error('meta_description_ar') is-invalid @enderror"
                          rows="3">{{ old('meta_description_ar', $category->meta_description_ar ?? '') }}</textarea>
                @error('meta_description_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="meta_keywords_en" class="form-label">Meta Keywords (EN)</label>
                <input type="text" name="meta_keywords_en" id="meta_keywords_en"
                       class="form-control @error('meta_keywords_en') is-invalid @enderror"
                       value="{{ old('meta_keywords_en', $category->meta_keywords_en ?? '') }}">
                @error('meta_keywords_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="meta_keywords_ar" class="form-label">Meta Keywords (AR)</label>
                <input type="text" name="meta_keywords_ar" id="meta_keywords_ar"
                       class="form-control @error('meta_keywords_ar') is-invalid @enderror"
                       value="{{ old('meta_keywords_ar', $category->meta_keywords_ar ?? '') }}">
                @error('meta_keywords_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($category) ? 'Update Category' : 'Create Category' }}
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
