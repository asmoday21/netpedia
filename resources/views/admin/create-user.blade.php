<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Akun Baru</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.store-user') }}">
                @csrf

                <!-- Nama -->
                <div>
                    <x-input-label for="name" value="Nama" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Konfirmasi Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Role -->
                <div class="mt-4">
                    <x-input-label for="role" value="Role" />
                    <select id="role" name="role" class="block mt-1 w-full" required>
                        <option value="" disabled selected>Pilih Role</option>
                        @foreach(\Spatie\Permission\Models\Role::all() as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <!-- Permissions -->
                <div class="mt-4">
                    <x-input-label for="permissions" value="Permission (opsional)" />
                    <div class="grid grid-cols-2 gap-4 mt-2">
                        @foreach(\Spatie\Permission\Models\Permission::all() as $permission)
                            <label class="flex items-center">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="mr-2">
                                <span class="text-sm">{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
                </div>

                <!-- Tombol Submit -->
                <div class="flex items-center justify-end mt-6">
                    <x-primary-button class="ml-4">
                        Tambah Akun
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
