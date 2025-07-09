<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile border-bottom">
      @php
        $id = Auth::user()->id;
        $guruData = App\Models\User::find($id);
      @endphp
      <a href="#" class="nav-link flex-column">
        <div class="nav-profile-image">
          <img src="{{ isset($guruData->profile_image) ? url('upload/guru_images/'. $guruData->profile_image) : url('upload/admin_images.jpg') }}" class="image-circle elevation-2" alt="profile">
        </div>
        <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
          <span class="fw-semibold mb-1 mt-2 text-center">{{ Auth::user()->name }}</span>
          <span class="text-secondary icon-sm text-center">{{ Auth::user()->email }}</span>
        </div>
      </a>
    </li>

    <li class="nav-item pt-3">
      <a class="nav-link d-block" href="{{ route('guru.guru_master') }}">
        <div class="d-flex justify-content-center">
          <img class="sidebar-brand-logo" src="{{ asset('backend/dist/assets/images/faces/logo.png') }}" alt="" style="width: 50px; height: 50px; object-fit: cover;">
          <img class="sidebar-brand-logomini" src="{{ asset('backend/dist/assets/images/faces/logo.png') }}" alt="" style="width: 30px; height: 30px; object-fit: cover;">
        </div>
        <div class="small fw-bold pt-1 text-center">Dashboard</div>
      </a>
    </li>

    <!-- Profil -->
    <li class="pt-2 pb-1">
      <span class="nav-item-head">Profil</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('guru.profile') }}">
        <i class="mdi mdi-pencil menu-icon"></i>
        <span class="menu-title">Edit Profil</span>
      </a>
    </li>

    <!-- Guru -->
    {{-- <li class="pt-2 pb-1">
      <span class="nav-item-head">Manajemen</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('guru.users.index') }}">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">User</span>
      </a>
    </li>    
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('guru.guru.index') }}">
        <i class="mdi mdi-school menu-icon"></i>
        <span class="menu-title">Guru</span>
      </a>
    </li> --}}

    <!-- Siswa -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('guru.siswa.index') }}">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Siswa</span>
      </a>
    </li>

    <!-- Bahan Ajar -->
    <li class="pt-2 pb-1">
      <span class="nav-item-head">Bahan Ajar</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('guru.modul.index')}}">
        <i class="mdi mdi-book-open-page-variant menu-icon"></i>
        <span class="menu-title">Daftar Materi</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('guru.quiz.index') }}">
      <i class="mdi mdi-trophy menu-icon"></i>
      <span class="menu-title">Quiz</span>
      </a>
    </li>
     

    <!-- Logout -->
    <li class="nav-item mt-4">
      <a class="nav-link" href="{{ route('guru.logout') }}">
        <button class="btn btn-sm btn-danger w-100">
          <i class="bi bi-box-arrow-right me-1"></i> Logout
        </button>
      </a>
    </li>
  </ul>
</nav>
