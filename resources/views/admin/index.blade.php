@extends('admin.admin_master')

@section('admin')
<!-- Load Material Design Icons -->
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css" rel="stylesheet">

<div class="container-fluid px-0">
  <!-- Header dengan gradient dan ilustrasi -->
  <div class="w-100 py-4" style="background: linear-gradient(135deg, #6a11cb, #2575fc); position: relative; overflow: hidden;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-8 py-4">
          <h2 class="fw-bold mb-2" style="font-size: 2.75rem; color: #fff;">
            Selamat Datang, {{ Auth::user()->name }}
          </h2>
          <p class="text-white mb-3" style="font-size: 1.2rem; opacity: 0.9;">
            Dashboard Admin - Kelola seluruh sistem akademik dengan kontrol penuh
          </p>
          <div class="d-flex flex-wrap gap-3">
            <div class="badge bg-white text-primary px-3 py-2 rounded-pill d-flex align-items-center">
              <i class="mdi mdi-calendar-check mdi-18px me-2"></i>
              <span id="current-date"></span>
            </div>
            <div class="badge bg-white text-primary px-3 py-2 rounded-pill d-flex align-items-center">
              <i class="mdi mdi-clock-outline mdi-18px me-2"></i>
              <span id="current-time"></span>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-none d-md-flex justify-content-end">
          <div class="position-relative" style="height: 150px;">
            <i class="mdi mdi-shield-account mdi-48px text-white" style="position: absolute; right: 20px; bottom: 0; opacity: 0.7;"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="wave-shape" style="position: absolute; bottom: 0; left: 0; width: 100%; overflow: hidden; line-height: 0;">
      <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="width: 100%; height: 40px;">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="#ffffff"></path>
        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="#ffffff"></path>
        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="#ffffff"></path>
      </svg>
    </div>
  </div>

  <!-- Konten Utama -->
  <div class="main-panel">
    <div class="container py-4">
         <!-- Statistik Cepat -->
        <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold mb-3" style="font-size: 1.75rem;">Statistik Sistem</h4>
            <div class="row g-4">
            @php
            $stats = [
                ['label' => 'Total Pengguna', 'icon' => 'mdi-account-group', 'value' => $totalUsers ?? \App\Models\User::count(), 'color' => 'bg-primary'],
                ['label' => 'Admin', 'icon' => 'mdi-shield-account', 'value' => $totalAdmins ?? \App\Models\User::where("role", "admin")->count(), 'color' => 'bg-success'],
                ['label' => 'Guru', 'icon' => 'mdi-account-tie', 'value' => $totalGurus ?? \App\Models\User::where("role", "guru")->count(), 'color' => 'bg-info'],
                ['label' => 'Siswa', 'icon' => 'mdi-account-school', 'value' => $totalSiswas ?? \App\Models\User::where("role", "siswa")->count(), 'color' => 'bg-danger'],
            ];
            @endphp

            @foreach ($stats as $item)
            <div class="col-6 col-md-3">
                <div class="card text-white {{ $item['color'] }} shadow rounded-4 p-3 text-center h-100">
                <i class="mdi {{ $item['icon'] }} mb-2 mx-auto" style="font-size: 2.5rem;"></i>
                <h3 class="fw-bold mb-1" style="font-size: 1.7rem;">{{ $item['value'] }}</h3>
                <p class="mb-0" style="font-size: 1.1rem;">{{ $item['label'] }}</p>
                </div>
            </div>
            @endforeach
            </div>
        </div>
        </div>

      <!-- Menu Utama (commented out in original) -->
      {{-- <div class="row mb-4">
        <div class="col-12">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0" style="font-size: 1.75rem;">Menu Administrasi</h4>
            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
          </div>
          <div class="row g-4">
            @php
              $cards = [
                ['title' => 'Manajemen User', 'icon' => 'mdi-account-settings', 'color' => 'bg-primary', 'route' => route('admin.users.index'), 'desc' => 'Kelola semua user sistem'],
                ['title' => 'Data Guru', 'icon' => 'mdi-school-outline', 'color' => 'bg-warning', 'route' => route('admin.guru.index'), 'desc' => 'Kelola data guru'],
              ];
            @endphp

            @foreach ($cards as $card)
              <div class="col-md-6 col-lg-4 col-xl-3">
                <a href="{{ $card['route'] }}" class="card h-100 border-0 shadow-sm card-hover text-decoration-none">
                  <div class="card-body text-center p-4 d-flex flex-column">
                    <div class="icon-rounded mb-3 mx-auto {{ $card['color'] }}">
                      <i class="mdi {{ $card['icon'] }} mdi-36px text-white"></i>
                    </div>
                    <h5 class="fw-bold mb-2 text-dark" style="font-size: 1.3rem;">{{ $card['title'] }}</h5>
                    <p class="text-muted mb-0 flex-grow-1" style="font-size: 0.95rem;">{{ $card['desc'] }}</p>
                    <span class="text-primary small mt-2">Akses Menu <i class="mdi mdi-arrow-right"></i></span>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      </div> --}}

      <!-- Aktivitas dan Statistik (commented out in original) -->
      {{-- <div class="row">       
        <!-- Statistik Login -->
        <div class="col-lg-6 mb-4">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pb-0 d-flex justify-content-between align-items-center">
              <h5 class="fw-bold mb-0" style="font-size: 1.3rem;">Statistik Login</h5>
              <div class="dropdown">
            <button class="btn btn-sm btn-link text-primary dropdown-toggle" type="button" id="chartDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              Minggu ini
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="chartDropdown">
              <li><a class="dropdown-item" href="#">Hari ini</a></li>
              <li><a class="dropdown-item" href="#">Minggu ini</a></li>
              <li><a class="dropdown-item" href="#">Bulan ini</a></li>
            </ul>
              </div>
            </div>
            <div class="card-body">
              <div class="chart-container" style="position: relative; height: 250px;">
            <canvas id="loginChart"></canvas>
              </div>
              <div class="mt-4">
            <div class="row g-3">
              @php
                $guruLogins = \App\Models\LoginActivity::where('role', 'guru')->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
                $siswaLogins = \App\Models\LoginActivity::where('role', 'siswa')->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
                $adminLogins = \App\Models\LoginActivity::where('role', 'admin')->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
              @endphp
              <div class="col-4">
                <div class="d-flex align-items-center">
                  <span class="badge bg-primary me-2" style="width: 12px; height: 12px; border-radius: 50%;"></span>
                  <div>
                <small class="text-muted d-block" style="font-size: 0.95rem;">Guru</small>
                <strong style="font-size: 1.1rem;">{{ $guruLogins }}</strong> login
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="d-flex align-items-center">
                  <span class="badge bg-success me-2" style="width: 12px; height: 12px; border-radius: 50%;"></span>
                  <div>
                <small class="text-muted d-block" style="font-size: 0.95rem;">Siswa</small>
                <strong style="font-size: 1.1rem;">{{ $siswaLogins }}</strong> login
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="d-flex align-items-center">
                  <span class="badge bg-warning me-2" style="width: 12px; height: 12px; border-radius: 50%;"></span>
                  <div>
                <small class="text-muted d-block" style="font-size: 0.95rem;">Admin</small>
                <strong style="font-size: 1.1rem;">{{ $adminLogins }}</strong> login
                  </div>
                </div>
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
  </div>
</div>

<!-- Custom Styles -->
<style>
  /* Efek hover card */
  .card-hover {
    transition: all 0.3s ease;
    border-radius: 12px;
  }
  .card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
  }

  /* Icon rounded */
  .icon-rounded {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  /* Warna tambahan */
  .bg-purple {
    background-color: #6f42c1 !important;
  }

  /* Wave shape positioning */
  .wave-shape {
    transform: rotate(180deg);
  }

  /* Responsif */
  @media (max-width: 768px) {
    .icon-rounded {
      width: 48px;
      height: 48px;
    }
    .icon-rounded i {
      font-size: 24px !important;
    }
    /* Penyesuaian font untuk layar kecil */
    .container-fluid .py-4 h2 { /* Selamat Datang */
        font-size: 2.25rem !important;
    }
    .container-fluid .py-4 p { /* Dashboard Admin description */
        font-size: 1.05rem !important;
    }
    h4.fw-bold.mb-3 { /* Statistik Sistem */
        font-size: 1.5rem !important;
    }
    .card.text-white h3 { /* Statistik cards value */
        font-size: 1.4rem !important;
    }
    .card.text-white p { /* Statistik cards label */
        font-size: 0.95rem !important;
    }
    /* Uncommented Menu Administrasi/Statistik Login if used */
    /* .card-body h5 { /* Menu Administrasi / Statistik Login title */
        /* font-size: 1.15rem !important;
    }
    .col-4 small { /* Chart legend small text */
        /* font-size: 0.85rem !important;
    }
    .col-4 strong { /* Chart legend strong text */
        /* font-size: 1rem !important;
    } */
  }
</style>

<!-- JavaScript untuk tanggal dan waktu -->
<script>
  function updateDateTime() {
    const now = new Date();
    
    // Format tanggal: Hari, DD MMMM YYYY
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', options);
    
    // Format waktu: HH:MM:SS
    document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID');
  }
  
  // Update setiap detik
  setInterval(updateDateTime, 1000);
  
  // Jalankan pertama kali
  updateDateTime();

  // Chart.js untuk statistik login (hanya jika elemen canvas ada)
  document.addEventListener('DOMContentLoaded', function() {
    const loginChartCanvas = document.getElementById('loginChart');
    if (loginChartCanvas) {
        const ctx = loginChartCanvas.getContext('2d');
        const loginChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [
                {
                    label: 'Guru',
                    data: [12, 19, 15, 27, 22, 18, 5],
                    borderColor: '#3a7bd5',
                    backgroundColor: 'rgba(58, 123, 213, 0.1)',
                    tension: 0.3,
                    fill: true,
                    borderWidth: 2
                },
                {
                    label: 'Siswa',
                    data: [120, 185, 162, 210, 195, 80, 45],
                    borderColor: '#00d2ff',
                    backgroundColor: 'rgba(0, 210, 255, 0.1)',
                    tension: 0.3,
                    fill: true,
                    borderWidth: 2
                },
                {
                    label: 'Admin',
                    data: [3, 5, 2, 6, 4, 1, 2],
                    borderColor: '#6f42c1',
                    backgroundColor: 'rgba(111, 66, 193, 0.1)',
                    tension: 0.3,
                    fill: true,
                    borderWidth: 2
                }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                legend: {
                    display: false
                }
                },
                scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                    drawBorder: false,
                    color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                    stepSize: 50
                    }
                },
                x: {
                    grid: {
                    display: false
                    }
                }
                },
                elements: {
                point: {
                    radius: 4,
                    hoverRadius: 6
                }
                }
            }
        });
    }
  });
</script>
@endsection
