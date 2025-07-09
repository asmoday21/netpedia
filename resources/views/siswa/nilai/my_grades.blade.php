@extends('siswa.siswa_master')

@section('siswa')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
{{-- Tailwind CSS CDN --}}
<script src="https://cdn.tailwindcss.com"></script>

<div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8 flex-wrap gap-3">
        <div>
            <h2 class="font-bold text-gray-900 text-3xl mb-1">
                <i class="fas fa-graduation-cap mr-3 text-blue-600"></i> Rapor Nilai Saya
            </h2>
            <p class="text-gray-600 mb-0">Lihat dan pantau semua nilai akademik Anda</p>
        </div>
        {{-- Tombol Nilai Umum --}}
        <a href="{{ route('siswa.nilai.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
            <i class="fas fa-bullhorn mr-2"></i> Pengumuman Umum
        </a>
    </div>

    {{-- Alert Sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative shadow-md mb-6" role="alert">
            <div class="flex items-center">
                <div class="bg-green-200 rounded-full p-2 mr-3 flex-shrink-0">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div>{{ session('success') }}</div>
                <button type="button" class="absolute top-0 right-0 px-4 py-3 text-green-700 hover:text-green-900 focus:outline-none close-alert-btn" aria-label="Close">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    {{-- Stats Card --}}
    <div class="mb-6">
        <div class="w-full">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden transition duration-300 ease-in-out hover:shadow-xl hover:scale-105">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-center justify-center md:justify-start">
                        <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-lg mr-0 md:mr-4 mb-4 md:mb-0">
                            <i class="fas fa-calculator text-white text-2xl"></i>
                        </div>
                        <div class="text-center md:text-left">
                            <h6 class="text-gray-500 text-sm mb-1">Total Nilai Pribadi</h6>
                            <h3 class="font-extrabold text-3xl text-gray-800 mb-0">{{ $nilais->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Empty State --}}
    @if($nilais->isEmpty())
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 shadow-lg rounded-lg text-center border border-gray-200">
            <div class="p-10">
                <div class="mb-6">
                    <i class="fas fa-chalkboard-user text-blue-400 opacity-30 text-6xl transition duration-300 ease-in-out hover:opacity-70"></i>
                </div>
                <h4 class="font-semibold text-2xl text-gray-800 mb-2">Belum ada nilai pribadi yang tersedia</h4>
                <p class="text-gray-600">Nilai atau tautan khusus untuk Anda akan ditampilkan di sini.</p>
            </div>
        </div>
    @else
        {{-- Tabel Nilai --}}
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h5 class="text-xl font-semibold text-blue-700">
                    <i class="fas fa-table mr-2"></i> Detail Nilai Pribadi Anda
                </h5>
            </div>
            <div class="p-0">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-user-tie mr-1"></i> Guru</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-star mr-1"></i> Nilai</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-info-circle mr-1"></i> Keterangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-calendar-alt mr-1"></i> Tanggal</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-search mr-1"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($nilais as $nilai)
                                <tr class="hover:bg-blue-50 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center mr-2 flex-shrink-0">
                                                <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $nilai->guru->name ?? 'Tidak Diketahui' }}</div>
                                                <small class="text-gray-500">Guru</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-blue-600">
                                        {{ $nilai->nilai ?? '-' }} {{-- Menampilkan nilai numerik --}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <div>{{ $nilai->keterangan }}</div>
                                        <small class="text-gray-500">{{ $nilai->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $nilai->created_at->format('d M Y') }}<br>
                                        <small class="text-gray-500">{{ $nilai->created_at->format('H:i') }}</small>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($nilai->file_path)
                                            @php
                                                $fileExtension = pathinfo($nilai->file_path, PATHINFO_EXTENSION);
                                                $viewableExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'webp'];
                                            @endphp

                                            @if(in_array(strtolower($fileExtension), $viewableExtensions))
                                                <button type="button" class="inline-flex items-center justify-center w-8 h-8 rounded-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out view-file-btn"
                                                        data-file-path="{{ asset('storage/' . $nilai->file_path) }}"
                                                        data-file-extension="{{ strtolower($fileExtension) }}"
                                                        title="Lihat File">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            @else
                                                <a href="{{ asset('storage/' . $nilai->file_path) }}" target="_blank"
                                                   class="inline-flex items-center justify-center w-8 h-8 rounded-full text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out"
                                                   title="Unduh File">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            @endif
                                        @elseif($nilai->link_eksternal)
                                            <a href="{{ $nilai->link_eksternal }}" target="_blank"
                                               class="inline-flex items-center justify-center w-8 h-8 rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out"
                                               title="Buka Tautan">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @else
                                            <button class="inline-flex items-center justify-center w-8 h-8 rounded-full text-gray-400 bg-gray-200 cursor-not-allowed" disabled
                                                    title="Tidak tersedia">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- Modal untuk Pratinjau File (Tailwind & Pure JS) --}}
