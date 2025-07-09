@extends('guru.guru_master')

@section('guru')
<div class="container py-5 px-3 px-md-5">

  <!-- Breadcrumb Navigation -->
  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('guru.materi.index') }}" class="text-decoration-none"><i class="bi bi-arrow-left me-2"></i>Media dan Jaringan Telekomunikasi</a></li>
      <li class="breadcrumb-item active" aria-current="page">Pengantar TCP/IP</li>
    </ol>
  </nav>

  <!-- Main Content Card -->
  <div class="card border-0 shadow-sm mb-5">
    <div class="card-body p-4 p-md-5">

      <!-- Introduction Paragraph with Image -->
      <section class="mb-5">
        <div class="bg-light p-4 p-md-5 rounded-4 shadow-sm border position-relative overflow-hidden" style="background: linear-gradient(90deg, #e3f2fd 0%, #ffffff 100%);">
          <div class="row g-4 align-items-center">
            <!-- Gambar -->
            <div class="col-md-4 text-center">
              <img 
                src="https://images.unsplash.com/photo-1620712943543-bcc4688e7485" 
                alt="Network Concept" 
                class="img-fluid rounded-3 border shadow-sm"
                style="max-width: 220px; object-fit: cover;"
              >
            </div>

            <!-- Konten -->
            <div class="col-md-8">
              <h3 class="fw-bold text-primary mb-3" style="letter-spacing: 0.5px;">
                🌐 Pengantar TCP/IP & Peran Teknologi Informasi
              </h3>
              <p class="text-dark fs-5" style="line-height: 1.8;">
                Teknologi informasi kini menjadi bagian <span class="fw-semibold text-primary">penting</span> dalam pembangunan era digital.
                Perkembangannya yang masif memberikan dampak besar terhadap berbagai bidang, termasuk:
                <span class="text-success">pendidikan</span>, 
                <span class="text-info">kesehatan</span>, dan 
                <span class="text-warning">komunikasi</span>.
              </p>
              <p class="text-dark fs-5" style="line-height: 1.8;">
                <span class="fw-semibold text-secondary">TCP/IP</span> adalah fondasi utama komunikasi internet, memungkinkan perangkat dari seluruh dunia 
                untuk saling terhubung dan bertukar data secara cepat, aman, dan efisien.
              </p>
            </div>
          </div>
        </div>
      </section>


      <!-- Main Content Accordion -->
      <div class="accordion" id="materiAccordion">

        <!-- Section 1: TCP/IP Basics -->
        <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button bg-light text-dark py-3 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <i class="bi bi-stack me-2 text-primary"></i> 1. Prinsip Dasar TCP/IP
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#materiAccordion">
            <div class="accordion-body">
              
              <!-- Model Comparison Tabs -->
              <section class="mb-5">
                <h5 class="fw-bold mb-3 text-dark">
                  <i class="bi bi-layers me-2 text-primary"></i> A. Perbandingan Model Jaringan
                </h5>

                <!-- Tabs -->
                <ul class="nav nav-tabs rounded overflow-hidden shadow-sm" id="modelTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-semibold" id="osi-tab" data-bs-toggle="tab" data-bs-target="#osi" type="button" role="tab" aria-controls="osi" aria-selected="true">
                      <i class="bi bi-diagram-3 me-1"></i> OSI Model
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold" id="tcpip-tab" data-bs-toggle="tab" data-bs-target="#tcpip" type="button" role="tab" aria-controls="tcpip" aria-selected="false">
                      <i class="bi bi-diagram-2 me-1"></i> TCP/IP Model
                    </button>
                  </li>
                </ul>

                <!-- Tab Contents -->
                <div class="tab-content p-4 border border-top-0 rounded-bottom bg-white shadow-sm" id="modelTabContent">
                  <!-- OSI Model -->
                  <div class="tab-pane fade show active" id="osi" role="tabpanel" aria-labelledby="osi-tab">
                    <div class="row g-4 align-items-center">
                      <div class="col-md-8">
                        <ol class="list-group list-group-numbered list-group-flush">
                          @foreach (['Physical Layer', 'Data Link Layer', 'Network Layer', 'Transport Layer', 'Session Layer', 'Presentation Layer', 'Application Layer'] as $index => $layer)
                            <li class="list-group-item d-flex align-items-center">
                              <span class="badge bg-primary me-3">{{ $index + 1 }}</span>
                              <span class="fw-medium">{{ $layer }}</span>
                            </li>
                          @endforeach
                        </ol>
                      </div>
                      <div class="col-md-4 text-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/OSI_Model_v1.svg/1200px-OSI_Model_v1.svg.png" alt="OSI Model" class="img-fluid rounded shadow-sm border">
                      </div>
                    </div>
                  </div>

                  <!-- TCP/IP Model -->
                  <div class="tab-pane fade" id="tcpip" role="tabpanel" aria-labelledby="tcpip-tab">
                    <div class="row g-4 align-items-center">
                      <div class="col-md-8">
                        <ol class="list-group list-group-numbered list-group-flush">
                          @foreach (['Network Interface', 'Internet Layer', 'Transport Layer', 'Application Layer'] as $index => $layer)
                            <li class="list-group-item d-flex align-items-center">
                              <span class="badge bg-success me-3">{{ $index + 1 }}</span>
                              <span class="fw-medium">{{ $layer }}</span>
                            </li>
                          @endforeach
                        </ol>
                      </div>
                      <div class="col-md-4 text-center">
                        <img src="https://miro.medium.com/v2/resize:fit:1100/format:webp/1*OEuofWaCivrbSegAl1ZpIw.png" alt="TCP/IP Model" class="img-fluid rounded shadow-sm border">
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Info Alert -->
                <div class="alert alert-light mt-4 border d-flex align-items-center shadow-sm">
                  <i class="bi bi-lightbulb-fill me-2 text-warning fs-4"></i>
                  <div class="fs-6">
                    <strong>Catatan:</strong> Lapisan OSI lebih bersifat konseptual untuk pemahaman, sedangkan model TCP/IP digunakan secara nyata dalam komunikasi jaringan internet.
                  </div>
                </div>
              </section>

              <!-- IP Addressing Section -->
              <section class="mb-4">
                <div class="d-flex align-items-center mb-3">
                  <h5 class="fw-bold mb-0 text-dark flex-grow-1">
                    <i class="bi bi-pin-map me-2 text-muted"></i> B. Pengalamatan IP
                  </h5>
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#subnettingCollapse" aria-expanded="false" aria-controls="subnettingCollapse">
                    Tampilkan Detail
                  </button>
                </div>
                <div class="collapse" id="subnettingCollapse">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="card h-100 border">
                        <div class="card-header bg-light text-dark d-flex align-items-center border-bottom">
                          <i class="bi bi-ip me-2 text-primary"></i> <strong>IPv4</strong>
                        </div>
                        <div class="card-body">
                          <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle me-2 text-primary"></i> 32-bit address</li>
                            <li class="mb-2"><i class="bi bi-check-circle me-2 text-primary"></i> Contoh: 192.168.1.1</li>
                            <li class="mb-2"><i class="bi bi-check-circle me-2 text-primary"></i> Dibagi ke dalam kelas A, B, C, D, E</li>
                            <li><i class="bi bi-exclamation-triangle me-2 text-warning"></i> Masalah: keterbatasan alamat</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card h-100 border">
                        <div class="card-header bg-light text-dark d-flex align-items-center border-bottom">
                          <i class="bi bi-ip me-2 text-primary"></i> <strong>IPv6</strong>
                        </div>
                        <div class="card-body">
                          <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle me-2 text-primary"></i> 128-bit address</li>
                            <li class="mb-2"><i class="bi bi-check-circle me-2 text-primary"></i> Contoh: 2001:db8::1</li>
                            <li class="mb-2"><i class="bi bi-check-circle me-2 text-primary"></i> Lebih banyak ruang alamat</li>
                            <li><i class="bi bi-shield-check me-2 text-success"></i> Fitur keamanan lebih baik</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mt-3">
                    <img src="https://www.cloudns.net/blog/wp-content/uploads/2023/02/IPv4-vs-IPv6.jpg" alt="IPv4 vs IPv6" class="img-fluid rounded">
                  </div>
                </div>
              </section>

              <!-- Subnetting and Routing -->
              <section>
                <div class="d-flex align-items-center mb-3">
                  <h5 class="fw-bold mb-0 text-dark flex-grow-1">
                    <i class="bi bi-router me-2 text-muted"></i> C. Subnetting dan Routing
                  </h5>
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#subnetRoutingCollapse" aria-expanded="false" aria-controls="subnetRoutingCollapse">
                    Tampilkan Detail
                  </button>
                </div>
                <div class="collapse" id="subnetRoutingCollapse">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="card h-100 border">
                        <div class="card-header bg-light text-dark d-flex align-items-center border-bottom">
                          <i class="bi bi-diagram-2 me-2 text-primary"></i> <strong>Subnetting</strong>
                        </div>
                        <div class="card-body">
                          <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-arrow-right me-2 text-muted"></i> Membagi jaringan menjadi bagian lebih kecil</li>
                            <li class="mb-2"><i class="bi bi-arrow-right me-2 text-muted"></i> Contoh: 192.168.1.0/26</li>
                            <li class="mb-2"><i class="bi bi-arrow-right me-2 text-muted"></i> Meningkatkan efisiensi alokasi IP</li>
                            <li><i class="bi bi-arrow-right me-2 text-muted"></i> Mengurangi broadcast domain</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card h-100 border">
                        <div class="card-header bg-light text-dark d-flex align-items-center border-bottom">
                          <i class="bi bi-signpost-2 me-2 text-primary"></i> <strong>Routing</strong>
                        </div>
                        <div class="card-body">
                          <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-arrow-right me-2 text-muted"></i> Pengiriman data antar jaringan</li>
                            <li class="mb-2"><i class="bi bi-arrow-right me-2 text-muted"></i> Routing statik: konfigurasi manual</li>
                            <li class="mb-2"><i class="bi bi-arrow-right me-2 text-muted"></i> Routing dinamik: RIP, OSPF, BGP</li>
                            <li><i class="bi bi-arrow-right me-2 text-muted"></i> Menggunakan tabel routing</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

            </div>
          </div>
        </div>

        <!-- Section 2: Network Services -->
        <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed bg-light text-dark py-3 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <i class="bi bi-server me-2 text-primary"></i> 2. Sistem Layanan Jaringan
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#materiAccordion">
            <div class="accordion-body">
              <div class="row g-3">
                <div class="col-md-4">
                  <div class="card h-100 border">
                    <div class="card-header bg-light text-dark d-flex align-items-center border-bottom">
                      <i class="bi bi-globe me-2 text-primary"></i> DNS
                    </div>
                    <div class="card-body">
                      <p class="card-text">Menerjemahkan nama domain ke alamat IP (contoh: google.com → 172.217.0.0)</p>
                      <div class="d-flex align-items-center text-muted">
                        <i class="bi bi-info-circle me-2"></i>
                        <small>Port 53 (UDP/TCP)</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card h-100 border">
                    <div class="card-header bg-light text-dark d-flex align-items-center border-bottom">
                      <i class="bi bi-hdd-network me-2 text-primary"></i> DHCP
                    </div>
                    <div class="card-body">
                      <p class="card-text">Memberikan alamat IP otomatis ke perangkat dalam jaringan</p>
                      <div class="d-flex align-items-center text-muted">
                        <i class="bi bi-info-circle me-2"></i>
                        <small>Port 67/68 (UDP)</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card h-100 border">
                    <div class="card-header bg-light text-dark d-flex align-items-center border-bottom">
                      <i class="bi bi-server me-2 text-primary"></i> Web Server
                    </div>
                    <div class="card-body">
                      <p class="card-text">Menyediakan layanan situs web menggunakan HTTP/HTTPS (Apache, Nginx)</p>
                      <div class="d-flex align-items-center text-muted">
                        <i class="bi bi-info-circle me-2"></i>
                        <small>Port 80/443 (TCP)</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Section 3: Network Security -->
        <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed bg-light text-dark py-3 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              <i class="bi bi-shield-lock me-2 text-primary"></i> 3. Keamanan Jaringan
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#materiAccordion">
            <div class="accordion-body">
              <div class="alert alert-light d-flex align-items-center border">
                <i class="bi bi-exclamation-triangle me-3 fs-4 text-warning"></i>
                <div>Keamanan jaringan adalah aspek kritis dalam infrastruktur TI modern.</div>
              </div>
              
              <!-- Security Cards -->
              <div class="row g-3 mb-4">
                <div class="col-md-4">
                  <div class="card h-100 border">
                    <div class="card-header bg-light text-dark d-flex align-items-center border-bottom">
                      <i class="bi bi-fire me-2 text-danger"></i> Firewall
                    </div>
                    <div class="card-body">
                      <p>Mengatur lalu lintas data berdasarkan aturan tertentu untuk melindungi jaringan internal</p>
                      <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle me-2 text-muted"></i> Stateful Inspection</li>
                        <li><i class="bi bi-check-circle me-2 text-muted"></i> Packet Filtering</li>
                        <li><i class="bi bi-check-circle me-2 text-muted"></i> Proxy Service</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card h-100 border">
                    <div class="card-header bg-light text-dark d-flex align-items-center border-bottom">
                      <i class="bi bi-file-lock2 me-2 text-success"></i> Enkripsi
                    </div>
                    <div class="card-body">
                      <p>Melindungi data dengan teknik kriptografi</p>
                      <ul class="list-unstyled">
                        <li><i class="bi bi-lock me-2 text-muted"></i> SSL/TLS</li>
                        <li><i class="bi bi-lock me-2 text-muted"></i> VPN</li>
                        <li><i class="bi bi-lock me-2 text-muted"></i> IPSec</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card h-100 border">
                    <div class="card-header bg-light text-dark d-flex align-items-center border-bottom">
                      <i class="bi bi-bug me-2 text-danger"></i> MITM Attack
                    </div>
                    <div class="card-body">
                      <p>Penyadapan data antara dua pihak</p>
                      <div class="alert alert-sm alert-light mb-0 border">
                        <i class="bi bi-lightbulb me-2 text-warning"></i> Pencegahan: SSL, VPN, DNSSEC
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Wireless Security -->
              <h5 class="fw-bold mb-3 text-dark d-flex align-items-center">
                <i class="bi bi-wifi me-2 text-muted"></i> Keamanan Jaringan Nirkabel
              </h5>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="card h-100 border">
                    <div class="card-header bg-light text-dark border-bottom">
                      <i class="bi bi-shield-check me-2 text-success"></i> Protokol Keamanan
                    </div>
                    <div class="card-body">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <div>
                            <i class="bi bi-wifi me-2 text-primary"></i> WPA2/WPA3
                          </div>
                          <span class="badge bg-light text-dark border rounded-pill">Enkripsi</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <div>
                            <i class="bi bi-filter-square me-2 text-primary"></i> MAC Filtering
                          </div>
                          <span class="badge bg-light text-dark border rounded-pill">Akses Kontrol</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card h-100 border">
                    <div class="card-header bg-light text-dark d-flex align-items-center border-bottom">
                      <i class="bi bi-shield-exclamation me-2 text-danger"></i> Serangan Umum
                    </div>
                    <div class="card-body">
                      <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-exclamation-triangle me-2 text-danger"></i> Evil Twin</li>
                        <li class="mb-2"><i class="bi bi-exclamation-triangle me-2 text-danger"></i> Packet Sniffing</li>
                        <li><i class="bi bi-exclamation-triangle me-2 text-danger"></i> Deauthentication Attack</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <img src="https://www.parallels.com/blogs/ras/app/uploads/2021/06/network-security-diagram.png" alt="Network Security" class="img-fluid rounded">
              </div>
            </div>
          </div>
        </div>

        <!-- Section 4: Network Practice -->
        <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
          <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed bg-light text-dark py-3 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              <i class="bi bi-terminal me-2 text-primary"></i> 4. Praktik Jaringan
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#materiAccordion">
            <div class="accordion-body">
              <p class="lead">Penggunaan perangkat jaringan dan konfigurasi dasar.</p>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="card h-100 border">
                    <div class="card-header bg-light text-dark border-bottom">
                      <i class="bi bi-router me-2 text-primary"></i> Perangkat Jaringan
                    </div>
                    <div class="card-body">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">Router dan Switch konfigurasi dasar</li>
                        <li class="list-group-item">Subnet Mask dan IP Addressing</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card h-100 border">
                    <div class="card-header bg-light text-dark border-bottom">
                      <i class="bi bi-command me-2 text-primary"></i> Perintah Dasar
                    </div>
                    <div class="card-body">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">ping, traceroute, ipconfig/ifconfig</li>
                        <li class="list-group-item">Pengujian koneksi dan troubleshooting</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>

      {{-- Navigasi materi --}}
      <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center">
          <a href="#" class="text-primary text-decoration-none small fw-semibold">
            ← Materi Sebelumnya
          </a>
          <a href="#" class="text-primary text-decoration-none small fw-semibold">
            Materi Selanjutnya →
          </a>
        </div>
      </div>

      <!-- Quiz Section with Bootstrap -->
      <section class="mt-5">
        <div class="card border-primary shadow">
          <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="bi bi-trophy me-2"></i> Evaluasi Pembelajaran
          </div>
          <div class="card-body">
            
            <!-- Local Quiz -->
            <div class="mt-5">
              <div class="card border-secondary">
                <div class="card-header bg-light text-dark d-flex align-items-center border-bottom">
                  <i class="bi bi-question-circle me-2 text-primary"></i> Quiz Singkat: Pilih Jawaban yang Benar
                </div>
                <div class="card-body">
                  <form id="quizForm">
                    <div class="mb-3">
                      <label class="form-label fw-bold">1. Berapa banyak lapisan pada model OSI?</label>
                      <select class="form-select" id="q1" required>
                        <option value="" disabled selected>Pilih jawaban</option>
                        <option value="5">5</option>
                        <option value="7">7</option>
                        <option value="4">4</option>
                        <option value="6">6</option>
                      </select>
                    </div>
                    <div class="mb-4">
                      <label class="form-label fw-bold">2. Protokol utama dalam internet yang dibahas adalah?</label>
                      <select class="form-select" id="q2" required>
                        <option value="" disabled selected>Pilih jawaban</option>
                        <option value="HTTP">HTTP</option>
                        <option value="TCP/IP">TCP/IP</option>
                        <option value="FTP">FTP</option>
                        <option value="SMTP">SMTP</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary px-4">
                      <i class="bi bi-check-circle me-2"></i> Cek Jawaban
                    </button>
                  </form>
                  <div id="quizResult" class="mt-4"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
  
  body {
    font-family: 'Poppins', sans-serif;
  }
  
  .accordion-button {
    font-weight: 500;
  }
  
  .card {
    transition: transform 0.2s, box-shadow 0.2s;
  }
  
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  }
  
  .nav-tabs .nav-link {
    font-weight: 500;
  }
  
  .list-group-item {
    border-left: 0;
    border-right: 0;
  }
  
  .quiz-section .card-header {
    font-size: 1.1rem;
  }
