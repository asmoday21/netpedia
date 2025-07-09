@extends('admin.admin_master')

@section('admin')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa Kelas {{ $kelas->nama_kelas }}</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Light gray background */
        }
        /* Custom modal styles for confirmation */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 0.75rem; /* rounded-lg */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-xl */
            max-width: 90%;
            width: 400px;
            text-align: center;
            transform: translateY(-20px);
            transition: transform 0.3s ease;
        }
        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <!-- Content that would typically be within the 'admin' section of admin_master -->
    <div class="min-h-screen bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <h2 class="text-3xl font-bold text-gray-800 text-center sm:text-left">
                    Siswa Kelas {{ $kelas->nama_kelas }}
                </h2>
                <a href="{{ route('admin.kelas.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2.5 rounded-lg shadow-md flex items-center gap-2 transition duration-300 ease-in-out transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar Kelas
                </a>
            </div>

            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('admin.kelas.show', $kelas->id) }}" class="mb-6 max-w-lg mx-auto sm:mx-0">
                <div class="flex items-center space-x-2">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari siswa..."
                        class="w-full px-4 py-2.5 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out focus:outline-none"
                    >
                    <button
                        type="submit"
                        class="px-5 py-2.5 text-base bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition duration-300 ease-in-out transform hover:scale-105"
                    >
                        Cari
                    </button>
                </div>
            </form>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto text-sm text-left text-gray-700">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3 font-semibold tracking-wider">No</th>
                                <th class="px-6 py-3 font-semibold tracking-wider">Nama</th>
                                <th class="px-6 py-3 font-semibold tracking-wider">Email</th>
                                <th class="px-6 py-3 font-semibold tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($students as $student)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $student->name }}</td>
                                    <td class="px-6 py-4">{{ $student->email }}</td>
                                    <td class="px-6 py-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start gap-2">
                                        <a href="{{ route('admin.users.edit', $student->id) }}"
                                           class="text-white bg-yellow-500 hover:bg-yellow-600 px-3 py-1.5 rounded-md text-xs font-medium transition duration-200 ease-in-out">Edit</a>
                                        <button type="button"
                                                onclick="showConfirmModal('{{ route('admin.users.destroy', $student->id) }}')"
                                                class="text-white bg-red-500 hover:bg-red-600 px-3 py-1.5 rounded-md text-xs font-medium transition duration-200 ease-in-out">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-6 text-center text-gray-500 italic">Belum ada siswa di kelas ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End of content that would typically be within the 'admin' section -->

    <!-- Custom Confirmation Modal -->
    <div id="confirmModal" class="modal-overlay hidden">
        <div class="modal-content">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h3>
            <p class="text-gray-700 mb-6">Yakin ingin menghapus siswa ini?</p>
            <div class="flex justify-center gap-4">
                <button id="cancelButton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-5 rounded-lg transition duration-200 ease-in-out">Batal</button>
                <button id="confirmDeleteButton" class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-5 rounded-lg transition duration-200 ease-in-out">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Hidden form for deletion -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // Get references to the modal elements
        const confirmModal = document.getElementById('confirmModal');
        const cancelButton = document.getElementById('cancelButton');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        const deleteForm = document.getElementById('deleteForm');

        // Function to show the custom confirmation modal
        function showConfirmModal(formAction) {
            deleteForm.action = formAction; // Set the form action dynamically
            confirmModal.classList.remove('hidden'); // Show the modal overlay
            confirmModal.classList.add('active'); // Add active class for transitions
        }

        // Function to hide the custom confirmation modal
        function hideConfirmModal() {
            confirmModal.classList.remove('active'); // Remove active class for transitions
            // Use a timeout to hide the modal completely after the transition
            setTimeout(() => {
                confirmModal.classList.add('hidden');
            }, 300);
        }

        // Event listener for the "Cancel" button in the modal
        cancelButton.addEventListener('click', hideConfirmModal);

        // Event listener for the "Confirm" button in the modal
        confirmDeleteButton.addEventListener('click', () => {
            deleteForm.submit(); // Submit the hidden form
            hideConfirmModal(); // Hide the modal
        });

        // Optional: Close modal if clicking outside the content
        confirmModal.addEventListener('click', (event) => {
            if (event.target === confirmModal) {
                hideConfirmModal();
            }
        });
    </script>

</body>
</html>
@endsection
