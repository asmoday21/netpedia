<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <!-- Profile Header -->
    <li class="nav-item nav-profile border-bottom">
      @php
        $id = Auth::user()->id;
        $siswaData = App\Models\User::find($id);
      @endphp
      <a href="#" class="nav-link flex-column">
        <div class="nav-profile-image text-center mt-3">
          <img src="{{ isset($siswaData->profile_image) ? url('upload/siswa_images/' . $siswaData->profile_image) : url('upload/admin_images.jpg') }}"
              class="img-xs rounded-circle" alt="profile">
        </div>
        <div class="nav-profile-text text-center mt-2">
          <span class="fw-semibold">{{ Auth::user()->name }}</span>
          <div class="text-secondary small">{{ Auth::user()->email }}</div>
        </div>
      </a>
    </li>

    <!-- Dashboard -->
    <li class="nav-item pt-3">
      <a class="nav-link d-block" href="{{ route('siswa.siswa_master') }}">
        <div class="d-flex justify-content-center">
          <img class="sidebar-brand-logo" src="{{ asset('backend/dist/assets/images/faces/logo.png') }}" alt="" style="width: 50px; height: 50px; object-fit: cover;">
          <img class="sidebar-brand-logomini" src="{{ asset('backend/dist/assets/images/faces/logo.png') }}" alt="" style="width: 30px; height: 30px; object-fit: cover;">
        </div>
        <div class="small fw-bold pt-1 text-center">Dashboard</div>
      </a>
    </li>

    <!-- Profil Section -->
    <li class="pt-2 pb-1">
      <span class="nav-item-head">Profil</span>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('siswa.siswa_profile') }}">
        <i class="mdi mdi-pencil menu-icon"></i>
        <span class="menu-title">Edit Profil</span>
      </a>
    </li>

    {{-- <li class="nav-item">
      <a class="nav-link" href="{{ route('siswa.semua_siswa') }}">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Data Siswa</span>
      </a>
    </li> --}}

    <!-- Modul Section -->
    <li class="pt-2 pb-1">
      <span class="nav-item-head">Bahan Ajar</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('siswa.modul.index') }}">
        <i class="mdi mdi-book-open-page-variant menu-icon"></i>
        <span class="menu-title">Daftar Materi</span>
      </a>
    </li>


    <!-- Quiz / Game Section -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('siswa.quiz.index') }}">
        <i class="mdi mdi-trophy-outline menu-icon"></i>
        <span class="menu-title">Quiz</span>
      </a>
    </li>


    <!-- Logout -->
    <li class="nav-item mt-4">
      <a class="nav-link" href="{{ route('siswa.logout') }}">
        <button class="btn btn-sm btn-danger w-100">
          <i class="bi bi-box-arrow-right me-1"></i> Logout
        </button>
      </a>
    </li>

  </ul>
</nav>
