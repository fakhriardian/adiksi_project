<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
    <head>
        @include('includes.meta')
        @include('includes.style')
    </head>

    <body>
        @include('includes.navbar')
        @yield('content')
        @include('includes.footer')
        @include('includes.script')
    </body>
</html>