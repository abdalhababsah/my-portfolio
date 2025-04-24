@extends('layouts.vertical', ['subtitle' => 'Social Links'])

@section('content')

@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($socialLink) ? 'Edit Social Link' : 'Create Social Link'
])

<div class="card">
    <div class="card-body">
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

        @if (isset($socialLink))
            <form class="row g-3" method="POST" action="{{ route('social-links.update', $socialLink->id) }}">
                @method('PUT')
        @else
            <form class="row g-3" method="POST" action="{{ route('social-links.store') }}">
        @endif
            @csrf

            <div class="col-md-6">
                <label for="platform" class="form-label">Platform</label>
                <input type="text" name="platform" id="platform" class="form-control @error('platform') is-invalid @enderror"
                       value="{{ old('platform', $socialLink->platform ?? '') }}">
                @error('platform')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="url" class="form-label">URL</label>
                <input type="url" name="url" id="url" class="form-control @error('url') is-invalid @enderror"
                       value="{{ old('url', $socialLink->url ?? '') }}">
                @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="icon_class" class="form-label">Icon Class</label>
                <input type="text" name="icon_class" id="icon_class" class="form-control @error('icon_class') is-invalid @enderror"
                       value="{{ old('icon_class', $socialLink->icon_class ?? '') }}">
                <div class="form-text">e.g., `fa fa-facebook` or `bi bi-twitter`</div>
                @error('icon_class')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($socialLink) ? 'Update Social Link' : 'Create Social Link' }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
