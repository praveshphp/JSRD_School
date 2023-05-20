@extends('layouts.admin.app')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Manage Marks </h4>
                        <p class="mb-0"></p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('marks.index') }}">List
                                Marks</a>
                        </li>
                    </ol>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                        fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    <strong>Error!</strong> There were some problems with your input.
                    <ol>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ol>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12 light">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Marks</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('marks.update', $mark->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        {{ $student->student_name }}
                                    </div>


                                    <div class="mb-3">
                                        <input type="text" name="subjects" class="form-control input-default "
                                            value="{{ $mark->subjects }}" placeholder="Subject">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="half_yearly_max_marks" class="form-control input-default "
                                            value="{{ $mark->half_yearly_max_marks }}" placeholder="half yearly max marks">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="half_yearly_obtained" class="form-control input-default "
                                            value="{{ $mark->half_yearly_obtained }}" placeholder="half yearly obtained marks">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="yearly_total_marks" class="form-control input-default "
                                            value="{{ $mark->yearly_total_marks }}" placeholder="yearly total marks">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="yearly_obtained_marks" class="form-control input-default "
                                            value="{{ $mark->yearly_obtained_marks }}" placeholder="yearly obtained marks">
                                    </div>
                                    <div class="mb-3">
                                        <input type="date" name="date"  class="form-control input-default "
                                            value="{{ \Carbon\Carbon::parse($mark->date)->format('Y-m-d')}}" placeholder="date">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
