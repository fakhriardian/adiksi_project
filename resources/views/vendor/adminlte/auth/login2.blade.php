@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

{{-- @section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop --}}

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

{{-- @section('auth_header', __('adminlte::adminlte.login_message')) --}}

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
                                <form action="{{ $login_url }}" method="post">
                                    @csrf   
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img src="/logo-images/adiksi_logo.png" class="border-0" alt="..." class="img-thumbnail" width="35" height="35">
                                        <a href="/" class="text-muted">
                                            <span class="h1 fw-bold mb-0">Adiksi Coffee Shop</span>
                                        </a>
                                    </div>
                
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                                    {{-- Email field --}}
                                    <div class="input-group mb-3">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>
                            
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

                                    <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    
                                        <label for="remember">
                                            {{ __('adminlte::adminlte.remember_me') }}
                                        </label>
                                    </div>
                
                                    <div class="pt-1 mb-4">
                                        <button type=submit class="btn btn-dark btn-lg rounded btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                            <span class="fas fa-sign-in-alt"></span>
                                            {{ __('adminlte::adminlte.sign_in') }}
                                        </button>
                                    </div>
                                    @if($password_reset_url)
                                        <a class="small text-muted" href="{{ $password_reset_url }}">Forgot password?</a>
                                    @endif

                                    @if($register_url)
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account?
                                            <a href="{{ $register_url }}" style="color: #393f81;">Register here</a>
                                        </p>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

{{-- @section('auth_body')
    <form action="{{ $login_url }}" method="post">
        @csrf

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

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

        <div class="row">
            <div class="col-7">
                <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label for="remember">
                        {{ __('adminlte::adminlte.remember_me') }}
                    </label>
                </div>
            </div>

            <div class="col-5">
                <button type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>

    </form>
@stop

@section('auth_footer')
    @if($password_reset_url)
        <p class="my-0">
            <a href="{{ $password_reset_url }}">
                {{ __('adminlte::adminlte.i_forgot_my_password') }}
            </a>
        </p>
    @endif

    @if($register_url)
        <p class="my-0">
            <a href="{{ $register_url }}">
                {{ __('adminlte::adminlte.register_a_new_membership') }}
            </a>
        </p>
    @endif
@stop --}}
