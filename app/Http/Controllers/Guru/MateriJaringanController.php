<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MateriJaringanController extends Controller
{
    /**
     * Menampilkan modul prinsip dasar layanan jaringan
     */
    public function showNetworkingService()
    {
        // Data untuk tabel port dan protokol
        $protocols = [
            ['HTTP', 'TCP', '80, 443'],
            ['DHCP', 'UDP', '67, 68'],
            ['DNS', 'UDP/TCP', '53'],
            ['FTP', 'TCP', '20, 21'],
            ['SMTP', 'TCP', '25']
        ];

        // Data untuk kuis
        $quizData = [
            'drag_drop' => [
                ['HTTP', 'Transfer data web'],
                ['DHCP', 'Memberikan alamat IP'],
                ['DNS', 'Mengubah nama domain ke IP'],
                ['FTP', 'Transfer file']
            ],
            'port_quiz' => [
                [
                    'question' => 'HTTP',
                    'options' => [80, 25, 53, 67],
                    'answer' => 80
                ],
                [
                    'question' => 'DNS',
                    'options' => [80, 25, 53, 67],
                    'answer' => 53
                ],
                [
                    'question' => 'SMTP',
                    'options' => [80, 25, 53, 67],
                    'answer' => 25
                ],
                [
                    'question' => 'DHCP Server',
                    'options' => [80, 25, 53, 67],
                    'answer' => 67
                ]
            ]
        ];

        return view('guru.materi.networking', [
            'protocols' => $protocols,
            'quizData' => $quizData
        ]);
    }

    /**
     * Untuk menangani submit kuis (jika diperlukan)
     */
    public function handleQuiz(Request $request)
    {
        $answers = $request->validate([
            'quiz_type' => 'required|string',
            'answers' => 'required|array'
        ]);

        // Logika penilaian kuis bisa ditambahkan di sini
        return response()->json([
            'success' => true,
            'message' => 'Jawaban berhasil disimpan'
        ]);
    }
}