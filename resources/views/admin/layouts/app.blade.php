<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Meta tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Admin Dashboard - GearHub')</title>

    {{-- CSS plugins --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

    {{-- CSS plugins --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/js/select.dataTables.min.css') }}">

    {{-- CSS chính --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" />

    {{-- CSS tùy chỉnh --}}
    @stack('styles')
</head>

<body class="with-welcome-text">
    <div class="container-scroller">
        {{-- Thanh điều hướng --}}
        @include('admin.layouts.partials.navbar')

        <div class="container-fluid page-body-wrapper">
            {{-- Sidebar --}}
            @include('admin.layouts.partials.sidebar')

            {{-- Nội dung chính --}}
            <div class="main-panel">
                <div class="content-wrapper">
                    
                    @yield('content')
                </div>
                {{-- Footer --}}
                @include('admin.layouts.partials.footer')
            </div>
        </div>
    </div>

    {{-- JavaScript plugins  --}}
    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    {{-- JavaScript plugins --}}
    <script src="{{ asset('admin/assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>

    {{-- JavaScript  --}}
    <script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/assets/js/template.js') }}"></script>
    <script src="{{ asset('admin/assets/js/settings.js') }}"></script>
    <script src="{{ asset('admin/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/assets/js/todolist.js') }}"></script>

    {{-- JavaScript tùy chỉnh --}}
    <script src="{{ asset('admin/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>

    {{-- JavaScript tùy chỉnh --}}
    @stack('scripts')
</body>

</html>
