@extends('guru.guru_master')

@section('guru')
{{-- Include Bootstrap Icons CSS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
{{-- Include Tailwind CSS CDN --}}
<script src="https://cdn.tailwindcss.com"></script>
{{-- Custom Tailwind Configuration for primary color and font --}}
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#667eea', // A nice blue-purple gradient start
                    secondary: '#764ba2', // A nice blue-purple gradient end
                },
                fontFamily: {
                    sans: ['Inter', 'sans-serif'], // Use Inter font
                },
            }
        }
    }
</script>

<div class="container mx-auto px-4 py-8 font-sans">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-primary to-secondary text-white rounded-xl shadow-lg p-6 md:p-8">
            <div class="flex items-center">
                <i class="bi bi-cloud-arrow-up mr-4 text-4xl md:text-5xl"></i>
                <div>
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-1">
                        Upload Nilai Siswa
                    </h2>
                    <p class="text-lg opacity-90">Unggah data nilai dari file Excel</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md mb-6 flex items-center animate-fade-in" role="alert">
            <i class="bi bi-check-circle-fill mr-3 text-2xl"></i>
            <div>
                <strong class="font-bold">Berhasil!</strong> {{ session('success') }}
            </div>
            <button type="button" class="ml-auto text-green-700 hover:text-green-900 focus:outline-none" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md mb-6 flex items-center animate-fade-in" role="alert">
            <i class="bi bi-exclamation-triangle-fill mr-3 text-2xl"></i>
            <div>
                <strong class="font-bold">Error!</strong> {{ session('error') }}
            </div>
            <button type="button" class="ml-auto text-red-700 hover:text-red-900 focus:outline-none" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md mb-6 animate-fade-in">
            <div class="flex items-center mb-2">
                <i class="bi bi-exclamation-octagon-fill mr-3 text-2xl"></i>
                <strong class="font-bold">Terjadi Kesalahan Validasi:</strong>
            </div>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Upload Form -->
    <form action="{{ route('guru.nilai.import') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-lg p-6 md:p-8">
        @csrf

        <div class="mb-6">
            <label for="file" class="block text-gray-700 text-lg font-semibold mb-2 flex items-center">
                <i class="bi bi-file-earmark-arrow-up mr-2 text-xl text-primary"></i> Pilih File Excel (.xlsx, .xls, .csv)
            </label>
            <input type="file" class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-secondary transition-colors duration-300 ease-in-out" name="file" accept=".xlsx,.xls,.csv" required>
        </div>

        <div class="mb-6">
            <label for="link" class="block text-gray-700 text-lg font-semibold mb-2 flex items-center">
                <i class="bi bi-link-45deg mr-2 text-xl text-primary"></i> Link Google Form (Opsional)
            </label>
            <input type="url" class="shadow-sm appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 ease-in-out" name="link" placeholder="https://forms.gle/..." value="{{ old('link') }}">
        </div>

        <div class="mb-8">
            <label for="keterangan" class="block text-gray-700 text-lg font-semibold mb-2 flex items-center">
                <i class="bi bi-pencil-square mr-2 text-xl text-primary"></i> Keterangan Nilai (Opsional)
            </label>
            <input type="text" class="shadow-sm appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 ease-in-out" name="keterangan" placeholder="Contoh: Nilai Ujian TCP/IP" value="{{ old('keterangan') }}">
        </div>

        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-primary text-white font-bold rounded-lg shadow-md hover:bg-secondary transition-all duration-300 ease-in-out transform hover:scale-105 text-xl">
            <i class="bi bi-upload mr-3 text-2xl"></i> Upload Nilai
        </button>
    </form>
</div>

{{-- Bootstrap JS for tooltips and alerts (ensure it's loaded after your main app.js if any) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto-dismiss alerts
    setTimeout(() => {
        document.querySelectorAll('.animate-fade-in').forEach(alert => {
            alert.classList.add('opacity-0', 'transition-opacity', 'duration-500', 'ease-out');
            setTimeout(() => alert.remove(), 500); // Remove after fade out
        });
    }, 5000);
</script>
@endsection