</style>



<script>
  document.getElementById("quizForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const jawabanBenar = {
      q1: "7",
      q2: "TCP/IP"
    };

    const q1 = document.getElementById("q1").value;
    const q2 = document.getElementById("q2").value;

    let skor = 0;
    if (q1 === jawabanBenar.q1) skor++;
    if (q2 === jawabanBenar.q2) skor++;

    // Tentukan pesan motivasi
    let motivasi = "";
    if (skor === 2) {
      motivasi = "Luar biasa! Kamu telah memahami materi dengan sangat baik. Terus pertahankan!";
    } else if (skor === 1) {
      motivasi = "Bagus, tapi masih ada yang perlu ditingkatkan. Coba pelajari ulang bagian yang belum dipahami.";
    } else {
      motivasi = "Jangan putus asa! Ayo pelajari kembali materi dan coba lagi ya!";
    }

    let hasil = `
      <div class="alert ${skor === 2 ? 'alert-success' : (skor === 1 ? 'alert-warning' : 'alert-danger')}">
        <h5 class="mb-2">Hasil Evaluasi:</h5>
        <ul class="mb-2">
          <li><strong>Soal 1:</strong> ${q1 === jawabanBenar.q1 ? 'Benar' : 'Salah'} (${q1})</li>
          <li><strong>Soal 2:</strong> ${q2 === jawabanBenar.q2 ? 'Benar' : 'Salah'} (${q2})</li>
        </ul>
        <p><strong>Skor Anda:</strong> ${skor}/2</p>
        <hr>
        <p class="mb-0"><strong>Motivasi:</strong> ${motivasi}</p>
      </div>
    `;

    document.getElementById("quizResult").innerHTML = hasil;
  });
</script>
@endsection