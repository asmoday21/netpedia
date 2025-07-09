<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
            
            @auth
    <ul class="navbar-nav ms-auto">
        @if(Auth::user()->role === 'admin')
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.admin_master') }}">Dashboard Admin</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Kelola Pengguna</a></li>
        @elseif(Auth::user()->role === 'guru')
            <li class="nav-item"><a class="nav-link" href="{{ route('guru.guru_master') }}">Dashboard Guru</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Tugas & Nilai</a></li>
        @elseif(Auth::user()->role === 'siswa')
            <li class="nav-item"><a class="nav-link" href="{{ route('siswa.siswa_master') }}">Dashboard Siswa</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Materi</a></li>
        @endif

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-link nav-link" type="submit">Logout</button>
            </form>
        </li>
    </ul>
@endauth

</div>
    </body>
</html>
