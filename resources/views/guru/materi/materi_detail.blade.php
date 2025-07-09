@extends('guru.guru_master')

@section('guru')
<script src="//unpkg.com/alpinejs" defer></script>

<div class="container-fluid py-4">
    <div class="row">
        {{-- TOC Sidebar --}}
        <nav class="col-md-3 d-none d-md-block position-sticky top-0" style="height: 100vh;" id="toc-sidebar">
            <div class="p-3 bg-light rounded shadow-sm">
                <h6 class="text-primary">Daftar Isi</h6>
                <nav class="nav flex-column">
                    <a class="nav-link py-1" href="#section1">1. Prinsip Dasar TCP/IP</a>
                    <a class="nav-link py-1" href="#section2">2. Sistem Layanan Jaringan</a>
                    <a class="nav-link py-1" href="#section3">3. Keamanan Jaringan</a>
                    <a class="nav-link py-1" href="#section4">4. Sistem Telekomunikasi</a>
                    <a class="nav-link py-1" href="#quiz">Quiz Interaktif</a>
                </nav>
            </div>
        </nav>

        {{-- Main Content --}}
        <main class="col-md-9" x-data="{ quizStarted: false, score: 0, answered: false, selected: null }">
            <div class="mb-3">
                <a href="{{ route('guru.materi.index') }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">

                    <h1 class="display-6 text-primary fw-bold text-center mb-4">Pengantar TCP/IP dan Jaringan</h1>

                    {{-- Content Sections --}}
                    <section id="section1" class="mb-5">
                        <h4 class="fw-bold text-dark">1. Prinsip Dasar TCP/IP</h4>
                        <p>Penjelasan tentang OSI vs TCP/IP, alamat IP, subnetting, dan routing.</p>
                        {{-- Contoh isi lengkap ada di versi sebelumnya --}}
                    </section>

                    <section id="section2" class="mb-5">
                        <h4 class="fw-bold text-dark">2. Sistem Layanan Jaringan</h4>
                        <p>DNS, DHCP, dan Web Server.</p>
                    </section>

                    <section id="section3" class="mb-5">
                        <h4 class="fw-bold text-dark">3. Keamanan Jaringan</h4>
                        <p>Firewall, Enkripsi, dan Serangan MITM.</p>
                    </section>

                    <section id="section4" class="mb-5">
                        <h4 class="fw-bold text-dark">4. Sistem Telekomunikasi</h4>
                        <p>3G/4G/5G, Microwave, VSAT, Fiber Optik, WLAN.</p>
                    </section>

                    {{-- Quiz Interaktif --}}
                    <section id="quiz" class="mb-5">
                        <h4 class="fw-bold text-dark">Quiz Interaktif</h4>

                        <template x-if="!answered">
                            <div>
                                <p class="text-dark">Apa fungsi utama dari protokol DHCP?</p>
                                <div class="form-check" x-data>
                                    <input class="form-check-input" type="radio" name="quiz" id="opt1" value="1" x-model="selected">
                                    <label class="form-check-label" for="opt1">Mengubah alamat IP ke nama domain</label>
                                </div>
                                <div class="form-check" x-data>
                                    <input class="form-check-input" type="radio" name="quiz" id="opt2" value="2" x-model="selected">
                                    <label class="form-check-label" for="opt2">Menghubungkan ke server DNS</label>
                                </div>
                                <div class="form-check" x-data>
                                    <input class="form-check-input" type="radio" name="quiz" id="opt3" value="3" x-model="selected">
                                    <label class="form-check-label" for="opt3">Memberikan alamat IP secara otomatis</label>
                                </div>

                                <button class="btn btn-sm btn-primary mt-3" @click="answered = true; score = selected == 3 ? 1 : 0;">
                                    Cek Jawaban
                                </button>
                            </div>
                        </template>

                        <template x-if="answered">
                            <div class="alert" :class="score === 1 ? 'alert-success' : 'alert-danger'">
                                <span x-text="score === 1 ? 'Benar! DHCP memberikan alamat IP secara otomatis.' : 'Jawaban salah. DHCP memberikan alamat IP secara otomatis.'"></span>
                            </div>
                        </template>
                    </section>

                    {{-- Navigasi Materi --}}
                    <div class="d-flex justify-content-between mt-5 border-top pt-4">
                        @if($previous)
                            <a href="{{ route('materi.show', $previous->id) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left-circle"></i> {{ $previous->judul }}
                            </a>
                        @else
                            <div></div>
                        @endif

                        @if($next)
                            <a href="{{ route('materi.show', $next->id) }}" class="btn btn-outline-primary">
                                {{ $next->judul }} <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>

@endsection
