@extends('layouts.vertical', ['subtitle' => 'Project Technology'])

@section('content')

@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($certificate) ? 'Edit Certificate' : 'Create Certificate'
])

<div class="card">
    <div class="card-body">
        @if (isset($certificate))
            <form class="row g-3" method="POST" action="{{ route('certificates.update', $certificate->id) }}" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form class="row g-3" method="POST" action="{{ route('certificates.store') }}" enctype="multipart/form-data">
        @endif
            @csrf

            <div class="col-md-6">
                <label for="title_en" class="form-label">Title (EN)</label>
                <input type="text" name="title_en" id="title_en"
                       class="form-control @error('title_en') is-invalid @enderror"
                       value="{{ old('title_en', $certificate->title_en ?? '') }}">
                @error('title_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="title_ar" class="form-label">Title (AR)</label>
                <input type="text" name="title_ar" id="title_ar"
                       class="form-control @error('title_ar') is-invalid @enderror"
                       value="{{ old('title_ar', $certificate->title_ar ?? '') }}">
                @error('title_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="issued_by" class="form-label">Issued By</label>
                <input type="text" name="issued_by" id="issued_by"
                       class="form-control @error('issued_by') is-invalid @enderror"
                       value="{{ old('issued_by', $certificate->issued_by ?? '') }}">
                @error('issued_by')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="file_path" class="form-label">Certificate File</label>
                <input type="file" name="file_path" id="file_path"
                       class="form-control @error('file_path') is-invalid @enderror">
                @error('file_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="date_issued" class="form-label">Date Issued</label>
                <input type="date" name="date_issued" id="date_issued"
                       class="form-control @error('date_issued') is-invalid @enderror"
                       value="{{ old('date_issued', isset($certificate->date_issued) ? \Carbon\Carbon::parse($certificate->date_issued)->format('Y-m-d') : '') }}">
                @error('date_issued')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="expiry_date" class="form-label">Expiry Date</label>
                <input type="date" name="expiry_date" id="expiry_date"
                       class="form-control @error('expiry_date') is-invalid @enderror"
                       value="{{ old('expiry_date', isset($certificate->expiry_date) ? \Carbon\Carbon::parse($certificate->expiry_date)->format('Y-m-d') : '') }}">
                @error('expiry_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="description_en" class="form-label">Description (EN)</label>
                <textarea name="description_en" id="description_en"
                          class="form-control @error('description_en') is-invalid @enderror"
                          rows="4">{{ old('description_en', $certificate->description_en ?? '') }}</textarea>
                @error('description_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="description_ar" class="form-label">Description (AR)</label>
                <textarea name="description_ar" id="description_ar"
                          class="form-control @error('description_ar') is-invalid @enderror"
                          rows="4">{{ old('description_ar', $certificate->description_ar ?? '') }}</textarea>
                @error('description_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($certificate) ? 'Update Certificate' : 'Create Certificate' }}
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
