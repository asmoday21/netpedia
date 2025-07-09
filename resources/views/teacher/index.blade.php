@extends('admin.admin_master')
@section('admin')
<div class="main-panel">
  <div class="content-wrapper pb-0">
    <div class="page-header flex-wrap">
      <div class="header-left">
        <button class="btn btn-primary mb-2 mb-md-0 me-2">Buat materi baru</button>
        <button class="btn btn-outline-primary bg-white mb-2 mb-md-0">Impor materi</button>
      </div>
      <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
        <div class="d-flex align-items-center">
          <a href="#">
            <p class="m-0 pe-3">Dashboard</p>
          </a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12 stretch-card grid-margin">
        <div class="card">
          <div class="row">
            <div class="col-md-4">
              <div class="card border-0">
                <div class="card-body">
                  <div class="card-title"> Sesi Pembelajaran </div>
                  <div class="d-flex flex-wrap">
                    <div class="doughnut-wrapper w-50">
                      <canvas id="doughnutChart1" width="136" height="136" style="display: block; box-sizing: border-box; height: 109px; width: 109px;"></canvas>
                    </div>
                    <div id="doughnutChart1-legend" class="ps-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left">
                      <ul>
                        <li>
                          <span class="legend-dots" style="background-color: #5e6eed"></span>
                          Teori
                        </li>
                        <li>
                          <span class="legend-dots" style="background-color: #ff5730"></span>
                          Praktik
                        </li>
                        <li>
                          <span class="legend-dots" style="background-color: #00cff4"></span>
                          Diskusi
                        </li>
                      </ul>
                      <ul>
                        <li>
                          <span class="legend-dots" style="background-color: #5e6eed"></span>
                          Teori
                        </li>
                        <li>
                          <span class="legend-dots" style="background-color: #ff5730"></span>
                          Praktik
                        </li>
                        <li>
                          <span class="legend-dots" style="background-color: #00cff4"></span>
                          Diskusi
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card border-0">
                <div class="card-body">
                  <div class="card-title"> Sesi Evaluasi </div>
                  <div class="d-flex flex-wrap">
                    <div class="doughnut-wrapper w-50">
                      <canvas id="doughnutChart2" width="136" height="136" style="display: block; box-sizing: border-box; height: 109px; width: 109px;"></canvas>
                    </div>
                    <div id="doughnutChart2-legend" class="ps-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left">
                      <ul>
                        <li>
                          <span class="legend-dots" style="background-color: #5e6eed"></span>
                          Ujian
                        </li>
                        <li>
                          <span class="legend-dots" style="background-color: #ff0d59"></span>
                          Tugas
                        </li>
                        <li>
                          <span class="legend-dots" style="background-color: #00d284"></span>
                          Kuis
                        </li>
                      </ul>
                      <ul>
                        <li>
                          <span class="legend-dots" style="background-color: #5e6eed"></span>
                          Ujian
                        </li>
                        <li>
                          <span class="legend-dots" style="background-color: #ff0d59"></span>
                          Tugas
                        </li>
                        <li>
                          <span class="legend-dots" style="background-color: #00d284"></span>
                          Kuis
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card border-0">
                <div class="card-body">
                  <div class="card-title"> Sesi Perangkat </div>
                  <div class="d-flex flex-wrap">
                    <div class="doughnut-wrapper w-50">
                      <canvas id="doughnutChart3" width="136" height="136" style="display: block; box-sizing: border-box; height: 109px; width: 109px;"></canvas>
                    </div>
                    <div id="doughnutChart3-legend" class="ps-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left">
                      <ul>
                        <li>
                          <span class="legend-dots" style="background-color: #00cff4"></span>
                          Laptop
                        </li>
                        <li>
                          <span class="legend-dots" style="background-color: #ff0d59"></span>
                          Proyektor
                        </li>
                        <li>
                          <span class="legend-dots" style="background-color: #00d284"></span>
                          Papan Tulis
                        </li>
                      </ul>
                      <ul>
                        <li>
                          <span class="legend-dots" style="background-color: #00cff4"></span>
                          Laptop
                        </li>
                        <li>
                          <span class="legend-dots" style="background-color: #ff0d59"></span>
                          Proyektor
                        </li>
                        <li>
                          <span class="legend-dots" style="background-color: #00d284"></span>
                          Papan Tulis
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- last row starts here -->
      <div class="row">
        <div class="col-sm-6 col-xl-4 stretch-card grid-margin">
          <div class="card">
            <div class="card-body">
              <div class="card-title mb-2"> Kegiatan Mendatang (3) </div>
              <h3 class="mb-3">23 September 2023</h3>
              <div class="d-flex border-bottom border-top py-3">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" checked=""><i class="input-helper"></i></label>
                </div>
                <div class="ps-2">
                  <span class="font-12 text-muted">Sel, 5 Mar, 9.30am</span>
                  <p class="m-0 text-black">Saya melampirkan beberapa file PSD baru…</p>
                </div>
              </div>
              <div class="d-flex border-bottom py-3">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input"><i class="input-helper"></i></label>
                </div>
                <div class="ps-2">
                  <span class="font-12 text-muted">Sen, 11 Mar, 4.30 PM</span>
                  <p class="m-0 text-black">Diskusikan kinerja dengan manajer</p>
                </div>
              </div>
              <div class="d-flex border-bottom py-3">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input"><i class="input-helper"></i></label>
                </div>
                <div class="ps-2">
                  <span class="font-12 text-muted">Sel, 5 Mar, 9.30am</span>
                  <p class="m-0 text-black">Rapat dengan Alisa</p>
                </div>
              </div>
              <div class="d-flex pt-3">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input"><i class="input-helper"></i></label>
                </div>
                <div class="ps-2">
                  <span class="font-12 text-muted">Sen, 11 Mar, 4.30 PM</span>
                  <p class="m-0 text-black">Saya melampirkan beberapa file PSD baru…</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-4 stretch-card grid-margin">
          <div class="card">
            <div class="card-body">
              <div class="d-flex border-bottom mb-4 pb-2">
                <div class="hexagon">
                  <div class="hex-mid hexagon-warning">
                    <i class="mdi mdi-clock-outline"></i>
                  </div>
                </div>
                <div class="ps-4">
                  <h4 class="fw-bold text-warning mb-0">12.45</h4>
                  <h6 class="text-muted">Jadwal Rapat</h6>
                </div>
              </div>
              <div class="d-flex border-bottom mb-4 pb-2">
                <div class="hexagon">
                  <div class="hex-mid hexagon-danger">
                    <i class="mdi mdi-account-outline"></i>
                  </div>
                </div>
                <div class="ps-4">
                  <h4 class="fw-bold text-danger mb-0">34568</h4>
                  <h6 class="text-muted">Kunjungan Profil</h6>
                </div>
              </div>
              <div class="d-flex border-bottom mb-4 pb-2">
                <div class="hexagon">
                  <div class="hex-mid hexagon-success">
                    <i class="mdi mdi-laptop"></i>
                  </div>
                </div>
                <div class="ps-4">
                  <h4 class="fw-bold text-success mb-0">33.50%</h4>
                  <h6 class="text-muted">Rasio Pentalan</h6>
                </div>
              </div>
              <div class="d-flex border-bottom mb-4 pb-2">
                <div class="hexagon">
                  <div class="hex-mid hexagon-info">
                    <i class="mdi mdi-clock-outline"></i>
                  </div>
                </div>
                <div class="ps-4">
                  <h4 class="fw-bold text-info mb-0">12.45</h4>
                  <h6 class="text-muted">Jadwal Rapat</h6>
                </div>
              </div>
              <div class="d-flex">
                <div class="hexagon">
                  <div class="hex-mid hexagon-primary">
                    <i class="mdi mdi-timer-sand"></i>
                  </div>
                </div>
                <div class="ps-4">
                  <h4 class="fw-bold text-primary mb-0">12.45</h4>
                  <h6 class="text-muted mb-0">Penggunaan Browser</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-4 stretch-card grid-margin">
          <div class="card color-card-wrapper">
            <div class="card-body">
              <img class="img-fluid card-top-img w-100" src="http://127.0.0.1:8000/backend/dist/assets/images/dashboard/img_5.jpg" alt="">
              <div class="d-flex flex-wrap justify-content-around color-card-outer">
                <div class="col-6 p-0 mb-4">
                  <div class="color-card primary m-auto">
                    <i class="mdi mdi-clock-outline"></i>
                    <p class="fw-semibold mb-0">Dikirim</p>
                    <span class="small">15 Paket</span>
                  </div>
                </div>
                <div class="col-6 p-0 mb-4">
                  <div class="color-card bg-success  m-auto">
                    <i class="mdi mdi-tshirt-crew"></i>
                    <p class="fw-semibold mb-0">Dipesan</p>
                    <span class="small">72 Item</span>
                  </div>
                </div>
                <div class="col-6 p-0">
                  <div class="color-card bg-info m-auto">
                    <i class="mdi mdi-trophy-outline"></i>
                    <p class="fw-semibold mb-0">Tiba</p>
                    <span class="small">34 Ditingkatkan</span>
                  </div>
                </div>
                <div class="col-6 p-0">
                  <div class="color-card bg-danger m-auto">
                    <i class="mdi mdi-presentation"></i>
                    <p class="fw-semibold mb-0">Dilaporkan</p>
                    <span class="small">72 Dukungan</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
</div>
@endsection