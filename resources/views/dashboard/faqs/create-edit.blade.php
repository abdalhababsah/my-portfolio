@extends('layouts.vertical', ['subtitle' => 'faqs'])

@section('content')

@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($faq) ? 'Edit FAQ' : 'Create FAQ'
])

<div class="card">
    <div class="card-body">
        @if (isset($faq))
            <form class="row g-3" method="POST" action="{{ route('faqs.update', $faq->id) }}">
                @method('PUT')
        @else
            <form class="row g-3" method="POST" action="{{ route('faqs.store') }}">
        @endif
            @csrf

            <div class="col-md-6">
                <label for="question_en" class="form-label">Question (EN)</label>
                <input type="text" name="question_en" id="question_en" class="form-control @error('question_en') is-invalid @enderror"
                       value="{{ old('question_en', $faq->question_en ?? '') }}">
                @error('question_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="question_ar" class="form-label">Question (AR)</label>
                <input type="text" name="question_ar" id="question_ar" class="form-control @error('question_ar') is-invalid @enderror"
                       value="{{ old('question_ar', $faq->question_ar ?? '') }}">
                @error('question_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="answer_en" class="form-label">Answer (EN)</label>
                <textarea name="answer_en" id="answer_en" class="form-control @error('answer_en') is-invalid @enderror"
                          rows="4">{{ old('answer_en', $faq->answer_en ?? '') }}</textarea>
                @error('answer_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="answer_ar" class="form-label">Answer (AR)</label>
                <textarea name="answer_ar" id="answer_ar" class="form-control @error('answer_ar') is-invalid @enderror"
                          rows="4">{{ old('answer_ar', $faq->answer_ar ?? '') }}</textarea>
                @error('answer_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="display_order" class="form-label">Display Order</label>
                <input type="number" name="display_order" id="display_order" class="form-control @error('display_order') is-invalid @enderror"
                       value="{{ old('display_order', $faq->display_order ?? '') }}">
                @error('display_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">
                    {{ isset($faq) ? 'Update FAQ' : 'Create FAQ' }}
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
