@extends('layouts.authLayout')

@php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
@php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))

@if (config('adminlte.use_route_url', false))
    @php($login_url = $login_url ? route($login_url) : '')
    @php($register_url = $register_url ? route($register_url) : '')
@else
    @php($login_url = $login_url ? url($login_url) : '')
    @php($register_url = $register_url ? url($register_url) : '')
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('content')
<div class="h-screen md:flex">
    <div class="flex md:w-1/2 h-screen justify-center py-10 items-center backdrop-blur-md bg-brokenwhite-200">
        <div class="absolute inline-flex items-center top-5 left-5">
            <img src="/logo-images/adiksi_logo.png" class="border-0 w-10 h-10" alt="...">
            <a href="/" class="text-black hover:text-gold-800 transition-colors duration-300 font-bold text-4xl translate-y-1 font-alice capitalize">adiksi</a>
        </div>
		<form class="w-2/3" action="{{ $register_url }}" method="post">
            @csrf
			<h1 class="text-gray-800 font-alice text-center text-4xl mb-1 capitalize">create your account</h1>
			<p class="text-sm text-center font-serif font-normal text-gray-400 mb-7">Hi, Let's get started by fill the forms.</p>
            <div class="flex items-center border-2 py-2 px-3 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-4 w-4" fill="gray"
                    stroke="currentColor"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/>
                </svg>
                <input value="{{ old('name') }}" class="pl-2 autofill-shadow-none bg-brokenwhite-200 @error('name') is-invalid @enderror border-transparent focus:border-transparent focus:ring-0 w-full border-none" type="text" name="name" id="name" placeholder="Username" />
            </div>
            @error('mname')
                <p class="text-sm text-red-600 dark:text-red-500">
                    *{{ $message }}
                </p>
            @enderror
            <div class="flex items-center border-2 py-2 px-3 rounded-xl mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                </svg>
                <input value="{{ old('email') }}" class="pl-2 autofill-shadow-none bg-brokenwhite-200 @error('email') is-invalid @enderror border-transparent focus:border-transparent focus:ring-0 w-full border-none" type="text" name="email" id="email" placeholder="Email Address" />
            </div>
            @error('email')
                <p class="text-sm text-red-600 dark:text-red-500">
                    *{{ $message }}
                </p>
            @enderror
            <div class="flex items-center border-2 py-2 px-3 rounded-xl mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                        clip-rule="evenodd" />
                </svg>
                <input value="{{ old('password') }}" class="pl-2 autofill-shadow-none bg-brokenwhite-200 @error('password') is-invalid @enderror border-transparent focus:border-transparent focus:ring-0 w-full border-none" type="password" name="password" id="password" placeholder="Password" />
            </div>
            @error('password')
                <p class="=text-sm text-red-600 dark:text-red-500">
                    *{{ $message }}
                </p>
            @enderror
            <div class="flex items-center border-2 py-2 px-3 rounded-xl mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                        clip-rule="evenodd" />
                </svg>
                <input value="{{ old('password_confirmation') }}" class="pl-2 autofill-shadow-none bg-brokenwhite-200 @error('password_confirmation') is-invalid @enderror border-transparent focus:border-transparent focus:ring-0 w-full border-none" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" />
            </div>
            @error('password_confirmation')
                <p class="=text-sm text-red-600 dark:text-red-500">
                    *{{ $message }}
                </p>
            @enderror
            <button type="submit" class="block w-full bg-gray-600 hover:bg-black transition-colors duration-300 mt-4 py-2 rounded-xl text-white font-semibold mb-2">Sign Up</button>
		</form>
        <div class="absolute inline-flex items-center bottom-5">
            <p class="font-serif text-gray-500 text-md">Sudah memiliki akun?</p>
            <a href="{{ $login_url }}" class="font-serif text-black text-md hover:text-blue-500 ml-2 tracking-tighter">Sign In</a>
        </div>
	</div>
	<div class="relative overflow-hidden md:flex w-1/2 bg-cover bg-center p-10 hidden" style="background-image: url('asset/adiksi-login-pg.jpg')">
        <div>
            <div class="absolute -bottom-32 -left-40 w-80 h-80 border-2 rounded-full border-blue-400 blur-lg animate-ping border-t-8"></div>
            <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 rounded-full border-blue-600 border-t-8 blur-sm animate-spin"></div>
        </div>
        <div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 border-2 rounded-full border-green-800 blur-lg animate-ping border-t-8"></div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 rounded-full border-green-400 border-t-8 blur-sm animate-spin"></div>
        </div>
        <div>
            <div class="absolute -top-40 -right-0 w-80 h-80 border-8 rounded-full border-purple-600 blur-lg animate-ping border-t-8"></div>
            <div class="absolute -top-40 -right-0 w-80 h-80 border-4 rounded-full border-purple-200 border-b-8 blur-sm animate-spin"></div>
        </div>
        <div>
            <div class="absolute -top-20 -right-20 w-80 h-80 border-2 rounded-full border-yellow-200 blur-lg animate-ping border-t-8"></div>
            <div class="absolute -top-20 -right-20 w-80 h-80 border-4 rounded-full border-yellow-200 border-l-8 blur-sm animate-spin"></div>
        </div>
	</div>
</div>
@endsection