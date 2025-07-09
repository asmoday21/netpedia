<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile border-bottom">
      @php
        $id = Auth::user()->id;
        $adminData = App\Models\User::find($id);
      @endphp
      <a href="#" class="nav-link flex-column">
        <div class="nav-profile-image">
          <img src="{{ isset($adminData->profile_image) ? url('upload/admin_images/'. $adminData->profile_image) : url('upload/admin_images.jpg') }}" class="image-circle elevation-2" alt="profile">
        </div>
        <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
          <span class="fw-semibold mb-1 mt-2 text-center">{{ Auth::user()->name }}</span>
          <span class="text-secondary icon-sm text-center">{{ Auth::user()->email }}</span>
        </div>
      </a>
    </li>
    <li class="nav-item pt-3">
      <a class="nav-link d-block" href="index.html">
        <div class="d-flex justify-content-center">
          <img class="sidebar-brand-logo" src="{{ asset('backend/dist/assets/images/faces/logo.png') }}" alt="" style="width: 50px; height: 50px; object-fit: cover;">
          <img class="sidebar-brand-logomini" src="{{ asset('backend/dist/assets/images/faces/logo.png') }}" alt="" style="width: 30px; height: 30px; object-fit: cover;">
        </div>
        <div class="small fw-bold pt-1 text-center">Dashboard</div>
      </a>
    </li>
    <li class="pt-2 pb-1">
      <span class="nav-item-head">Profil</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.profile') }}">
        <i class="mdi mdi-pencil menu-icon"></i>
        <span class="menu-title">Edit Profil</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">Siswa</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="forms">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">TJKT 1</a></li>
          <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">TJKT 2</a></li>
        </ul>
      </div>
    </li>
    <li class="pt-2 pb-1">
      <span class="nav-item-head">Bahan Ajar</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-book menu-icon"></i>
        <span class="menu-title">Daftar Modul</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.modul') }}">Sistem TCP/IP</a></li>
          <li class="nav-item"><a class="nav-link" href="pages/ui-features/dropdowns.html">Sistem Layanan Jaringan</a></li>
          <li class="nav-item"><a class="nav-link" href="pages/ui-features/typography.html">Sistem Keamanan Jaringan Telekomunikasi</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
        <i class="mdi mdi-trophy menu-icon"></i>
        <span class="menu-title">Game</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="icons">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.quiz') }}">Sistem Seluler</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.logout') }}">
        <button class="btn btn-sm btn-danger w-100">Logout</button>
      </a>
    </li>
  </ul>
</nav>
