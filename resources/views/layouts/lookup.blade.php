<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title') - Project Tool</title>
    <!-- Styles -->
    @include('layouts.partials.styles')
    <!-- Styles -->
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div class="wrapper" style="height: auto;">
        <section class="content-header">
            <h1>
                @yield('content_header')
            </h1>
        </section>
        <section class="content">
            @yield('content')
        </section>
    </div>
    <!-- Scripts -->
    @include('layouts.partials.scripts')
    <!-- Scripts -->  
</body>
</html>