@extends('layouts.vertical', ['subtitle' => 'Testimonials'])

@section('content')

@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($testimonial) ? 'Edit Testimonial' : 'Create Testimonial'
])

<div class="card">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card-body">
        <form class="row g-3" method="POST"
            action="{{ isset($testimonial) ? route('testimonials.update', $testimonial->id) : route('testimonials.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if(isset($testimonial))
                @method('PUT')
            @endif

            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $testimonial->name ?? '') }}">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="role" class="form-label">Role</label>
                <input type="text" name="role" id="role" class="form-control @error('role') is-invalid @enderror"
                       value="{{ old('role', $testimonial->role ?? '') }}">
                @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                @if(isset($testimonial) && $testimonial->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Image" width="80">
                    </div>
                @endif
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="rating" class="form-label">Rating (1-5)</label>
                <input type="number" name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror"
                       value="{{ old('rating', $testimonial->rating ?? '') }}" min="1" max="5">
                @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="message_en" class="form-label">Message (EN)</label>
                <textarea name="message_en" id="message_en" rows="3" class="form-control @error('message_en') is-invalid @enderror">{{ old('message_en', $testimonial->message_en ?? '') }}</textarea>
                @error('message_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="message_ar" class="form-label">Message (AR)</label>
                <textarea name="message_ar" id="message_ar" rows="3" class="form-control @error('message_ar') is-invalid @enderror">{{ old('message_ar', $testimonial->message_ar ?? '') }}</textarea>
                @error('message_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label for="date_given" class="form-label">Date Given</label>
                <input type="date" name="date_given" id="date_given" class="form-control @error('date_given') is-invalid @enderror"
                       value="{{ old('date_given', isset($testimonial) && $testimonial->date_given ? \Carbon\Carbon::parse($testimonial->date_given)->format('Y-m-d') : '') }}">

                @error('date_given')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($testimonial) ? 'Update Testimonial' : 'Create Testimonial' }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
