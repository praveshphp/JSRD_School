@extends('layouts.auth')

@section('content')
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <img src="{{URL::asset('/images/logo-full-black.png')}}"  width="200"/>
                                </div>
                                <h4 class="text-center mb-4">{{ __('Sign in your account')}}</h4>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="mb-1"><strong>{{ __('Email')}}</strong></label>
                                        <input  id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>{{ __('Password')}}</strong></label>
                                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-3"></div>
                                    {{-- <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox ms-1">
                                                <input type="checkbox" class="form-check-input" id="basic_checkbox_1" name="remember"  {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="basic_checkbox_1">{{ __('Remember my preference')}}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">{{ __('Forgot Password?')}}</a>
                                            @endif
                                        </div>
                                    </div> --}}
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">{{ __('Sign Me In')}}</button>
                                    </div>
                                </form>
                                {{-- <div class="new-account mt-3">
                                    <p>Don't have an account? <a class="text-primary" href="javascript:void(0);">{{ __('Sign up')}}</a></p>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection

@push('js')
@endpush

@push('css')
@endpush