<div id="fileViewerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] flex flex-col overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-4 flex items-center justify-between rounded-t-lg">
            <h5 class="text-xl font-semibold flex items-center" id="fileViewerModalLabel"><i class="fas fa-file-alt mr-2"></i> Pratinjau File</h5>
            <button type="button" class="text-white hover:text-gray-200 focus:outline-none close-modal-btn" aria-label="Close">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6 flex-grow overflow-y-auto text-center flex items-center justify-center bg-gray-100" id="fileViewerModalBody">
            {{-- Konten pratinjau akan dimuat di sini --}}
            <div class="animate-spin rounded-full h-12 w-12 border-4 border-blue-500 border-t-transparent" role="status">
                <span class="sr-only">Memuat...</span>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 flex justify-end rounded-b-lg">
            <button type="button" class="px-5 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition duration-150 ease-in-out close-modal-btn">Tutup</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileViewerModal = document.getElementById('fileViewerModal');
    const modalBody = document.getElementById('fileViewerModalBody');
    const viewFileButtons = document.querySelectorAll('.view-file-btn');
    const closeModalButtons = document.querySelectorAll('.close-modal-btn');
    const closeAlertButtons = document.querySelectorAll('.close-alert-btn');

    // Fungsi untuk menampilkan modal
    function showModal() {
        fileViewerModal.classList.remove('hidden');
        fileViewerModal.classList.add('flex');
    }

    // Fungsi untuk menyembunyikan modal
    function hideModal() {
        fileViewerModal.classList.remove('flex');
        fileViewerModal.classList.add('hidden');
        // Reset konten modal saat ditutup
        modalBody.innerHTML = `
            <div class="animate-spin rounded-full h-12 w-12 border-4 border-blue-500 border-t-transparent" role="status">
                <span class="sr-only">Memuat...</span>
            </div>
        `;
    }

    // Event listener untuk tombol "Lihat File"
    viewFileButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filePath = this.dataset.filePath;
            const fileExtension = this.dataset.fileExtension;

            showModal();

            const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            // Tampilkan spinner saat memuat, lalu muat konten setelah sedikit penundaan
            setTimeout(() => {
                if (fileExtension === 'pdf') {
                    modalBody.innerHTML = `<iframe src="${filePath}" class="w-full h-[70vh] border-none"></iframe>`;
                } else if (imageExtensions.includes(fileExtension)) {
                    modalBody.innerHTML = `<img src="${filePath}" class="max-w-full max-h-[70vh] object-contain mx-auto" alt="Pratinjau File">`;
                } else {
                    modalBody.innerHTML = `
                        <div class="text-center text-gray-600 mt-4">
                            <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-3"></i>
                            <p class="text-lg font-medium">Pratinjau tidak tersedia untuk jenis file ini.</p>
                            <p class="mt-2">
                                Silakan <a href="${filePath}" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out mt-4">
                                    <i class="fas fa-download mr-2"></i> Unduh File
                                </a> untuk melihatnya.
                            </p>
                        </div>
                    `;
                }
            }, 300); // Penundaan kecil untuk menampilkan spinner
        });
    });

    // Event listener untuk tombol tutup modal
    closeModalButtons.forEach(button => {
        button.addEventListener('click', hideModal);
    });

    // Tutup modal saat mengklik di luar area modal
    fileViewerModal.addEventListener('click', function(event) {
        if (event.target === fileViewerModal) {
            hideModal();
        }
    });

    // Event listener untuk tombol tutup alert
    closeAlertButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.closest('[role="alert"]').remove();
        });
    });

    // Animasi baris tabel saat dimuat
    const rows = document.querySelectorAll('table.min-w-full tbody tr');
    rows.forEach((row, i) => {
        row.style.opacity = 0;
        row.style.transform = 'translateY(10px)';
        row.style.transition = `all 0.4s ease ${i * 0.05}s`;
        setTimeout(() => {
            row.style.opacity = 1;
            row.style.transform = 'translateY(0)';
        }, 50);
    });
});
</script>
@endpush
@endsection
