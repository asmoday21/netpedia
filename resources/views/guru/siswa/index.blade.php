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
            <h2 class="text-3xl font-extrabold text-gray-800 leading-tight mb-2">Manajemen Siswa</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb flex text-sm text-gray-600 space-x-2">
                    <li class="breadcrumb-item">
                        <a href="{{ route('guru.guru_master') }}" class="text-blue-600 hover:text-blue-800 transition duration-200 ease-in-out">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active text-gray-500" aria-current="page">Semua Siswa</li>
                </ol>
            </nav>
        </div>
        {{-- No "Tambah Siswa Baru" button here as it's for guru role --}}
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md relative mb-6" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 2.65a1.2 1.2 0 1 1-1.697-1.697L8.303 10l-2.651-2.651a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-2.651a1.2 1.2 0 1 1 1.697 1.697L11.697 10l2.651 2.651a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif

    <!-- Filter Pencarian -->
    <div class="bg-white shadow-lg rounded-xl p-6 mb-6 border border-gray-200">
        <form action="{{ route('guru.siswa.index') }}" method="GET" class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
            <input type="text" name="search" placeholder="Cari nama atau email" value="{{ request('search') }}"
                   class="flex-grow px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out w-full sm:w-auto">
            
            <select name="kelas" id="kelas"
                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out w-full sm:w-auto">
                <option value="">Semua Kelas</option>
                @foreach($daftarKelas as $kelas)
                    <option value="{{ $kelas->id }}" {{ request('kelas') == $kelas->id ? 'selected' : '' }}>
                        {{ $kelas->nama_kelas }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 ease-in-out w-full sm:w-auto">
                Cari
            </button>

            @if(request('search') || request('kelas'))
                <a href="{{ route('guru.siswa.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 ease-in-out w-full sm:w-auto">
                    Reset
                </a>
            @endif
        </form>
    </div>
    <!-- End Filter -->

    <!-- Tabel Data -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider rounded-tl-xl">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Kelas</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider rounded-tr-xl">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($semuaSiswa as $index => $siswa)
                        <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $semuaSiswa->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $siswa->name }}</div>
                                <div class="text-xs text-gray-600">NIS: {{ $siswa->nis ?? '-' }}</div> {{-- Changed from ID to NIS --}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $siswa->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $siswa->kelas->nama_kelas ?? 'Belum ada Kelas' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $siswa->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-center">Tidak ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Tabel Data -->

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $semuaSiswa->links('pagination::tailwind') }} {{-- Assuming you have a Tailwind pagination view --}}
    </div>
    <!-- End Pagination -->

</div>
@endsection
