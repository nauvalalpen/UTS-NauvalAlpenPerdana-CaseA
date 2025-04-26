<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Aplikasi Donasi Sosial')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 60px;
            /* Padding for fixed navbar */
        }

        .footer {
            padding: 1rem 0;
            background-color: #f8f9fa;
            margin-top: 2rem;
        }

        .pagination {
            justify-content: flex-end !important;
            /* Move pagination to the right */
        }

        .table {
            margin-bottom: 1rem;
        }

        /* Add space below table before pagination */
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('donasi.index') }}">Donasi Sosial</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('donasi.index') ? 'active' : '' }}"
                            href="{{ route('donasi.index') }}">Daftar Donasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('donasi.create') ? 'active' : '' }}"
                            href="{{ route('donasi.create') }}">Tambah Donasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('donasi.deleted') ? 'active' : '' }}"
                            href="{{ route('donasi.deleted') }}">Riwayat Dihapus</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        <!-- Include partial for displaying messages -->
        @include('partials._messages')
        @yield('content') <!-- Page-specific content will be loaded here -->
    </main>

    <footer class="footer text-center">
        <div class="container">
            <span class="text-muted">Aplikasi Manajemen Donasi Sosial © {{ date('Y') }}</span>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    @yield('scripts') <!-- Placeholder for page-specific JS scripts -->
</body>

</html>
