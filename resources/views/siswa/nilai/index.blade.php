@extends('siswa.siswa_master') {{-- Tetap menggunakan siswa_master --}}

@section('siswa') {{-- Tetap menggunakan section siswa --}}
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
                    info: '#3a7bd5', // Retained for info messages, can be adjusted
                    warning: '#ffc107', // Retained for warning messages, can be adjusted
                    success: '#28a745', // Retained for success messages, can be adjusted
                },
                fontFamily: {
                    sans: ['Inter', 'sans-serif'], // Use Inter font
                },
                boxShadow: {
                    'xl-custom': '0 10px 20px rgba(0, 0, 0, 0.1)',
                    '2xl-custom': '0 12px 35px rgba(0, 0, 0, 0.12)',
                },
                borderRadius: {
                    '4xl': '2rem', // Custom large radius
                }
            }
        }
    }
</script>

<div class="container mx-auto px-4 py-8 font-sans min-h-screen bg-gray-100">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-primary to-secondary text-white rounded-xl shadow-lg p-6 md:p-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <h2 class="text-3xl md:text-4xl font-extrabold flex items-center justify-center md:justify-start">
                        <i class="bi bi-graph-up-arrow mr-3 text-4xl md:text-5xl"></i>
                        Nilai Saya
                    </h2>
                    <p class="mt-1 text-sm opacity-80 italic">
                        <i class="bi bi-info-circle mr-1"></i> Nilai dan statistik di halaman ini dihitung berdasarkan data nilai Anda sendiri.
                    </p>
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

    @if (session('error')) {{-- Added error message handling --}}
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
        @if ($nilais->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                <div class="mb-6">
                    <i class="bi bi-inbox text-primary text-8xl"></i>
                </div>
                <h4 class="text-blue-950 text-2xl font-semibold mb-2">Belum Ada Nilai</h4>
                <p class="text-blue-800 mb-6">Belum ada nilai yang diunggah untukmu.</p>
            </div>
        @else
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-5 flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-full p-3">
                        <i class="bi bi-bar-chart-line text-blue-600 text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h6 class="text-blue-800 text-sm font-medium">Jumlah Nilai</h6>
                        <h4 class="text-2xl font-bold text-blue-950">{{ $nilais->count() }}</h4>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-5 flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                        <i class="bi bi-award-fill text-green-600 text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h6 class="text-blue-800 text-sm font-medium">Nilai Tertinggi</h6>
                        <h4 class="text-2xl font-bold text-blue-950">{{ $nilais->max('nilai_angka') ?? 0 }}</h4>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-5 flex items-center">
                    <div class="flex-shrink-0 bg-yellow-100 rounded-full p-3">
                        <i class="bi bi-calculator-fill text-yellow-600 text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h6 class="text-blue-800 text-sm font-medium">Rata-rata Nilai</h6>
                        <h4 class="text-2xl font-bold text-blue-950">{{ number_format($nilais->avg('nilai_angka'), 1) ?? 0 }}</h4>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-5 flex items-center">
                    <div class="flex-shrink-0 bg-indigo-100 rounded-full p-3">
                        <i class="bi bi-graph-down text-indigo-600 text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h6 class="text-blue-800 text-sm font-medium">Nilai Terendah</h6>
                        <h4 class="text-2xl font-bold text-blue-950">{{ $nilais->min('nilai_angka') ?? 0 }}</h4>
                    </div>
                </div>
            </div>

            <!-- Data Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center flex-wrap">
                    <h5 class="text-xl font-semibold text-blue-950 flex items-center mb-2 md:mb-0">
                        <i class="bi bi-table mr-2 text-indigo-700 text-2xl"></i>
                        Daftar Nilai
                    </h5>
                    <small class="text-blue-800">{{ $nilais->count() }} total data</small>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-indigo-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-blue-950 uppercase tracking-wider rounded-tl-xl">
                                    <i class="bi bi-hash text-blue-700 mr-1"></i> No.
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-950 uppercase tracking-wider">
                                    <i class="bi bi-person-fill mr-2 text-blue-700"></i> Guru
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-blue-950 uppercase tracking-wider">
                                    <i class="bi bi-trophy-fill mr-2 text-blue-700"></i> Nilai
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-950 uppercase tracking-wider">
                                    <i class="bi bi-chat-left-text mr-2 text-blue-700"></i> Keterangan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-blue-950 uppercase tracking-wider rounded-tr-xl">
                                    <i class="bi bi-calendar-event mr-2 text-blue-700"></i> Tanggal
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($nilais as $i => $nilai)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-900">{{ $i + 1 }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-blue-100 rounded-full p-2 mr-3">
                                            <i class="bi bi-person-fill text-blue-600"></i>
                                        </div>
                                        <div class="text-sm font-medium text-blue-950">
                                            {{ $nilai->guru->name ?? '-' }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($nilai->nilai_angka)
                                        @if($nilai->nilai_angka >= 80)
                                            <span class="px-3 py-1 inline-flex text-lg leading-5 font-bold rounded-full bg-green-100 text-green-800">
                                                <i class="bi bi-star-fill mr-1"></i>
                                                {{ $nilai->nilai_angka }}
                                            </span>
                                        @elseif($nilai->nilai_angka >= 70)
                                            <span class="px-3 py-1 inline-flex text-lg leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800">
                                                <i class="bi bi-circle-fill mr-1"></i>
                                                {{ $nilai->nilai_angka }}
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-lg leading-5 font-bold rounded-full bg-red-100 text-red-800">
                                                <i class="bi bi-triangle-fill mr-1"></i>
                                                {{ $nilai->nilai_angka }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-indigo-600">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-950">
                                    {{ $nilai->keterangan ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-blue-900">
                                    <div class="flex flex-col items-center">
                                        <i class="bi bi-clock mr-1 text-base text-blue-700"></i>
                                        <span>{{ $nilai->created_at->format('d M Y') }}</span>
                                        <span class="text-xs">{{ $nilai->created_at->format('H:i') }}</span>
                                    </div>
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

    // Initialize tooltips (if any Bootstrap tooltips are used, otherwise this can be removed)
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

<style>
    /* Custom font */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    body {
        font-family: 'Inter', sans-serif;
    }

    /* Animations for flash messages */
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.5s ease-out forwards;
    }
</style>
@endsection
