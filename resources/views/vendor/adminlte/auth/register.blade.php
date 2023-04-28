@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
    <section class="w-100 h-100" style="background-color: #67687e;">
        <div class="h-100 row d-flex justify-content-center align-items-center">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="store-image/adiksi3.png"
                            alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form action="{{ $register_url }}" method="post">
                                    @csrf   
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img src="/logo-images/adiksi_logo.png" class="border-0" alt="..." class="img-thumbnail" width="35" height="35">
                                        <a href="/" class="text-muted">
                                            <span class="h1 fw-bold mb-0">Adiksi Coffee Shop</span>
                                        </a>
                                    </div>
                
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register your account</h5>
                                    {{-- Name field --}}
                                    <div class="input-group mb-3">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                            </div>
                                        </div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Email field --}}
                                    <div class="input-group mb-3">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                            </div>
                                        </div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Password field --}}
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                            placeholder="{{ __('adminlte::adminlte.password') }}">

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                            </div>
                                        </div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Confirm password field --}}
                                    <div class="input-group mb-3">
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            placeholder="{{ __('adminlte::adminlte.retype_password') }}">

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                            </div>
                                        </div>

                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                
                                    <div class="pt-1 mb-4">
                                        <button type=submit class="btn btn-dark btn-lg rounded btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                            <span class="fas fa-sign-in-alt"></span>
                                            {{ __('adminlte::adminlte.register') }}
                                        </button>
                                    </div>
                                </form>
                                <p class="my-0">
                                    <a href="{{ $login_url }}" style="color: #393f81;">Already have account</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
