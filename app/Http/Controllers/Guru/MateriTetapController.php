<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;

class MateriTetapController extends Controller
{
    public function tcpIp()
    {
        return view('guru.materi.tcp_ip');
    }

    public function layananJaringan()
    {
        return view('guru.materi.layanan_jaringan');
    }

    public function keamananJaringan()
    {
        return view('guru.materi.keamanan_jaringan');
    }

        public function seluler()
    {
        return view('guru.materi.seluler');
    }

    public function optik()
    {
        return view('guru.materi.optik');
    }
}
