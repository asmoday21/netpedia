@extends('admin.admin_master')

@section('admin')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas Baru</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Light gray background */
        }
    </style>
</head>
<body>

    <!-- Content that would typically be within the 'admin' section of admin_master -->
    <div class="min-h-screen bg-gray-100 py-6 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg p-6 sm:p-8 max-w-lg w-full">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Tambah Kelas Baru</h2>

            <form action="{{ route('admin.kelas.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Input Nama Kelas -->
                <div>
                    <label for="nama_kelas" class="block text-sm font-medium text-gray-700 mb-2">Nama Kelas</label>
                    <input
                        type="text"
                        name="nama_kelas"
                        id="nama_kelas"
                        placeholder="Contoh: X TJKT 3"
                        value="{{ old('nama_kelas') }}"
                        required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base transition duration-200 ease-in-out focus:outline-none"
                    >
                    @error('nama_kelas')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 mt-6">
                    <a href="{{ route('admin.kelas.index') }}"
                       class="w-full sm:w-auto px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg shadow-md text-center transition duration-300 ease-in-out transform hover:scale-105">
                        Batal
                    </a>
                    <button type="submit"
                            class="w-full sm:w-auto px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- End of content that would typically be within the 'admin' section -->

</body>
</html>
@endsection
