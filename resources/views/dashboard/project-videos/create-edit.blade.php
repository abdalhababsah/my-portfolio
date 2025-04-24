@extends('layouts.vertical', ['subtitle' => 'project-videos'])

@section('content')

@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($video) ? 'Edit Project Video' : 'Create Project Video'
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
        @if (isset($video))
            <form class="row g-3" method="POST" action="{{ route('project-videos.update', $video->id) }}" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form class="row g-3" method="POST" action="{{ route('project-videos.store') }}"enctype="multipart/form-data">
        @endif
            @csrf

            <div class="col-md-6">
                <label for="project_id" class="form-label">Project</label>
                <select name="project_id" id="project_id" class="form-select @error('project_id') is-invalid @enderror">
                    <option value="">Select Project</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id', $video->project_id ?? '') == $project->id ? 'selected' : '' }}>
                            {{ $project->title_en }} | {{ $project->title_ar }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>



            <div class="col-md-6">
                <label for="caption_en" class="form-label">Caption (EN)</label>
                <input type="text" name="caption_en" id="caption_en" class="form-control @error('caption_en') is-invalid @enderror" value="{{ old('caption_en', $video->caption_en ?? '') }}">
                @error('caption_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="caption_ar" class="form-label">Caption (AR)</label>
                <input type="text" name="caption_ar" id="caption_ar" class="form-control @error('caption_ar') is-invalid @enderror" value="{{ old('caption_ar', $video->caption_ar ?? '') }}">
                @error('caption_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="thumbnail_alt_en" class="form-label">Thumbnail Alt (EN)</label>
                <input type="text" name="thumbnail_alt_en" id="thumbnail_alt_en" class="form-control @error('thumbnail_alt_en') is-invalid @enderror" value="{{ old('thumbnail_alt_en', $video->thumbnail_alt_en ?? '') }}">
                @error('thumbnail_alt_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="thumbnail_alt_ar" class="form-label">Thumbnail Alt (AR)</label>
                <input type="text" name="thumbnail_alt_ar" id="thumbnail_alt_ar" class="form-control @error('thumbnail_alt_ar') is-invalid @enderror" value="{{ old('thumbnail_alt_ar', $video->thumbnail_alt_ar ?? '') }}">
                @error('thumbnail_alt_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="thumbnail_path" class="form-label">Thumbnail Image</label>
                <input type="file" name="thumbnail_path" id="thumbnail_path" class="form-control @error('thumbnail_path') is-invalid @enderror">
                @if(isset($video) && $video->thumbnail_path)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $video->thumbnail_path) }}" alt="Thumbnail" class="img-thumbnail" width="150">
                    </div>
                @endif
                @error('thumbnail_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="video_file" class="form-label">Video File</label>
                <input type="file" name="video_file" id="video_file" class="form-control @error('video_file') is-invalid @enderror">
                @if(isset($video) && $video->video_url)
                    <div class="mt-2">
                        <video width="320" height="240" controls>
                            <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif
                @error('video_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>




            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($video) ? 'Update Video' : 'Create Video' }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
@vite(['resources/js/pages/table-gridjs.js'])
@endsection
