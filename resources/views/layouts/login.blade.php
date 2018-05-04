<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Project Tools</title>
    <!-- Styles -->
    @include('layouts.partials.styles')
    <!-- Styles -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="skin-blue sidebar-mini" onload="currentDateTime()">
    <div class="wrapper" style="height: auto;">
        @include('common.headermenu')
        @include('common.menu')
        <div class="content-wrapper overlay-wrapper" style="min-height: 1126px;">
            <section class="content-header">
                <h1>
                    @yield('content_header')
                </h1>
            </section>
            <section class="content">
                @yield('content')
            </section>
            <div class="modal" id="gb-modal">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content overlay-wrapper"></div>
                </div>
            </div>
        <!-- Scripts -->
        </div>
        <footer class="main-footer">
            <strong><span style="font-size:1.4em; display:inline-block; transform:rotate(180deg);">&copy;</span> {!! date('Y') !!} <a href="https://project-tools.co.uk" target="_blank">Project Tools</a></strong>
        </footer>
    </div>
    <!-- Scripts -->
    @include('layouts.partials.scripts')
    <!-- Scripts --> 
    <div id="notifications"></div>
</body>
</html>