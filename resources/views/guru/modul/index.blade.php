@extends('guru.guru_master')
@section('guru')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media dan Jaringan Telekomunikasi - guru</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Import Poppins font from Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap');

        /* Base body styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8faff; /* Very light blue-grey background */
            line-height: 1.6; /* Consistent line height for readability */
        }

        /* Header background with a professional blue gradient and subtle pattern */
        .header-bg {
            background: linear-gradient(135deg, #2c3e50 0%, #4a69bd 100%); /* Deep blue to medium blue */
            position: relative;
            overflow: hidden;
            padding-top: 6rem; /* Increased padding for more vertical space */
            padding-bottom: 6rem; /* Increased padding for more vertical space */
            box-shadow: 0 8px 20px rgba(0,0,0,0.15); /* Softer shadow */
        }

        /* Overlay pattern for the header */
        .header-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* SVG data URL for diagonal lines pattern */
            background: url('data:image/svg+xml;utf8,<svg width="100%" height="100%" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="diagonal-lines" width="10" height="10" patternUnits="userSpaceOnUse" patternTransform="rotate(45)"><line x1="0" y1="0" x2="0" y2="10" stroke="%23ffffff" stroke-width="0.7" stroke-opacity="0.08"/></pattern></defs><rect width="100%" height="100%" fill="url(%23diagonal-lines)"/></svg>') repeat;
            opacity: 0.8; /* Subtle pattern overlay */
            pointer-events: none; /* Allows clicks to pass through */
        }

        /* Card styles for content sections */
        .card-hover {
            transition: all 0.3s ease-in-out; /* Smooth transition for hover effects */
            border-radius: 12px; /* Rounded corners */
            border: 1px solid #e0e0e0; /* Subtle border */
            background-color: #ffffff; /* White background */
            box-shadow: 0 4px 12px rgba(0,0,0,0.06); /* Lighter initial shadow */
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Distributes space between items */
            padding: 1.75rem; /* Consistent padding for cards */
        }

        /* Card hover effect */
        .card-hover:hover {
            transform: translateY(-8px); /* Lifts the card slightly */
            box-shadow: 0 10px 25px rgba(0,0,0,0.12); /* More noticeable hover shadow */
        }

        /* Details content (accordion) animation for collapse/expand */
        .details-content {
            max-height: 0; /* Initially hidden */
            opacity: 0; /* Initially transparent */
            overflow: hidden; /* Hides overflowing content */
            transition: max-height 0.5s ease-out, opacity 0.5s ease-out, padding-top 0.5s ease-out; /* Smooth animation */
        }

        /* Class added by JS when content is expanded */
        .details-content.is-expanded {
            max-height: 500px; /* Sufficient height to show content */
            opacity: 1; /* Fully visible */
            padding-top: 1.25rem; /* Adds top padding when expanded, consistent with other spacing */
        }

        /* Animated underline for titles within cards */
        .animated-underline {
            position: relative;
            cursor: pointer;
        }

        .animated-underline::after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0); /* Initially hidden */
            height: 2px;
            bottom: -5px; /* Position below the text */
            left: 0;
            background-color: #4ac2e0; /* Teal highlight color */
            transform-origin: bottom right; /* Animation origin */
            transition: transform 0.25s ease-out; /* Smooth transition */
        }

        /* Underline animation on hover */
        .animated-underline:hover::after {
            transform: scaleX(1); /* Expands the underline */
            transform-origin: bottom left; /* Animation origin */
        }

        /* Toggle button styles for "Lihat Detail" */
        .toggle-details {
            display: flex !important; /* Ensures flex display */
            align-items: center;
            justify-content: center;
            width: 100%; /* Full width of its container */
            margin-top: auto; /* Pushes button to the bottom of flex container */
            background-color: #4ac2e0; /* Teal color */
            color: white;
            border: none;
            padding: 0.9rem 1.8rem; /* Consistent padding for buttons */
            border-radius: 9999px; /* Pill shape */
            font-weight: 600;
            font-size: 1rem; /* Consistent font size */
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease; /* Smooth transitions */
            box-shadow: 0 3px 8px rgba(74, 194, 224, 0.3); /* Teal shadow */
            cursor: pointer;
        }

        /* Toggle button hover effects */
        .toggle-details:hover {
            background-color: #3aa6c0; /* Darker teal on hover */
            transform: translateY(-2px); /* Lifts the button slightly */
            box-shadow: 0 5px 12px rgba(74, 194, 224, 0.4);
        }

        /* Icon rotation for toggle button */
        .toggle-details i {
            transition: transform 0.3s ease-in-out; /* Smooth icon rotation */
        }

        .toggle-details .fa-chevron-up {
            transform: rotate(180deg); /* Rotates the icon when expanded */
        }

        /* Main content section padding */
        .main-content-section {
            padding-top: 4rem;
            padding-bottom: 4rem;
        }

        /* TP Heading styles (e.g., Indikator 6.1) */
        .tp-heading {
            background-color: #eaf6ff; /* Very light blue background */
            padding: 1.5rem 2.5rem; /* Increased padding for better visual weight */
            border-left: 6px solid #4a69bd; /* Blue border matching header */
            border-radius: 8px;
            margin-bottom: 3rem; /* Consistent spacing */
            margin-top: 4rem; /* Consistent spacing */
            font-size: 2rem; /* Consistent font size */
            color: #2c3e50; /* Dark text matching header */
            box-shadow: 0 3px 10px rgba(0,0,0,0.08); /* Subtle shadow */
            font-weight: 700;
            line-height: 1.4;
        }

        /* Intro section (Peta Konsep Pembelajaran) styles */
        .intro-section {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.07);
            padding: 3rem; /* Consistent padding */
            margin-bottom: 4rem; /* Consistent spacing */
            border-top: 5px solid #4a69bd; /* Top border matching header */
            max-width: 900px; /* Slightly reduced max-width for better readability */
            margin-left: auto;
            margin-right: auto;
        }

        .intro-section h2 {
            font-weight: 800;
            color: #333;
            margin-bottom: 1.5rem; /* Consistent spacing */
            font-size: 2.75rem; /* Consistent font size */
        }

        .intro-section p {
            font-size: 1.15rem; /* Consistent font size */
            line-height: 1.7;
            color: #555;
        }

        /* Main Call-to-Action button (Mulai Belajar) */
        .main-cta-button {
            background: linear-gradient(45deg, #ff9800, #ff5722); /* Orange to deep orange gradient */
            color: white;
            font-size: 1.15rem; /* Consistent font size */
            box-shadow: 0 5px 15px rgba(255, 152, 0, 0.3);
            border: none;
            border-radius: 50px; /* Pill shape */
            font-weight: 700;
            padding: 1rem 2.5rem; /* Consistent padding for buttons */
            transition: all 0.3s ease-in-out; /* Smooth transitions */
        }

        /* Main CTA button hover effects */
        .main-cta-button:hover {
            background: linear-gradient(45deg, #ff5722, #ff9800); /* Reverse gradient on hover */
            transform: scale(1.05); /* Slightly scales up */
            box-shadow: 0 8px 20px rgba(255, 152, 0, 0.4);
        }

        /* Quiz section styles */
        .quiz-section {
            background-color: #eaf6ff; /* Light blue background */
            padding: 3.5rem; /* Increased padding for more prominence */
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 184, 255, 0.1); /* Subtle blue shadow */
            margin-top: 5rem; /* Consistent spacing */
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid #d0e7f7; /* Subtle border */
        }

        .quiz-section h2 {
            color: #2c3e50; /* Dark text matching header */
            font-weight: 800;
            font-size: 2.5rem; /* Consistent font size */
            margin-bottom: 1.5rem; /* Consistent spacing */
        }

        .quiz-section p {
            color: #555;
            font-size: 1.1rem; /* Consistent font size */
            line-height: 1.7;
            margin-bottom: 2rem; /* Consistent spacing */
        }

        /* Quiz Call-to-Action button */
        .quiz-cta-button {
            background: linear-gradient(45deg, #00c853, #00a03c); /* Green gradient */
            color: white;
            font-size: 1.15rem; /* Consistent font size */
            box-shadow: 0 5px 15px rgba(0, 200, 83, 0.3);
            border-radius: 50px; /* Pill shape */
            font-weight: 700;
            padding: 1rem 2.5rem; /* Consistent padding for buttons */
            transition: all 0.3s ease-in-out; /* Smooth transitions */
        }

        /* Quiz CTA button hover effects */
        .quiz-cta-button:hover {
            background: linear-gradient(45deg, #00a03c, #00c853); /* Reverse gradient on hover */
            transform: scale(1.05); /* Slightly scales up */
            box-shadow: 0 8px 20px rgba(0, 200, 83, 0.4);
        }

        /* Main container width for content centering */
        .container {
            max-width: 1100px; /* Slightly narrower max width for a more focused layout */
        }

        /* Responsive adjustments for various screen sizes */
        @media (max-width: 1024px) {
            .header-bg { padding: 5rem; }
            .tp-heading { font-size: 1.8rem; padding: 1.25rem 2rem; }
            .intro-section { padding: 2.5rem; }
            .intro-section h2 { font-size: 2.25rem; }
            .intro-section p { font-size: 1.05rem; }
            .main-cta-button, .toggle-details, .quiz-cta-button { font-size: 1rem; padding: 0.8rem 2rem; }
            .card-hover { padding: 1.5rem; }
            .card-hover h3 { font-size: 1.8rem; }
            .card-hover p { font-size: 0.9rem; }
            .quiz-section { padding: 3rem; }
            .quiz-section h2 { font-size: 2.1rem; }
            .quiz-section p { font-size: 1rem; }
        }

        @media (max-width: 768px) {
            .header-bg { padding: 4rem; }
            .header-bg h1 { font-size: 3rem; }
            .header-bg p { font-size: 1.1rem; }
            .main-content-section { padding-top: 3rem; padding-bottom: 3rem; }
            .tp-heading {
                font-size: 1.6rem;
                padding: 1rem 1.5rem;
                margin-top: 3rem;
                margin-bottom: 2.5rem;
            }
            .intro-section {
                padding: 2rem;
                margin-bottom: 3rem;
            }
            .intro-section h2 {
                font-size: 2rem;
            }
            .intro-section p {
                font-size: 0.95rem;
            }
            .main-cta-button, .toggle-details, .quiz-cta-button {
                font-size: 0.95rem;
                padding: 0.7rem 1.6rem;
            }
            .card-hover { padding: 1.25rem; }
            .card-hover h3 { font-size: 1.6rem; }
            .card-hover p { font-size: 0.85rem; }
            .quiz-section { padding: 2.5rem; }
            .quiz-section h2 { font-size: 1.8rem; }
            .quiz-section p { font-size: 0.95rem; }
        }

        @media (max-width: 500px) {
            .header-bg { padding: 3rem 1.5rem; }
            .header-bg h1 { font-size: 2.5rem; }
            .header-bg p { font-size: 1rem; }
            .tp-heading {
                font-size: 1.3rem;
                padding: 0.9rem 1.2rem;
                margin-top: 2rem;
                margin-bottom: 1.8rem;
            }
            .intro-section {
                padding: 1.5rem;
                margin-bottom: 2rem;
            }
            .intro-section h2 {
                font-size: 1.7rem;
            }
            .intro-section p {
                font-size: 0.85rem;
            }
            .main-cta-button, .toggle-details, .quiz-cta-button {
                font-size: 0.85rem;
                padding: 0.6rem 1.4rem;
            }
            .card-hover { padding: 1rem; }
            .card-hover h3 { font-size: 1.4rem; }
            .card-hover p { font-size: 0.8rem; }
            .quiz-section { padding: 2rem; }
            .quiz-section h2 { font-size: 1.5rem; }
            .quiz-section p { font-size: 0.85rem; }
        }
    </style>
</head>
<body>
    <!-- Header section with background gradient and text -->
    <header class="header-bg text-white shadow-lg">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold mb-3 leading-tight">Media dan Jaringan Telekomunikasi</h1>
            <p class="text-lg md:text-xl font-light opacity-90">Dasar-Dasar Teknik Jaringan Komputer dan Telekomunikasi</p>
            <p class="text-base md:text-lg font-light mt-2 opacity-80">Semester Genap | Kelas X TJKT</p>
            <div class="mt-8">
                <!-- Call-to-action button to scroll to content -->
                <a href="#materi" class="main-cta-button text-lg transition duration-300 ease-in-out transform hover:scale-105">Mulai Belajar <i class="fas fa-arrow-down ml-2"></i></a>
            </div>
        </div>
    </header>

    <!-- Main content area -->
    <main id="materi" class="container mx-auto px-6 main-content-section">
        <!-- Introduction section -->
        <section class="text-center intro-section">
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">
                Temukan alur pembelajaran Anda dalam dasar-dasar teknik jaringan komputer dan telekomunikasi. Setiap bagian akan membuka wawasan baru!
            </p>
        </section>

        <!-- Group for TP 6.1 -->
        <h3 class="tp-heading">Indikator 6.1: Memahami prinsip dasar sistem IPV4/IPV6, TCP IP, Networking Service, Sistem Keamanan Jaringan Telekomunikasi.</h3>
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Card 1: Prinsip Dasar TCP/IP dan Alamat IP -->
            <div class="card-hover">
                <div>
                    <h3 class="text-xl md:text-2xl lg:text-2xl font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-network-wired text-indigo-500 mr-3"></i>
                        <span class="animated-underline">Prinsip Dasar TCP/IP dan Alamat IP</span>
                    </h3>
                    <p class="text-base text-gray-700 mb-4">
                        Pelajari fondasi komunikasi jaringan, termasuk apa itu TCP/IP dan bagaimana alamat IP bekerja dalam menghubungkan perangkat.
                    </p>
                </div>
                <div class="mt-4">
                    <!-- Toggle button for details -->
                    <button class="toggle-details text-base">
                        Lihat Detail <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <!-- Collapsible details content -->
                    <div class="details-content">
                        <ul class="list-disc list-inside text-base text-gray-700 space-y-1">
                            <li>Pengertian dan Sejarah TCP/IP</li>
                            <li>Struktur dan Kelas Alamat IPv4</li>
                            <li>Konsep Subnetting dan CIDR</li>
                            <li>Pengantar Alamat IPv6</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Card 2: Prinsip Dasar Layanan Jaringan (Networking Service) -->
            <div class="card-hover">
                <div>
                    <h3 class="text-xl md:text-2xl lg:text-2xl font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-cogs text-purple-500 mr-3"></i>
                        <span class="animated-underline">Prinsip Dasar Layanan Jaringan (Networking Service)</span>
                    </h3>
                    <p class="text-base text-gray-700 mb-4">
                        Pahami berbagai layanan penting yang membuat jaringan berfungsi, seperti DNS, DHCP, dan layanan file sharing.
                    </p>
                </div>
                <div class="mt-4">
                    <!-- Toggle button for details -->
                    <button class="toggle-details text-base">
                        Lihat Detail <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <!-- Collapsible details content -->
                    <div class="details-content">
                        <ul class="list-disc list-inside text-base text-gray-700 space-y-1">
                            <li>Fungsi dan Cara Kerja DNS</li>
                            <li>Manajemen IP dengan DHCP</li>
                            <li>Layanan Berbagi Berkas (File Sharing)</li>
                            <li>Layanan Server Web dan Email</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Card 3: Prinsip Dasar Keamanan Jaringan Komputer dan Telekomunikasi -->
            <div class="card-hover">
                <div>
                    <h3 class="text-xl md:text-2xl lg:text-2xl font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-lock text-red-500 mr-3"></i>
                        <span class="animated-underline">Prinsip Dasar Keamanan Jaringan Komputer dan Telekomunikasi</span>
                    </h3>
                    <p class="text-base text-gray-700 mb-4">
                        Pelajari pentingnya keamanan jaringan, ancaman umum, dan cara melindungi data serta sistem dari serangan.
                    </p>
                </div>
                <div class="mt-4">
                    <!-- Toggle button for details -->
                    <button class="toggle-details text-base">
                        Lihat Detail <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <!-- Collapsible details content -->
                    <div class="details-content">
                        <ul class="list-disc list-inside text-base text-gray-700 space-y-1">
                            <li>Ancaman Keamanan Jaringan</li>
                            <li>Enkripsi dan Algoritma (WEP, WPA, WPA2)</li>
                            <li>Firewall dan Intrusion Detection/Prevention Systems (IDS/IPS)</li>
                            <li>Kebijakan Keamanan dan Pentingnya Backup</li>
                            <li>Detail Keamanan WLAN (WEP, WPA, WPA2, WPA2 Enterprise)</li>
                            <li>Metode Enkripsi RC4 dan AES</li>
                            <li>TKIP (Temporal Key Integrity Protocol)</li>
                            <li>WPA2-PSK (Pre-Shared Key)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Group for TP 6.2 -->
        <h3 class="tp-heading">Indikator 6.2: Memahami prinsip dasar Sistem Seluler, Sistem Microwave, Sistem VSAT IP.</h3>
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Card 4: Sistem Seluler, Microwave, & VSAT IP -->
            <div class="card-hover">
                <div>
                    <h3 class="text-xl md:text-2xl lg:text-2xl font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-broadcast-tower text-green-500 mr-3"></i>
                        <span class="animated-underline">Sistem Seluler, Microwave, & VSAT IP</span>
                    </h3>
                    <p class="text-base text-gray-700 mb-4">
                        Pahami teknologi di balik komunikasi nirkabel jarak jauh, termasuk jaringan seluler, transmisi microwave, dan komunikasi satelit VSAT IP.
                    </p>
                </div>
                <div class="mt-4">
                    <!-- Toggle button for details -->
                    <button class="toggle-details text-base">
                        Lihat Detail <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <!-- Collapsible details content -->
                    <div class="details-content">
                        <ul class="list-disc list-inside text-base text-gray-700 space-y-1">
                            <li>Prinsip Dasar Sistem Seluler (GSM, 3G, 4G, 5G)</li>
                            <li>Arsitektur dan Komponen Jaringan Seluler</li>
                            <li>Konsep Transmisi Microwave</li>
                            <li>Aplikasi dan Keunggulan Sistem Microwave</li>
                            <li>Dasar-dasar VSAT IP</li>
                            <li>Implementasi VSAT IP dalam Jaringan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Group for TP 6.3 -->
        <h3 class="tp-heading">Indikator 6.3: Memahami prinsip dasar Sistem Optik dan Sistem WLAN.</h3>
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Card 5: Sistem Optik dan Sistem WLAN -->
            <div class="card-hover">
                <div>
                    <h3 class="text-xl md:text-2xl lg:text-2xl font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-lightbulb text-teal-500 mr-3"></i>
                        <span class="animated-underline">Sistem Optik dan Sistem WLAN</span>
                    </h3>
                    <p class="text-base text-gray-700 mb-4">
                        Jelajahi teknologi komunikasi berbasis cahaya dan jaringan nirkabel lokal, termasuk serat optik dan standar Wi-Fi.
                    </p>
                </div>
                <div class="mt-4">
                    <!-- Toggle button for details -->
                    <button class="toggle-details text-base">
                        Lihat Detail <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <!-- Collapsible details content -->
                    <div class="details-content">
                        <ul class="list-disc list-inside text-base text-gray-700 space-y-1">
                            <li>Konsep Dasar Serat Optik</li>
                            <li>Jenis-jenis Serat Optik dan Aplikasinya</li>
                            <li>Dasar-dasar Wireless LAN (WLAN)</li>
                            <li>Standar dan Konfigurasi Wi-Fi (802.11)</li>
                            <li>Komponen Utama Sistem WLAN (AP, Client)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quiz section -->
        <section class="text-center quiz-section">
            <h2 class="font-bold text-gray-900 mb-4 text-3xl md:text-4xl">Siap untuk Tantangan Berikutnya?</h2>
            <p class="text-lg text-gray-700 mb-6">
                Setelah mempelajari semua materi ini, Anda akan memiliki pemahaman kuat tentang dasar-dasar jaringan.
            </p>
            <!-- Link to the quiz page (placeholder, as Laravel route is not available in standalone HTML) -->
            <a href="#" class="quiz-cta-button text-lg transition duration-300 ease-in-out transform hover:scale-105">
                Uji Pemahaman Anda! <i class="fas fa-trophy ml-2"></i>
            </a>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all buttons with the class 'toggle-details'
            const toggleButtons = document.querySelectorAll('.toggle-details');

            // Iterate over each toggle button to attach event listeners
            toggleButtons.forEach(button => {
                // Find the corresponding details content div within the same card
                const detailsContent = button.closest('.card-hover').querySelector('.details-content');

                // Add click event listener to each button
                button.addEventListener('click', function() {
                    // Select the icon within the clicked button
                    const icon = this.querySelector('i');

                    // Toggle the 'is-expanded' class on the details content.
                    // This class controls the max-height, opacity, and padding-top for the expansion animation.
                    detailsContent.classList.toggle('is-expanded');

                    // Update the button text and icon based on the expanded state
                    if (detailsContent.classList.contains('is-expanded')) {
                        // If expanded, change icon to 'chevron-up' and text to 'Sembunyikan Detail'
                        icon.classList.remove('fa-chevron-down');
                        icon.classList.add('fa-chevron-up');
                        this.innerHTML = 'Sembunyikan Detail <i class="fas fa-chevron-up ml-2"></i>';
                    } else {
                        // If collapsed, change icon to 'chevron-down' and text to 'Lihat Detail'
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                        this.innerHTML = 'Lihat Detail <i class="fas fa-chevron-down ml-2"></i>';
                    }
                });
            });
        });
    </script>
</body>
</html>

@endsection