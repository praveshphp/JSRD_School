@extends('layouts.front.app')
@section('content')
    <!-- about section -->
    <section class="about_section ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="{{ asset('front/images/about-img.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                {{ $pages->title }}
                            </h2>
                        </div>
                        {!! $pages->description !!}
                        <div>
                            <a href="">
                                Read More
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </section>

    <!-- end about section -->
@endsection
