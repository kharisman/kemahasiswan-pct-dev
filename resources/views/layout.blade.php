<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    {{-- <link href="/dist/main.css" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="./output.css" rel="stylesheet">
</head>

<body>
    <div>
        @include('includes/navbar')
    </div>
    <div class="container-fluid">
       @yield('content')
    </div>
    {{-- @include('part/carousel') --}}
    {{-- @extends('layout')
    @section('content')
    @include('part/slider')
    @include('part/smart_campus')
    @include('part/project_popular')
    @include('part/palcomtech')
    @include('part/testimoni')
    @include('part/jurusan')
    @include('part/news')
    @endsection --}}
    {{-- @include('part/subscribe') --}}
    {{-- @include('includes/footer') --}}
</body>

</html>
