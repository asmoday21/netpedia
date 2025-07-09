@extends('admin.admin_master') {{-- Tetap menggunakan admin_master --}}

@section('admin') {{-- Tetap menggunakan section admin --}}
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#3a7bd5',
                    secondary: '#00d2ff',
                    info: '#3a7bd5',
                    warning: '#ffc107',
                    success: '#28a745',
                    darkblue: '#1a569a', // A darker shade for text/elements
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 font-inter min-h-screen bg-gray-100">
    <div class="flex justify-center items-center">
        <div class="w-full max-w-full"> {{-- Menggunakan max-w-full untuk tampilan penuh lebar --}}
            <div class="bg-white rounded-xl shadow-2xl-custom overflow-hidden mb-8">
                {{-- Card Header with SMK Theme Gradient --}}
                <div class="px-6 py-6 sm:px-8 sm:py-8 bg-gradient-to-r from-primary to-secondary text-white relative overflow-hidden rounded-t-xl flex justify-between items-center">
                    <h3 class="text-2xl sm:text-3xl font-extrabold mb-0 drop-shadow-md flex items-center">
                        <i class="mdi mdi-account-edit-outline mr-3 text-3xl"></i> Edit Profil
                    </h3>
                    <a href="{{ route('admin.profile') }}" class="inline-flex items-center px-4 py-2 border border-white/50 rounded-full text-sm text-white hover:bg-white/20 transition-all duration-300">
                        <i class="mdi mdi-arrow-left mr-2 text-lg"></i> Kembali
                    </a>
                    {{-- Subtle background pattern for flair --}}
                    <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zm0 36v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0 36v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zM12 34v-4H10v4H6v2h4v4h2v-4h4v-2h-4zm0-30V0H10v4H6v2h4v4h2V6h4V4h-4zm0 36v-4H10v4H6v2h4v4h2v-4h4v-2h-4zm0 36v-4H10v4H6v2h4v4h2v-4h4v-2h-4z"%3E%3C/path%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-repeat: repeat; background-size: 60px 60px;"></div>
                </div>

                <form method="POST" action="{{ route('store.profile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 sm:p-8">
                        <div class="mb-5">
                            <label for="inputName" class="block text-gray-700 text-sm font-semibold mb-2">Nama Lengkap</label>
                            <input type="text" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition duration-200 text-gray-800" id="inputName" name="name" value="{{ $editData->name }}" placeholder="Masukkan nama">
                        </div>

                        <div class="mb-5">
                            <label for="inputEmail" class="block text-gray-700 text-sm font-semibold mb-2">Alamat Email</label>
                            <input type="email" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition duration-200 text-gray-800" id="inputEmail" name="email" value="{{ $editData->email }}" placeholder="Masukkan email">
                        </div>

                        <div class="mb-5">
                            <label for="image" class="block text-gray-700 text-sm font-semibold mb-2">Gambar Profil</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-darkblue transition duration-200" type="file" id="image" name="profile_image">
                        </div>

                        {{-- Gambar preview opsional --}}
                        <div class="text-center mb-6">
                            <img id="showImage" src="{{ isset($editData->profile_image) ? url('upload/admin_images/'.$editData->profile_image) : url('upload/no_image.jpg') }}" class="rounded-full w-36 h-36 object-cover mx-auto border-4 border-primary shadow-lg" alt="Preview Gambar">
                        </div>
                    </div>

                    <div class="px-6 py-5 sm:px-8 sm:py-6 bg-gray-50 text-center border-t border-gray-200 rounded-b-xl">
                        <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent rounded-full shadow-lg text-base font-semibold text-white bg-success hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-success transition-all duration-300 transform hover:-translate-y-1">
                            <i class="mdi mdi-content-save-outline mr-2 text-xl"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom font */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    body {
        font-family: 'Inter', sans-serif;
    }
</style>

<script>
    $(document).ready(function(){
        $('#image').change(function(e){
            let reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>

@endsection
