@extends('guru.guru_master')

@section('guru')
<div class="container-fluid p-4 sm:p-6 lg:p-8 bg-gray-100 min-h-screen font-sans">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for Inter font */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-800 leading-tight mb-2">Tambah Quiz Baru</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb flex text-sm text-gray-600 space-x-2">
                    <li class="breadcrumb-item">
                        <a href="{{ route('guru.guru_master') }}" class="text-blue-600 hover:text-blue-800 transition duration-200 ease-in-out">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('guru.quiz.index') }}" class="text-blue-600 hover:text-blue-800 transition duration-200 ease-in-out">Daftar Quiz</a>
                    </li>
                    <li class="breadcrumb-item active text-gray-500" aria-current="page">Tambah Quiz</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Form Section -->
    <div class="bg-white shadow-lg rounded-xl p-6 sm:p-8 border border-gray-200"> {{-- Removed max-w-lg mx-auto to make it full width --}}
        <form action="{{ route('guru.quiz.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Judul Quiz -->
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Quiz <span class="text-red-500">*</span></label>
                <input type="text" id="judul" name="judul" placeholder="Contoh: Quiz Pemrograman" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                @error('judul') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Platform -->
            <div>
                <label for="platform" class="block text-sm font-medium text-gray-700 mb-1">Platform <span class="text-red-500">*</span></label>
                <select id="platform" name="platform" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                    <option disabled selected>-- Pilih Platform --</option>
                    <option value="Kahoot">Kahoot</option>
                    <option value="Quizizz">Quizizz</option>
                    <option value="Wordwall">Wordwall</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
                @error('platform') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Link Quiz -->
            <div>
                <label for="link" class="block text-sm font-medium text-gray-700 mb-1">Link Quiz <span class="text-red-500">*</span></label>
                <input type="url" id="link" name="link" placeholder="https://quiz.example.com" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                @error('link') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-4"> {{-- Adjusted to match previous full-width forms --}}
                <a href="{{ route('guru.quiz.index') }}"
                   class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 ease-in-out">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 ease-in-out">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
