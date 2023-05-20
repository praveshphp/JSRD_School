@extends('layouts.admin.app')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Manage REITs Companies </h4>
                        <p class="mb-0"></p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('reitCompanies.create') }}">Add REITs Company</a>
                        </li>
                    </ol>
                </div>
            </div>
            @include('admin.component.messages')
            <div class="row">
                <div class="col-lg-12 light">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List REITs Companies</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th style="width:80px;"><strong>#</strong></th>
                                            <th><strong>Company Name</strong></th>
                                            <th><strong>STATUS</strong></th>
                                            <th><strong>ACTION</strong></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reitCompanies as $competitor)
                                            <tr>
                                                <td><strong>{{ ++$i }}</strong></td>
                                                <td>{{ $competitor->company_name }}</td>
                                                <td>
                                                    @if ($competitor->status)
                                                        <span class="badge light badge-success">Active</span>
                                                    @else
                                                        <span class="badge light badge-danger">In-Active</span>
                                                    @endif
                                                </td>
                                                <td>

                                                    <div class="d-flex sweetalert">
                                                        <form action="{{ route('reitCompanies.destroy', $competitor->id) }}"
                                                            method="POST" id="sub">
                                                            <a href="{{ route('reitCompanies.edit', $competitor->id) }}"
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
                                {!! $reitCompanies->links() !!}
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
