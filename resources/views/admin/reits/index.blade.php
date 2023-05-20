@extends('layouts.admin.app')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Manage REITs </h4>
                        <p class="mb-0"></p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('reits.create') }}">Add
                                REIT</a>
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
                                <h4 class="card-title">List REITs</h4>
                            </div>
                            <div class="col-sm-6 p-md-0">
                                <form action="{{ route('reits.index') }}" method="GET" id="search-form">
                                    @if (request()->has('s'))
                                        <div class="text-end"><a href="{{ route('reits.index') }}">Reset
                                                Search</a></div>
                                    @endif
                                    <div class="header-left float-end">
                                        <div class="input-group search-area right d-lg-inline-flex d-none ">
                                            <input type="text" class="form-control" name="s" id="s"
                                                placeholder="Find something here..."
                                                value="{{ app('request')->input('s') }}">
                                            <div class="input-group-append">
                                                {{-- <span class="input-group-text">
                                                    <a href="javascript:void(0)">
                                                        <i class="flaticon-381-search-2"></i>
                                                    </a>                                                   
                                                </span> --}}
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
                                            <th><strong>PROPERTY</strong></th>
                                            <th><strong>ADDRESS</strong></th>
                                            <th><strong>COMPANY</strong></th>
                                            <th><strong>STATE</strong></th>
                                            <th><strong>CITY</strong></th>
                                            <th><strong>CREATED TIME</strong></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reits as $reit)
                                            <tr>
                                                <td><strong>{{ ++$i }}</strong></td>    
                                                <td>{{ $reit->property }}</td>
                                                <td>{{ $reit->address }}</td>
                                                <td>{{ $reit->reit_companies->company_name }}</td>
                                                <td>{{ $reit->state }}</td>
                                                <td>{{ $reit->city }}</td>
                                                <td>{{ \Carbon\Carbon::parse($reit->updated_at)->format('M d, Y H:i A')}}</td>
                                               
                                                <td>

                                                    <div class="d-flex sweetalert">
                                                        <form
                                                            action="{{ route('reits.destroy', $reit->id) }}"
                                                            method="POST" id="sub">
                                                            <a href="{{ route('reits.edit', $reit->id) }}"
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
                                {!! $reits->links() !!}
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
