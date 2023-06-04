<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
    <head>
        @include('includes.meta')
        @include('includes.style')
    </head>

    <body>
        @yield('content')
        @include('includes.script')
    </body>
</html>