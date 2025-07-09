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
                    // Adding a very dark blue for high contrast text
                    'blue-950': '#1a202c', // A very dark blue, almost black, for high contrast
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
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <h2 class="text-3xl md:text-4xl font-extrabold flex items-center justify-center md:justify-start">
                        <i class="bi bi-clipboard-data mr-3 text-4xl md:text-5xl"></i>
                        Daftar Nilai Siswa
                    </h2>
                    <p class="mt-2 text-lg opacity-90">Kelola dan pantau nilai siswa dengan mudah</p>
                </div>
                <div class="flex flex-col md:flex-row gap-4 mt-4 md:mt-0"> {{-- Added margin-top for mobile, removed for desktop --}}
                    <a href="javascript:history.back()" class="inline-flex items-center justify-center px-6 py-3 bg-white text-primary font-semibold rounded-lg shadow-md hover:bg-gray-100 transition-all duration-300 ease-in-out transform hover:scale-105 w-full md:w-auto"> {{-- Added w-full for mobile button width --}}
                        <i class="bi bi-arrow-left mr-2 text-xl"></i>
                        Kembali
                    </a>
                    <a href="{{ route('guru.nilai.upload') }}" class="inline-flex items-center justify-center px-6 py-3 bg-white text-primary font-semibold rounded-lg shadow-md hover:bg-gray-100 transition-all duration-300 ease-in-out transform hover:scale-105 w-full md:w-auto"> {{-- Added w-full for mobile button width --}}
                        <i class="bi bi-cloud-upload mr-2 text-xl"></i>
                        Upload Nilai
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
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

    @if (session('error'))
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

    <!-- Main Content -->
    <div>
        @if ($nilai->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                <div class="mb-6">
                    <i class="bi bi-inbox text-primary text-8xl"></i>
                </div>
                <h4 class="text-blue-950 text-2xl font-semibold mb-2">Belum Ada Nilai</h4> {{-- Changed to blue-950 for clarity --}}
                <p class="text-blue-800 mb-6">Belum ada nilai yang diunggah untuk siswa.</p>
                <a href="{{ route('guru.nilai.upload') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-secondary transition-all duration-300 ease-in-out transform hover:scale-105">
                    <i class="bi bi-plus-circle mr-2 text-xl"></i>
                    Upload Nilai Pertama
                </a>
            </div>
        @else
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-5 flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-full p-3">
                        <i class="bi bi-people-fill text-blue-600 text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h6 class="text-blue-800 text-sm font-medium">Total Siswa</h6>
                        <h4 class="text-2xl font-bold text-blue-950">{{ $nilai->count() }}</h4> {{-- Changed to blue-950 --}}
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-5 flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                        <i class="bi bi-award-fill text-green-600 text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h6 class="text-blue-800 text-sm font-medium">Nilai Tertinggi</h6>
                        <h4 class="text-2xl font-bold text-blue-950">{{ $nilai->max('nilai_angka') ?? 0 }}</h4> {{-- Changed to blue-950 --}}
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-5 flex items-center">
                    <div class="flex-shrink-0 bg-yellow-100 rounded-full p-3">
                        <i class="bi bi-bar-chart-fill text-yellow-600 text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h6 class="text-blue-800 text-sm font-medium">Rata-rata</h6>
                        <h4 class="text-2xl font-bold text-blue-950">{{ number_format($nilai->avg('nilai_angka'), 1) ?? 0 }}</h4> {{-- Changed to blue-950 --}}
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-5 flex items-center">
                    <div class="flex-shrink-0 bg-indigo-100 rounded-full p-3">
                        <i class="bi bi-graph-down text-indigo-600 text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h6 class="text-blue-800 text-sm font-medium">Nilai Terendah</h6>
                        <h4 class="text-2xl font-bold text-blue-950">{{ $nilai->min('nilai_angka') ?? 0 }}</h4> {{-- Changed to blue-950 --}}
                    </div>
                </div>
            </div>

            <!-- Data Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center flex-wrap"> {{-- Added flex-wrap for responsiveness --}}
                    <h5 class="text-xl font-semibold text-blue-950 flex items-center mb-2 md:mb-0"> {{-- Changed to blue-950, added margin-bottom for mobile --}}
                        <i class="bi bi-table mr-2 text-indigo-700 text-2xl"></i>
                        Data Nilai Siswa
                    </h5>
                    <small class="text-blue-800">{{ $nilai->count() }} total data</small> {{-- Changed to blue-800 --}}
                </div>
                <div class="overflow-x-auto"> {{-- Ensures horizontal scrolling on small screens --}}
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-indigo-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-blue-950 uppercase tracking-wider rounded-tl-xl"> {{-- Changed to blue-950 --}}
                                    <i class="bi bi-hash text-blue-700 mr-1"></i> {{-- Changed to blue-700 --}}
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-950 uppercase tracking-wider"> {{-- Changed to blue-950 --}}
                                    <i class="bi bi-person-fill mr-2 text-blue-700"></i> {{-- Changed to blue-700 --}}
                                    Nama Siswa
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-blue-950 uppercase tracking-wider"> {{-- Changed to blue-950 --}}
                                    <i class="bi bi-card-text mr-2 text-blue-700"></i> {{-- Changed to blue-700 --}}
                                    <span class="text-blue-700 font-bold">NIS</span>
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-blue-950 uppercase tracking-wider"> {{-- Changed to blue-950 --}}
                                    <i class="bi bi-trophy-fill mr-2 text-blue-700"></i> {{-- Changed to blue-700 --}}
                                    Nilai
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-950 uppercase tracking-wider"> {{-- Changed to blue-950 --}}
                                    <i class="bi bi-chat-left-text mr-2 text-blue-700"></i> {{-- Changed to blue-700 --}}
                                    Keterangan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-blue-950 uppercase tracking-wider"> {{-- Changed to blue-950 --}}
                                    <i class="bi bi-calendar-event mr-2 text-blue-700"></i> {{-- Changed to blue-700 --}}
                                    Tanggal Upload
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-blue-950 uppercase tracking-wider rounded-tr-xl"> {{-- Changed to blue-950 --}}
                                    <i class="bi bi-gear-fill mr-2 text-blue-700"></i> {{-- Changed to blue-700 --}}
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($nilai as $i => $n)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-900">{{ $i + 1 }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-blue-100 rounded-full p-2 mr-3">
                                            <i class="bi bi-person-fill text-blue-600"></i>
                                        </div>
                                        <div class="text-sm font-medium text-blue-950"> {{-- Changed to blue-950 --}}
                                            {{ $n->user->name ?? '-' }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-blue-800">
                                    {{ $n->user->nis ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($n->nilai_angka)
                                        @if($n->nilai_angka >= 80)
                                            <span class="px-3 py-1 inline-flex text-lg leading-5 font-bold rounded-full bg-green-100 text-green-800">
                                                <i class="bi bi-star-fill mr-1"></i>
                                                {{ $n->nilai_angka }}
                                            </span>
                                        @elseif($n->nilai_angka >= 70)
                                            <span class="px-3 py-1 inline-flex text-lg leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800">
                                                <i class="bi bi-circle-fill mr-1"></i>
                                                {{ $n->nilai_angka }}
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-lg leading-5 font-bold rounded-full bg-red-100 text-red-800">
                                                <i class="bi bi-triangle-fill mr-1"></i>
                                                {{ $n->nilai_angka }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-indigo-600">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-950"> {{-- Changed to blue-950 --}}
                                    {{ $n->keterangan ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-blue-900"> {{-- Changed to blue-900 --}}
                                    <div class="flex flex-col items-center">
                                        <i class="bi bi-clock mr-1 text-base text-blue-700"></i> {{-- Changed to blue-700 --}}
                                        <span>{{ $n->created_at->format('d M Y') }}</span>
                                        <span class="text-xs">{{ $n->created_at->format('H:i') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <form action="{{ route('guru.nilai.destroy', $n->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus nilai ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 ease-in-out"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Nilai">
                                            <i class="bi bi-trash3 mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
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

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection
