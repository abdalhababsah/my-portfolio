@extends('layouts.vertical', ['subtitle' => 'Service Images'])

@section('content')

@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($image) ? 'Edit Service Image' : 'Create Service Image'
])

<div class="card">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card-body">
        @if (isset($image))
            <form class="row g-3" method="POST" action="{{ route('service-images.update', $image->id) }}" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form class="row g-3" method="POST" action="{{ route('service-images.store') }}" enctype="multipart/form-data">
        @endif
            @csrf

            <div class="col-md-6">
                <label for="service_id" class="form-label">Service</label>
                <select name="service_id" id="service_id" class="form-select @error('service_id') is-invalid @enderror">
                    <option value="">Select a service</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id', $image->service_id ?? '') == $service->id ? 'selected' : '' }}>
                            {{ $service->title_en }} | {{ $service->title_ar }}
                        </option>
                    @endforeach
                </select>
                @error('service_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="image_path" class="form-label">Image</label>
                <input type="file" name="image_path" id="image_path" class="form-control @error('image_path') is-invalid @enderror">
                @error('image_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="alt_text_en" class="form-label">Alt Text (EN)</label>
                <input type="text" name="alt_text_en" id="alt_text_en" class="form-control @error('alt_text_en') is-invalid @enderror" value="{{ old('alt_text_en', $image->alt_text_en ?? '') }}">
                @error('alt_text_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="alt_text_ar" class="form-label">Alt Text (AR)</label>
                <input type="text" name="alt_text_ar" id="alt_text_ar" class="form-control @error('alt_text_ar') is-invalid @enderror" value="{{ old('alt_text_ar', $image->alt_text_ar ?? '') }}">
                @error('alt_text_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <div class="form-check mt-4 pt-2">
                    <input class="form-check-input" type="checkbox" value="1" id="is_main" name="is_main"
                        {{ old('is_main', $image->is_main ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_main">Main Image</label>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($image) ? 'Update Image' : 'Create Image' }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
@vite(['resources/js/pages/table-gridjs.js'])
@endsection
