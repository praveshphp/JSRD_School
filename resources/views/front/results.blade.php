@extends('layouts.front.app')
@section('content')
    <!-- contact section -->

    <section class="contact_section layout_padding">
        <div class="container ">
            <div class="heading_container ">
                <h2 class="">
                    Find
                    <span>
                        Results
                    </span>

                </h2>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <form class="form-inline2" action="{{ route('front.results') }}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-11">
                                <input type="number" name="roll_no" placeholder="Search Roll No"
                                    value="{{ $request->get('roll_no') }}" />
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary mb-4">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- end contact section -->

    <!-- offer section -->
    @if (isset($roll_no) && $roll_no != '')
        <section class="offer_section layout_padding">
            <div class="container">
                <div class="heading_container">
                    @if (!isset($student))
                        <h2>
                            We are sorry ):
                        </h2>
                        <p>
                            No result found with roll number <b>{{ $request->get('roll_no') }}</b>
                        </p>
                    @else
                        <h2>
                            Result
                        </h2>
                        <p>
                            Hello <b>{{ $student[0]->student_name }}</b> s/o <b>{{ $student[0]->father_name }}</b> you
                            obtained
                            <b>{{ $obtained_marks }}</b> marks out of <b>{{ $max_marks }}</b>
                        </p>
                    @endif
                </div>
                @if (isset($student))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content-box">
                                <div class="detail-box">

                                    <p>
                                    <form class="form-inline2" action="{{ route('front.myPDF') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="roll_no" value="{{ $request->get('roll_no') }}">
                                        <button type="submit" class="btn btn-primary mb-4">Download Marksheet</button>
                                </div>
                                </form>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            </div>
        </section>
    @endif

    <!-- end offer section -->
@endsection
