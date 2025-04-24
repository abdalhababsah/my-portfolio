@extends('layouts.vertical', ['subtitle' => 'tags'])

@section('content')

@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($tag) ? 'Edit Tag' : 'Create Tag'
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
        @if (isset($tag))
            <form class="row g-3" method="POST" action="{{ route('tags.update', $tag->id) }}">
                @method('PUT')
        @else
            <form class="row g-3" method="POST" action="{{ route('tags.store') }}">
        @endif
            @csrf

            <div class="col-md-6">
                <label for="name_en" class="form-label">Name (EN)</label>
                <input type="text" name="name_en" id="name_en" class="form-control @error('name_en') is-invalid @enderror"
                       value="{{ old('name_en', $tag->name_en ?? '') }}">
                @error('name_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="name_ar" class="form-label">Name (AR)</label>
                <input type="text" name="name_ar" id="name_ar" class="form-control @error('name_ar') is-invalid @enderror"
                       value="{{ old('name_ar', $tag->name_ar ?? '') }}">
                @error('name_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($tag) ? 'Update Tag' : 'Create Tag' }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
@vite(['resources/js/pages/table-gridjs.js'])
@endsection
