@extends('guru.guru_master')

@section('guru')
<div class="container classroom-container__content" id="tutorial-content" style="margin-left: auto;">
    <div class="py-4 my-2">
        <div class="mb-5 fr-view academy-tutorial-content content--prettify-light js-content-prettify">
            <h2 class="text-center fw-bold">📡 Sistem TCP/IP</h2>

            <!-- Video Responsif -->
            <div class="video-container text-center my-4">
                <iframe width="100%" height="400" src="https://www.youtube.com/embed/cbAO3e40wxI?si=ZO_iF1QXvjiHPsA3"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>

            <!-- Intro -->
            <p class="fs-5 text-center text-primary">
                Selamat datang di kelas <strong>Belajar Dasar-Dasar Teknik Jaringan Komputer dan Telekomunikasi!</strong> 🎉
            </p>

            <p class="fs-6">
                Di kelas ini, kita akan mempelajari konsep dasar jaringan komputer, teknologi telekomunikasi, serta cara kerja perangkat jaringan yang digunakan dalam kehidupan sehari-hari.
                Anda akan memahami bagaimana data dikirim, diterima, dan diamankan dalam suatu jaringan.
            </p>

            <div class="alert alert-info">
                <strong>📖 Materi yang akan kita bahas:</strong>
            </div>

            <ul class="list-group">
                <li class="list-group-item">🔹 Pengantar Jaringan Komputer dan Telekomunikasi</li>
                <li class="list-group-item">🔹 Jenis-jenis Jaringan (LAN, MAN, WAN)</li>
                <li class="list-group-item">🔹 Perangkat Jaringan (Router, Switch, Hub, dll.)</li>
                <li class="list-group-item">🔹 Model OSI dan TCP/IP</li>
                <li class="list-group-item">🔹 Dasar-Dasar Keamanan Jaringan</li>
                <li class="list-group-item">🔹 Konfigurasi Dasar Jaringan</li>
            </ul>

            <p class="fs-6 mt-3">
                Kelas ini dirancang untuk membantu Anda memahami konsep secara teori dan praktik, sehingga Anda dapat mengembangkan keterampilan yang diperlukan dalam dunia teknologi jaringan.
            </p>

            <div class="text-center mt-4">
                <a href="{{ route('guru.modul')}}" class="btn btn-primary">Mulai Belajar 🚀</a>
            </div>
        </div>
    </div>
</div>

<style>
    .video-container iframe {
        max-width: 800px;
        height: 400px;
    }

    @media (max-width: 768px) {
        .video-container iframe {
            height: 250px;
        }
    }
</style>

@endsection