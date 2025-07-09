<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
 public function index()
    {
        // Ambil data materi dengan pagination
        $materi = Materi::latest()->paginate(9);

        // Jika pakai fitur search
        if ($search = request('search')) {
            $materi = Materi::where('judul', 'like', "%{$search}%")
                ->latest()
                ->paginate(9);
        }

        return view('guru.materi.index', compact('materi'));
    }
    public function create()
    {
        return view('guru.materi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'nullable|string',
            'file'   => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480',
        ]);

        $filename = null;

        if ($request->hasFile('file')) {
            $filename = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('public/materi', $filename);
        }

        Materi::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'file' => $filename,
            'guru_id' => auth()->id(),
        ]);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $materi = Materi::where('id', $id)->where('guru_id', auth()->id())->firstOrFail();
        return view('guru.materi.edit', compact('materi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480',
        ]);

        $materi = Materi::where('id', $id)->where('guru_id', auth()->id())->firstOrFail();

        if ($request->hasFile('file')) {
            if ($materi->file) {
                Storage::delete('public/materi/' . $materi->file);
            }

            $filename = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('public/materi', $filename);
            $materi->file = $filename;
        }

        $materi->judul = $request->judul;
        $materi->konten = $request->konten;
        $materi->save();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $materi = Materi::where('id', $id)->where('guru_id', auth()->id())->firstOrFail();

        if ($materi->file) {
            Storage::delete('public/materi/' . $materi->file);
        }

        $materi->delete();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dihapus!');
    }

    public function showTcpIp()
    {
        return view('guru.materi.tcp_ip', [
            'title' => 'Prinsip Dasar TCP/IP',
            'materi' => [
                'judul' => 'TCP/IP',
                'konten' => '...isi materi...',
                'last_updated' => now()->format('Y-m-d')
            ]
        ]);
    }
    public function showLayananJaringan()
    {
        return view('guru.materi.layanan_jaringan', [
            'title' => 'Prinsip Dasar Layanan Jaringan',
            'materi' => $this->getLayananJaringanContent()
        ]);
    }

    /**
     * Menampilkan materi Keamanan Jaringan
     */
    public function showKeamananJaringan()
    {
        return view('guru.materi.keamanan_jaringan', [
            'title' => 'Prinsip Dasar Keamanan Jaringan',
            'materi' => $this->getKeamananJaringanContent()
        ]);
    }

    /**
     * Konten materi TCP/IP (bisa dipindah ke database/config file jika perlu)
     */
    protected function getTcpIpContent()
    {
        return [
            'judul' => 'Prinsip Dasar TCP/IP',
            'deskripsi' => 'Memahami model referensi TCP/IP dan protokol jaringan',
            'konten' => [
                'Model TCP/IP vs OSI',
                'Lapisan jaringan (Application, Transport, Internet, Network Access)',
                'Protokol utama (HTTP, TCP, UDP, IP, ICMP)',
                'Konfigurasi dasar alamat IP'
            ],
            'last_updated' => '2023-10-15'
        ];
    }

    /**
     * Konten materi Layanan Jaringan
     */
    protected function getLayananJaringanContent()
    {
        return [
            'judul' => 'Prinsip Dasar Layanan Jaringan',
            'deskripsi' => 'Memahami fungsi dan prinsip kerja layanan jaringan',
            'konten' => [
                'HTTP/HTTPS - Port 80/443',
                'DHCP - Port 67/68',
                'DNS - Port 53',
                'FTP - Port 20/21',
                'Email (SMTP, POP3, IMAP)'
            ],
            'last_updated' => '2023-10-20'
        ];
    }

    /**
     * Konten materi Keamanan Jaringan
     */
    protected function getKeamananJaringanContent()
    {
        return [
            'judul' => 'Prinsip Dasar Keamanan Jaringan',
            'deskripsi' => 'Memahami ancaman dan proteksi jaringan',
            'konten' => [
                'Ancaman jaringan (spoofing, sniffing, DDoS)',
                'Kriptografi dasar',
                'Keamanan WLAN (WPA, WPA2)',
                'Firewall dan MAC filtering'
            ],
            'last_updated' => '2023-10-25'
        ];
    }
    
}
