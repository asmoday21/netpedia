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
    <div class="w-full max-w-5xl bg-white rounded-xl shadow-xl overflow-hidden md:flex md:flex-row">
        <!-- Left Section: Profile Image & Title -->
        <div class="md:w-1/3 bg-blue-600 text-white p-8 flex flex-col items-center justify-center rounded-l-xl md:rounded-r-none">
            <div class="w-36 h-36 rounded-full overflow-hidden border-4 border-white shadow-lg mb-4">
                <img src="{{ isset($editData->profile_image) ? url('upload/guru_images/' . $editData->profile_image) : url('upload/admin_images.jpg') }}"
                    alt="Foto Profil Guru"
                    class="w-full h-full object-cover object-center">
            </div>
            <h2 class="text-3xl font-extrabold text-center leading-tight">Profil Guru</h2>
            <p class="text-blue-200 text-center mt-2 text-sm">Dedikasi untuk Pendidikan</p>
        </div>

        <!-- Right Section: Profile Details & Actions -->
        <div class="md:w-2/3 p-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center md:text-left">Detail Informasi</h3>

            <div class="space-y-6">
                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <!-- User icon from Lucide React, adapted as SVG for HTML -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <input type="text" id="name" value="{{ $editData->name }}"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-800 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" readonly>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <!-- Mail icon from Lucide React, adapted as SVG for HTML -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400">
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                        </div>
                        <input type="email" id="email" value="{{ $editData->email }}"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-800 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" readonly>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
                <a href="{{ route('guru.edit.profile') }}"
                    class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 shadow-md transition duration-300 ease-in-out transform hover:-translate-y-0.5 hover:scale-105">
                    <!-- Edit icon from Lucide React, adapted as SVG for HTML -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                    Edit Profil
                </a>
                <button onclick="copyProfileUrl()"
                    class="flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 shadow-md transition duration-300 ease-in-out transform hover:-translate-y-0.5 hover:scale-105">
                    <!-- Share icon from Lucide React, adapted as SVG for HTML -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                        <polyline points="16 6 12 2 8 6"></polyline>
                        <line x1="12" x2="12" y1="2" y2="15"></line>
                    </svg>
                    Bagikan Profil
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Notifikasi salin link -->
<div id="copyMsg" class="fixed bottom-5 right-5 bg-green-600 text-white px-5 py-3 rounded-lg shadow-lg hidden z-50 animate-fade-in-out">
    <div class="flex items-center">
        <!-- Check icon from Lucide React, adapted as SVG for HTML -->
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
            <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        <span>Link profil telah disalin!</span>
    </div>
</div>

<style>
    /* Custom keyframes for fade-in-out animation */
    @keyframes fade-in-out {
        0% { opacity: 0; transform: translateY(20px); }
        10% { opacity: 1; transform: translateY(0); }
        90% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(20px); }
    }

    .animate-fade-in-out {
        animation: fade-in-out 2.5s ease-in-out forwards;
    }
</style>

<script>
    function copyProfileUrl() {
        const url = window.location.href;
        // Using document.execCommand('copy') for better compatibility in iframe environments
        const tempInput = document.createElement('input');
        document.body.appendChild(tempInput);
        tempInput.value = url;
        tempInput.select();
        try {
            document.execCommand('copy');
            const msg = document.getElementById('copyMsg');
            msg.classList.remove('hidden');
            // Remove previous animation to re-trigger it
            msg.classList.remove('animate-fade-in-out');
            void msg.offsetWidth; // Trigger reflow
            msg.classList.add('animate-fade-in-out');
            // The animation itself handles hiding after 2.5s
        } catch (err) {
            // Fallback for older browsers or if execCommand fails
            console.error('Failed to copy text: ', err);
            // Instead of alert, display a custom message box or integrate into the existing notification
            const msg = document.getElementById('copyMsg');
            msg.innerHTML = '<div class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" x2="12" y1="8" y2="12"></line><line x1="12" x2="12.01" y1="16" y2="16"></line></svg><span>Gagal menyalin. Salin manual: ' + url + '</span></div>';
            msg.classList.remove('hidden');
            msg.classList.remove('bg-green-600');
            msg.classList.add('bg-red-600');
            msg.classList.remove('animate-fade-in-out');
            void msg.offsetWidth; // Trigger reflow
            msg.classList.add('animate-fade-in-out');
        } finally {
            document.body.removeChild(tempInput);
        }
    }
</script>
@endsection
