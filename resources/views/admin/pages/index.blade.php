@extends('layouts.admin.app')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Manage Pages </h4>
                        <p class="mb-0"></p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('pages.create') }}">Add
                                Page</a>
                        </li>
                    </ol>
                </div>
            </div>
            <div id="jserror"></div>
            @include('admin.component.messages')
            <div class="row">
                <div class="col-lg-12 light">
                    <div class="card">
                        <div class="card-header row">
                            <div class="col-sm-6 p-md-0">
                                <h4 class="card-title">List Pages</h4>
                            </div>
                            <div class="col-sm-6 p-md-0">
                                <form action="{{ route('pages.index') }}" method="GET" id="search-form">
                                    @if (request()->has('s'))
                                        <div class="text-end"><a href="{{ route('pages.index') }}">Reset
                                                Search</a></div>
                                    @endif
                                    <div class="header-left float-end">
                                        <div class="input-group search-area right d-lg-inline-flex d-none ">
                                            <input type="text" class="form-control" name="s" id="s"
                                                placeholder="Find something here..."
                                                value="{{ app('request')->input('s') }}">
                                            <div class="input-group-append">                                      
                                                <button class="input-group-text" id=""><i
                                                        class="flaticon-381-search-2"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th style="width:80px;"><strong>#</strong></th>
                                            <th><strong>Title</strong></th>
                                            <th><strong>Description</strong></th>
                                            <th><strong>CREATED TIME</strong></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pages as $page)
                                            <tr>
                                                <td><strong>{{ ++$i }}</strong></td>    
                                                <td>{{ $page->title }}</td>
                                                <td>{{ $page->description }}</td>
                                                <td>{{ \Carbon\Carbon::parse($page->updated_at)->format('M d, Y H:i A')}}</td>
                                               
                                                <td>

                                                    <div class="d-flex sweetalert">
                                                        <form
                                                            action="{{ route('pages.destroy', $page->id) }}"
                                                            method="POST" id="sub">
                                                            <a href="{{ route('pages.edit', $page->id) }}"
                                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                    class="fas fa-pencil-alt"></i></a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#"
                                                                class="btn btn-danger shadow btn-xs sharp  sweet-success-cancel"><i
                                                                    class="fa fa-trash"></i></a>
                                                            <button type="submit" style="display:none"></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $pages->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    @endsection
    @push('js')
        <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
        <script>
            jQuery('.sweet-success-cancel').on('click', function() {
                var that = jQuery(this);
                swal({
                    title: "Are you sure to delete ?",
                    text: "You will not be able to recover this imaginary file !!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it !!",
                    cancelButtonText: "No, cancel it !!",
                    closeOnConfirm: !1,
                    closeOnCancel: !1
                }).then((result) => {
                    console.info(result.value);
                    if (result.value === true) {
                        swal("Deleted !!", "Hey, your imaginary file has been deleted !!", "success");
                        that.parents('form').submit();
                    } else {
                        swal(
                            "Cancelled !!", "Hey, your imaginary file is safe !!", "error");
                        return false;
                    }
                });
            })
        </script>
    @endpush
    @push('css')
        <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    @endpush
