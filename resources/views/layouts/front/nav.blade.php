<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand d-flex ml-auto flex-column flex-lg-row align-items-center" href="{{ route('front.home') }}">
                    <img width="100"
                        src="{{ asset('front/images/buddha-clipart-wedding-buddha-wedding-transparent-40.png') }}"
                        alt="" />
                    <span style="font-size: 19px">
                        J.S.R.D. International Public School
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
                        <ul class="navbar-nav  ">
                            <li class="nav-item @if (Route::currentRouteName() == 'front.home') active @endif">
                                <a class="nav-link" href="{{ route('front.home') }}">
                                    Home

                                </a>
                            </li>
                            <li class="nav-item @if (Route::currentRouteName() == 'front.pages') active @endif">
                                <a class="nav-link" href="{{ route('front.pages', 'about') }}"> About
                                </a>
                            </li>
                            <li class="nav-item @if (Route::currentRouteName() == 'front.results') active @endif">
                                <a class="nav-link" href="{{ route('front.results') }}"> Results
                                </a>
                            </li>
                           <?php /* <li class="nav-item">
                                <a class="nav-link" href="program.html"> Programs </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.html"> Contact us</a>
                            </li>
                            */ ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- end header section -->
    @if (Route::currentRouteName() == 'front.home')
        @include('layouts.front.slider')
    @else
    @endif


</div>
