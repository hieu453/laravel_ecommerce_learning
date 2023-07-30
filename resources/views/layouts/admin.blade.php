<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/css/style.css') }} ">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ URL::asset('admin_assets/images/favicon.png') }}" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="container-scroller">
        @include('layouts.include.admin.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.include.admin.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    {{-- Script --}}
    <script src="{{ URL::asset('admin_assets/vendors/base/vendor.bundle.base.js') }}"></script>

    <script src="{{ URL::asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>

    <script src="{{ URL::asset('admin_assets/js/off-canvas.js') }}"></script>
    <script src="{{ URL::asset('admin_assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ URL::asset('admin_assets/js/template.js') }}"></script>

    <script src="{{ URL::asset('admin_assets/js/dashboard.js') }}"></script>
    <script src="{{ URL::asset('admin_assets/js/data-table.js') }}"></script>
    <script src="{{ URL::asset('admin_assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('admin_assets/js/dataTables.bootstrap4.js') }}"></script>
    @yield('script')
    @livewireScripts
    @stack('script')
</body>
</html>