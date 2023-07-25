<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
    <head>
        @include('includes.meta')
        @include('includes.style')
        <link rel="icon" type="image/x-icon" href="/logo-images/adiksi_logo.png">
    </head>

    <body>
        @include('includes.navbar')
        @yield('content')
        @include('includes.footer')
        @include('includes.script')
    </body>
</html>