@extends('layouts.vertical', ['subtitle' => 'project-images'])

@section('content')

@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($image) ? 'Edit Project Image' : 'Create Project Image'
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
            <form class="row g-3" method="POST" action="{{ route('project-images.update', $image->id) }}" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form class="row g-3" method="POST" action="{{ route('project-images.store') }}" enctype="multipart/form-data">
        @endif
            @csrf

            <div class="col-md-6">
                <label for="project_id" class="form-label">Project</label>
                <select name="project_id" id="project_id" class="form-select @error('project_id') is-invalid @enderror">
                    <option value="">Select Project</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id', $image->project_id ?? '') == $project->id ? 'selected' : '' }}>
                            {{ $project->title_en }} | {{ $project->title_ar }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                <div class="form-check mt-4">
                    <input type="checkbox" class="form-check-input" name="is_main" id="is_main" value="1" {{ old('is_main', $image->is_main ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_main">Main Image</label>
                </div>
                @error('is_main')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
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
