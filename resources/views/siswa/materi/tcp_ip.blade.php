@extends('siswa.siswa_master')

@section('siswa')    

<div class="main-wrapper">
    <div class="container-fluid py-5">
        <!-- Header dengan Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 px-4"> <!-- Added px-4 for padding -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('siswa.siswa_master')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('siswa.materi.index')}}">Materi</a></li>
                <li class="breadcrumb-item active" style="color: var(--text-dark);" aria-current="page">Prinsip Dasar TCP/IP</li>
            </ol>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="network-grid"></div>
            <div class="particles" id="particles"></div>
            
            <div class="container-fluid text-center position-relative z-3 px-4"> <!-- Changed to container-fluid and added px-4 -->
                <div class="row justify-content-center">
                    <div class="col-12"> <!-- Changed col-lg-10 to col-12 for full width -->
                        <h1 class="display-2 fw-bold mb-4 fade-in" style="text-shadow: 0 0 20px var(--primary-color);">
                            Prinsip Dasar <span style="background: linear-gradient(90deg, var(--primary-color), var(--secondary-color)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">TCP/IP</span>
                        </h1>
                        
                        <p class="lead mb-5 fade-in" style="font-size: 1.2rem; color: var(--text-dark);">
                            Memahami Protokol Jaringan yang Menjadi Fondasi Internet Modern
                        </p>
                        
                        <!-- Interactive TCP/IP Stack in Hero -->
                        <div class="tcp-stack fade-in mx-auto">
                            <div class="stack-layer" data-layer-id="app-hero">
                                <h5><i class="fas fa-window-maximize me-2"></i>Application Layer</h5>
                                <p class="mb-0">HTTP, HTTPS, FTP, SMTP, DNS</p>
                            </div>
                            <div class="stack-layer" data-layer-id="transport-hero">
                                <h5><i class="fas fa-exchange-alt me-2"></i>Transport Layer</h5>
                                <p class="mb-0">TCP, UDP</p>
                            </div>
                            <div class="stack-layer" data-layer-id="internet-hero">
                                <h5><i class="fas fa-globe me-2"></i>Internet Layer</h5>
                                <p class="mb-0">IP, ICMP, ARP</p>
                            </div>
                            <div class="stack-layer" data-layer-id="network-hero">
                                <h5><i class="fas fa-ethernet me-2"></i>Network Access</h5>
                                <p class="mb-0">Ethernet, Wi-Fi</p>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap justify-content-center gap-3 mb-5 fade-in">
                            <button class="neon-btn" onclick="scrollToSection('introduction-section')">
                                <i class="fas fa-rocket me-2"></i>Mulai Belajar
                            </button>
                            <button class="neon-btn" onclick="startInteractiveDemo()">
                                <i class="fas fa-play-circle me-2"></i>Demo Interaktif
                            </button>
                        </div>

                        <!-- Protocol Badges -->
                        <div class="fade-in">
                            <div class="protocol-badge">HTTP/HTTPS</div>
                            <div class="protocol-badge">FTP/SFTP</div>
                            <div class="protocol-badge">SMTP/POP3</div>
                            <div class="protocol-badge">DNS</div>
                            <div class="protocol-badge">DHCP</div>
                            <div class="protocol-badge">SSH</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal for Layer Info -->
        <div id="layerInfoModal" class="modal-custom">
            <div class="modal-content-custom">
                <span class="close-button-custom" onclick="closeLayerInfoModal()">&times;</span>
                <h3 id="modalLayerTitle" class="mb-3"></h3>
                <p id="modalLayerDescription"></p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container-fluid px-4" id="content">
            <div class="row justify-content-center">
                <!-- Main Content Area -->
                <div class="col-12"> <!-- Changed col-lg-10 to col-12 for full width -->
                    <!-- Peta Konsep Section -->
                    <section id="peta-konsep-section" class="mb-5 fade-in">
                        <div class="interactive-card">
                            <h2 class="h3 mb-4 text-center">
                                <i class="fas fa-map-marked-alt me-3"></i>Peta Konsep TCP/IP
                            </h2>
                            <p class="text-center mt-4 opacity-75" style="color: var(--text-dark);">
                                Materi ini menunjukkan bagaimana Prinsip Dasar TCP/IP dan Alamat IP merupakan fondasi penting dalam memahami media dan jaringan telekomunikasi.
                            </p>
                        </div>
                    </section>

                    <!-- Introduction Section -->
                    <section id="introduction-section" class="mb-5 fade-in">
                        <div class="interactive-card">                    
                            <div class="alert alert-info border-0" style="background: var(--glass-bg); border-left: 4px solid var(--primary-color) !important; color: var(--text-dark);">
                                <h5><i class="fas fa-lightbulb me-2"></i>Definisi</h5>
                                <p class="mb-0">TCP/IP (Transmission Control Protocol/Internet Protocol) adalah <strong>suite protokol komunikasi</strong> yang menjadi fondasi utama internet dan seluruh jaringan komputer modern di dunia.</p>
                            </div>

                            <ol class="opacity-75" style="color: var(--text-dark);">
                                TCP/IP bukanlah sebuah protokol tunggal, melainkan <strong>kumpulan protokol yang bekerja secara harmonis</strong> untuk memungkinkan komunikasi antar perangkat dalam jaringan, dari perangkat sederhana hingga infrastruktur internet global.
                            </ol>

                            <section id="video-section" class="mb-5 fade-in">
                                <div class="interactive-card">
                                    <h2 class="h3 mb-4">
                                        <i class="fas fa-video me-3"></i>Video Pendukung: Memahami TCP/IP
                                    </h2>
                                    <p class="opacity-75" style="color: var(--text-dark);">Untuk pemahaman yang lebih mendalam, saksikan video animasi penjelasan mengenai TCP/IP Protocol berikut:</p>
                                    <div class="ratio ratio-16x9 rounded-lg overflow-hidden shadow-lg">
                                        <!-- Changed from iframe to video tag for local video control -->
                                        <video id="video-player-tcp-ip" controls preload="metadata" style="width: 100%; height: 100%;">
                                            <source src="{{ asset('homepage/img/tcp.mp4')}}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>

                                    <p class="text-center mt-3 opacity-75 small" style="color: var(--text-dark);">Sumber video: Learn About TCP/IP (dari channel "TALtech Media")</p>
                                </div>
                            </section>

                            <!-- Interactive Timeline -->
                            <h5 class="mt-4 mb-3" style="color: var(--text-dark);">
                                <i class="fas fa-history me-2"></i>Perjalanan Sejarah TCP/IP
                            </h5>
                            <div class="timeline-container">
                                <div class="timeline-item" data-year="1969">
                                    <div class="timeline-badge">1969</div>
                                    <div class="timeline-content">
                                        <h6>Kelahiran ARPANET</h6>
                                        <p>Departemen Pertahanan AS meluncurkan ARPANET, cikal bakal internet dengan hanya 4 node komputer.</p>
                                    </div>
                                </div>
                                <div class="timeline-item" data-year="1974">
                                    <div class="timeline-badge">1974</div>
                                    <div class="timeline-content">
                                        <h6>Spesifikasi TCP Pertama</h6>
                                        <p>Vint Cerf dan Bob Kahn mempublikasikan spesifikasi Transmission Control Protocol (TCP).</p>
                                    </div>
                                </div>
                                <div class="timeline-item" data-year="1978">
                                    <div class="timeline-badge">1978</div>
                                    <div class="timeline-content">
                                        <h6>Pemisahan TCP dan IP</h6>
                                        <p>TCP dibagi menjadi dua protokol terpisah: TCP untuk kontrol transmisi dan IP untuk pengalamatan.</p>
                                    </div>
                                </div>
                                <div class="timeline-item" data-year="1983">
                                    <div class="timeline-badge">1983</div>
                                    <div class="timeline-content">
                                        <h6>Adopsi Resmi TCP/IP</h6>
                                        <p>ARPANET secara resmi beralih menggunakan TCP/IP sebagai protokol standar.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Transmission Control Protocol (TCP) Section -->
                    <section id="tcp-section" class="mb-5 slide-in-left">
                        <div class="interactive-card">
                            <h2 class="h3 mb-4">
                                <i class="fas fa-upload me-3"></i>1. Transmission Control Protocol (TCP)
                            </h2>
                            
                            <h4 class="mb-3" style="color: var(--text-dark);">a. Fungsi TCP dan IP</h4>
                            <p class="opacity-75" style="color: var(--text-dark);">TCP/IP sendiri terdiri atas dua bagian dengan fungsi yang berbeda:</p>
                            <ul class="list-unstyled" style="color: var(--text-dark);">
                                <li><i class="fas fa-check-circle text-primary me-2"></i><strong>TCP:</strong> Berfungsi untuk mengatur bagaimana paket data dikirim dan diterima, memastikan pengiriman yang andal.</li>
                                <li><i class="fas fa-check-circle text-primary me-2"></i><strong>IP:</strong> Berfungsi untuk mengatur pengalamatan paket data yang akan dikirimkan, memastikan data sampai ke tujuan yang benar.</li>
                            </ul>

                            <h4 class="mt-5 mb-3" style="color: var(--text-dark);">b. Encapsulation dan Decapsulation (Interaktif)</h4>
                            <p class="opacity-75" style="color: var(--text-dark);">Prinsip kerja jaringan komputer dan telekomunikasi sebenarnya mengikuti prinsip-prinsip di dunia nyata. Mari kita menyimak analogi berikut:</p>
                            <ol class="opacity-75" style="color: var(--text-dark);">
                                <li>Kalian akan memasukkan barang ke sebuah wadah/bungkus. Prinsip kerja TCP pada bagian ini disebut <strong>Encapsulation</strong>.</li>
                                <li>Pada bungkus paket tersebut, kalian menuliskan alamat tujuan. Bagian ini disebut <strong>TCP header</strong>. Di dalamnya terdapat informasi tentang alamat IP (IP address), yaitu destination IP, destination port sebagai soket tujuan.</li>
                                <li>Selanjutnya, paket tersebut akan dikirimkan oleh jasa pengiriman barang atau kurir. Pada bagian ini, jasa kurir dapat menggunakan metode <strong>CSMA/CD (Carrier Sense Multiple Access with Collision Detection)</strong> yang dimiliki oleh standar ethernet.</li>
                                <li>Setelah paket diterima oleh teman kalian, header akan dibuang dan bungkus/wadah akan dibuka untuk diambil isinya. Proses ini disebut <strong>Decapsulation</strong>.</li>
                            </ol>
                            <div class="alert alert-warning" style="background: var(--glass-bg); border-left: 4px solid var(--accent-color) !important; color: var(--text-dark);">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i>Analogi CSMA/CD</h5>
                                <p class="mb-0">Bayangkan kalian berkomunikasi dengan teman. Saat teman berbicara, kalian mendengarkan. Begitu pula ketika kalian berbicara, teman kalian mendengarkan. Jika kalian berbicara bersamaan, itu disebut "bertengkar" atau dalam jaringan disebut <strong>collision</strong> (tabrakan data). CSMA/CD memastikan jalur komunikasi kosong sebelum mengirim data.</p>
                            </div>
                            <h5 class="text-center mt-4 mb-3" style="color: var(--text-dark);">Simulasi Aliran Data Encapsulation/Decapsulation:</h5>
                            <div class="data-flow d-flex justify-content-between align-items-center flex-wrap">
                                <div class="text-center mb-3">
                                    <img src="https://placehold.co/100x100/1E90FF/FFFFFF?text=PC+Pengirim" alt="" class="img-fluid rounded-circle mb-2" style="box-shadow: 0 0 10px rgba(30, 144, 255, 0.6);">
                                    <p class="small" style="color: var(--text-dark);">PC Pengirim</p>
                                </div>
                                <div class="flex-grow-1 text-center position-relative">
                                    <div class="data-packet" style="left: -70px; top: 50%; transform: translateY(-50%); animation-delay: 0s;">Data App</div>
                                    <div class="data-packet" style="left: -70px; top: 50%; transform: translateY(-50%); animation-delay: 1s;">+ TCP Header</div>
                                    <div class="data-packet" style="left: -70px; top: 50%; transform: translateY(-50%); animation-delay: 2s;">+ IP Header</div>
                                    <div class="data-packet" style="left: -70px; top: 50%; transform: translateY(-50%); animation-delay: 3s;">+ Ethernet</div>
                                    <h6 style="color: var(--text-dark);">Aliran Data</h6>
                                </div>
                                <div class="text-center mb-3">
                                    <img src="https://placehold.co/100x100/32CD32/FFFFFF?text=PC+Penerima" alt="" class="img-fluid rounded-circle mb-2" style="box-shadow: 0 0 10px rgba(50, 205, 50, 0.6);">
                                    <p class="small" style="color: var(--text-dark);">PC Penerima</p>
                                </div>
                            </div>

                            <h4 class="mt-5 mb-3" style="color: var(--text-dark);">c. TCP Sequence Number dan Error Recovery</h4>
                            <p class="opacity-75" style="color: var(--text-dark);">Pada pengiriman paket dalam jaringan komputer menggunakan protokol TCP/IP, tidak langsung semua dikirim dan diterima, tetapi ada pemecahan paket menjadi bagian-bagian lebih kecil untuk dikirim, kemudian disusun kembali menjadi paket utuh.</p>
                            <p class="opacity-75" style="color: var(--text-dark);"><strong>Analogi Rak Buku:</strong> Bayangkan kalian mengirimkan rak buku besar ke rumah teman yang berada di gang sempit. Kalian akan melepas rak tersebut menjadi beberapa bagian kecil dan memberikan urutan berdasarkan bagian-bagian dari rak tersebut. Pengurutan ini dinamakan <strong>sequence number</strong>.</p>
                            <p class="opacity-75" style="color: var(--text-dark);">Selanjutnya, kalian dapat mengirimkan rak tersebut melalui gang satu per satu sampai ke dalam rumah berdasarkan sequence number. Setelah di dalam rumah, kalian menyatukan kembali rak tersebut. Jika ada bagian yang hilang dari rak tersebut, kalian dapat mengetahui berdasarkan sequence number tadi. Kalian hanya perlu mengirim paket dengan sequence number yang hilang. Ini adalah salah satu fitur dari TCP, yaitu <strong>error recovery</strong> (pemulihan setelah terjadi kegagalan).</p>

                            <h4 class="mt-5 mb-3" style="color: var(--text-dark);">d. TCP Three Way Handshake (Animasi)</h4>
                            <p class="opacity-75" style="color: var(--text-dark);">Komunikasi antara perangkat komputer sumber dan perangkat komputer tujuan diawali dengan melakukan tiga langkah jabat tangan (three way handshake) sebagai salam perkenalan.</p>
                            <p class="opacity-75" style="color: var(--text-dark);">Setiap paket harus mempunyai nomor pengenal yang dinamakan sebagai <strong>sequence number ($SEQ$)</strong>. Selain itu, ada juga <strong>Acknowledgements ($ACK$)</strong>, yaitu kode pengenal balasan dari perangkat komputer tujuan.</p>
                            <div class="alert alert-info" style="background: var(--glass-bg); border-left: 4px solid var(--primary-color) !important; color: var(--text-dark);">
                                <h5><i class="fas fa-handshake me-2"></i>Prinsip Kerja Three Way Handshake:</h5>
                                <ol class="opacity-75" style="color: var(--text-dark);">
                                    <li><strong>Langkah 1 (SYN):</strong> PC A (misal $SEQ=100$) mengirim paket SYN (synchronize sequence) ke PC B dengan $ACK=0$. Ini adalah "Halo, saya siap berbicara."</li>
                                    <li><strong>Langkah 2 (SYN-ACK):</strong> PC B (misal $SEQ=200$) menerima SYN dari PC A. Kemudian, PC B membalas dengan paket SYN-ACK, yang berisi $ACK=100+10$ (mengindikasikan paket selanjutnya yang diharapkan dari PC A) dan $SEQ=200$ (mengindikasikan $SEQ$ PC B). Ini adalah "Halo juga, saya siap berbicara, dan saya menunggu balasanmu."</li>
                                    <li><strong>Langkah 3 (ACK):</strong> PC A menerima SYN-ACK dari PC B. PC A kemudian mengirimkan paket ACK dengan $ACK=210$ (mengindikasikan paket selanjutnya yang diharapkan dari PC B) dan $SEQ=110$ (mengindikasikan $SEQ$ PC A). Ini adalah "Oke, saya siap."</li>
                                </ol>
                                <p class="mb-0 opacity-75" style="color: var(--text-dark);">Sampai tahap ini komunikasi telah terjalin dengan baik. Pada proses selanjutnya, nilai sequence number akan bertambah bergantung pada ACK yang diinginkan dari komputer sumber dan komputer tujuan.</p>
                            </div>

                            <h5 class="text-center mt-4 mb-3" style="color: var(--text-dark);">Visualisasi Three Way Handshake:</h5>
                            <div class="handshake-demo position-relative">
                                <div id="handshake-step-1" class="handshake-step">
                                    <div class="client"><i class="fas fa-desktop"></i> PC A</div>
                                    <div class="flex-grow-1 text-center position-relative">
                                        <div class="packet-animation" id="packet1" style="left: 0; top: 50%;"></div>
                                        <span style="color: var(--text-dark);">SYN (Seq=100, ACK=0)</span>
                                        <div class="arrow-line arrow-head-right"></div>
                                    </div>
                                    <div class="server"><i class="fas fa-server"></i> PC B</div>
                                </div>
                                <div id="handshake-step-2" class="handshake-step">
                                    <div class="client"><i class="fas fa-desktop"></i> PC A</div>
                                    <div class="flex-grow-1 text-center position-relative">
                                        <div class="packet-animation" id="packet2" style="right: 0; top: 50%;"></div>
                                        <span style="color: var(--text-dark);">SYN-ACK (Seq=200, ACK=110)</span>
                                        <div class="arrow-line arrow-head-left"></div>
                                    </div>
                                    <div class="server"><i class="fas fa-server"></i> PC B</div>
                                </div>
                                <div id="handshake-step-3" class="handshake-step">
                                    <div class="client"><i class="fas fa-desktop"></i> PC A</div>
                                    <div class="flex-grow-1 text-center position-relative">
                                        <div class="packet-animation" id="packet3" style="left: 0; top: 50%;"></div>
                                        <span style="color: var(--text-dark);">ACK (Seq=110, ACK=210)</span>
                                        <div class="arrow-line arrow-head-right"></div>
                                    </div>
                                    <div class="server"><i class="fas fa-server"></i> PC B</div>
                                </div>
                                <div class="d-flex justify-content-center gap-3 mt-4">
                                    <button class="neon-btn" onclick="startHandshakeAnimation()">Mulai Animasi</button>
                                    <button class="neon-btn" onclick="resetHandshakeAnimation()">Reset</button>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- TCP/IP vs OSI Model -->
                    <section id="models-comparison-section" class="mb-5 slide-in-right">
                        <div class="interactive-card">
                            <h2 class="h3 mb-4">
                                <i class="fas fa-layer-group me-3"></i>
                                Model TCP/IP vs OSI: Perbandingan Mendalam
                            </h2>

                            <ol class="opacity-75" style="color: var(--text-dark);">
                                Kedua model ini adalah <strong>kerangka konseptual</strong> yang membantu kita memahami bagaimana komunikasi jaringan bekerja, namun dengan pendekatan yang berbeda.
                            </ol>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="model-comparison osi-model">
                                        <h5 class="text-center mb-3">
                                            <i class="fas fa-layer-group me-2"></i>Model OSI (7 Lapisan)
                                        </h5>
                                        <div class="osi-layers">
                                            <div class="model-layer" data-layer-id="osi-7">
                                                <span class="layer-number">7</span>
                                                <div class="layer-info">
                                                    <strong>Application</strong>
                                                    <small>Interface dengan aplikasi pengguna</small>
                                                </div>
                                            </div>
                                            <div class="model-layer" data-layer-id="osi-6">
                                                <span class="layer-number">6</span>
                                                <div class="layer-info">
                                                    <strong>Presentation</strong>
                                                    <small>Enkripsi, kompresi, format data</small>
                                                </div>
                                            </div>
                                            <div class="model-layer" data-layer-id="osi-5">
                                                <span class="layer-number">5</span>
                                                <div class="layer-info">
                                                    <strong>Session</strong>
                                                    <small>Manajemen sesi komunikasi</small>
                                                </div>
                                            </div>
                                            <div class="model-layer" data-layer-id="osi-4">
                                                <span class="layer-number">4</span>
                                                <div class="layer-info">
                                                    <strong>Transport</strong>
                                                    <small>Kontrol aliran, error detection</small>
                                                </div>
                                            </div>
                                            <div class="model-layer" data-layer-id="osi-3">
                                                <span class="layer-number">3</span>
                                                <div class="layer-info">
                                                    <strong>Network</strong>
                                                    <small>Routing dan pengalamatan logis</small>
                                                </div>
                                            </div>
                                            <div class="model-layer" data-layer-id="osi-2">
                                                <span class="layer-number">2</span>
                                                <div class="layer-info">
                                                    <strong>Data Link</strong>
                                                    <small>Frame, MAC address, error detection</small>
                                                </div>
                                            </div>
                                            <div class="model-layer" data-layer-id="osi-1">
                                                <span class="layer-number">1</span>
                                                <div class="layer-info">
                                                    <strong>Physical</strong>
                                                    <small>Transmisi bit, media fisik</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="model-comparison tcp-model">
                                        <h5 class="text-center mb-3">
                                            <i class="fas fa-network-wired me-2"></i>Model TCP/IP (4 Lapisan)
                                        </h5>
                                        <div class="tcpip-layers">
                                            <div class="model-layer" data-layer-id="tcp-4">
                                                <span class="layer-number">4</span>
                                                <div class="layer-info">
                                                    <strong>Application</strong>
                                                    <small>Menggabungkan layer 5, 6, 7 OSI</small>
                                                    <div class="protocols">HTTP, FTP, SMTP, DNS</div>
                                                </div>
                                            </div>
                                            <div class="model-layer" data-layer-id="tcp-3">
                                                <span class="layer-number">3</span>
                                                <div class="layer-info">
                                                    <strong>Transport</strong>
                                                    <small>Sama dengan layer 4 OSI</small>
                                                    <div class="protocols">TCP, UDP</div>
                                                </div>
                                            </div>
                                            <div class="model-layer" data-layer-id="tcp-2">
                                                <span class="layer-number">2</span>
                                                <div class="layer-info">
                                                    <strong>Internet</strong>
                                                    <small>Sama dengan layer 3 OSI</small>
                                                    <div class="protocols">IP, ICMP, ARP</div>
                                                </div>
                                            </div>
                                            <div class="model-layer" data-layer-id="tcp-1">
                                                <span class="layer-number">1</span>
                                                <div class="layer-info">
                                                    <strong>Network Access</strong>
                                                    <small>Menggabungkan layer 1, 2 OSI</small>
                                                    <div class="protocols">Ethernet, Wi-Fi</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <section id="video-osi-section" class="mb-5 fade-in">
                                <div class="interactive-card">
                                    <h2 class="h3 mb-4">
                                        <i class="fas fa-video me-3"></i>Video Pendukung: Memahami OSI Layer
                                    </h2>
                                    <p class="opacity-75" style="color: var(--text-dark);">Untuk pemahaman yang lebih mendalam, saksikan video animasi penjelasan mengenai OSI Layer berikut:</p>
                                    <div class="ratio ratio-16x9 rounded-lg overflow-hidden shadow-lg">
                                        <!-- Changed from iframe to video tag for local video control -->
                                        <video id="video-player-osi-layer" controls preload="metadata" style="width: 100%; height: 100%;">
                                            <source src="{{ asset('homepage/img/osi layer.mp4')}}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    <p class="text-center mt-3 opacity-75 small" style="color: var(--text-dark);">Sumber video: Learn About OSI Layer (dari channel "Sultan Ilyas Arsal")</p>
                                </div>
                            </section>
                        </div>
                    </section>

                    <!-- Internet Protocol (IP) Section -->
                    <section id="ip-section" class="mb-5 fade-in">
                        <div class="interactive-card">
                            <h2 class="h3 mb-4">
                                <i class="fas fa-network-wired me-3"></i>2. Internet Protocol (IP)
                            </h2>
                            <p class="opacity-75" style="color: var(--text-dark);">Internet Protocol (IP) menempati lapisan ketiga model TCP/IP, yaitu Network, berfungsi menyediakan informasi alamat IP sumber, alamat IP tujuan, dan routing protokol. Setiap perangkat akhir pengguna pasti memiliki <strong>alamat IP (IP address)</strong>.</p>

                            <h4 class="mt-4 mb-3" style="color: var(--text-dark);">a. IP Header</h4>
                            <p class="opacity-75" style="color: var(--text-dark);">IP header memiliki ukuran 32 bit atau 4 byte. Berikut adalah komponen-komponen utama dalam IP header:</p>
                            <ul class="list-unstyled opacity-75" style="color: var(--text-dark);">
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>Version:</strong> Informasi versi IP (IPv4 atau IPv6).</li>
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>Header Length:</strong> Panjang header IPv4 (min 5, max 20 bit).</li>
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>Type of Services (QoS):</strong> Digunakan untuk Quality of Service, menandai paket untuk perlakuan tertentu (misal prioritas).</li>
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>Total Length:</strong> Ukuran seluruh paket IP (header dan data), 16 bit, maks 65.535 bit.</li>
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>Identification:</strong> Nomor pengenal 16 bit untuk paket yang difragmentasi.</li>
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>IP Flag:</strong> 3 bit untuk fragmentasi (DF - don’t fragment, MF - more fragment).</li>
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>Fragment Offset:</strong> 13 bit untuk menentukan posisi paket yang difragmentasi.</li>
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>Time to Live (TTL):</strong> Membatasi perjalanan paket, dikurangi 1 setiap melewati router. Jika 0, paket dibuang untuk mencegah looping.</li>
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>Protocol:</strong> Informasi protokol yang digunakan (TCP=6, UDP=17).</li>
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>Header Checksum:</strong> 16 bit untuk pemeriksaan kesalahan header.</li>
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>Source Address:</strong> Alamat IP sumber (32 bit).</li>
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>Destination Address:</strong> Alamat IP tujuan (32 bit).</li>
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>IP Option:</strong> Pilihan tambahan, jika terisi, panjang header bertambah. Contoh: route source.</li>
                                <li><i class="fas fa-dot-circle text-primary me-2"></i><strong>Data:</strong> Data yang dienkapsulasi dari lapisan atas.</li>
                            </ul>

                            <h4 class="mt-5 mb-3" style="color: var(--text-dark);">b. Alamat IP (IP Address)</h4>
                            <p class="opacity-75" style="color: var(--text-dark);">Alamat IPv4 terdiri dari 32 bit biner yang dibagi menjadi 4 oktet (1 oktet = 8 bit). Ada dua format penulisan:</p>
                            <ul class="list-unstyled opacity-75" style="color: var(--text-dark);">
                                <li><i class="fas fa-code text-primary me-2"></i><strong>Bilangan Desimal Bertitik:</strong> Contoh: <code>192.168.0.1</code></li>
                                <li><i class="fas fa-binary text-primary me-2"></i><strong>Bilangan Biner:</strong> Contoh: <code>11000000.10101000.00000000.00000001</code></li>
                            </ul>
                            <h5 class="text-center mt-4 mb-3" style="color: var(--text-dark);">Visualisasi IPv4 Oktet:</h5>
                            <div class="ip-visualizer">
                                <span class="ip-octet" onclick="showOctetInfo(1)">192</span>.
                                <span class="ip-octet" onclick="showOctetInfo(2)">168</span>.
                                <span class="ip-octet" onclick="showOctetInfo(3)">0</span>.
                                <span class="ip-octet" onclick="showOctetInfo(4)">1</span>
                            </div>
                            <p id="octet-info" class="text-center opacity-75 small mt-2" style="color: var(--text-dark);">Klik oktet di atas untuk melihat detailnya!</p>

                            <h4 class="mt-5 mb-3" style="color: var(--text-dark);">c. Kelas Alamat IP (Interaktif)</h4>
                            <p class="opacity-75" style="color: var(--text-dark);">Untuk mempermudah penggunaan alamat IPv4 dan menyesuaikannya dengan kebutuhan jaringan (jumlah pengguna atau host), alamat IPv4 dikelompokkan berdasarkan kelas:</p>
                            <h5 class="text-center mt-4 mb-3" style="color: var(--text-dark);">Pilih Kelas IP untuk Melihat Detail:</h5>
                            <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                                <button class="neon-btn ip-class-btn active" data-class="classA" onclick="showIpClassInfo('classA', this)">Kelas A</button>
                                <button class="neon-btn ip-class-btn" data-class="classB" onclick="showIpClassInfo('classB', this)">Kelas B</button>
                                <button class="neon-btn ip-class-btn" data-class="classC" onclick="showIpClassInfo('classC', this)">Kelas C</button>
                                <button class="neon-btn ip-class-btn" data-class="classD" onclick="showIpClassInfo('classD', this)">Kelas D</button>
                                <button class="neon-btn ip-class-btn" data-class="classE" onclick="showIpClassInfo('classE', this)">Kelas E</button>
                            </div>

                            <div id="ip-class-details-display" class="alert alert-info" style="background: var(--glass-bg); border-left: 4px solid var(--accent-color) !important; color: var(--text-dark);">
                                <p id="ip-class-description" class="mb-2"></p>
                                <p id="ip-class-range" class="font-weight-bold"></p>
                            </div>

                            <h4 class="mt-5 mb-3" style="color: var(--text-dark);">d. IP Privat dan IP Global</h4>
                            <p class="opacity-75" style="color: var(--text-dark);">Berdasarkan RFC 1918, alamat IPv4 untuk jaringan lokal (IP Privat) dapat menggunakan tiga kelas:</p>
                            <ul class="list-unstyled opacity-75" style="color: var(--text-dark);">
                                <li><i class="fas fa-lock text-info me-2"></i><strong>Kelas A:</strong> <code>10.0.0.0 – 10.255.255.255</code></li>
                                <li><i class="fas fa-lock text-info me-2"></i><strong>Kelas B:</strong> <code>172.16.0.0 – 172.31.255.255</code></li>
                                <li><i class="fas fa-lock text-info me-2"></i><strong>Kelas C:</strong> <code>192.168.0.0 – 192.168.255.255</code></li>
                            </ul>
                            <p class="opacity-75" style="color: var(--text-dark);">Di luar alamat IP Privat adalah <strong>IP Global</strong> atau sering disebut <strong>IP Publik</strong>, yaitu IP unik yang digunakan untuk koneksi internet. IP Global bersifat unik karena tidak memiliki duplikasi di internet.</p>
                        </div>
                    </section>

                    <!-- Quiz Sederhana Section -->
                    <section id="quiz-section" class="mb-5 fade-in">
                        <div class="quiz-card">
                            <h2 class="h3 mb-4">
                                <i class="fas fa-question-circle me-3"></i>Uji Pemahaman: Kuis Sederhana
                            </h2>
                            <div id="quiz-container">
                                <!-- Question 1 -->
                                <div class="question-block mb-4">
                                    <p class="mb-3" style="color: var(--text-dark);"><strong>1. Protokol apa yang bertanggung jawab untuk memastikan pengiriman data yang andal dan terurut dalam suite TCP/IP?</strong></p>
                                    <div class="mb-2 quiz-option" data-question="q1" data-answer="a">
                                        <input type="radio" name="q1" value="a" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">a. TCP</label>
                                    </div>
                                    <div class="mb-2 quiz-option" data-question="q1" data-answer="b">
                                        <input type="radio" name="q1" value="b" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">b. IP</label>
                                    </div>
                                    <div class="mb-2 quiz-option" data-question="q1" data-answer="c">
                                        <input type="radio" name="q1" value="c" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">c. UDP</label>
                                    </div>
                                    <div class="mb-4 quiz-option" data-question="q1" data-answer="d">
                                        <input type="radio" name="q1" value="d" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">d. ICMP</label>
                                    </div>
                                </div>

                                <!-- Question 2 -->
                                <div class="question-block mb-4">
                                    <p class="mb-3" style="color: var(--text-dark);"><strong>2. Dalam analogi pengiriman paket, proses pembungkusan data dengan header TCP dan IP disebut apa?</strong></p>
                                    <div class="mb-2 quiz-option" data-question="q2" data-answer="a">
                                        <input type="radio" name="q2" value="a" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">a. Encapsulation</label>
                                    </div>
                                    <div class="mb-2 quiz-option" data-question="q2" data-answer="b">
                                        <input type="radio" name="q2" value="b" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">b. Decapsulation</label>
                                    </div>
                                    <div class="mb-2 quiz-option" data-question="q2" data-answer="c">
                                        <input type="radio" name="q2" value="c" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">c. Fragmentation</label>
                                    </div>
                                    <div class="mb-4 quiz-option" data-question="q2" data-answer="d">
                                        <input type="radio" name="q2" value="d" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">d. Reassembly</label>
                                    </div>
                                </div>

                                <!-- Question 3 -->
                                <div class="question-block mb-4">
                                    <p class="mb-3" style="color: var(--text-dark);"><strong>3. Apa tujuan dari "Three Way Handshake" dalam koneksi TCP?</strong></p>
                                    <div class="mb-2 quiz-option" data-question="q3" data-answer="b">
                                        <input type="radio" name="q3" value="a" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">a. Untuk mengakhiri koneksi.</label>
                                    </div>
                                    <div class="mb-2 quiz-option" data-question="q3" data-answer="b">
                                        <input type="radio" name="q3" value="b" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">b. Untuk membangun koneksi yang andal antara dua host.</label>
                                    </div>
                                    <div class="mb-2 quiz-option" data-question="q3" data-answer="c">
                                        <input type="radio" name="q3" value="c" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">c. Untuk mengirimkan data tanpa konfirmasi.</label>
                                    </div>
                                    <div class="mb-4 quiz-option" data-question="q3" data-answer="d">
                                        <input type="radio" name="q3" value="d" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">d. Untuk menemukan alamat MAC.</label>
                                    </div>
                                </div>

                                <!-- Question 4 -->
                                <div class="question-block mb-4">
                                    <p class="mb-3" style="color: var(--text-dark);"><strong>4. Lapisan manakah dalam model TCP/IP yang bertanggung jawab untuk pengalamatan logis (IP address) dan routing paket antar jaringan?</strong></p>
                                    <div class="mb-2 quiz-option" data-question="q4" data-answer="a">
                                        <input type="radio" name="q4" value="a" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">a. Internet Layer</label>
                                    </div>
                                    <div class="mb-2 quiz-option" data-question="q4" data-answer="b">
                                        <input type="radio" name="q4" value="b" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">b. Application Layer</label>
                                    </div>
                                    <div class="mb-2 quiz-option" data-question="q4" data-answer="c">
                                        <input type="radio" name="q4" value="c" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">c. Transport Layer</label>
                                    </div>
                                    <div class="mb-4 quiz-option" data-question="q4" data-answer="d">
                                        <input type="radio" name="q4" value="d" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">d. Network Access Layer</label>
                                    </div>
                                </div>

                                <!-- Question 5 -->
                                <div class="question-block mb-4">
                                    <p class="mb-3" style="color: var(--text-dark);"><strong>5. Alamat IP kelas C biasanya digunakan untuk jaringan dengan jumlah host yang relatif kecil, dengan berapa bit pertama yang selalu diset untuk mengidentifikasi kelas ini?</strong></p>
                                    <div class="mb-2 quiz-option" data-question="q5" data-answer="c">
                                        <input type="radio" name="q5" value="a" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">a. 0 (1 bit)</label>
                                    </div>
                                    <div class="mb-2 quiz-option" data-question="q5" data-answer="b">
                                        <input type="radio" name="q5" value="b" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">b. 10 (2 bit)</label>
                                    </div>
                                    <div class="mb-2 quiz-option" data-question="q5" data-answer="c">
                                        <input type="radio" name="q5" value="c" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">c. 110 (3 bit)</label>
                                    </div>
                                    <div class="mb-4 quiz-option" data-question="q5" data-answer="d">
                                        <input type="radio" name="q5" value="d" class="d-none">
                                        <label class="w-100 cursor-pointer" style="color: var(--text-dark);">d. 1110 (4 bit)</label>
                                    </div>
                                </div>
                                
                                <button onclick="checkQuiz()" class="neon-btn w-100 mt-3">Periksa Jawaban</button>
                                <p id="quiz-feedback" class="mt-4 font-weight-bold text-center"></p>
                                <!-- Next Material Button - Hidden by default -->
                                <a href="{{ route('siswa.materi.index')}}" id="nextMaterialBtn" class="neon-btn w-100 mt-3 d-none">Lanjut ke Materi Berikutnya <i class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <!-- Video Quiz Modal Structure -->
        <div id="videoQuizModal" class="video-quiz-modal-overlay">
            <div class="video-quiz-modal-content">
                <h4 id="videoQuizQuestion"></h4>
                <div id="videoQuizOptions" class="video-quiz-modal-options mb-3">
                    <!-- Options will be dynamically loaded here -->
                </div>
                <p id="videoQuizFeedback" class="video-quiz-modal-feedback"></p>
                <button id="videoQuizContinueBtn" class="neon-btn mt-3 d-none" onclick="continueVideo()">Lanjutkan Video</button>
            </div>
        </div>

        <style>
            /* Color Variables */
            :root {
                --primary-color: #3B82F6; /* Bright Blue */
                --secondary-color: #6366F1; /* Vibrant Indigo */
                --accent-color: #FACC15; /* Bright Yellow */
                --light-bg: #FFFFFF; /* Pure White background */
                --lighter-bg: #F8FAFC; /* Off-white for cards */
                --glass-bg: rgba(255, 255, 255, 0.7); /* More transparent white for glass effect */
                --text-dark: #1F2937; /* Dark text for contrast */
                --text-muted-light: #4B5563; /* Muted dark text */
                
                /* Shadows for a bright and prominent look */
                --shadow-bright-blue: 0 0 15px rgba(59, 130, 246, 0.4), 0 0 30px rgba(59, 130, 246, 0.2);
                --shadow-bright-indigo: 0 0 15px rgba(99, 102, 241, 0.4), 0 0 30px rgba(99, 102, 241, 0.2);
                --shadow-bright-yellow: 0 0 15px rgba(250, 204, 21, 0.6), 0 0 30px rgba(250, 204, 21, 0.4);
                --button-shadow-bright: 0 5px 15px rgba(59, 130, 246, 0.3);
                --header-shadow-bright: 0 0 40px rgba(59, 130, 246, 0.2);

                /* Alert backgrounds - made slightly more opaque for light theme */
                --alert-success-bg: rgba(40, 167, 69, 0.15); /* Lighter green */
                --alert-warning-bg: rgba(255, 193, 7, 0.15); /* Lighter yellow */
                --alert-danger-bg: rgba(220, 53, 69, 0.15); /* Lighter red */
                --alert-info-bg: rgba(23, 162, 184, 0.15); /* Lighter cyan */
            }

            /* Global Styles */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Poppins', sans-serif;
                background: var(--light-bg); /* Use pure white background */
                color: var(--text-dark); /* Dark text for contrast */
                overflow-x: hidden;
                font-size: 1.1rem; /* Base font size for body text */
            }

            /* Adjust default Bootstrap heading sizes for consistency */
            h1 { font-size: 3.5rem; } /* Adjusted from display-2 */
            h2 { font-size: 2.2rem; }
            h3 { font-size: 1.8rem; }
            h4 { font-size: 1.5rem; }
            h5 { font-size: 1.3rem; }
            h6 { font-size: 1.1rem; } /* Match body text if not explicitly styled otherwise */

            p { font-size: 1.1rem; } /* Ensure paragraphs match base font size */
            ol, ul { font-size: 1.1rem; } /* Ensure lists match base font size */
            small { font-size: 0.9rem; } /* Consistent small text */


            /* Hero Section */
            .hero-section {
                min-height: 100vh;
                position: relative;
                background: linear-gradient(135deg, #E0F2FE 0%, #BFDBFE 100%); /* Light blue gradient */
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                box-shadow: var(--header-shadow-bright);
            }

            /* Network Grid Animation */
            .network-grid {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-image: 
                    linear-gradient(rgba(59, 130, 246, 0.1) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
                background-size: 50px 50px;
                animation: gridMove 20s linear infinite;
                opacity: 0.8;
            }

            @keyframes gridMove {
                0% { transform: translate(0, 0); }
                100% { transform: translate(50px, 50px); }
            }

            /* Floating Particles */
            .particles {
                position: absolute;
                width: 100%;
                height: 100%;
                overflow: hidden;
            }

            .particle {
                position: absolute;
                width: 5px;
                height: 5px;
                background: var(--primary-color);
                border-radius: 50%;
                box-shadow: 0 0 10px var(--primary-color);
                animation: float 6s infinite ease-in-out;
            }

            @keyframes float {
                0%, 100% { 
                    transform: translateY(100vh) translateX(0);
                    opacity: 0;
                }
                10%, 90% { 
                    opacity: 0.8;
                }
                50% { 
                    transform: translateY(-100px) translateX(100px);
                }
            }

            /* Interactive TCP/IP Stack */
            .tcp-stack {
                perspective: 1000px;
                margin: 2rem auto; /* Changed margin to auto for horizontal centering */
                width: 80%;
                max-width: 600px;
            }

            .stack-layer {
                background: var(--glass-bg);
                border: 2px solid rgba(59, 130, 246, 0.3); /* Brighter border */
                border-radius: 15px;
                padding: 20px;
                margin: 10px 0;
                transform-style: preserve-3d;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                cursor: pointer;
                backdrop-filter: blur(5px); /* Slightly less blur for brighter theme */
                position: relative;
                overflow: hidden;
                text-align: center;
                color: var(--text-dark);
                box-shadow: var(--shadow-bright-blue);
            }

            .stack-layer::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.2), transparent);
                transition: left 0.5s;
            }

            .stack-layer:hover::before {
                left: 100%;
            }

            .stack-layer:hover {
                transform: translateZ(50px) rotateX(5deg);
                box-shadow: var(--shadow-bright-indigo);
                border-color: var(--primary-color);
            }

            .stack-layer.active {
                background: rgba(59, 130, 246, 0.2);
                transform: scale(1.05) translateZ(30px);
                box-shadow: var(--shadow-bright-yellow);
            }

            .stack-layer h5 {
                font-size: 1.3rem; /* Consistent with h5 */
                color: var(--primary-color);
            }
            .stack-layer p {
                font-size: 1.1rem; /* Consistent with body text */
                color: var(--text-muted-light);
            }

            /* Data Flow Animation */
            .data-flow {
                position: relative;
                height: 400px;
                background: var(--lighter-bg); /* Use lighter background for data flow */
                border-radius: 20px;
                margin: 2rem 0;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
                border: 1px solid rgba(59, 130, 246, 0.2);
                box-shadow: var(--shadow-bright-blue);
            }

            .data-packet {
                position: absolute;
                width: 80px;
                height: 40px;
                background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.95rem; /* Slightly smaller for packet labels */
                font-weight: bold;
                box-shadow: 0 0 15px var(--primary-color);
                animation: packetFlow 4s infinite ease-in-out;
                color: white;
            }

            @keyframes packetFlow {
                0% { 
                    left: -70px; 
                    opacity: 0;
                    transform: scale(0.8);
                }
                10% { 
                    opacity: 1;
                    transform: scale(1);
                }
                90% { 
                    opacity: 1;
                    transform: scale(1);
                }
                100% { 
                    left: calc(100% + 70px); 
                    opacity: 0;
                    transform: scale(0.8);
                }
            }

            /* Interactive Cards */
            .interactive-card {
                background: var(--lighter-bg); /* Use lighter background for cards */
                border: 1px solid rgba(59, 130, 246, 0.2);
                border-radius: 20px;
                padding: 2rem;
                margin: 1rem 0;
                backdrop-filter: blur(5px);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                cursor: pointer;
                position: relative;
                overflow: hidden;
                color: var(--text-dark);
                box-shadow: var(--shadow-bright-blue);
            }

            .interactive-card::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(45deg, transparent, rgba(59, 130, 246, 0.1), transparent);
                transform: translateX(-100%);
                transition: transform 0.6s;
            }

            .interactive-card:hover::after {
                transform: translateX(100%);
            }

            .interactive-card:hover {
                transform: translateY(-10px) scale(1.02);
                box-shadow: var(--shadow-bright-indigo);
                border-color: var(--primary-color);
            }

            /* Handshake Animation */
            .handshake-demo {
                background: var(--lighter-bg); /* Use lighter background */
                border-radius: 20px;
                padding: 2rem;
                margin: 2rem 0;
                position: relative;
                overflow: hidden;
                border: 1px solid rgba(59, 130, 246, 0.2);
                box-shadow: var(--shadow-bright-blue);
            }

            .handshake-step {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin: 1rem 0;
                opacity: 0.5;
                transition: all 0.5s ease;
                color: var(--text-dark);
                font-size: 1.1rem; /* Consistent with body text */
            }

            .handshake-step.active {
                opacity: 1;
                transform: scale(1.05);
            }

            .client, .server {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px; /* Icon size, not text size */
                color: white;
                box-shadow: 0 0 15px var(--primary-color);
            }

            .arrow-line {
                flex: 1;
                height: 4px;
                background: var(--primary-color);
                margin: 0 1rem;
                position: relative;
                border-radius: 2px;
            }

            .arrow-head-right::after {
                content: '';
                position: absolute;
                right: -10px;
                top: -6px;
                width: 0;
                height: 0;
                border-left: 10px solid var(--primary-color);
                border-top: 7px solid transparent;
                border-bottom: 7px solid transparent;
            }
            .arrow-head-left::after {
                content: '';
                position: absolute;
                left: -10px;
                top: -6px;
                width: 0;
                height: 0;
                border-right: 10px solid var(--primary-color);
                border-top: 7px solid transparent;
                border-bottom: 7px solid transparent;
            }
            .packet-animation {
                position: absolute;
                background: var(--primary-color);
                width: 20px;
                height: 20px;
                border-radius: 50%;
                box-shadow: 0 0 10px var(--primary-color);
                opacity: 0;
                transition: all 0.5s ease-out;
            }

            /* IP Address Visualizer */
            .ip-visualizer {
                background: var(--lighter-bg); /* Use lighter background */
                border-radius: 20px;
                padding: 2rem;
                margin: 2rem 0;
                text-align: center;
                border: 1px solid rgba(59, 130, 246, 0.2);
                box-shadow: var(--shadow-bright-blue);
                color: var(--text-dark);
            }

            .ip-octet {
                display: inline-block;
                background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
                padding: 10px 15px;
                margin: 5px;
                border-radius: 10px;
                font-weight: bold;
                transition: all 0.3s ease;
                cursor: pointer;
                color: white;
                font-size: 1.2rem; /* Slightly larger for emphasis */
                box-shadow: 0 0 15px var(--primary-color);
            }

            .ip-octet:hover {
                transform: scale(1.1);
                box-shadow: 0 0 25px var(--secondary-color);
            }

            /* Protocol Badge Animation */
            .protocol-badge {
                display: inline-block;
                background: rgba(59, 130, 246, 0.1);
                color: var(--primary-color);
                padding: 8px 16px;
                margin: 5px;
                border-radius: 25px;
                border: 1px solid var(--primary-color);
                font-family: 'Courier New', monospace;
                font-weight: bold;
                transition: all 0.3s ease;
                cursor: pointer;
                position: relative;
                overflow: hidden;
                box-shadow: 0 0 10px rgba(59, 130, 246, 0.2);
                font-size: 0.95rem; /* Consistent with small text or slightly larger */
            }

            .protocol-badge::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.2), transparent);
                transition: left 0.5s;
            }

            .protocol-badge:hover::before {
                left: 100%;
            }

            .protocol-badge:hover {
                background: rgba(59, 130, 246, 0.2);
                transform: translateY(-5px);
                box-shadow: 0 0 20px var(--secondary-color);
                color: var(--primary-color);
            }

            /* Buttons */
            .neon-btn {
                background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
                color: white;
                border: none;
                padding: 12px 30px;
                border-radius: 50px;
                font-weight: bold;
                text-transform: uppercase;
                letter-spacing: 1px;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
                cursor: pointer;
                box-shadow: var(--button-shadow-bright);
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 1rem; /* Consistent button text size */
            }

            .neon-btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: left 0.5s;
            }

            .neon-btn:hover::before {
                left: 100%;
            }

            .neon-btn:hover {
                background: linear-gradient(45deg, #2563EB, #4F46E5); /* Darker shades on hover */
                box-shadow: 0 0 30px var(--accent-color);
                transform: translateY(-5px);
                color: white;
            }

            /* Progress Bar (if used) */
            .learning-progress {
                background: rgba(59, 130, 246, 0.1); /* Lighter background for progress bar */
                border-radius: 50px;
                padding: 5px;
                margin: 2rem auto;
                max-width: 800px;
                box-shadow: var(--shadow-bright-blue);
            }

            .progress-fill {
                height: 20px;
                background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
                border-radius: 50px;
                transition: width 0.5s ease;
                position: relative;
                overflow: hidden;
            }

            .progress-fill::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                animation: progressShine 2s infinite;
            }

            @keyframes progressShine {
                0% { transform: translateX(-100%); }
                100% { transform: translateX(100%); }
            }

            /* Quiz Section */
            .quiz-card {
                background: var(--lighter-bg); /* Lighter background for quiz card */
                border-radius: 20px;
                padding: 2rem;
                margin: 1rem 0;
                backdrop-filter: blur(5px);
                border: 1px solid rgba(59, 130, 246, 0.2);
                color: var(--text-dark);
                box-shadow: var(--shadow-bright-blue);
            }

            .quiz-option {
                background: rgba(59, 130, 246, 0.05); /* Very light blue tint for options */
                border: 1px solid rgba(59, 130, 246, 0.2);
                border-radius: 15px;
                padding: 1rem;
                margin: 0.5rem 0;
                cursor: pointer;
                transition: all 0.3s ease;
                position: relative;
                color: var(--text-dark);
                font-size: 1.1rem; /* Consistent with body text */
            }

            .quiz-option:hover {
                border-color: var(--primary-color);
                background: rgba(59, 130, 246, 0.1);
            }

            .quiz-option.selected {
                border-color: var(--primary-color);
                background: rgba(59, 130, 246, 0.2);
                font-weight: bold;
            }

            .quiz-option.correct {
                border-color: #28a745; /* Bootstrap success green */
                background: var(--alert-success-bg);
                box-shadow: 0 0 10px rgba(40, 167, 69, 0.3);
            }

            .quiz-option.incorrect {
                border-color: #dc3545; /* Bootstrap danger red */
                background: var(--alert-danger-bg);
                box-shadow: 0 0 10px rgba(220, 53, 69, 0.3);
            }

            .quiz-option input[type="radio"] {
                position: absolute;
                left: 1rem;
                top: 50%;
                transform: translateY(-50%);
                pointer-events: none;
            }

            .quiz-option label {
                padding-left: 2rem;
                display: flex;
                align-items: center;
                font-size: 1.1rem; /* Ensure label inside option is consistent */
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .hero-section {
                    min-height: 80vh;
                }
                
                h1 { font-size: 2.5rem; } /* Smaller h1 on mobile */
                h2 { font-size: 1.8rem; }
                h3 { font-size: 1.5rem; }
                h4 { font-size: 1.3rem; }
                h5 { font-size: 1.1rem; }
                p, ol, ul, .quiz-option, .stack-layer p { font-size: 1rem; } /* Slightly smaller body on mobile */
                .protocol-badge, .data-packet { font-size: 0.85rem; }
                .ip-octet { font-size: 1.1rem; }
                .neon-btn { font-size: 0.9rem; padding: 10px 20px; }

                .tcp-stack {
                    perspective: none;
                    width: 95%;
                    margin: 1rem auto;
                }
                
                .stack-layer:hover {
                    transform: none;
                }
                
                .handshake-step {
                    flex-direction: column;
                    text-align: center;
                }
                
                .arrow-line {
                    width: 4px;
                    height: 50px;
                    margin: 1rem 0;
                }
                
                .arrow-head-right::after, .arrow-head-left::after {
                    right: -6px;
                    top: 40px;
                    border-left: 7px solid var(--primary-color);
                    border-top: 10px solid transparent;
                    border-bottom: none;
                    transform: rotate(90deg);
                }

                .ip-octet {
                    padding: 8px 12px;
                    font-size: 1rem;
                }
            }

            /* Animations */
            .fade-in {
                animation: fadeIn 1s ease-in-out;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .slide-in-left {
                animation: slideInLeft 0.8s ease-out;
            }

            @keyframes slideInLeft {
                from { opacity: 0; transform: translateX(-50px); }
                to { opacity: 1; transform: translateX(0); }
            }

            .slide-in-right {
                animation: slideInRight 0.8s ease-out;
            }

            @keyframes slideInRight {
                from { opacity: 0; transform: translateX(50px); }
                to { opacity: 1; transform: translateX(0); }
            }

            /* Scroll Indicator */
            .scroll-indicator {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 4px;
                background: rgba(0,0,0, 0.1); /* Darker background for light theme */
                z-index: 1000;
            }

            .scroll-progress {
                height: 100%;
                background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
                width: 0%;
                transition: width 0.1s ease;
            }

            /* Modal styling for layer info */
            .modal-custom {
                display: none;  
                position: fixed;  
                z-index: 1050;
                left: 0;
                top: 0;
                width: 100%;  
                height: 100%;  
                overflow: auto;  
                background-color: rgba(0,0,0,0.5);  
                justify-content: center;
                align-items: center;
            }
            .modal-content-custom {
                background: var(--lighter-bg); /* Lighter background for modal */
                color: var(--text-dark);
                padding: 2rem;
                border-radius: 1rem;
                box-shadow: var(--shadow-bright-blue);
                max-width: 90%;
                width: 600px;
                position: relative;
                text-align: center;
                border: 2px solid var(--primary-color);
            }
            .close-button-custom {
                color: var(--text-muted-light);
                position: absolute;
                top: 10px;
                right: 20px;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
            }
            .close-button-custom:hover,
            .close-button-custom:focus {
                color: var(--primary-color); /* Bright color on hover */
                text-decoration: none;
            }

            /* Video Quiz Modal Styles */
            .video-quiz-modal-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent background */
                display: none;
                align-items: center;
                justify-content: center;
                z-index: 1050;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }

            .video-quiz-modal-overlay.show {
                opacity: 1;
                visibility: visible;
                display: flex;
            }

            .video-quiz-modal-content {
                background: var(--lighter-bg); /* Lighter background for modal */
                color: var(--text-dark);
                padding: 2.5rem;
                border-radius: 1.5rem;
                box-shadow: var(--shadow-bright-blue);
                max-width: 550px;
                width: 90%;
                text-align: center;
                transform: translateY(20px);
                transition: transform 0.3s ease;
                border: 2px solid var(--primary-color);
            }

            .video-quiz-modal-overlay.show .video-quiz-modal-content {
                transform: translateY(0);
            }

            .video-quiz-modal-content h4 {
                color: var(--primary-color);
                margin-bottom: 1.5rem;
                font-weight: 700;
                font-size: 1.5rem; /* Consistent with h4 */
            }

            .video-quiz-modal-options .quiz-option {
                background: rgba(59, 130, 246, 0.05); /* Very light blue tint */
                border: 1px solid rgba(59, 130, 246, 0.2);
                border-radius: 0.75rem;
                padding: 1rem;
                margin-bottom: 0.75rem;
                cursor: pointer;
                transition: all 0.2s ease;
                color: var(--text-dark);
                text-align: left;
                font-size: 1.1rem; /* Consistent with body text */
            }

            .video-quiz-modal-options .quiz-option:hover {
                border-color: var(--primary-color);
                background: rgba(59, 130, 246, 0.1);
            }

            .video-quiz-modal-options .quiz-option.selected {
                border-color: var(--primary-color);
                background: rgba(59, 130, 246, 0.2);
                font-weight: bold;
            }
            .video-quiz-modal-options .quiz-option.correct-answer {
                border-color: #28a745;
                background: var(--alert-success-bg);
                font-weight: bold;
            }
            .video-quiz-modal-options .quiz-option.incorrect {
                border-color: #dc3545;
                background: var(--alert-danger-bg);
                font-weight: bold;
            }
            .video-quiz-modal-options .quiz-option label {
                cursor: inherit;
                width: 100%;
                display: block;
                font-size: 1.1rem; /* Ensure label inside option is consistent */
            }

            .video-quiz-modal-feedback {
                margin-top: 1.5rem;
                font-weight: bold;
                font-size: 1.1rem; /* Consistent with body text */
            }

            .video-quiz-modal-feedback.text-success {
                color: #28a745;
            }
            .video-quiz-modal-feedback.text-danger {
                color: #dc3545;
            }

            /* Timeline styling */
            .timeline-container {
                position: relative;
                max-width: 800px;
                margin: 0 auto;
                padding: 20px 0;
            }

            .timeline-container::after {
                content: '';
                position: absolute;
                width: 6px;
                background-color: var(--primary-color);
                top: 0;
                bottom: 0;
                left: 50%;
                margin-left: -3px;
            }

            .timeline-item {
                padding: 10px 40px;
                position: relative;
                background-color: inherit;
                width: 50%;
            }

            .timeline-item::after {
                content: '';
                position: absolute;
                width: 25px;
                height: 25px;
                right: -17px;
                background-color: var(--light-bg); /* Use light background for dot */
                border: 4px solid var(--primary-color);
                top: 15px;
                border-radius: 50%;
                z-index: 1;
            }

            .timeline-item:nth-child(even) {
                left: 50%;
            }

            .timeline-item:nth-child(even)::after {
                left: -16px;
            }

            .timeline-badge {
                padding: 8px 15px;
                background-color: var(--primary-color);
                color: white;
                border-radius: 10px;
                font-weight: bold;
                display: inline-block;
                margin-bottom: 10px;
                box-shadow: 0 0 10px var(--primary-color);
                font-size: 1rem; /* Consistent with button text */
            }

            .timeline-content {
                padding: 20px 30px;
                background: var(--lighter-bg); /* Lighter background for content */
                position: relative;
                border-radius: 10px;
                border: 1px solid rgba(59, 130, 246, 0.2);
                box-shadow: var(--shadow-bright-blue);
                color: var(--text-dark);
                font-size: 1.1rem; /* Consistent with body text */
            }

            .timeline-content::after {
                content: '';
                position: absolute;
                border-color: transparent;
                border-style: solid;
                pointer-events: none;
                top: 20px;
            }

            .timeline-item:nth-child(odd) .timeline-content::after {
                border-left: 10px solid var(--lighter-bg);
                right: -10px;
            }

            .timeline-item:nth-child(even) .timeline-content::after {
                border-right: 10px solid var(--lighter-bg);
                left: -10px;
            }

            @media screen and (max-width: 768px) {
                .timeline-container::after {
                    left: 31px;
                }
                .timeline-item {
                    width: 100%;
                    padding-left: 70px;
                    padding-right: 25px;
                }
                .timeline-item::before {
                    left: 60px;
                    border: medium solid var(--light-bg);
                    border-width: 10px 0 10px 10px;
                    border-color: transparent transparent transparent var(--light-bg);
                }
                .timeline-item::after {
                    left: 18px;
                }
                .timeline-item:nth-child(even) {
                    left: 0%;
                }
                .timeline-item:nth-child(odd) .timeline-content::after{
                    border-left: none;
                    border-right: 10px solid var(--lighter-bg);
                    left: -10px;
                }
            }
            
            /* Model Comparison */
            .model-comparison {
                background: var(--lighter-bg); /* Lighter background */
                border-radius: 20px;
                padding: 2rem;
                min-height: 450px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                border: 1px solid rgba(59, 130, 246, 0.2);
                box-shadow: var(--shadow-bright-blue);
            }
            .model-layer {
                background: var(--lighter-bg); /* Lighter background for layers */
                border: 1px solid rgba(59, 130, 246, 0.2);
                border-radius: 10px;
                padding: 10px 15px;
                margin-bottom: 10px;
                display: flex;
                align-items: center;
                gap: 15px;
                transition: all 0.3s ease;
                cursor: pointer;
                color: var(--text-dark);
                font-size: 1.1rem; /* Consistent with body text */
            }
            .model-layer:hover {
                background: rgba(59, 130, 246, 0.1);
                transform: scale(1.03);
                box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
            }
            .model-layer .layer-number {
                background: var(--primary-color);
                color: white;
                border-radius: 50%;
                width: 30px;
                height: 30px;
                display: flex;
                justify-content: center;
                align-items: center;
                font-weight: bold;
                font-size: 0.9rem; /* Small number, so slightly smaller */
            }
            .model-layer .layer-info {
                flex-grow: 1;
                text-align: left;
            }
            .model-layer .layer-info strong {
                font-size: 1.1rem; /* Consistent with body text */
                color: var(--primary-color);
            }
            .model-layer .protocols {
                font-size: 0.9rem; /* Consistent with small text */
                color: var(--text-muted-light);
                margin-top: 5px;
            }
            .osi-model .model-layer { border-color: rgba(59, 130, 246, 0.2); }
            .osi-model .model-layer:hover { background: rgba(59, 130, 246, 0.1); box-shadow: 0 0 15px rgba(59, 130, 246, 0.3); }
            .osi-model .layer-number { background: var(--primary-color); }

            .tcp-model .model-layer { border-color: rgba(99, 102, 241, 0.2); }
            .tcp-model .model-layer:hover { background: rgba(99, 102, 241, 0.1); box-shadow: 0 0 15px rgba(99, 102, 241, 0.3); }
            .tcp-model .layer-number { background: var(--secondary-color); }

            /* Alert Styling */
            .alert.position-fixed {
                top: 20px;
                right: 20px;
                z-index: 1050;
                min-width: 300px;
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.2); /* Adjusted for bright theme */
                border-radius: 10px;
                display: flex;
                align-items: center;
                color: var(--text-dark);
                font-size: 1rem; /* Slightly smaller for alerts to be less intrusive */
            }
            .alert-success { background-color: var(--alert-success-bg); color: #28a745; border-left: 5px solid #28a745; }
            .alert-warning { background-color: var(--alert-warning-bg); color: #ffc107; border-left: 5px solid #ffc107; }
            .alert-danger { background-color: var(--alert-danger-bg); color: #dc3545; border-left: 5px solid #dc3545; }
            .alert-info { background-color: var(--alert-info-bg); color: #17a2b8; border-left: 5px solid #17a2b8; }
            .alert .btn-close { filter: none; } /* No invert for close button on light theme */
        </style>

        <!-- Bootstrap JS and Custom JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <!-- Mermaid JS -->
        <script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>
        <!-- Removed YouTube IFrame Player API -->
        <script>
            // Data for interactive elements
            const layerInfoDetails = {
                'app-hero': {
                    title: 'Application Layer',
                    description: 'Lapisan ini adalah titik interaksi utama pengguna dengan aplikasi jaringan, seperti web browser (HTTP), email client (SMTP), dan file transfer (FTP). Protokol di lapisan ini menyediakan layanan langsung kepada aplikasi pengguna.'
                },
                'transport-hero': {
                    title: 'Transport Layer',
                    description: 'Lapisan ini bertanggung jawab untuk pengiriman data end-to-end yang andal atau tidak andal. TCP (Transmission Control Protocol) memastikan pengiriman yang terurut dan bebas kesalahan, sementara UDP (User Datagram Protocol) menawarkan pengiriman yang lebih cepat tanpa jaminan.'
                },
                'internet-hero': {
                    title: 'Internet Layer',
                    description: 'Lapisan ini mengurus pengalamatan logis (IP addresses) dan routing paket data antar jaringan. IP (Internet Protocol) adalah protokol utamanya, dibantu oleh ICMP (ping) dan ARP (resolusi alamat MAC).'
                },
                'network-hero': {
                    title: 'Network Access Layer',
                    description: 'Lapisan ini menggabungkan fungsi lapisan Fisik dan Data Link dari model OSI. Ia mengelola detail fisik transmisi data melalui media jaringan (kabel Ethernet, Wi-Fi) dan pengalamatan fisik (MAC addresses).'
                },
                'osi-7': { title: 'OSI Layer 7: Application', description: 'Menyediakan interface antara aplikasi pengguna dan fungsi jaringan.' },
                'osi-6': { title: 'OSI Layer 6: Presentation', description: 'Menerjemahkan, mengompresi, dan mengenkripsi/mendekripsi data untuk lapisan aplikasi.' },
                'osi-5': { title: 'OSI Layer 5: Session', description: 'Mengelola sesi komunikasi antara aplikasi.' },
                'osi-4': { title: 'OSI Layer 4: Transport', description: 'Menyediakan pengiriman data end-to-end dan kontrol aliran (misal TCP, UDP).' },
                'osi-3': { title: 'OSI Layer 3: Network', description: 'Menentukan jalur logis untuk data (routing) dan pengalamatan IP.' },
                'osi-2': { title: 'OSI Layer 2: Data Link', description: 'Frame, MAC address, error detection.' },
                'osi-1': { title: 'OSI Layer 1: Physical', description: 'Mendefinisikan karakteristik fisik media transmisi (kabel, sinyal, konektor).' },
                'tcp-4': { title: 'TCP/IP Layer 4: Application', description: 'Fungsi gabungan dari lapisan Aplikasi, Presentasi, dan Sesi OSI. Mengatur protokol tingkat tinggi seperti HTTP, FTP, SMTP, DNS.' },
                'tcp-3': { title: 'TCP/IP Layer 3: Transport', description: 'Sama dengan lapisan Transport OSI. Bertanggung jawab untuk pengiriman data dari satu proses ke proses lain (TCP dan UDP).' },
                'tcp-2': { title: 'TCP/IP Layer 2: Internet', description: 'Sama dengan lapisan Jaringan OSI. Menangani pengalamatan logis dan routing paket antar jaringan (IP).' },
                'tcp-1': { title: 'TCP/IP Layer 1: Network Access', description: 'Fungsi gabungan dari lapisan Data Link dan Fisik OSI. Mengelola detail fisik transmisi data melalui media jaringan (Ethernet, Wi-Fi) dan pengalamatan fisik (MAC addresses).' }
            };

            const ipClassDetails = {
                'classA': {
                    description: 'Kelas A menggunakan 8 bit pertama sebagai alamat network. Bit pertama selalu diset 0. Cocok untuk jaringan dengan banyak host (sekitar 16 juta) dan sedikit network.',
                    range: 'Range IP: 0.0.0.0 - 127.255.255.255 (Efektif: 1.0.0.0 - 126.255.255.255)'
                },
                'classB': {
                    description: 'Kelas B menggunakan 16 bit pertama sebagai alamat network. Dua bit pertama selalu diset 10. Cocok untuk jaringan skala menengah, dengan sekitar 65 ribu host per network.',
                    range: 'Range IP: 128.0.0.0 - 191.255.255.255'
                },
                'classC': {
                    description: 'Kelas C menggunakan 24 bit pertama sebagai alamat network. Tiga bit pertama selalu diset 110. Cocok untuk jaringan lokal yang kecil, dengan sekitar 254 host per network.',
                    range: 'Range IP: 192.0.0.0 - 223.255.255.255'
                },
                'classD': {
                    description: 'Kelas D adalah untuk alamat multicast. Ini digunakan untuk mengirimkan data ke sekelompok tujuan secara bersamaan, bukan ke host tunggal.',
                    range: 'Range IP: 224.0.0.0 - 239.255.255.255'
                },
                'classE': {
                    description: 'Kelas E adalah untuk tujuan penelitian dan eksperimen di masa depan. Alamat di kelas ini tidak dialokasikan untuk penggunaan umum.',
                    range: 'Range IP: 240.0.0.0 - 255.255.255.255'
                }
            };

            const octetDescriptions = {
                1: 'Oktet pertama (8 bit) ini menentukan kelas alamat IP dan bagian Network ID. Misalnya, untuk kelas A dimulai dengan 0, kelas B dengan 10, dan kelas C dengan 110.',
                2: 'Oktet kedua (8 bit) ini, bersama dengan oktet pertama (dan ketiga untuk kelas C), membentuk Network ID atau bagian Host ID, tergantung pada kelas IP.',
                3: 'Oktet ketiga (8 bit) ini, bersama dengan oktet sebelumnya, dapat membentuk Network ID atau bagian Host ID, tergantung pada kelas IP.',
                4: 'Oktet keempat (8 bit) ini biasanya merupakan bagian dari Host ID, yang mengidentifikasi perangkat spesifik dalam sebuah jaringan.'
            };

            // Scroll Progress Indicator
            window.onscroll = function() { updateScrollProgress() };

            function updateScrollProgress() {
                var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                var scrolled = (winScroll / height) * 100;
                const scrollProgress = document.getElementById("scrollProgress");
                if (scrollProgress) {
                    scrollProgress.style.width = scrolled + "%";
                }
            }

            // Particle Animation
            function createParticle() {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                const size = Math.random() * 5 + 2; // size between 2px and 7px
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${Math.random() * 100}vw`;
                particle.style.animationDuration = `${Math.random() * 5 + 3}s`; // duration between 3s and 8s
                particle.style.animationDelay = `-${Math.random() * 5}s`; // start at random points
                document.getElementById('particles').appendChild(particle);

                particle.addEventListener('animationend', () => {
                    particle.remove();
                    createParticle(); // Recreate particle when one finishes
                });
            }

            // Generate a few particles on load
            document.addEventListener('DOMContentLoaded', () => {
                const particlesContainer = document.getElementById('particles');
                if (particlesContainer) {
                    for (let i = 0; i < 50; i++) {
                        createParticle();
                    }
                }
                // Set initial state for IP Class Info
                showIpClassInfo('classA', document.querySelector('.ip-class-btn[data-class="classA"]'));
            });

            // Scroll to section function
            function scrollToSection(id) {
                const section = document.getElementById(id);
                if (section) {
                    section.scrollIntoView({ behavior: 'smooth' });
                }
            }

            // Interactive Demo - simply scrolls to a specific section for now
            function startInteractiveDemo() {
                // For now, this will scroll to the Encapsulation section
                scrollToSection('tcp-section');
                // In a more complex demo, you could trigger a sequence of animations here
            }

            // Layer Info Modal
            document.querySelectorAll('.stack-layer').forEach(layer => {
                layer.addEventListener('click', function() {
                    const layerId = this.dataset.layerId;
                    const info = layerInfoDetails[layerId];
                    if (info) {
                        document.getElementById('modalLayerTitle').textContent = info.title;
                        document.getElementById('modalLayerDescription').textContent = info.description;
                        document.getElementById('layerInfoModal').style.display = 'flex';
                    }
                });
            });

            document.querySelectorAll('.model-layer').forEach(layer => {
                layer.addEventListener('click', function() {
                    const layerId = this.dataset.layerId;
                    const info = layerInfoDetails[layerId];
                    if (info) {
                        document.getElementById('modalLayerTitle').textContent = info.title;
                        document.getElementById('modalLayerDescription').textContent = info.description;
                        document.getElementById('layerInfoModal').style.display = 'flex';
                    }
                });
            });

            function closeLayerInfoModal() {
                document.getElementById('layerInfoModal').style.display = 'none';
            }

            // TCP Three Way Handshake Animation
            let handshakeAnimationTimeout;

            function startHandshakeAnimation() {
                resetHandshakeAnimation(); // Ensure reset before starting

                const step1 = document.getElementById('handshake-step-1');
                const step2 = document.getElementById('handshake-step-2');
                const step3 = document.getElementById('handshake-step-3');

                const packet1 = step1.querySelector('.packet-animation');
                const packet2 = step2.querySelector('.packet-animation');
                const packet3 = step3.querySelector('.packet-animation');

                // Step 1: SYN
                handshakeAnimationTimeout = setTimeout(() => {
                    step1.classList.add('active');
                    packet1.style.opacity = '1';
                    packet1.style.transform = 'translateX(calc(100% + 50px))'; /* Move across */
                }, 500);

                // Step 2: SYN-ACK
                handshakeAnimationTimeout = setTimeout(() => {
                    step1.classList.remove('active');
                    packet1.style.opacity = '0'; // Hide first packet
                    packet1.style.transform = 'translateX(0)'; // Reset position
                    
                    step2.classList.add('active');
                    packet2.style.opacity = '1';
                    packet2.style.transform = 'translateX(calc(-100% - 50px))'; /* Move across */
                }, 2500);

                // Step 3: ACK
                handshakeAnimationTimeout = setTimeout(() => {
                    step2.classList.remove('active');
                    packet2.style.opacity = '0'; // Hide second packet
                    packet2.style.transform = 'translateX(0)'; // Reset position

                    step3.classList.add('active');
                    packet3.style.opacity = '1';
                    packet3.style.transform = 'translateX(calc(100% + 50px))'; /* Move across */
                }, 4500);

                // Reset after animation
                handshakeAnimationTimeout = setTimeout(() => {
                    step3.classList.remove('active');
                    packet3.style.opacity = '0'; // Hide third packet
                    packet3.style.transform = 'translateX(0)'; // Reset position
                }, 6500);
            }

            function resetHandshakeAnimation() {
                clearTimeout(handshakeAnimationTimeout);
                document.querySelectorAll('.handshake-step').forEach(step => {
                    step.classList.remove('active');
                    const packet = step.querySelector('.packet-animation');
                    if (packet) {
                        packet.style.opacity = '0';
                        packet.style.transform = 'translateX(0)';
                    }
                });
            }

            // IP Octet Info
            function showOctetInfo(octetNum) {
                const infoText = octetDescriptions[octetNum];
                document.getElementById('octet-info').textContent = `Oktet ${octetNum}: ${infoText}`;
            }

            // IP Class Info display
            function showIpClassInfo(classId, element) {
                // Deactivate all class buttons
                document.querySelectorAll('.ip-class-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                // Activate clicked button
                element.classList.add('active');

                const details = ipClassDetails[classId];
                document.getElementById('ip-class-description').textContent = details.description;
                document.getElementById('ip-class-range').textContent = details.range;
            }

            // Quiz functionality
            const quizAnswers = {
                q1: 'a', // TCP
                q2: 'a', // Encapsulation
                q3: 'b', // To establish a reliable connection
                q4: 'a', // Internet Layer
                q5: 'c'  // 110 (3 bit)
            };

            // Minimum score to unlock next material
            const REQUIRED_SCORE = 80;

            // Attach event listeners to quiz options using delegation
            document.getElementById('quiz-container').addEventListener('click', function(event) {
                const option = event.target.closest('.quiz-option');
                if (option) {
                    // Ensure the label or the div containing the radio is clicked
                    const radioInput = option.querySelector('input[type="radio"]');
                    if (radioInput) {
                        radioInput.checked = true; // Manually check the radio button
                        selectQuizOption(option);
                    }
                }
            });

            function selectQuizOption(selectedOption) {
                const questionBlock = selectedOption.closest('.question-block');
                const questionName = selectedOption.querySelector('input[type="radio"]').name;  
                
                // Remove 'selected' class from all options in this question block
                questionBlock.querySelectorAll('.quiz-option').forEach(opt => {
                    opt.classList.remove('selected');
                });

                // Add 'selected' class to the clicked option
                selectedOption.classList.add('selected');
            }

            function resetQuizUI() {
                document.querySelectorAll('.quiz-option').forEach(option => {
                    option.classList.remove('selected', 'correct', 'incorrect');
                    const radio = option.querySelector('input[type="radio"]');
                    if (radio) {
                        radio.checked = false;
                    }
                });
                document.getElementById('quiz-feedback').textContent = "";
                document.getElementById('nextMaterialBtn').classList.add('d-none');
            }

            function checkQuiz() {
                let score = 0;
                const totalQuestions = Object.keys(quizAnswers).length;
                const feedback = document.getElementById('quiz-feedback');
                const nextMaterialBtn = document.getElementById('nextMaterialBtn');

                // Clear previous results
                document.querySelectorAll('.quiz-option').forEach(option => {
                    option.classList.remove('correct', 'incorrect');
                });
                
                let allAnswered = true;

                for (const qId in quizAnswers) {
                    const selectedRadio = document.querySelector(`input[name="${qId}"]:checked`); // Get the checked radio button
                    const correctAnswer = quizAnswers[qId];

                    if (!selectedRadio) {
                        allAnswered = false;
                        break; // Exit loop if any question is not answered
                    }

                    const selectedAnswer = selectedRadio.value; // Get value from the checked radio input
                    const selectedOptionDiv = selectedRadio.closest('.quiz-option'); // Get the parent div

                    if (selectedAnswer === correctAnswer) {
                        score += 1;
                        selectedOptionDiv.classList.add('correct');
                    } else {
                        selectedOptionDiv.classList.add('incorrect');
                        // Highlight the correct answer for clarity
                        document.querySelector(`.quiz-option[data-question="${qId}"][data-answer="${correctAnswer}"]`).classList.add('correct');
                    }
                }

                if (!allAnswered) {
                    showAlert("Mohon jawab semua pertanyaan sebelum memeriksa.", 'warning');
                    nextMaterialBtn.classList.add('d-none'); // Hide button
                    return;
                }

                const percentage = (score / totalQuestions) * 100;
                
                // Store the score for Material 1 in localStorage using the correct key
                localStorage.setItem('material_1_score', percentage.toFixed(0));

                if (percentage >= REQUIRED_SCORE) { // Passing score
                    showAlert(`Selamat! Anda berhasil memahami materi ini dengan baik dengan skor ${percentage.toFixed(0)}%. Materi selanjutnya akan terbuka!`, 'success');
                    nextMaterialBtn.classList.remove('d-none'); // Show next material button
                } else {
                    showAlert(`Skor Anda: ${percentage.toFixed(0)}%. Terus semangat belajar! Anda perlu mencapai setidaknya ${REQUIRED_SCORE}% untuk melanjutkan.`, 'danger');
                    nextMaterialBtn.classList.add('d-none'); // Hide button
                    
                    // Reset quiz for retake
                    setTimeout(() => {
                        resetQuizUI();
                    }, 3000); // Reset after 3 seconds so user can see results briefly
                }
            }

            // Show a custom alert message (success, warning, danger, or info)
            function showAlert(message, type = 'success') {
                const alertElement = document.getElementById('alert-notification');
                const messageElement = document.getElementById('alert-message');
                
                if (!alertElement || !messageElement) return;

                // Update alert style and icon based on type
                alertElement.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
                messageElement.textContent = message;
                
                const icon = alertElement.querySelector('i');
                if (type === 'success') {
                    icon.className = 'bi bi-check-circle-fill me-2';
                } else if (type === 'warning') {
                    icon.className = 'bi bi-exclamation-triangle-fill me-2';
                } else if (type === 'danger') {
                    icon.className = 'bi bi-x-circle-fill me-2';
                } else if (type === 'info') {
                    icon.className = 'bi bi-info-circle-fill me-2';
                }
                
                alertElement.style.display = 'block'; // Show the alert
                
                // Auto close after 4 seconds
                setTimeout(() => {
                    closeAlert();
                }, 4000);
            }

            // Close the custom alert message
            function closeAlert() {
                const alertElement = document.getElementById('alert-notification');
                if (alertElement) {
                    alertElement.classList.remove('show');
                    alertElement.classList.add('fade');
                    // Hide after fade out animation
                    setTimeout(() => {
                        alertElement.style.display = 'none';
                    }, 150);  
                }
            }

            // HTML5 Video Quiz Logic - UPDATED
            let tcpIpVideoPlayer; // Reference to the TCP/IP video player
            let quizInterval; // Interval for checking video time

            // Define quiz points for the TCP/IP video
            var videoQuizPoints = [
                {
                    time: 15, // Approx. 15 seconds into the video
                    question: "Menurut video, apa kepanjangan dari TCP?",
                    options: [
                        "Transfer Control Packet",
                        "Transmission Control Protocol",
                        "Total Communication Protocol",
                        "Technical Control Point"
                    ],
                    correctAnswerIndex: 1, // "Transmission Control Protocol"
                    answered: false // Flag to track if this quiz has been triggered and answered
                },
                {
                    time: 35, // Approx. 35 seconds into the video
                    question: "Apa fungsi utama dari Internet Protocol (IP) dalam komunikasi jaringan?",
                    options: [
                        "Mengatur pengiriman email",
                        "Mengelola koneksi Wi-Fi",
                        "Melakukan pengalamatan dan routing paket data",
                        "Mengenkripsi data sensitif"
                    ],
                    correctAnswerIndex: 2, // "Melakukan pengalamatan dan routing paket data"
                    answered: false
                },
                {
                    time: 60, // Approx. 1 minute into the video
                    question: "Berapa lapisan yang dimiliki oleh model TCP/IP, seperti yang dijelaskan dalam video?",
                    options: [
                        "3 lapisan",
                        "4 lapisan",
                        "5 lapisan",
                        "7 lapisan"
                    ],
                    correctAnswerIndex: 1, // "4 lapisan"
                    answered: false
                }
            ];
            var currentVideoQuizQuestion = null; // To store the current quiz data being displayed

            document.addEventListener('DOMContentLoaded', () => {
                // Initialize HTML5 video players
                tcpIpVideoPlayer = document.getElementById('video-player-tcp-ip');
                const osiLayerVideoPlayer = document.getElementById('video-player-osi-layer');

                // Add event listeners for the TCP/IP video for quiz functionality
                if (tcpIpVideoPlayer) {
                    tcpIpVideoPlayer.addEventListener('play', onVideoPlay);
                    tcpIpVideoPlayer.addEventListener('pause', onVideoPause);
                    tcpIpVideoPlayer.addEventListener('ended', onVideoEnded);
                    tcpIpVideoPlayer.addEventListener('timeupdate', checkVideoTime);
                }

                // For the OSI Layer video, just ensure it doesn't autoplay and has controls
                // No specific quiz logic added for this video based on the request.
                if (osiLayerVideoPlayer) {
                    // No need for specific event listeners unless quiz points are added later
                }

                // ... (rest of your existing DOMContentLoaded logic)
            });

            function onVideoPlay() {
                // Video is playing, start checking current time
                quizInterval = setInterval(checkVideoTime, 250); // Check every 250ms for precision
            }

            function onVideoPause() {
                // Video is paused, stop checking time
                clearInterval(quizInterval);
            }

            function onVideoEnded() {
                // Video ended, clear interval and reset quiz points for potential replay
                clearInterval(quizInterval);
                videoQuizPoints.forEach(point => point.answered = false);
            }

            function checkVideoTime() {
                if (tcpIpVideoPlayer && !tcpIpVideoPlayer.paused && !tcpIpVideoPlayer.ended) {
                    var currentTime = tcpIpVideoPlayer.currentTime;
                    for (let i = 0; i < videoQuizPoints.length; i++) {
                        const quizPoint = videoQuizPoints[i];
                        // Trigger quiz if current time is at or past the quiz point, and it hasn't been answered yet
                        // Adding a small buffer (e.g., < quizPoint.time + 0.5) to ensure it triggers if time is slightly off
                        if (!quizPoint.answered && currentTime >= quizPoint.time && currentTime < quizPoint.time + 0.5) {
                            tcpIpVideoPlayer.pause(); // Pause the HTML5 video
                            showVideoQuiz(quizPoint, i);
                            quizPoint.answered = true; // Mark as answered to prevent re-triggering
                            clearInterval(quizInterval); // Stop time checking until quiz is answered
                            break; // Stop checking further quiz points for this interval
                        }
                    }
                }
            }

            function showVideoQuiz(quizData, index) {
                currentVideoQuizQuestion = { data: quizData, index: index };
                const modal = document.getElementById('videoQuizModal');
                const questionElement = document.getElementById('videoQuizQuestion');
                const optionsElement = document.getElementById('videoQuizOptions');
                const feedbackElement = document.getElementById('videoQuizFeedback');
                const continueBtn = document.getElementById('videoQuizContinueBtn');

                if (!modal || !questionElement || !optionsElement || !feedbackElement || !continueBtn) {
                    console.error("One or more video quiz modal elements not found!");
                    return;
                }

                questionElement.textContent = quizData.question;
                optionsElement.innerHTML = ''; // Clear previous options
                feedbackElement.textContent = ''; // Clear previous feedback
                continueBtn.classList.add('d-none'); // Hide continue button initially

                quizData.options.forEach((optionText, idx) => {
                    const optionDiv = document.createElement('div');
                    optionDiv.classList.add('quiz-option');
                    optionDiv.setAttribute('data-index', idx);
                    // Using a radio button visually inside the custom styled div
                    optionDiv.innerHTML = `
                        <input type="radio" name="video-quiz-option" id="video-option-${idx}" value="${idx}" class="d-none">
                        <label for="video-option-${idx}" class="w-100 cursor-pointer" style="color: var(--text-dark);">
                            ${String.fromCharCode(97 + idx)}. ${optionText}
                        </label>
                    `;  
                    optionDiv.onclick = (e) => {
                        // Prevent propagation if the actual radio input is clicked (though it's d-none)
                        if (e.target.tagName === 'INPUT') return;
                        selectVideoQuizOption(optionDiv, idx);
                    };
                    optionsElement.appendChild(optionDiv);
                });

                // Ensure the modal is displayed as flex, then add 'show' class for transition
                modal.style.display = 'flex';
                setTimeout(() => {
                    modal.classList.add('show');
                }, 50); // Small delay to ensure display property is applied before transition
            }

            function selectVideoQuizOption(selectedOptionDiv, selectedIndex) {
                const optionsContainer = selectedOptionDiv.closest('.video-quiz-modal-options');
                optionsContainer.querySelectorAll('.quiz-option').forEach(opt => {
                    opt.classList.remove('selected', 'correct-answer', 'incorrect');
                    const radio = opt.querySelector('input[type="radio"]');
                    if(radio) radio.checked = false; // Uncheck other radios
                });

                selectedOptionDiv.classList.add('selected');
                const selectedRadio = selectedOptionDiv.querySelector('input[type="radio"]');
                if(selectedRadio) selectedRadio.checked = true; // Check the selected radio

                const quizData = currentVideoQuizQuestion.data;
                const feedbackElement = document.getElementById('videoQuizFeedback');
                const continueBtn = document.getElementById('videoQuizContinueBtn');

                // Disable all options immediately after selection to prevent multiple answers
                optionsContainer.querySelectorAll('.quiz-option').forEach(opt => {
                    opt.onclick = null;
                    opt.style.cursor = 'default';
                });

                if (selectedIndex === quizData.correctAnswerIndex) {
                    selectedOptionDiv.classList.add('correct-answer');
                    feedbackElement.textContent = "Jawaban Benar!";
                    feedbackElement.classList.remove('text-danger');
                    feedbackElement.classList.add('text-success');
                    continueBtn.classList.remove('d-none'); // Show continue button
                } else {
                    selectedOptionDiv.classList.add('incorrect');
                    // Highlight correct answer
                    optionsContainer.querySelector(`.quiz-option[data-index="${quizData.correctAnswerIndex}"]`).classList.add('correct-answer');
                    feedbackElement.textContent = "Jawaban Salah. Jawaban yang benar sudah ditandai.";
                    feedbackElement.classList.remove('text-success');
                    feedbackElement.classList.add('text-danger');
                    continueBtn.classList.remove('d-none'); // Still show continue button to proceed
                }
            }

            function continueVideo() {
                const modal = document.getElementById('videoQuizModal');
                modal.classList.remove('show');
                // Hide modal completely after transition to ensure no click-throughs
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300); // Match CSS transition duration

                if (tcpIpVideoPlayer && tcpIpVideoPlayer.play) {
                    tcpIpVideoPlayer.play();
                    // Restart the time checking interval after video resumes
                    quizInterval = setInterval(checkVideoTime, 250); // Use 250ms interval
                }
            }

            // Scroll reveal animations
            document.addEventListener('DOMContentLoaded', function() {
                const sections = document.querySelectorAll('section'); // Select all sections as scroll reveal targets

                const observerOptions = {
                    root: null, // viewport
                    rootMargin: '0px',
                    threshold: 0.1 // 10% visible to trigger
                };

                const observer = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                            entry.target.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                sections.forEach(section => {
                    section.style.opacity = '0';
                    section.style.transform = 'translateY(30px)';
                    observer.observe(section);
                });

                // Specific animations for header elements that should not wait for scroll
                const headerContentElements = document.querySelectorAll('header h1, header p, header .badge, header .neon-btn');
                headerContentElements.forEach((el, index) => {
                    setTimeout(() => {
                        el.classList.add('header-content-visible');
                    }, index * 100 + 500); // Staggered delay, starting after 0.5s
                });
                
                // Header title words animation
                const titleWords = document.querySelectorAll('.title-word');
                titleWords.forEach((word, index) => {
                    word.style.opacity = '1';  
                });

                // On page load, check if quiz was already passed and show "next material" button
                // Changed from 'quizScore_1' to 'material_1_score'
                const savedScore = parseInt(localStorage.getItem('material_1_score')) || 0;
                const nextMaterialBtn = document.getElementById('nextMaterialBtn');
                if (savedScore >= REQUIRED_SCORE) {
                    nextMaterialBtn.classList.remove('d-none');
                } else {
                    nextMaterialBtn.classList.add('d-none');
                }
            });
        </script>
    </div>
</div>
@endsection
