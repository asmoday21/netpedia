@extends('guru.guru_master')

@section('guru')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 font-inter">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <!-- Viewport Meta Tag for Responsiveness -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Changed max-w-2xl to max-w-5xl for a wider layout -->
    <div class="w-full max-w-5xl bg-white rounded-xl shadow-xl p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Edit Profil Guru</h1>

        <form method="POST" action="{{ route('guru.store.profile') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Profile Image Section -->
            <div class="flex flex-col items-center mb-6">
                <img id="showImage" src="{{ isset($editData->profile_image) ? url('upload/guru_images/'.$editData->profile_image) : url('upload/default_profile.jpg') }}"
                    alt="Foto Profil"
                    class="w-32 h-32 rounded-full object-cover border-4 border-blue-300 shadow-md mb-4">

                <div class="w-full max-w-sm">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Ubah Foto Profil</label>
                    <input type="file" name="profile_image" id="image" accept="image/*"
                        class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100 cursor-pointer">
                    <p class="mt-2 text-xs text-gray-500">Format PNG/JPG, maksimal 2MB.</p>
                </div>
            </div>

            <!-- Nama Lengkap -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ $editData->name }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-800 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
            </div>

            <!-- Alamat Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ $editData->email }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-800 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
            </div>

            <!-- Password Baru (Opsional) -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru (Opsional)</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-800 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                <p class="mt-2 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah password.</p>
            </div>

            <!-- Button Group -->
            <div class="flex flex-col sm:flex-row justify-end gap-4 pt-4">
                <button type="reset"
                    class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 shadow-md transition duration-300 ease-in-out transform hover:-translate-y-0.5 hover:scale-105">
                    Reset
                </button>
                <button type="submit"
                    class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 shadow-md transition duration-300 ease-in-out transform hover:-translate-y-0.5 hover:scale-105">
                    Simpan
                </button>
            </div>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('guru.profile') }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out text-sm font-medium">
                <!-- Arrow left icon from Lucide React, adapted as SVG for HTML -->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                    <path d="m15 18-6-6 6-6"></path>
                </svg>
                Kembali ke profil
            </a>
        </div>
    </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function (e) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('showImage').src = e.target.result;
        };
        if (e.target.files[0]) {
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection
