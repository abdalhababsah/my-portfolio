@extends('frontend.layout.base')
@section('content')
    <section>
        <div class="w-100 pt-60 pb-130 position-relative">
            <div class="container">
                <div class="resume-wrapper d-flex justify-content-between position-relative w-100">
                    @include('frontend.common.sticky-user-card')
                    <div class="resume-content d-flex flex-column">
                        <div class="theiaStickySidebar">
                            <section>
                                <div class="position-relative w-100">
                                    <div
                                        class="page-title gap-3 d-flex align-items-center justify-content-between round15 w-100">
                                        <h3 class="mb-0 fw-normal sz-36">{{ $project->title }}</h3>
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item"><a href="{{ route('home') }}" title="">{{ __('Home') }}</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="{{ route('projects.index') }}"
                                                    title="">{{ __('Projects') }}</a></li>
                                            <li class="breadcrumb-item active">{{ Str::limit($project->title, 20) }}</li>
                                        </ol>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="position-relative pt-60 w-100">
                                    <div class="port-detail position-relative w-100">
                                        <div class="port-detail-img round15 overflow-hidden position-relative w-100">
                                            <img class="img-fluid w-100"
                                                src="{{ asset('storage/' . $project->cover_image) }}"
                                                alt="{{ $project->title }}" loading="lazy">
                                            <div class="port-cat d-flex align-items-center position-absolute">
                                                @if ($project->category)
                                                    <a href="" title="">{{ $project->category->name }}</a>
                                                @endif
                                                @foreach ($project->technologies as $tech)
                                                    <a href="" title="">{{ $tech->name }}</a>
                                                @endforeach
                                            </div><!-- Portfolio Categories -->
                                        </div><!-- Portfolio Detail Image -->
                                        <div class="port-detail-cont mt-50 d-flex flex-column position-relative w-100">
                                            <div class="port-detail-cont-box position-relative w-100">
                                                <div class="row">
                                                    <div class="col-md-5 col-sm-12 col-lg-5">
                                                        <div
                                                            class="port-detail-cap d-flex flex-column align-items-start w-100">
                                                            <h3 class="mb-0 fw-normal sz-36">{{ $project->title }}</h3>
                                                            <span>{{ $project->role ?? __('Designing') }}</span>
                                                            <div
                                                                class="single-social-wrap d-flex align-items-center position-relative w-100">
                                                                <span>{{ __('Share:') }}</span>
                                                                <div class="social-links2 d-flex align-items-center gap-1">
                                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                                                        title="Facebook" target="_blank"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                    <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $project->title }}"
                                                                        title="Twitter" target="_blank"><i
                                                                            class="fab fa-twitter"></i></a>
                                                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ $project->title }}"
                                                                        title="Linkedin" target="_blank"><i
                                                                            class="fab fa-linkedin-in"></i></a>
                                                                    <a href="https://www.instagram.com/" title="Instagram"
                                                                        target="_blank"><i class="fab fa-instagram"></i></a>
                                                                </div><!-- Social Links -->
                                                            </div><!-- Single Social Wrap -->
                                                        </div><!-- Portfolio Detail Cap -->
                                                    </div>
                                                    <div class="col-md-7 col-sm-12 col-lg-7">
                                                        <p class="mb-0">{!! $project->full_description !!}</p>
                                                    </div>
                                                </div>
                                            </div><!-- Portfolio Detail Content Box -->
                                            <div class="port-detail-info-boxes round15 position-relative w-100">
                                                <div class="row mrg">
                                                    <div class="col-md-6 col-sm-6 col-lg-3">
                                                        <div
                                                            class="port-detail-info-box d-flex flex-column overflow-hidden position-relative w-100">
                                                            <strong>{{ __('Category:') }}</strong>
                                                            <h4 class="mb-0 fw-normal sz-24">
                                                                {{ $project->category->name ?? __('N/A') }}</h4>
                                                        </div><!-- Portfolio Detail Info Box -->
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-lg-3">
                                                        <div
                                                            class="port-detail-info-box d-flex flex-column overflow-hidden position-relative w-100">
                                                            <strong>{{ __('Role:') }}</strong>
                                                            <h4 class="mb-0 fw-normal sz-24">{{ $project->role ?? __('N/A') }}
                                                            </h4>
                                                        </div><!-- Portfolio Detail Info Box -->
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-lg-3">
                                                        <div
                                                            class="port-detail-info-box d-flex flex-column overflow-hidden position-relative w-100">
                                                            <strong>{{ __('Duration:') }}</strong>
                                                            <h4 class="mb-0 fw-normal sz-24">
                                                                {{ $project->duration ?? __('N/A') }}</h4>
                                                        </div><!-- Portfolio Detail Info Box -->
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-lg-3">
                                                        <div
                                                            class="port-detail-info-box d-flex flex-column overflow-hidden position-relative w-100">
                                                            <strong>{{ __('Tags:') }}</strong>
                                                            <h4 class="mb-0 fw-normal sz-24">
                                                                @forelse($project->tags as $tag)
                                                                    {{ $tag->name }}{{ !$loop->last ? ', ' : '' }}
                                                                @empty
                                                                    {{ __('N/A') }}
                                                                @endforelse
                                                            </h4>
                                                        </div><!-- Portfolio Detail Info Box -->
                                                    </div>
                                                </div>
                                            </div><!-- Portfolio Detail Info Boxes -->

                                            <!-- Project Links Section -->

                                            @if ($project->github_url || $project->demo_url)
                                                <div class="port-detail-links position-relative w-100 mt-4">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="d-flex gap-3">
                                                                @if ($project->github_url)
                                                                    <a href="{{ $project->github_url }}" target="_blank"
                                                                        class="theme-btn3 github-btn">
                                                                        <i class="fab fa-github"></i>{{ __('View Code') }}
                                                                    </a>
                                                                @endif
                                                                @if ($project->demo_url)
                                                                    <a href="{{ $project->demo_url }}" target="_blank"
                                                                        class="theme-btn3 demo-btn">
                                                                        <i class="fas fa-external-link-alt"></i>{{ __('Live Demo') }}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Technologies Detail -->
                                            @if (count($project->technologies) > 0)
                                                <div class="port-detail-cont-box position-relative w-100 mt-5">
                                                    <div class="row">
                                                        <div class="col-md-5 col-sm-12 col-lg-5">
                                                            <h3 class="mb-0 fw-normal sz-36">{{ __('Technologies Used') }}</h3>
                                                        </div>
                                                        <div class="col-md-7 col-sm-12 col-lg-7">
                                                            <div class="tech-tags d-flex flex-wrap gap-2">
                                                                @foreach ($project->technologies as $tech)
                                                                    <span
                                                                        class="badge bg-light text-dark p-2">{{ $tech->name }}</span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Gallery Images -->
                                            @if (count($project->images) > 0)
                                                <div class="single-gal-boxes position-relative w-100 mt-5">
                                                    <div class="row mrg20">
                                                        @foreach ($project->images->where('is_main', false) as $image)
                                                            <div class="col-md-6 col-sm-6 col-lg-6 wow fadeIn"
                                                                data-wow-duration=".5s"
                                                                data-wow-delay=".{{ $loop->iteration * 2 }}s">
                                                                <div
                                                                    class="single-gal-box round15 overflow-hidden position-relative w-100">
                                                                    <a href="{{ asset('storage/' . $image->image_path) }}"
                                                                        data-fancybox="gallery"
                                                                        title="{{ $image->alt_text }}"><img
                                                                            class="img-fluid w-100"
                                                                            src="{{ asset('storage/' . $image->image_path) }}"
                                                                            alt="{{ $image->alt_text }}"
                                                                            loading="lazy"></a>
                                                                </div><!-- Single Gallery Box -->
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div><!-- Single Gallery Boxes -->
                                            @endif

                                            <!-- Videos Section -->
                                            @if (count($project->videos) > 0)
                                                <div class="project-videos position-relative w-100 mt-5">
                                                    <h3 class="mb-4 fw-normal sz-36">{{ __('Project Videos') }}</h3>
                                                    <div class="row mrg20">
                                                        @foreach ($project->videos as $video)
                                                            <div class="col-md-6 col-sm-12 col-lg-6 mb-4">
                                                                <div
                                                                    class="video-container round15 overflow-hidden position-relative w-100">
                                                                    <div class="ratio ratio-16x9">
                                                                        <iframe
                                                                            src="{{ str_replace('watch?v=', 'embed/', $video->video_url) }}"
                                                                            title="{{ $video->caption }}"
                                                                            allowfullscreen></iframe>
                                                                    </div>
                                                                    <p class="mt-2">{{ $video->caption }}</p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Navigation Between Projects -->
                                            <div
                                                class="projects-navigation d-flex justify-content-between mt-5 pt-4 border-top">
                                                <div class="prev-project">
                                                    @if ($previous)
                                                        <a href="{{ route('projects.show', $previous->slug) }}"
                                                            class="d-flex align-items-center">
                                                            <i class="fas {{ app()->getLocale() == 'ar' ? 'fa-arrow-right ms-2' : 'fa-arrow-left me-2' }}"></i>
                                                            <div>
                                                                <small>{{ __('Previous Project') }}</small>
                                                                <h5 class="mb-0">{{ Str::limit($previous->title, 20) }}
                                                                </h5>
                                                            </div>
                                                        </a>
                                                    @endif
                                                </div>

                                                <div class="next-project text-end">
                                                    @if ($next)
                                                        <a href="{{ route('projects.show', $next->slug) }}"
                                                            class="d-flex align-items-center justify-content-end">
                                                            <div>
                                                                <small>{{ __('Next Project') }}</small>
                                                                <h5 class="mb-0">{{ Str::limit($next->title, 20) }}</h5>
                                                            </div>
                                                            <i class="fas {{ app()->getLocale() == 'ar' ? 'fa-arrow-left ms-2' : 'fa-arrow-right me-2' }}"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>

                                        </div><!-- Portfolio Detail Content -->
                                    </div><!-- Portfolio Detail -->
                                </div>
                            </section>

                            @include('frontend.common.contact-form')

                        </div>
                    </div><!-- Resume Content -->
                </div><!-- Resume Wrapper -->
            </div>
        </div>
    </section>
@endsection