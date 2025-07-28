<!DOCTYPE html>
<html lang="vi" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GearHub Admin Dashboard')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Admin CSS -->
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>
    {{-- Sidebar --}}
    @include('admin.layouts.partials.sidebar')

    {{-- Main Content--}}
    <main class="main-content" id="main-content">
        {{-- Navigation --}}
        @include('admin.layouts.partials.navbar')

        {{-- Content Area  --}}
        @yield('content')

        {{-- Footer --}}
        @include('admin.layouts.partials.footer')
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Admin JS -->
    <script src="{{ asset('js/admin/admin.js') }}"></script>

    @stack('scripts')
</body>

</html>
