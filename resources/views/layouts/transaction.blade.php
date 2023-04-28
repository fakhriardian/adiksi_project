<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- googleFont --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alice&family=Poppins&display=swap" rel="stylesheet">
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://kit.fontawesome.com/bc51f3fd1e.css" crossorigin="anonymous">
    {{-- taos tailwind --}}
</head>
<body>
    @yield('content')
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/taos@1.0.2/dist/taos.js"></script>
    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/bc51f3fd1e.js" crossorigin="anonymous"></script>
    <script>
        function printSection() {
            var section = document.getElementById("printSection");
            var sectionContent = section.innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = sectionContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
</body>
</html>