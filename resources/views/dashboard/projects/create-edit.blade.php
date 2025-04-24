@extends('layouts.vertical')

@section('title', isset($project) ? __('Edit Project') : __('Create Project'))

@section('content')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/projects.css') }}">

  <link
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
    rel="stylesheet"
  />
  <!-- Dropify -->
  <link
    href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css"
    rel="stylesheet"
  />
  <!-- Summernote -->
  <link
    href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css"
    rel="stylesheet"
  />
  <!-- jQuery UI (for sortable images) -->
  <link
    href="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.13.2/jquery-ui.min.css"
    rel="stylesheet"
  />
  <!-- Material Design Icons -->
  <link
    href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css"
    rel="stylesheet"
  />



  <div class="container-fluid">
    {{-- Page title --}}
    <div class="row mb-4">
      <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
          <h4 class="mb-0">{{ isset($project) ? __('Edit Project') : __('Create Project') }}</h4>
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
              <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ route('projects.index') }}">{{ __('Projects') }}</a>
            </li>
            <li class="breadcrumb-item active">
              {{ isset($project) ? __('Edit Project') : __('Create Project') }}
            </li>
          </ol>
        </div>
      </div>
    </div>

    {{-- Form card --}}
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">

            {{-- Validation errors --}}
            @if ($errors->any())
              <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form
              action="{{ isset($project)
                ? route('admin.projects.update', $project->id)
                : route('admin.projects.store') }}"
              method="POST"
              enctype="multipart/form-data"
            >
              @csrf
              @if (isset($project))
                @method('PUT')
              @endif

              {{-- Tabs --}}
              <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    href="#basic-info"
                    data-toggle="tab"
                  >{{ __('Basic Info') }}</a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    href="#images"
                    data-toggle="tab"
                  >{{ __('Images') }}</a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    href="#videos"
                    data-toggle="tab"
                  >{{ __('Videos') }}</a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    href="#meta-info"
                    data-toggle="tab"
                  >{{ __('Meta Info') }}</a>
                </li>
              </ul>

              <div class="tab-content">
                {{-- Basic Info --}}
                <div class="tab-pane fade show active" id="basic-info">
                  <h5 class="mb-4">{{ __('Project Basic Information') }}</h5>

                  <div class="row">
                    {{-- Title EN --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="title_en">
                          {{ __('Title (English)') }}
                          <span class="text-danger">*</span>
                        </label>
                        <input
                          type="text"
                          id="title_en"
                          name="title_en"
                          class="form-control @error('title_en') is-invalid @enderror"
                          value="{{ old('title_en', $project->title_en ?? '') }}"
                          required
                        >
                        @error('title_en')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Title AR --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="title_ar">
                          {{ __('Title (Arabic)') }}
                          <span class="text-danger">*</span>
                        </label>
                        <input
                          type="text"
                          id="title_ar"
                          name="title_ar"
                          class="form-control @error('title_ar') is-invalid @enderror"
                          value="{{ old('title_ar', $project->title_ar ?? '') }}"
                          required
                        >
                        @error('title_ar')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    {{-- Slug --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="slug">
                          {{ __('Slug') }}
                          <span class="text-danger">*</span>
                        </label>
                        <input
                          type="text"
                          id="slug"
                          name="slug"
                          class="form-control @error('slug') is-invalid @enderror"
                          value="{{ old('slug', $project->slug ?? '') }}"
                          required
                        >
                        <small class="form-text text-muted">
                          {{ __('Unique URL-friendly name') }}
                        </small>
                        @error('slug')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Category --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="category_id">
                          {{ __('Category') }}
                          <span class="text-danger">*</span>
                        </label>
                        <select
                          id="category_id"
                          name="category_id"
                          class="form-control select2 @error('category_id') is-invalid @enderror"
                          required
                        >
                          <option value="">{{ __('Select Category') }}</option>
                          @foreach ($categories as $cat)
                            <option
                              value="{{ $cat->id }}"
                              {{ old('category_id', $project->category_id ?? '') == $cat->id ? 'selected' : '' }}
                            >
                              {{ $cat->name_en }}
                            </option>
                          @endforeach
                        </select>
                        @error('category_id')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    {{-- Short description EN --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="short_description_en">
                          {{ __('Short Description (English)') }}
                          <span class="text-danger">*</span>
                        </label>
                        <textarea
                          id="short_description_en"
                          name="short_description_en"
                          rows="3"
                          class="form-control @error('short_description_en') is-invalid @enderror"
                          required
                        >{{ old('short_description_en', $project->short_description_en ?? '') }}</textarea>
                        @error('short_description_en')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Short description AR --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="short_description_ar">
                          {{ __('Short Description (Arabic)') }}
                          <span class="text-danger">*</span>
                        </label>
                        <textarea
                          id="short_description_ar"
                          name="short_description_ar"
                          rows="3"
                          class="form-control @error('short_description_ar') is-invalid @enderror"
                          required
                        >{{ old('short_description_ar', $project->short_description_ar ?? '') }}</textarea>
                        @error('short_description_ar')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    {{-- Full description EN --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="full_description_en">
                          {{ __('Full Description (English)') }}
                          <span class="text-danger">*</span>
                        </label>
                        <textarea
                          id="full_description_en"
                          name="full_description_en"
                          class="form-control summernote @error('full_description_en') is-invalid @enderror"
                          required
                        >{{ old('full_description_en', $project->full_description_en ?? '') }}</textarea>
                        @error('full_description_en')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Full description AR --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="full_description_ar">
                          {{ __('Full Description (Arabic)') }}
                          <span class="text-danger">*</span>
                        </label>
                        <textarea
                          id="full_description_ar"
                          name="full_description_ar"
                          class="form-control summernote @error('full_description_ar') is-invalid @enderror"
                          required
                        >{{ old('full_description_ar', $project->full_description_ar ?? '') }}</textarea>
                        @error('full_description_ar')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    {{-- Role EN --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="role_en">{{ __('Role (English)') }}</label>
                        <input
                          type="text"
                          id="role_en"
                          name="role_en"
                          class="form-control @error('role_en') is-invalid @enderror"
                          value="{{ old('role_en', $project->role_en ?? '') }}"
                        >
                        @error('role_en')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Role AR --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="role_ar">{{ __('Role (Arabic)') }}</label>
                        <input
                          type="text"
                          id="role_ar"
                          name="role_ar"
                          class="form-control @error('role_ar') is-invalid @enderror"
                          value="{{ old('role_ar', $project->role_ar ?? '') }}"
                        >
                        @error('role_ar')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    {{-- Duration --}}
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="duration">{{ __('Duration') }}</label>
                        <input
                          type="text"
                          id="duration"
                          name="duration"
                          class="form-control @error('duration') is-invalid @enderror"
                          value="{{ old('duration', $project->duration ?? '') }}"
                        >
                        @error('duration')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Year --}}
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="year">{{ __('Year') }}</label>
                        <input
                          type="text"
                          id="year"
                          name="year"
                          class="form-control @error('year') is-invalid @enderror"
                          value="{{ old('year', $project->year ?? '') }}"
                        >
                        @error('year')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Client Name --}}
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="client_name">{{ __('Client Name') }}</label>
                        <input
                          type="text"
                          id="client_name"
                          name="client_name"
                          class="form-control @error('client_name') is-invalid @enderror"
                          value="{{ old('client_name', $project->client_name ?? '') }}"
                        >
                        @error('client_name')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Location --}}
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="location">{{ __('Location') }}</label>
                        <input
                          type="text"
                          id="location"
                          name="location"
                          class="form-control @error('location') is-invalid @enderror"
                          value="{{ old('location', $project->location ?? '') }}"
                        >
                        @error('location')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    {{-- GitHub URL --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="github_url">{{ __('GitHub URL') }}</label>
                        <input
                          type="url"
                          id="github_url"
                          name="github_url"
                          class="form-control @error('github_url') is-invalid @enderror"
                          value="{{ old('github_url', $project->github_url ?? '') }}"
                        >
                        @error('github_url')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Demo URL --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="demo_url">{{ __('Demo URL') }}</label>
                        <input
                          type="url"
                          id="demo_url"
                          name="demo_url"
                          class="form-control @error('demo_url') is-invalid @enderror"
                          value="{{ old('demo_url', $project->demo_url ?? '') }}"
                        >
                        @error('demo_url')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    {{-- Tags --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="tags">{{ __('Tags') }}</label>
                        <select
                          id="tags"
                          name="tags[]"
                          class="form-control select2-multiple @error('tags') is-invalid @enderror"
                          multiple="multiple"
                          data-placeholder="{{ __('Choose tags...') }}"
                        >
                          @foreach ($tags as $tag)
                            <option
                              value="{{ $tag->id }}"
                              {{ isset($project) && $project->tags->contains($tag->id) ? 'selected' : '' }}
                            >
                              {{ $tag->name_en }}
                            </option>
                          @endforeach
                        </select>
                        <small class="form-text text-muted">
                          {{ __('Select multiple tags') }}
                        </small>
                        @error('tags')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Technologies --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="technologies">{{ __('Technologies') }}</label>
                        <select
                          id="technologies"
                          name="technologies[]"
                          class="form-control select2-multiple @error('technologies') is-invalid @enderror"
                          multiple="multiple"
                          data-placeholder="{{ __('Choose technologies...') }}"
                        >
                          @foreach ($technologies as $tech)
                            <option
                              value="{{ $tech->id }}"
                              {{ isset($project) && $project->technologies->contains($tech->id) ? 'selected' : '' }}
                            >
                              {{ $tech->name_en }}
                            </option>
                          @endforeach
                        </select>
                        <small class="form-text text-muted">
                          {{ __('Select multiple technologies') }}
                        </small>
                        @error('technologies')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    {{-- Cover Image --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="cover_image">
                          {{ __('Cover Image') }}
                          @if (!isset($project))
                            <span class="text-danger">*</span>
                          @endif
                        </label>
                        <input
                          type="file"
                          id="cover_image"
                          name="cover_image"
                          class="dropify form-control @error('cover_image') is-invalid @enderror"
                          data-allowed-file-extensions="jpg jpeg png gif"
                          data-max-file-size="2M"
                          {{ !isset($project) ? 'required' : '' }}
                          @if (isset($project) && $project->cover_image)
                            data-default-file="{{ Storage::url($project->cover_image) }}"
                          @endif
                        >
                        <small class="form-text text-muted">
                          {{ __('Upload a cover image (max 2MB)') }}
                        </small>
                        @error('cover_image')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    {{-- Featured --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>{{ __('Featured Project') }}</label>
                        <div class="custom-control custom-switch mt-2">
                          <input
                            type="hidden"
                            name="featured"
                            value="0"
                          >
                          <input
                            type="checkbox"
                            id="featured"
                            name="featured"
                            class="custom-control-input"
                            value="1"
                            {{ old('featured', $project->featured ?? false) ? 'checked' : '' }}
                          >
                          <label class="custom-control-label" for="featured">
                            {{ __('Mark as featured') }}
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                {{-- Images tab --}}
                <div class="tab-pane fade" id="images">
                  <h5 class="mb-4">{{ __('Project Images') }}</h5>

                  {{-- Existing images --}}
                  @if (isset($project) && $project->images->count())
                    <div class="mb-4">
                      <h6>{{ __('Existing Images') }}</h6>
                      <div id="sortable-images" class="row">
                        @foreach ($project->images as $i => $img)
                          <div class="col-md-3 mb-3 sortable-image-item">
                            <div class="card">
                              <div
                                class="card-header d-flex justify-content-between align-items-center bg-light"
                                style="cursor: move;"
                              >
                                <span>#{{ $i + 1 }}</span>
                                <div class="custom-control custom-radio">
                                  <input
                                    type="radio"
                                    id="main_image_{{ $img->id }}"
                                    name="main_image"
                                    class="custom-control-input"
                                    value="{{ $img->id }}"
                                    {{ $img->is_main ? 'checked' : '' }}
                                  >
                                  <label class="custom-control-label" for="main_image_{{ $img->id }}">
                                    {{ __('Main') }}
                                  </label>
                                </div>
                              </div>
                              <img
                                src="{{ Storage::url($img->image_path) }}"
                                class="card-img-top"
                                alt="{{ $img->alt_text_en }}"
                                style="height:150px;object-fit:cover;"
                              >
                              <div class="card-body p-3">
                                <input type="hidden" name="existing_image_ids[]" value="{{ $img->id }}">
                                <input type="hidden" name="image_order[]" value="{{ $i + 1 }}">

                                <div class="form-group">
                                  <label>{{ __('Alt Text (EN)') }}</label>
                                  <input
                                    type="text"
                                    name="existing_image_alt_text_en[]"
                                    class="form-control form-control-sm"
                                    value="{{ $img->alt_text_en }}"
                                  >
                                </div>

                                <div class="form-group">
                                  <label>{{ __('Alt Text (AR)') }}</label>
                                  <input
                                    type="text"
                                    name="existing_image_alt_text_ar[]"
                                    class="form-control form-control-sm"
                                    value="{{ $img->alt_text_ar }}"
                                  >
                                </div>

                                <div class="form-group mb-0">
                                  <div class="custom-control custom-checkbox">
                                    <input
                                      type="checkbox"
                                      id="remove_image_{{ $img->id }}"
                                      name="remove_images[]"
                                      class="custom-control-input"
                                      value="{{ $img->id }}"
                                    >
                                    <label class="custom-control-label text-danger" for="remove_image_{{ $img->id }}">
                                      {{ __('Remove') }}
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  @endif

                  {{-- Add new images --}}
                  <h6 class="mb-3">{{ __('Add New Images') }}</h6>
                  <div id="image-inputs-container">
                    <div class="row mb-3 image-input-row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>{{ __('Project Image') }}</label>
                          <input type="file" name="project_images[]" class="form-control-file" accept="image/*">
                          <div class="image-preview mt-2"></div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>{{ __('Alt Text (EN)') }}</label>
                          <input
                            type="text"
                            name="image_alt_text_en[]"
                            class="form-control"
                            placeholder="{{ __('Alt text in English') }}"
                          >
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>{{ __('Alt Text (AR)') }}</label>
                          <input
                            type="text"
                            name="image_alt_text_ar[]"
                            class="form-control"
                            placeholder="{{ __('Alt text in Arabic') }}"
                          >
                        </div>
                      </div>
                      <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-sm btn-danger remove-image">
                          <i class="mdi mdi-trash-can"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-sm btn-success mb-4" id="add-more-images">
                    <i class="mdi mdi-plus-circle mr-1"></i> {{ __('Add More Images') }}
                  </button>
                </div>

                {{-- Videos tab --}}
                <div class="tab-pane fade" id="videos">
                  <h5 class="mb-4">{{ __('Project Videos') }}</h5>

                  {{-- Existing videos --}}
                  @if (isset($project) && $project->videos->count())
                    <h6 class="mb-3">{{ __('Existing Videos') }}</h6>
                    @foreach ($project->videos as $video)
                      <div class="row mb-3 existing-video-row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>{{ __('Video URL') }}</label>
                            <input type="hidden" name="existing_video_ids[]" value="{{ $video->id }}">
                            <input
                              type="url"
                              name="existing_video_urls[]"
                              class="form-control video-url-input"
                              value="{{ $video->video_url }}"
                            >
                            <div class="video-preview mt-2 mb-3">
                                <video controls class="embed-responsive-item" style="max-height:200px;">
                                  <source src="{{ Storage::url($video->video_url) }}" type="video/mp4">
                                </video>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label>{{ __('Title (EN)') }}</label>
                            <input
                              type="text"
                              name="existing_video_titles_en[]"
                              class="form-control"
                              value="{{ $video->title_en }}"
                            >
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>{{ __('Title (AR)') }}</label>
                            <input
                              type="text"
                              name="existing_video_titles_ar[]"
                              class="form-control"
                              value="{{ $video->title_ar }}"
                            >
                          </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                          <div class="custom-control custom-checkbox mb-2">
                            <input
                              type="checkbox"
                              id="remove_video_{{ $video->id }}"
                              name="remove_videos[]"
                              class="custom-control-input"
                              value="{{ $video->id }}"
                            >
                            <label class="custom-control-label text-danger" for="remove_video_{{ $video->id }}">
                              <i class="mdi mdi-trash-can"></i>
                            </label>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif

                  {{-- Add new videos --}}
                  <h6 class="mb-3">{{ __('Add New Videos') }}</h6>
                  <div id="video-inputs-container">
                    <div class="row mb-3 video-input-row">
                         <div class="col-md-6">
                               <div class="form-group">
                                 <label>{{ __('Upload Video File') }}</label>
                                 <input
                                   type="file"
                                   name="video_files[]"
                                   class="form-control video-file-input"
                                   accept="video/*"
                                 >
                                 <div class="video-preview mt-2"></div>
                                 <small class="form-text text-muted">
                                   {{ __('MP4, WebM, etc. (max 50MB)') }}
                                 </small>
                               </div>
                             </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>{{ __('Title (EN)') }}</label>
                          <input
                            type="text"
                            name="video_titles_en[]"
                            class="form-control"
                            placeholder="{{ __('English title') }}"
                          >
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>{{ __('Title (AR)') }}</label>
                          <input
                            type="text"
                            name="video_titles_ar[]"
                            class="form-control"
                            placeholder="{{ __('Arabic title') }}"
                          >
                        </div>
                      </div>
                      <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-sm btn-danger remove-video">
                          <i class="mdi mdi-trash-can"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-sm btn-success mb-4" id="add-more-videos">
                    <i class="mdi mdi-plus-circle mr-1"></i> {{ __('Add More Videos') }}
                  </button>
                </div>

                {{-- Meta Info tab --}}
                <div class="tab-pane fade" id="meta-info">
                  <h5 class="mb-4">{{ __('SEO & Meta Information') }}</h5>

                  <div class="row">
                    {{-- Meta Title EN --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="meta_title_en">{{ __('Meta Title (English)') }}</label>
                        <input
                          type="text"
                          id="meta_title_en"
                          name="meta_title_en"
                          class="form-control"
                          value="{{ old('meta_title_en', $project->meta_title_en ?? '') }}"
                        >
                      </div>
                    </div>
                    {{-- Meta Title AR --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="meta_title_ar">{{ __('Meta Title (Arabic)') }}</label>
                        <input
                          type="text"
                          id="meta_title_ar"
                          name="meta_title_ar"
                          class="form-control"
                          value="{{ old('meta_title_ar', $project->meta_title_ar ?? '') }}"
                        >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    {{-- Meta Desc EN --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="meta_description_en">
                          {{ __('Meta Description (English)') }}
                        </label>
                        <textarea
                          id="meta_description_en"
                          name="meta_description_en"
                          class="form-control"
                          rows="3"
                        >{{ old('meta_description_en', $project->meta_description_en ?? '') }}</textarea>
                      </div>
                    </div>
                    {{-- Meta Desc AR --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="meta_description_ar">
                          {{ __('Meta Description (Arabic)') }}
                        </label>
                        <textarea
                          id="meta_description_ar"
                          name="meta_description_ar"
                          class="form-control"
                          rows="3"
                        >{{ old('meta_description_ar', $project->meta_description_ar ?? '') }}</textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    {{-- Meta Keywords EN --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="meta_keywords_en">
                          {{ __('Meta Keywords (English)') }}
                        </label>
                        <textarea
                          id="meta_keywords_en"
                          name="meta_keywords_en"
                          class="form-control"
                          rows="3"
                          placeholder="{{ __('Separate with commas') }}"
                        >{{ old('meta_keywords_en', $project->meta_keywords_en ?? '') }}</textarea>
                      </div>
                    </div>
                    {{-- Meta Keywords AR --}}
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="meta_keywords_ar">
                          {{ __('Meta Keywords (Arabic)') }}
                        </label>
                        <textarea
                          id="meta_keywords_ar"
                          name="meta_keywords_ar"
                          class="form-control"
                          rows="3"
                          placeholder="{{ __('Separate with commas') }}"
                        >{{ old('meta_keywords_ar', $project->meta_keywords_ar ?? '') }}</textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div> {{-- /.tab-content --}}

              {{-- Submit --}}
              <div class="row mt-4">
                <div class="col-12 text-right">
                  <a href="{{ route('projects.index') }}" class="btn btn-secondary mr-2">
                    {{ __('Cancel') }}
                  </a>
                  <button type="submit" class="btn btn-primary">
                    <i class="mdi mdi-content-save mr-1"></i>
                    {{ isset($project) ? __('Update Project') : __('Save Project') }}
                  </button>
                </div>
              </div>
            </form>
          </div> {{-- /.card-body --}}
        </div> {{-- /.card --}}
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<!-- jQuery UI (for sortable images) -->
<script src="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.13.2/jquery-ui.min.js"></script>
<!-- Bootstrap 4 (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Dropify -->
<script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>
<!-- Summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
  $(function(){
    // ──────────────────────────────────────
    // TAB SWITCHER
    // ──────────────────────────────────────
    $('.nav-tabs a').on('click', function(e){
      e.preventDefault();
      $(this).tab('show');
    });

    // ──────────────────────────────────────
    // INIT PLUGINS
    // ──────────────────────────────────────
    // Dropify
    $('.dropify').dropify({
      messages: {
        default: 'Drag and drop a file here or click',
        replace: 'Drag and drop or click to replace',
        remove:  'Remove',
        error:   'Oops, something went wrong'
      }
    });

    // Select2
    $('.select2').select2({ width: '100%' });
    $('.select2-multiple').select2({ width: '100%', tags: false, tokenSeparators: [','] });

    // Summernote
    $('.summernote').summernote({
      height: 200,
      toolbar: [
        ['style', ['style']],
        ['font',  ['bold','underline','clear']],
        ['color', ['color']],
        ['para',  ['ul','ol','paragraph']],
        ['table', ['table']],
        ['insert',['link','picture']],
        ['view',  ['fullscreen','codeview','help']]
      ]
    });

    // ──────────────────────────────────────
    // SORTABLE EXISTING IMAGES
    // ──────────────────────────────────────
    $('#sortable-images').sortable({
      items: '.sortable-image-item',
      handle: '.card-header',
      update() {
        $('#sortable-images .sortable-image-item').each(function(i){
          $(this).find('input[name="image_order[]"]').val(i+1);
          $(this).find('.card-header span').first().text('#' + (i+1));
        });
      }
    });

    // ──────────────────────────────────────
    // SLUG AUTO-GENERATE
    // ──────────────────────────────────────
    $('#title_en').on('input', function(){
      if (!$('#slug').data('manually-entered')) {
        let slug = $(this).val()
          .toLowerCase()
          .replace(/[^\w\s-]/g,'')
          .trim()
          .replace(/\s+/g,'-');
        $('#slug').val(slug);
      }
    }).trigger('input');

    $('#slug').on('keyup change', function(){
      $('#slug').data('manually-entered', $(this).val().length>0);
    });

    // ──────────────────────────────────────
    // IMAGES REPEATER
    // ──────────────────────────────────────
    $('#add-more-images').on('click', function(e){
      e.preventDefault();
      let $row = $('.image-input-row').first().clone();
      $row.find('input').val('');
      $row.find('.image-preview').empty();
      $('#image-inputs-container').append($row);
    });
    $(document).on('click','.remove-image', function(e){
      e.preventDefault();
      let $all = $('.image-input-row');
      if ($all.length>1) {
        $(this).closest('.image-input-row').remove();
      } else {
        let $row = $(this).closest('.image-input-row');
        $row.find('input').val('');
        $row.find('.image-preview').empty();
      }
    });
    $(document).on('change','input[name="project_images[]"]', function(){
      let file = this.files[0],
          $preview = $(this).siblings('.image-preview');
      if (!file) return $preview.empty();
      let reader = new FileReader();
      reader.onload = e => $preview.html(
        `<img src="${e.target.result}" class="img-thumbnail mt-2" style="height:150px;">`
      );
      reader.readAsDataURL(file);
    });

    // ──────────────────────────────────────
    // VIDEOS REPEATER
    // ──────────────────────────────────────
    $('#add-more-videos').on('click', function(e){
      e.preventDefault();
      let $row = $('.video-input-row').first().clone();
      $row.find('input').val('');
      $row.find('.video-preview').empty();
      $('#video-inputs-container').append($row);
    });
    $(document).on('click','.remove-video', function(e){
      e.preventDefault();
      let $all = $('.video-input-row');
      if ($all.length>1) {
        $(this).closest('.video-input-row').remove();
      } else {
        let $row = $(this).closest('.video-input-row');
        $row.find('input').val('');
        $row.find('.video-preview').empty();
      }
    });

// remove renderEmbed, instead:
$(document).on('change', '.video-file-input', function(){
  const file = this.files[0],
        $preview = $(this).siblings('.video-preview');
  if (!file) return $preview.empty();
  const url = URL.createObjectURL(file);
  $preview.html(`
    <video controls class="embed-responsive-item mt-2" style="max-height:200px;">
      <source src="${url}" type="${file.type}">
    </video>
  `);
});

  });
</script>
@endsection