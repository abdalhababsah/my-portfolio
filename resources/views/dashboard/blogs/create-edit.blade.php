@extends('layouts.vertical', ['subtitle' => 'Blogs'])

@section('content')

@include('layouts.partials.page-title', [
    'title' => 'Darkone',
    'subtitle' => isset($blog) ? 'Edit Blog' : 'Create Blog'
])

<div class="card">
    <div class="card-body">
        @if (isset($blog))
        <form method="POST" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data" class="row g-3">
            @method('PUT')
        @else
        <form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data" class="row g-3">
        @endif
            @csrf

            <div class="col-md-6">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $blog->slug ?? '') }}">
                @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Title (EN)</label>
                <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en', $blog->title_en ?? '') }}">
                @error('title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Title (AR)</label>
                <input type="text" name="title_ar" class="form-control @error('title_ar') is-invalid @enderror" value="{{ old('title_ar', $blog->title_ar ?? '') }}">
                @error('title_ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Summary (EN)</label>
                <textarea name="summary_en" class="form-control @error('summary_en') is-invalid @enderror">{{ old('summary_en', $blog->summary_en ?? '') }}</textarea>
                @error('summary_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Summary (AR)</label>
                <textarea name="summary_ar" class="form-control @error('summary_ar') is-invalid @enderror">{{ old('summary_ar', $blog->summary_ar ?? '') }}</textarea>
                @error('summary_ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Content (EN)</label>
                <textarea name="content_en" class="form-control @error('content_en') is-invalid @enderror">{{ old('content_en', $blog->content_en ?? '') }}</textarea>
                @error('content_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Content (AR)</label>
                <textarea name="content_ar" class="form-control @error('content_ar') is-invalid @enderror">{{ old('content_ar', $blog->content_ar ?? '') }}</textarea>
                @error('content_ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Cover Image</label>
                <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror">
                @error('cover_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Reading Time (minutes)</label>
                <input type="number" name="reading_time" class="form-control @error('reading_time') is-invalid @enderror" value="{{ old('reading_time', $blog->reading_time ?? '') }}">
                @error('reading_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- SEO FIELDS --}}
            <div class="col-md-6">
                <label class="form-label">Meta Title (EN)</label>
                <input type="text" name="meta_title_en" class="form-control @error('meta_title_en') is-invalid @enderror" value="{{ old('meta_title_en', $blog->meta_title_en ?? '') }}">
                @error('meta_title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Meta Title (AR)</label>
                <input type="text" name="meta_title_ar" class="form-control @error('meta_title_ar') is-invalid @enderror" value="{{ old('meta_title_ar', $blog->meta_title_ar ?? '') }}">
                @error('meta_title_ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Meta Description (EN)</label>
                <input type="text" name="meta_description_en" class="form-control @error('meta_description_en') is-invalid @enderror" value="{{ old('meta_description_en', $blog->meta_description_en ?? '') }}">
                @error('meta_description_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Meta Description (AR)</label>
                <input type="text" name="meta_description_ar" class="form-control @error('meta_description_ar') is-invalid @enderror" value="{{ old('meta_description_ar', $blog->meta_description_ar ?? '') }}">
                @error('meta_description_ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Meta Keywords (EN)</label>
                <input type="text" name="meta_keywords_en" class="form-control @error('meta_keywords_en') is-invalid @enderror" value="{{ old('meta_keywords_en', $blog->meta_keywords_en ?? '') }}">
                @error('meta_keywords_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Meta Keywords (AR)</label>
                <input type="text" name="meta_keywords_ar" class="form-control @error('meta_keywords_ar') is-invalid @enderror" value="{{ old('meta_keywords_ar', $blog->meta_keywords_ar ?? '') }}">
                @error('meta_keywords_ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label for="tags" class="form-label">Tags</label>
                <select name="tags[]" id="tags" class="form-select @error('tags') is-invalid @enderror" multiple>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}"
                            {{ in_array($tag->id, old('tags', isset($blog) ? $blog->tags->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                            {{ $tag->name_en }} | {{ $tag->name_ar }}
                        </option>
                    @endforeach
                </select>
                @error('tags')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-12">
                <button class="btn btn-primary float-end">
                    {{ isset($blog) ? 'Update Blog' : 'Create Blog' }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
