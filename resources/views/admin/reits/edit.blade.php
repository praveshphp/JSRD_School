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
                            <h4 class="card-title">Edit REIT</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('reits.update', $reit->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">

                                        <select class="default-select  form-control wide" name="reit_company_id">
                                            <option value="">Choose Company</option>
                                            @foreach ($reitCompany as $region)
                                                <option value="{{ $region->id }}"
                                                    @if ($reit && $reit->reit_company_id == $region->id) selected @endif>
                                                    {{ $region->company_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <input type="text" name="property" class="form-control input-default "
                                            value="{{ $reit->property }}" placeholder="Property name">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="address" class="form-control input-default "
                                            value="{{ $reit->address }}" placeholder="Address">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="address_2" class="form-control input-default "
                                            value="{{ $reit->address_2 }}" placeholder="Address 2">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="city" class="form-control input-default "
                                            value="{{ $reit->city }}" placeholder="City">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="state" class="form-control input-default "
                                            value="{{ $reit->state }}" placeholder="State">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="zip" class="form-control input-default "
                                            value="{{ $reit->zip }}" placeholder="Zip Code">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="size" class="form-control input-default "
                                            value="{{ $reit->size }}" placeholder="Size">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="market" class="form-control input-default "
                                            value="{{ $reit->market }}" placeholder="Market">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="number_of_buildings" class="form-control input-default "
                                            value="{{ $reit->number_of_buildings }}" placeholder="Number Of Buildings">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="acquistion_date" class="form-control input-default "
                                            value="{{ $reit->acquistion_date }}" placeholder="Acquistion Date">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="office_size" class="form-control input-default "
                                            value="{{ $reit->office_size }}" placeholder="Office Size">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="land_size" class="form-control input-default "
                                            value="{{ $reit->land_size }}" placeholder="Land Size">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="ownership" class="form-control input-default "
                                            value="{{ $reit->ownership }}" placeholder="Ownership %">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="purchase_price" class="form-control input-default "
                                            value="{{ $reit->purchase_price }}" placeholder="Purchase Price">
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
