<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;

class MateriTetapController extends Controller
{
    public function tcpIp()
    {
        return view('siswa.materi.tcp_ip');
    }

    public function layananJaringan()
    {
        return view('siswa.materi.layanan_jaringan');
    }

    public function keamananJaringan()
    {
        return view('siswa.materi.keamanan_jaringan');
    }

    public function seluler()
    {
        return view('siswa.materi.seluler');
    }

    public function optik()
    {
        return view('siswa.materi.optik');
    }
}
