@extends('layouts.vertical', ['subtitle' => 'services'])

@section('content')
@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($service) ? 'Edit Service' : 'Create Service'
])

<div class="card">
    <div class="card-body">
        @if (isset($service))
            <form class="row g-3" method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form class="row g-3" method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">
        @endif
            @csrf

            <div class="col-md-6">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $service->slug ?? '') }}">
                @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="title_en" class="form-label">Title (EN)</label>
                <input type="text" name="title_en" id="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en', $service->title_en ?? '') }}">
                @error('title_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="title_ar" class="form-label">Title (AR)</label>
                <input type="text" name="title_ar" id="title_ar" class="form-control @error('title_ar') is-invalid @enderror" value="{{ old('title_ar', $service->title_ar ?? '') }}">
                @error('title_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $service->price ?? '') }}">
                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="currency" class="form-label">Currency</label>
                <input type="text" name="currency" id="currency" class="form-control @error('currency') is-invalid @enderror" value="{{ old('currency', $service->currency ?? '') }}">
                @error('currency')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="unit_en" class="form-label">Unit (EN)</label>
                <input type="text" name="unit_en" id="unit_en" class="form-control @error('unit_en') is-invalid @enderror" value="{{ old('unit_en', $service->unit_en ?? '') }}">
                @error('unit_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="unit_ar" class="form-label">Unit (AR)</label>
                <input type="text" name="unit_ar" id="unit_ar" class="form-control @error('unit_ar') is-invalid @enderror" value="{{ old('unit_ar', $service->unit_ar ?? '') }}">
                @error('unit_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="cover_image" class="form-label">Cover Image</label>
                <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror">
                @error('cover_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="description_en" class="form-label">Description (EN)</label>
                <textarea name="description_en" id="description_en" class="form-control @error('description_en') is-invalid @enderror">{{ old('description_en', $service->description_en ?? '') }}</textarea>
                @error('description_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="description_ar" class="form-label">Description (AR)</label>
                <textarea name="description_ar" id="description_ar" class="form-control @error('description_ar') is-invalid @enderror">{{ old('description_ar', $service->description_ar ?? '') }}</textarea>
                @error('description_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            {{-- Meta Fields --}}

            <div class="col-md-6">
                <label for="meta_title_en" class="form-label">Meta Title (EN)</label>
                <input type="text" name="meta_title_en" class="form-control" value="{{ old('meta_title_en', $service->meta_title_en ?? '') }}">
            </div>

            <div class="col-md-6">
                <label for="meta_title_ar" class="form-label">Meta Title (AR)</label>
                <input type="text" name="meta_title_ar" class="form-control" value="{{ old('meta_title_ar', $service->meta_title_ar ?? '') }}">
            </div>

            <div class="col-md-6">
                <label for="meta_description_en" class="form-label">Meta Description (EN)</label>
                <input type="text" name="meta_description_en" class="form-control" value="{{ old('meta_description_en', $service->meta_description_en ?? '') }}">
            </div>

            <div class="col-md-6">
                <label for="meta_description_ar" class="form-label">Meta Description (AR)</label>
                <input type="text" name="meta_description_ar" class="form-control" value="{{ old('meta_description_ar', $service->meta_description_ar ?? '') }}">
            </div>

            <div class="col-md-6">
                <label for="meta_keywords_en" class="form-label">Meta Keywords (EN)</label>
                <input type="text" name="meta_keywords_en" class="form-control" value="{{ old('meta_keywords_en', $service->meta_keywords_en ?? '') }}">
            </div>

            <div class="col-md-6">
                <label for="meta_keywords_ar" class="form-label">Meta Keywords (AR)</label>
                <input type="text" name="meta_keywords_ar" class="form-control" value="{{ old('meta_keywords_ar', $service->meta_keywords_ar ?? '') }}">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($service) ? 'Update Service' : 'Create Service' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
