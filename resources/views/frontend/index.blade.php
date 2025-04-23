@extends('frontend.layout.base')
@section('content')
    <section>
        <div class="w-100 pt-60 pb-130 position-relative">
            <div class="container">
                <div class="resume-wrapper d-flex justify-content-between position-relative w-100">
                    {{-- ================= Sidebar ================= --}}
                    <aside class="resume-sidebar d-flex flex-column position-sticky">
                        <div class="theiaStickySidebar">
                            <div class="resume-info round50 d-flex flex-column position-relative w-100">
                                <div class="user-img round40 overflow-hidden position-relative w-100">
                                    <img class="img-fluid w-100"
                                        src="{{ asset('frontend/assets/images/resources/user-img.png') }}" alt="User Image"
                                        loading="lazy">
                                </div>
                                <div class="user-info d-flex flex-column align-items-start w-100">
                                    <a href="mailto:{{ $settings['contact_email'] ?? 'email@example.com' }}"
                                        title="">{{ $settings['contact_email'] ?? 'email@example.com' }}</a>
                                    <span>{{ $settings['base_location'] ?? 'Jordan' }}</span>
                                    <p class="mb-0">&copy; {{ date('Y') }} <a href="{{ url('/') }}"
                                            title="">{{ $settings['site_title'] ?? 'Portfolio' }}</a>. All Rights
                                        Reserved</p>
                                </div>
                                <div
                                    class="user-social-wrap d-flex align-items-center justify-content-between position-relative w-100">
                                    <span>Follow Me:</span>
                                    <div class="social-links d-flex align-items-center gap-1">
                                        @foreach ($socialLinks as $social)
                                            <a href="{{ $social->url }}" title="{{ $social->platform }}" target="_blank"><i
                                                    class="{{ $social->icon_class }}"></i></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>

                    {{-- ================= Main ================= --}}
                    <div class="resume-content d-flex flex-column">
                        <div class="theiaStickySidebar">

                            {{-- ************ INTRO ************ --}}
                            <section>
                                <div class="position-relative w-100">
                                    <div class="intro-wrapper d-flex flex-column align-items-start position-relative w-100">
                                        <div class="intro-box d-flex flex-column align-items-start position-relative w-100">
                                            <span class="sec-sub rounded-pill text-center">Introduction</span>
                                            <h2 class="mb-0 fw-normal sz-55">Hey! I am
                                                <span>{{ $settings['site_title'] ?? 'Your Name' }}</span>, Full‑Stack
                                                Developer</h2>
                                            <p class="mb-0">
                                                {{ $settings['hero_tagline'] ?? 'I build scalable web & mobile experiences.' }}
                                            </p>
                                            <div class="intro-btns d-flex align-items-center w-100">
                                                <a class="theme-btn position-relative overflow-hidden round10"
                                                    href="#contact" title=""><i class="far fa-envelope"></i>Hire Me
                                                    Now</a>
                                                @if (isset($settings['cv_url']))
                                                    <a class="simple-link" href="{{ $settings['cv_url'] }}" title=""
                                                        download><i class="fas fa-arrow-alt-to-bottom round5"></i>Download
                                                        CV</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="fun-fact-boxes mt-90 round15 position-relative w-100">
                                            <div class="row mrg">
                                                <div class="col-md-6 col-sm-6 col-lg-3 wow fadeIn" data-wow-duration="1s"
                                                    data-wow-delay=".2s">
                                                    <div
                                                        class="fun-fact-box d-flex flex-column align-items-start position-relative w-100">
                                                        <span>Born In</span>
                                                        <h3 class="mb-0 fw-normal sz-30">Locust, USA</h3>
                                                    </div><!-- Fun Fact Box -->
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-lg-3 wow fadeIn" data-wow-duration="1s"
                                                    data-wow-delay=".4s">
                                                    <div
                                                        class="fun-fact-box d-flex flex-column align-items-start position-relative w-100">
                                                        <span>Experience</span>
                                                        <h3 class="mb-0 fw-normal sz-30">5+ Years</h3>
                                                    </div><!-- Fun Fact Box -->
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-lg-3 wow fadeIn" data-wow-duration="1s"
                                                    data-wow-delay=".6s">
                                                    <div
                                                        class="fun-fact-box d-flex flex-column align-items-start position-relative w-100">
                                                        <span>Worldwide Client</span>
                                                        <h3 class="mb-0 fw-normal sz-30">1.3k</h3>
                                                    </div><!-- Fun Fact Box -->
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-lg-3 wow fadeIn" data-wow-duration="1s"
                                                    data-wow-delay=".8s">
                                                    <div
                                                        class="fun-fact-box d-flex flex-column align-items-start position-relative w-100">
                                                        <span>Job Done Successfully</span>
                                                        <h3 class="mb-0 fw-normal sz-30">4.9k</h3>
                                                    </div><!-- Fun Fact Box -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="position-relative pt-140 w-100">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-lg-5">
                                            <div class="sec-title-wrap mb-50 d-flex flex-column align-items-start position-relative w-100 wow fadeInUp"
                                                data-wow-duration=".5s" data-wow-delay=".2s">
                                                <div class="sec-title d-flex flex-column align-items-start w-100">
                                                    <span class="sec-sub rounded-pill text-center">About Me</span>
                                                    <h2 class="mb-0 sz-40">I Have Rich Experience In Web Site Design
                                                    </h2>
                                                </div><!-- Sec Title -->
                                                <a class="simple-link wow fadeInUp" data-wow-duration=".5s"
                                                    data-wow-delay=".4s" href="javascript:void(0);" title=""><i
                                                        class="fas fa-arrow-alt-to-bottom round5"></i>Download
                                                    CV</a>
                                            </div><!-- Sec Title Wrap -->
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-7">
                                            <div class="about-cap d-flex flex-column position-relative w-100">
                                                <div class="about-img round15 overflow-hidden position-relative w-100 wow fadeIn"
                                                    data-wow-duration="1s" data-wow-delay=".5s">
                                                    <img class="img-fluid w-100" src="assets/images/resources/about-img.jpg"
                                                        alt="About Image" loading="lazy">
                                                    <a class="position-absolute sz-60"
                                                        href="https://www.youtube.com/embed/peiPQzRIxpI?si=anW1E2xiT9J98Xb5"
                                                        data-fancybox title=""><i class="fas fa-play-circle"></i></a>
                                                </div><!-- About Image -->
                                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    elit.
                                                    In nisi, augue urna, mauris elementum ligula semper enim.
                                                    Tristique sed sit facilisis ultrices rhoncus eget ullamcorper
                                                    tellus. Itaque earum rerum hic tenetur a sapiente
                                                    delectus, ut aut reiciendi.</p>
                                                <p class="mb-0">Srepellat volup tatibus maiores aliasta consequatur
                                                    auto
                                                    perferendis repellat quia voluptas sit upto aspernatur te natus
                                                    accusan.</p>
                                            </div><!-- About Cap -->
                                        </div>
                                    </div>
                                </div>
                            </section>

                            {{-- ************ SERVICES ************ --}}
                            <section id="services">
                                <div class="position-relative pt-100 w-100">
                                    <div
                                        class="sec-title-wrap mb-50 d-flex flex-column align-items-center text-center w-100">
                                        <div class="sec-title d-flex flex-column align-items-center w-100">
                                            <span class="sec-sub rounded-pill text-center">Services</span>
                                            <h2 class="mb-0 sz-40">My Specializations</h2>
                                        </div>
                                    </div>
                                    <div class="serv-boxes position-relative w-100">
                                        <div class="row mrg40">
                                            @forelse($services as $index=>$service)
                                                <div class="col-md-6 col-sm-6 col-lg-4">
                                                    <div
                                                        class="serv-box round15 d-flex flex-column position-relative w-100 h-100">
                                                        <a class="serv-read rounded-circle" href=""
                                                            title=""><i class="far fa-long-arrow-right"></i></a>
                                                        <h3 class="mb-0 fw-normal sz-30"><a href=""
                                                                title="">{!! nl2br(e($service->title_en)) !!}</a></h3>
                                                        <p class="mb-0">{{ Str::limit($service->description_en, 60) }}
                                                        </p>
                                                        <span>{{ number_format($service->price, 2) }}
                                                            {{ $service->currency }}</span>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>No services added yet.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </section>

                            {{-- ************ SKILLS ************ --}}
                            <section id="skills">
                                <div class="position-relative pt-120 w-100">
                                    <div
                                        class="sec-title-wrap mb-50 d-flex flex-column align-items-center text-center w-100">
                                        <div class="sec-title d-flex flex-column align-items-center w-100">
                                            <span class="sec-sub rounded-pill text-center">My Skills</span>
                                            <h2 class="mb-0 sz-40">My Advantages</h2>
                                        </div>
                                    </div>
                                    <div class="skill-boxes position-relative w-100">
                                        <div class="row justify-content-center mrg20">
                                            @foreach ($skills as $skill)
                                                <div class="col-md-4 col-sm-6 col-lg-3">
                                                    <div
                                                        class="skill-box round15 overflow-hidden position-relative text-center w-100">
                                                        <div class="skill-img overflow-hidden position-relative w-100 p-3">
                                                            <img class="img-fluid"
                                                                src="{{ asset($skill->icon ?? 'frontend/assets/images/placeholder.png') }}"
                                                                alt="{{ $skill->name_en }}" loading="lazy">
                                                        </div>
                                                        <div
                                                            class="skill-info d-flex flex-column align-items-center w-100 py-2">
                                                            <h3 class="mb-0 fw-normal sz-36">{{ $skill->level ?? 100 }}%
                                                            </h3>
                                                            <h4 class="mb-0 sz-20">{{ $skill->name_en }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </section>

                            {{-- ************ EDUCATION & EXPERIENCE ************ --}}
                            <section id="resume">
                                <div class="position-relative pt-110 w-100">
                                    <div class="edu-exp-wrap position-relative w-100">
                                        <div class="row mrg40">

                                            <div class="col-lg-6">
                                                <div class="sec-title-wrap mb-50">
                                                    <div class="sec-title">
                                                        <span class="sec-sub rounded-pill text-center">Knowledge</span>
                                                        <h2 class="mt-4 sz-40">My Education</h2>
                                                    </div>
                                                </div>
                                                <div class="edu-boxes d-flex flex-column w-100">
                                                    @foreach ($education as $edu)
                                                        <div
                                                            class="edu-box round15 d-flex flex-column position-relative w-100 p-3">
                                                            <h4 class="mb-0 fw-normal sz-24">{{ $edu->degree_en }}</h4>
                                                            <p class="mb-0">{{ $edu->institution_en }}</p>
                                                            <span>{{ $edu->start_date->format('Y') }} -
                                                                {{ $edu->end_date ? $edu->end_date->format('Y') : 'Present' }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="sec-title-wrap mb-50">
                                                    <div class="sec-title">
                                                        <span class="sec-sub rounded-pill text-center">Resume</span>
                                                        <h2 style="margin-top: 26px;" class="mt-4 sz-40">My Experience
                                                        </h2>
                                                    </div>
                                                </div>
                                                <div class="exp-boxes d-flex flex-column w-100">
                                                    @foreach ($experiences as $exp)
                                                        <div
                                                            class="exp-box round15 d-flex flex-column position-relative w-100 p-3">
                                                            <h4 class="mb-0 fw-normal sz-24 position-relative">
                                                                {{ $exp->position_en }}</h4>
                                                            <p class="mb-0">{{ $exp->company_en }}</p>
                                                            <span>{{ $exp->start_date->format('Y') }} -
                                                                {{ $exp->end_date ? $exp->end_date->format('Y') : 'Present' }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            {{-- ************ PORTFOLIO ************ --}}
                            <section id="portfolio">
                                <div class="position-relative pt-110 w-100">
                                    <div class="sec-title-wrap mb-50 text-center">
                                        <div class="sec-title">
                                            <span class="sec-sub rounded-pill text-center">Portfolio</span>
                                            <h2 class="mt-4 sz-40">My Recent Projects</h2>
                                        </div>
                                    </div>
                                    <div class="port-wrap position-relative w-100">
                                        <div class="row g-4">
                                            @foreach ($projects as $project)
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="port-box d-flex flex-column align-items-start w-100">
                                                        <div
                                                            class="port-img round15 overflow-hidden position-relative w-100">
                                                            <a href="">
                                                                <img class="img-fluid w-100" src=""
                                                                    loading="lazy">
                                                            </a>
                                                            <div
                                                                class="port-cat d-flex align-items-center position-absolute">
                                                                @foreach ($project->technologies as $tech)
                                                                    <a href="javascript:void(0);" title=""></a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="port-info d-flex flex-column align-items-start w-100">
                                                            <a class="port-read rounded-circle" href=""><i
                                                                    class="far fa-long-arrow-right"></i></a>
                                                            <h4 class="mb-0 fw-normal sz-26"><a href=""
                                                                    title="">{{ $project->title_en }}</a></h4>
                                                            <span>{{ $project->category?->name_en }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </section>

                            {{-- ************ TESTIMONIALS ************ --}}
                            <section id="testimonials">
                                <div class="position-relative pt-110 w-100">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="sec-title-wrap mb-20">
                                                <div class="sec-title">
                                                    <span class="sec-sub rounded-pill text-center">Testimonial</span>
                                                    <h2 class="mt-4 sz-40">Trusted By Clients</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="testi-wrap position-relative w-100">
                                                <div class="swiper-wrapper">
                                                    @foreach ($testimonials as $t)
                                                        <div
                                                            class="testi-item swiper-slide d-block position-relative w-100">
                                                            <div
                                                                class="testi-box round15 d-flex position-relative w-100 p-4">
                                                                <p class="mb-3">{{ $t->message_en }}</p>
                                                                <div class="testi-info d-flex align-items-center">
                                                                    <img class="img-fluid rounded-circle me-3"
                                                                        src="{{ asset($t->image ?? 'frontend/assets/images/placeholder.png') }}"
                                                                        alt="{{ $t->name }}" loading="lazy">
                                                                    <div
                                                                        class="testi-info-inner d-flex flex-column align-items-start">
                                                                        <h4 class="mb-0 fw-semibold sz-22">
                                                                            {{ $t->name }}</h4>
                                                                        <span>{{ $t->role }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            {{-- ************ BLOGS ************ --}}
                            <section id="blogs">
                                <div class="position-relative pt-110 w-100">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="sec-title-wrap mb-20">
                                                <div class="sec-title">
                                                    <span class="sec-sub rounded-pill text-center">My Blogs</span>
                                                    <h2 class="mt-4 sz-40">Recent Blogs & Articles</h2>
                                                </div>
                                            </div>
                                            <div class="view-all mb-50">
                                                <p class="mb-0">Want to see my recent activities? Click here to <a
                                                        href="" title="">View More Posts</a></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="post-boxes position-relative w-100">
                                                @foreach ($blogs as $blog)
                                                    <div class="post-box list d-flex position-relative w-100 mb-4">
                                                        <div class="post-img round15 overflow-hidden position-relative me-3"
                                                            style="max-width:200px">
                                                            <a href="" title="{{ $blog->title_en }}">
                                                                <img class="img-fluid w-100"
                                                                    src="{{ asset($blog->cover_image ?? 'frontend/assets/images/placeholder.png') }}"
                                                                    alt="{{ $blog->title_en }}" loading="lazy">
                                                            </a>
                                                        </div>
                                                        <div class="post-info d-flex flex-column align-items-start">
                                                            <i
                                                                class="small text-muted">{{ $blog->created_at->format('d M, Y') }}</i>
                                                            <h4 class="mb-0 fw-normal sz-24"><a href=""
                                                                    title="">{{ $blog->title_en }}</a></h4>
                                                            <span>
                                                                @foreach ($blog->tags as $tag)
                                                                    <a href="javascript:void(0);"
                                                                        title="">{{ $tag->name_en }}</a>{{ !$loop->last ? ',' : '' }}
                                                                @endforeach
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            {{-- ************ CONTACT ************ --}}
                            <section id="contact">
                                <div class="position-relative pt-110 w-100">
                                    <div class="contact-wrap round15 position-relative w-100">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="sec-title-wrap mb-40">
                                                    <div class="sec-title">
                                                        <span class="sec-sub rounded-pill text-center">Want to Hire
                                                            Me?</span>
                                                        <h2 class="mt-4 sz-40">Let's Work Together On Project</h2>
                                                    </div>
                                                </div>
                                                <div class="cont-info mb-40 d-inline-flex align-items-center gap-2">
                                                    <span><i class="fas fa-phone"></i></span>
                                                    <div class="cont-info-inner d-flex align-items-start flex-column">
                                                        <span>Contact Me At:</span>
                                                        <a href="tel:{{ $settings['phone'] ?? '' }}"
                                                            title="Call Us">{{ $settings['phone'] ?? '(000) 000-0000' }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                {{-- A simple contact form (no backend included) --}}
                                                <form class="contact-form position-relative w-100" method="post"
                                                    action="">
                                                    @csrf
                                                    <div class="row g-3">
                                                        <div class="col-md-12">
                                                            <input class="form-control" type="text" name="name"
                                                                placeholder="Full Name *" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control" type="email" name="email"
                                                                placeholder="Email *" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control" type="tel" name="phone"
                                                                placeholder="Phone (optional)">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <input class="form-control" type="text" name="subject"
                                                                placeholder="Your Subject *" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" name="message" rows="5" placeholder="Write your message here..." required></textarea>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button
                                                                class="theme-btn2 round10 d-flex align-items-center justify-content-center position-relative overflow-hidden"
                                                                type="submit">Send Message</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
