@extends('layouts.vertical', ['subtitle' => 'Technology'])

@section('content')

@include('layouts.partials.page-title', ['title' => 'Dashboard', 'subtitle' => isset($technology) ? 'Edit Technology' : 'Create Technology'])

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ isset($technology) ? route('technologies.update', $technology->id) : route('technologies.store') }}" enctype="multipart/form-data" class="row g-3">
            @csrf
            @if(isset($technology))
                @method('PUT')
            @endif

            <div class="col-md-6">
                <label for="name_en" class="form-label">Name (EN)</label>
                <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" id="name_en" value="{{ old('name_en', $technology->name_en ?? '') }}">
                @error('name_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="name_ar" class="form-label">Name (AR)</label>
                <input type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" id="name_ar" value="{{ old('name_ar', $technology->name_ar ?? '') }}">
                @error('name_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="logo" class="form-label">Logo</label>
                <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" id="logo">
                @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror

                @if(isset($technology) && $technology->logo)
                    <img src="{{ asset('storage/' . $technology->logo) }}" class="mt-2" alt="Logo" width="100">
                @endif
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($technology) ? 'Update Technology' : 'Create Technology' }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
