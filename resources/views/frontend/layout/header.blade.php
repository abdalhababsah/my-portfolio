<header class="stick">
    <div class="logo-menu-wrapper position-relative w-100">
        <div class="container">
            <div class="logo-menu-inner d-flex gap-4 align-items-center justify-content-between position-relative w-100">
                <div class="logo">
                    <h1>
                        <a href="{{ route('home') }}" title="Home">
                            <img class="scheme1-light-logo" src="{{ asset('assets/images/logo1-light.png') }}" alt="Logo" loading="lazy">
                            <img class="scheme2-light-logo position-absolute" src="{{ asset('assets/images/logo2-light.png') }}" alt="Logo" loading="lazy">
                            <img class="scheme3-light-logo position-absolute" src="{{ asset('assets/images/logo3-light.png') }}" alt="Logo" loading="lazy">
                            <img class="scheme4-light-logo position-absolute" src="{{ asset('assets/images/logo4-light.png') }}" alt="Logo" loading="lazy">
                            <img class="scheme5-light-logo position-absolute" src="{{ asset('assets/images/logo5-light.png') }}" alt="Logo" loading="lazy">
                            <img class="scheme1-dark-logo position-absolute" src="{{ asset('assets/images/logo1-dark.png') }}" alt="Logo" loading="lazy">
                            <img class="scheme2-dark-logo position-absolute" src="{{ asset('assets/images/logo2-dark.png') }}" alt="Logo" loading="lazy">
                            <img class="scheme3-dark-logo position-absolute" src="{{ asset('assets/images/logo3-dark.png') }}" alt="Logo" loading="lazy">
                            <img class="scheme4-dark-logo position-absolute" src="{{ asset('assets/images/logo4-dark.png') }}" alt="Logo" loading="lazy">
                            <img class="scheme5-dark-logo position-absolute" src="{{ asset('assets/images/logo5-dark.png') }}" alt="Logo" loading="lazy">
                        </a>
                    </h1>
                </div><!-- Logo -->

                <nav>
                    <a class="res-menu-close" href="javascript:void(0);" title=""><i class="fal fa-times"></i></a>
                    <ul>
                        <li><a href="{{ route('home') }}" title="">Home</a></li>

                        <li class="menu-item-has-children">
                            <a href="#" title="">Blog <i class="far fa-angle-down"></i></a>
                            <ul>
                                <li><a href="{{ route('blog') }}" title="">Blog</a></li>
                                <li><a href="{{ route('blog.detail') }}" title="">Blog Detail</a></li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children">
                            <a href="#" title="">Projects <i class="far fa-angle-down"></i></a>
                            <ul>
                                <li><a href="{{ route('projects.index') }}" title="">Portfolio</a></li>
                                {{-- <li><a href="{{ route('projects.show') }}" title="">Portfolio Detail</a></li> --}}
                            </ul>
                        </li>

                        <li class="menu-item-has-children">
                            <a href="#" title="">Pages <i class="far fa-angle-down"></i></a>
                            <ul>
                                <li class="menu-item-has-children">
                                    <a href="#" title="">Services <i class="far fa-angle-right"></i></a>
                                    <ul>
                                        <li><a href="{{ route('services') }}" title="">Services</a></li>
                                        <li><a href="{{ route('service.detail') }}" title="">Service Detail</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('hire.me') }}" title="">Hire Me</a></li>
                            </ul>
                        </li>

                        <li><a href="#contact" title="">Contact</a></li>
                    </ul>

                    <div class="cont-info d-inline-flex align-items-center gap-2">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                                <!-- SVG paths omitted for brevity -->
                            </svg>
                        </span>
                        <div class="cont-info-inner d-flex align-items-start flex-column">
                            <span>Contact Me At:</span>
                            <a href="tel:(635) 525-4250" title="Call Us">(635) 525-4250</a>
                        </div><!-- Contact Info Inner -->
                    </div><!-- Contact Info -->
                </nav><!-- Navigation -->

                <a class="res-menu-btn" href="javascript:void(0);" title=""><i class="fal fa-align-center"></i></a>

                <div class="cont-links d-flex position-relative">
                    <a href="mailto:user@yoursite.com" title=""><i class="far fa-envelope"></i>user@yoursite.com</a>
                    <a href="javascript:void(0);" title="">LETS TALK <i class="far fa-long-arrow-right"></i></a>
                </div><!-- Contact Links -->
            </div><!-- Logo Menu Inner -->
        </div>
    </div><!-- Logo Menu Wrapper -->
</header><!-- Header -->