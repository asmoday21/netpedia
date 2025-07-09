<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <!-- Profile Admin -->
    <li class="nav-item nav-profile border-bottom">
      @php
        $id = Auth::user()->id;
        $adminData = App\Models\User::find($id);
      @endphp
      <a href="#" class="nav-link flex-column">
        <div class="nav-profile-image">
          <img src="{{ isset($adminData->profile_image) ? url('upload/admin_images/' . $adminData->profile_image) : url('upload/admin_images.jpg') }}"
               class="image-circle elevation-2" alt="profile">
        </div>
        <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
          <span class="fw-semibold mb-1 mt-2 text-center">{{ Auth::user()->name }}</span>
          <span class="text-secondary icon-sm text-center">{{ Auth::user()->email }}</span>
        </div>
      </a>
    </li>

    <!-- Dashboard -->
    <li class="nav-item pt-3">
      <a class="nav-link d-block" href="{{ route('admin.admin_master') }}">
        <div class="d-flex justify-content-center">
          <img class="sidebar-brand-logo" src="{{ asset('backend/dist/assets/images/faces/logo.png') }}" alt=""
               style="width: 50px; height: 50px; object-fit: cover;">
          <img class="sidebar-brand-logomini" src="{{ asset('backend/dist/assets/images/faces/logo.png') }}" alt=""
               style="width: 30px; height: 30px; object-fit: cover;">
        </div>
        <div class="small fw-bold pt-1 text-center">Dashboard</div>
      </a>
    </li>

    <!-- Profil -->
    <li class="pt-2 pb-1">
      <span class="nav-item-head">Profil</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.profile') }}">
        <i class="mdi mdi-pencil menu-icon"></i>
        <span class="menu-title">Edit Profil</span>
      </a>
    </li>

    <!-- Guru -->
    <li class="pt-2 pb-1">
      <span class="nav-item-head">Manajemen</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.users.index') }}">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">User</span>
      </a>
    </li>    
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.guru.index') }}">
        <i class="mdi mdi-school menu-icon"></i>
        <span class="menu-title">Guru</span>
      </a>
    </li>

    <!-- Siswa -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.siswa.index') }}">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Siswa</span>
      </a>
    </li>

    <!-- Manajemen Kelas Dinamis -->
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('kelas.*') ? 'active' : '' }}" href="{{ route('admin.kelas.index') }}">
      <i class="mdi mdi-format-list-bulleted menu-icon"></i>
      <span class="menu-title">Manajemen Kelas</span>
    </a>
  </li>


    <!-- Kelas -->
    {{-- <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#kelas-dropdown" aria-expanded="false" aria-controls="kelas-dropdown">
      <i class="mdi mdi-google-classroom menu-icon"></i>
      <span class="menu-title">Kelas</span>
      <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="kelas-dropdown">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.kelas.tjkt_1') }}">
          <i class="mdi mdi-numeric-1-box-outline menu-icon"></i> X TJKT 1
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.kelas.tjkt_2') }}">
          <i class="mdi mdi-numeric-2-box-outline menu-icon"></i> X TJKT 2
        </a>
        </li>
      </ul>
      </div>
    </li> --}}
    

    <!-- Bahan Ajar -->
    {{-- <li class="pt-2 pb-1">
      <span class="nav-item-head">Bahan Ajar</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.modul.index')}}">
        <i class="mdi mdi-book-open-page-variant menu-icon"></i>
        <span class="menu-title">Daftar Modul</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.quiz.index')}}">
        <i class="mdi mdi-trophy menu-icon"></i>
        <span class="menu-title">Quiz</span>
      </a>
    </li> --}}

    <!-- Logout -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.logout') }}">
        <button class="btn btn-sm btn-danger w-100">Logout</button>
      </a>
    </li>

  </ul>
</nav>
