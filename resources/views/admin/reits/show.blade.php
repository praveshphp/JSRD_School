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
                        <li class="breadcrumb-item active"><a href="{{ route('reits.index') }}">List
                                REITs</a>
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
                            <h4 class="card-title">REIT Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table header-border  verticle-middle">
                                    <tbody>
                                        <tr>
                                            <th>Company</th>
                                            <td>{{ $reit->reit_companies->company_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Property name</th>
                                            <td>{{ $reit->property }}</td>
                                        </tr>

                                        <tr>
                                            <th>Address</th>
                                            <td>{{ $reit->address }}</td>

                                        </tr>
                                        <tr>
                                            <th>Address 2</th>
                                            <td>{{ $reit->address_2 }}</td>

                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <td>{{ $reit->city }}</td>
                                        </tr>
                                        <tr>
                                            <th>State</th>
                                            <td>{{ $reit->state }}</td>
                                        </tr>
                                        <tr>
                                            <th>Zip</th>
                                            <td>{{ $reit->zip }}</td>
                                        </tr>
                                        <tr>
                                            <th>Size</th>
                                            <td>{{ $reit->size }}</td>
                                        </tr>
                                        <tr>
                                            <th>Market</th>
                                            <td>{{ $reit->market }}</td>
                                        </tr>
                                        <tr>
                                            <th>Number Of Buildings</th>
                                            <td>{{ $reit->number_of_buildings }}</td>
                                        </tr>
                                        <tr>
                                            <th>Acquistion Date</th>
                                            <td>{{ $reit->acquistion_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Office Size</th>
                                            <td>{{ $reit->office_size }}</td>
                                        </tr>
                                        <tr>
                                            <th>Land Size</th>
                                            <td>{{ $reit->land_size }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ownership %</th>
                                            <td>{{ $reit->ownership }}</td>
                                        </tr>
                                        <tr>
                                            <th>Purchase Price</th>
                                            <td>{{ $reit->purchase_price }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
