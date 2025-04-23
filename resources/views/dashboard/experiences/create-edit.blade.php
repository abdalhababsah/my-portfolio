@extends('layouts.vertical', ['subtitle' => 'experiences'])

@section('content')

@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($experience) ? 'Edit Experience' : 'Create Experience'
])

<div class="card">
    <div class="card-body">
        @if (isset($experience))
            <form class="row g-3" method="POST" action="{{ route('experiences.update', $experience->id) }}">
                @method('PUT')
        @else
            <form class="row g-3" method="POST" action="{{ route('experiences.store') }}">
        @endif
            @csrf

            <div class="col-md-6">
                <label for="company_en" class="form-label">Company (EN)</label>
                <input type="text" name="company_en" id="company_en" class="form-control @error('company_en') is-invalid @enderror"
                       value="{{ old('company_en', $experience->company_en ?? '') }}">
                @error('company_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="company_ar" class="form-label">Company (AR)</label>
                <input type="text" name="company_ar" id="company_ar" class="form-control @error('company_ar') is-invalid @enderror"
                       value="{{ old('company_ar', $experience->company_ar ?? '') }}">
                @error('company_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="position_en" class="form-label">Position (EN)</label>
                <input type="text" name="position_en" id="position_en" class="form-control @error('position_en') is-invalid @enderror"
                       value="{{ old('position_en', $experience->position_en ?? '') }}">
                @error('position_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="position_ar" class="form-label">Position (AR)</label>
                <input type="text" name="position_ar" id="position_ar" class="form-control @error('position_ar') is-invalid @enderror"
                       value="{{ old('position_ar', $experience->position_ar ?? '') }}">
                @error('position_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="start_date" class="form-label">Start Date</label>
                <<input type="date" name="start_date" id="start_date"
                class="form-control @error('start_date') is-invalid @enderror"
                value="{{ old('start_date', isset($experience->start_date) ? \Carbon\Carbon::parse($experience->start_date)->format('Y-m-d') : '') }}">

                @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" id="end_date"
    class="form-control @error('end_date') is-invalid @enderror"
    value="{{ old('end_date', isset($experience->end_date) ? \Carbon\Carbon::parse($experience->end_date)->format('Y-m-d') : '') }}">

                @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="description_en" class="form-label">Description (EN)</label>
                <textarea name="description_en" id="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="4">{{ old('description_en', $experience->description_en ?? '') }}</textarea>
                @error('description_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="description_ar" class="form-label">Description (AR)</label>
                <textarea name="description_ar" id="description_ar" class="form-control @error('description_ar') is-invalid @enderror" rows="4">{{ old('description_ar', $experience->description_ar ?? '') }}</textarea>
                @error('description_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($experience) ? 'Update Experience' : 'Create Experience' }}
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
