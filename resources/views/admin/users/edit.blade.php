@extends('admin.admin_master')

@section('admin')
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
            <h2 class="text-3xl font-extrabold text-gray-800 leading-tight mb-2">Edit Pengguna</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb flex text-sm text-gray-600 space-x-2">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.admin_master') }}" class="text-blue-600 hover:text-blue-800 transition duration-200 ease-in-out">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800 transition duration-200 ease-in-out">Manajemen Pengguna</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Pengguna</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Form Section -->
    <div class="bg-white shadow-lg rounded-xl p-6 sm:p-8 border border-gray-200"> {{-- Removed max-w-lg mx-auto to match create page --}}
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Lengkap -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Alamat Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                @error('email') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Peran -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Peran <span class="text-red-500">*</span></label>
                <select id="role" name="role" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                    <option value="">-- Pilih Peran Pengguna --</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="siswa" {{ old('role', $user->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
                @error('role') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Kelas Siswa (Conditional Display) -->
            <div id="kelas-field" class="hidden"> {{-- Changed to 'hidden' for Tailwind --}}
                <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">Kelas Siswa <span class="text-red-500">*</span></label>
                <select id="kelas_id" name="kelas_id"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($daftarKelas as $kelas)
                        <option value="{{ $kelas->id }}" {{ old('kelas_id', $user->kelas_id) == $kelas->id ? 'selected' : '' }}>
                            {{ strtoupper($kelas->nama_kelas) }}
                        </option>
                    @endforeach
                </select>
                @error('kelas_id') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Kata Sandi Baru -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
                <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak diubah"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                @error('password') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Konfirmasi Kata Sandi Baru -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi baru"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-4"> {{-- Changed to match create page --}}
                <a href="{{ route('admin.users.index') }}"
                   class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 ease-in-out">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 ease-in-out">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Tampilkan kolom kelas jika role siswa
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const kelasField = document.getElementById('kelas-field');
        const kelasSelect = document.getElementById('kelas_id');

        function toggleKelas() {
            if (roleSelect.value === 'siswa') {
                kelasField.classList.remove('hidden'); // Show using Tailwind class
                kelasField.classList.add('block'); // Ensure it's block display
                kelasSelect.setAttribute('required', true);
            } else {
                kelasField.classList.add('hidden'); // Hide using Tailwind class
                kelasField.classList.remove('block');
                kelasSelect.removeAttribute('required');
                kelasSelect.value = ''; // Clear selected value when hidden
            }
        }

        roleSelect.addEventListener('change', toggleKelas);
        toggleKelas(); // Call on initial load to set initial state based on $user->role
    });
</script>
@endsection
