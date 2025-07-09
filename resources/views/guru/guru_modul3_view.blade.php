@extends('guru.guru_master')

@section('guru')
<div class="container classroom-container__content" id="tutorial-content" style="margin-left: auto;">
    <div class="py-4 my-2">
        <div class="mb-5 fr-view academy-tutorial-content content--prettify-light js-content-prettify">
            <h2 class="text-center fw-bold">🌐 Prinsip Dasar Layanan Jaringan</h2>

            <!-- Video Responsif -->
            <div class="video-container text-center my-4">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/WPhjxoVDygk?si=LC9P9K1D1dvHLmfd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>

            <!-- Intro -->
            <p class="fs-5 text-center text-primary">
                Selamat datang di kelas <strong>Prinsip Dasar Layanan Jaringan!</strong> 🚀
            </p>

            <p class="fs-6">
                Kita akan memahami bagaimana layanan jaringan berfungsi dan mempelajari teknologi penting seperti server, protokol, dan keamanan jaringan.
            </p>

            <div class="alert alert-info">
                <strong>📚 Materi Utama:</strong>
            </div>

            <ul class="list-group mb-4">
                <li class="list-group-item">🔹 Konsep Dasar Layanan Jaringan</li>
                <li class="list-group-item">🔹 Server dan Client</li>
                <li class="list-group-item">🔹 Protokol Jaringan (HTTP, FTP, SMTP, DNS)</li>
                <li class="list-group-item">🔹 Model Client-Server dan Peer-to-Peer</li>
                <li class="list-group-item">🔹 Keamanan Layanan Jaringan</li>
            </ul>

            <p class="fs-6 mt-4">
                Coba quiz interaktif ini untuk menguji pemahamanmu! 🎯
            </p>

            <!-- Quiz Interaktif -->
            <div class="mt-5 p-4 rounded shadow-sm" style="background-color: #e9f5ff;">
                <h5 class="fw-bold text-center mb-4 text-primary">🧠 Quiz Interaktif</h5>

                <div class="quiz-box p-3 mb-4 bg-white rounded" style="border: 1px solid #b3d7ff;">
                    <p class="fw-bold">1. Apa protokol untuk mengirim email?</p>
                    <div class="list-group">
                        <button class="list-group-item list-group-item-action" onclick="checkAnswer(this, false)">HTTP</button>
                        <button class="list-group-item list-group-item-action" onclick="checkAnswer(this, true)">SMTP</button>
                        <button class="list-group-item list-group-item-action" onclick="checkAnswer(this, false)">FTP</button>
                    </div>
                </div>

                <div class="quiz-box p-3 mb-4 bg-white rounded" style="border: 1px solid #b3d7ff;">
                    <p class="fw-bold">2. Model apa yang menggambarkan 7 lapisan komunikasi jaringan?</p>
                    <div class="list-group">
                        <button class="list-group-item list-group-item-action" onclick="checkAnswer(this, false)">TCP/IP</button>
                        <button class="list-group-item list-group-item-action" onclick="checkAnswer(this, true)">OSI</button>
                    </div>
                </div>

            </div>

            <div class="text-center mt-5">
                <a href="https://drive.google.com/file/d/1eNvqLOPXtpyeQ4xXTxmTe-gCthkMdnlK/view?usp=sharing" class="btn btn-success">Mulai Belajar Lengkap 📖</a>
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
    .list-group-item.correct {
        background-color: #d4edda;
        color: #155724;
        font-weight: bold;
    }
    .list-group-item.incorrect {
        background-color: #f8d7da;
        color: #721c24;
    }
</style>

<script>
function checkAnswer(button, isCorrect) {
    // Reset semua pilihan dalam satu grup
    const buttons = button.parentElement.querySelectorAll('button');
    buttons.forEach(btn => {
        btn.classList.remove('correct', 'incorrect');
        btn.innerHTML = btn.innerHTML.replace('✔️', '').replace('❌', '');
    });

    // Tandai jawaban
    if (isCorrect) {
        button.classList.add('correct');
        button.innerHTML += ' ✔️';
    } else {
        button.classList.add('incorrect');
        button.innerHTML += ' ❌';
    }
}
</script>

@endsection