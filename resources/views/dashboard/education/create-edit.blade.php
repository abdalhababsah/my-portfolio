@extends('layouts.vertical', ['subtitle' => 'education'])

@section('content')

@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($education) ? 'Edit Education' : 'Create Education'
])

<div class="card">
    <div class="card-body">
        @if (isset($education))
            <form class="row g-3" method="POST" action="{{ route('education.update', $education->id) }}">
                @method('PUT')
        @else
            <form class="row g-3" method="POST" action="{{ route('education.store') }}">
        @endif
            @csrf

            <div class="col-md-6">
                <label for="institution_en" class="form-label">Institution (EN)</label>
                <input type="text" name="institution_en" id="institution_en"
                       class="form-control @error('institution_en') is-invalid @enderror"
                       value="{{ old('institution_en', $education->institution_en ?? '') }}">
                @error('institution_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="institution_ar" class="form-label">Institution (AR)</label>
                <input type="text" name="institution_ar" id="institution_ar"
                       class="form-control @error('institution_ar') is-invalid @enderror"
                       value="{{ old('institution_ar', $education->institution_ar ?? '') }}">
                @error('institution_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="degree_en" class="form-label">Degree (EN)</label>
                <input type="text" name="degree_en" id="degree_en"
                       class="form-control @error('degree_en') is-invalid @enderror"
                       value="{{ old('degree_en', $education->degree_en ?? '') }}">
                @error('degree_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="degree_ar" class="form-label">Degree (AR)</label>
                <input type="text" name="degree_ar" id="degree_ar"
                       class="form-control @error('degree_ar') is-invalid @enderror"
                       value="{{ old('degree_ar', $education->degree_ar ?? '') }}">
                @error('degree_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" id="start_date"
                       class="form-control @error('start_date') is-invalid @enderror"
                       value="{{ old('start_date', isset($education->start_date) ? \Carbon\Carbon::parse($education->start_date)->format('Y-m-d') : '') }}">
                @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" id="end_date"
                       class="form-control @error('end_date') is-invalid @enderror"
                       value="{{ old('end_date', isset($education->end_date) ? \Carbon\Carbon::parse($education->end_date)->format('Y-m-d') : '') }}">
                @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="description_en" class="form-label">Description (EN)</label>
                <textarea name="description_en" id="description_en"
                          class="form-control @error('description_en') is-invalid @enderror"
                          rows="4">{{ old('description_en', $education->description_en ?? '') }}</textarea>
                @error('description_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="description_ar" class="form-label">Description (AR)</label>
                <textarea name="description_ar" id="description_ar"
                          class="form-control @error('description_ar') is-invalid @enderror"
                          rows="4">{{ old('description_ar', $education->description_ar ?? '') }}</textarea>
                @error('description_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($education) ? 'Update Education' : 'Create Education' }}
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
