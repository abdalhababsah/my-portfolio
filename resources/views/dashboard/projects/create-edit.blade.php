@extends('layouts.vertical', ['subtitle' => 'projects'])

@section('content')

@include('layouts.partials.page-title', ['title' => 'Darkone', 'subtitle' => isset($project) ? 'Edit Project' : 'Create Project'])

<div class="card">
    <div class="card-body">
        @if (isset($project))
        <form class="row g-3" method="POST" action="{{ route('projects.update', $project->id) }}" enctype="multipart/form-data">
            @method('PUT')
        @else
        <form class="row g-3" method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
        @endif
            @csrf
            <input type="hidden" name="project_id" value="{{ $project->id ?? '' }}">

            <div class="col-md-6">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $project->slug ?? '') }}">
                @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="title_en" class="form-label">Title (EN)</label>
                <input type="text" name="title_en" id="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en', $project->title_en ?? '') }}">
                @error('title_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="title_ar" class="form-label">Title (AR)</label>
                <input type="text" name="title_ar" id="title_ar" class="form-control @error('title_ar') is-invalid @enderror" value="{{ old('title_ar', $project->title_ar ?? '') }}">
                @error('title_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="short_description_en" class="form-label">Short Description (EN)</label>
                <textarea name="short_description_en" id="short_description_en" class="form-control @error('short_description_en') is-invalid @enderror">{{ old('short_description_en', $project->short_description_en ?? '') }}</textarea>
                @error('short_description_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="short_description_ar" class="form-label">Short Description (AR)</label>
                <textarea name="short_description_ar" id="short_description_ar" class="form-control @error('short_description_ar') is-invalid @enderror">{{ old('short_description_ar', $project->short_description_ar ?? '') }}</textarea>
                @error('short_description_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="full_description_en" class="form-label">Full Description (EN)</label>
                <textarea name="full_description_en" id="full_description_en" class="form-control @error('full_description_en') is-invalid @enderror">{{ old('full_description_en', $project->full_description_en ?? '') }}</textarea>
                @error('full_description_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="full_description_ar" class="form-label">Full Description (AR)</label>
                <textarea name="full_description_ar" id="full_description_ar" class="form-control @error('full_description_ar') is-invalid @enderror">{{ old('full_description_ar', $project->full_description_ar ?? '') }}</textarea>
                @error('full_description_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="role_en" class="form-label">Role (EN)</label>
                <input type="text" name="role_en" id="role_en" class="form-control @error('role_en') is-invalid @enderror" value="{{ old('role_en', $project->role_en ?? '') }}">
                @error('role_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="role_ar" class="form-label">Role (AR)</label>
                <input type="text" name="role_ar" id="role_ar" class="form-control @error('role_ar') is-invalid @enderror" value="{{ old('role_ar', $project->role_ar ?? '') }}">
                @error('role_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="duration_en" class="form-label">Duration (EN)</label>
                <input type="text" name="duration_en" id="duration_en" class="form-control @error('duration_en') is-invalid @enderror" value="{{ old('duration_en', $project->duration_en ?? '') }}">
                @error('duration_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="duration_ar" class="form-label">Duration (AR)</label>
                <input type="text" name="duration_ar" id="duration_ar" class="form-control @error('duration_ar') is-invalid @enderror" value="{{ old('duration_ar', $project->duration_ar ?? '') }}">
                @error('duration_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="cover_image" class="form-label">Cover Image</label>
                <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror">
                @error('cover_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $project->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name_en }} | {{ $category->name_ar }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="github_url" class="form-label">GitHub URL</label>
                <input type="url" name="github_url" id="github_url" class="form-control @error('github_url') is-invalid @enderror" value="{{ old('github_url', $project->github_url ?? '') }}">
                @error('github_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="demo_url" class="form-label">Demo URL</label>
                <input type="url" name="demo_url" id="demo_url" class="form-control @error('demo_url') is-invalid @enderror" value="{{ old('demo_url', $project->demo_url ?? '') }}">
                @error('demo_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="featured" name="featured"
                        {{ old('featured', $project->featured ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="featured">Featured</label>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($project) ? 'Update Project' : 'Create Project' }}
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
