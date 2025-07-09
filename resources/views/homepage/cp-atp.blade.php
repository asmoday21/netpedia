<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen CP/ATP | Teknik Jaringan Komputer</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Tom Select CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Define custom CSS variables for consistent theming */
        :root {
            --primary-color: #4361ee; /* Blue */
            --secondary-color: #3f37c9; /* Darker blue */
            --accent-color: #4cc9f0; /* Light blue/cyan */
            --light-bg: #f0f2f5; /* Lighter background for body */
            --card-bg: #ffffff; /* White background for cards */
            --dark-text: #212529; /* Dark text */
            --muted-text: #6c757d; /* Muted text */
            --border-color: #e9ecef; /* Light border color */
            --shadow-light: rgba(0, 0, 0, 0.05); /* Light shadow */
            --shadow-medium: rgba(0, 0, 0, 0.1); /* Medium shadow */
            --shadow-strong: rgba(67, 97, 238, 0.2); /* Strong shadow for hero */
        }
        
        /* General body styling */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased; /* Smoother fonts on WebKit browsers */
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%239C92AC' fill-opacity='0.05' fill-rule='evenodd'%3E%3Cpath d='M0 0h30v60H0zM30 0h30v60H30z' fill='%239C92AC' fill-opacity='0.05'/%3E%3C/g%3E%3C/svg%3E"); /* Subtle background pattern */
        }
        
        /* Navbar specific styling */
        .navbar {
            box-shadow: 0 4px 12px var(--shadow-light) !important;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.6rem; /* Slightly larger font */
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            color: var(--secondary-color); /* Icon color */
        }
        
        .nav-link {
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link.active {
            color: var(--primary-color) !important;
        }

        .nav-link:hover {
            color: var(--secondary-color);
        }

        /* Hero Section styling */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 4rem 0; /* Increased padding */
            border-radius: 0 0 30px 30px; /* More pronounced rounded bottom corners */
            margin-bottom: 2.5rem; /* Increased margin */
            box-shadow: 0 15px 40px var(--shadow-strong); /* Stronger shadow */
            position: relative;
            overflow: hidden; /* Hide overflowing pseudo-elements */
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at top left, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(20deg);
            pointer-events: none;
        }

        .hero-section h1 {
            font-size: 3rem; /* Larger heading */
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2); /* Text shadow for depth */
            margin-bottom: 1rem !important;
        }

        .hero-section .lead {
            font-size: 1.15rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 2rem !important;
        }
        
        /* Card for documents */
        .card-document {
            border: none;
            border-radius: 20px; /* More rounded corners */
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); /* Smoother transition */
            box-shadow: 0 8px 25px var(--shadow-light); /* Refined shadow */
            background-color: var(--card-bg);
            margin-bottom: 2rem;
        }
        
        .card-document:hover {
            transform: translateY(-8px); /* More pronounced lift */
            box-shadow: 0 20px 40px var(--shadow-medium); /* Stronger hover shadow */
        }
        
        .card-document .card-body {
            padding: 2rem; /* More padding */
        }
        
        .card-document .card-title {
            font-weight: 700; /* Bolder title */
            font-size: 1.75rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .card-document .card-text {
            color: var(--muted-text);
            font-size: 1rem; /* Slightly larger text */
            margin-bottom: 1.5rem;
        }

        .badge {
            padding: 0.6em 1em;
            border-radius: 50px;
            font-weight: 500;
        }

        .bg-primary.bg-opacity-10 {
            background-color: rgba(67, 97, 238, 0.1) !important;
        }
        
        /* Button styling */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.8rem 2rem; /* Larger padding */
            font-weight: 600; /* Bolder text */
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.2);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px); /* Slight lift on hover */
            box-shadow: 0 8px 20px rgba(63, 55, 201, 0.3);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.8rem 2rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.2);
        }

        .btn-light {
            color: var(--primary-color); /* Text color for light button */
        }
        .btn-light:hover {
            background-color: rgba(255, 255, 255, 0.9);
            color: var(--secondary-color);
        }

        /* Iframe container */
        .iframe-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            border-radius: 20px; /* More rounded corners */
            box-shadow: 0 10px 30px var(--shadow-medium);
            background-color: var(--card-bg); /* Use card background for iframe container */
            margin-bottom: 2.5rem;
            border: 1px solid var(--border-color); /* Subtle border */
        }
        
        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 20px;
            border: none;
            background-color: #f1f3f5; /* Light background for iframe area */
        }
        
        /* Fullscreen button for iframe */
        .fullscreen-btn {
            position: absolute;
            top: 15px; /* Slightly more inner padding */
            right: 15px;
            background: rgba(0, 0, 0, 0.6); /* Slightly transparent */
            color: white;
            border: none;
            padding: 0.6rem 1.2rem; /* Larger padding */
            border-radius: 50px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            z-index: 10;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px); /* Blurred background */
        }
        
        .fullscreen-btn:hover {
            background: rgba(0, 0, 0, 0.8);
            transform: translateY(-2px);
        }

        /* Document action buttons */
        .document-actions {
            display: flex;
            gap: 1.5rem; /* Increased gap */
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2.5rem;
        }
        
        .document-actions .btn {
            min-width: 200px; /* Slightly wider buttons */
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem; /* Larger gap for icon */
            font-size: 1rem; /* Slightly larger font */
            transition: all 0.3s ease;
        }
        
        .document-actions .btn:hover {
            transform: translateY(-3px); /* More noticeable lift */
        }
        
        /* Tom Select specific styling enhancements */
        .select-container {
            max-width: 900px; /* Wider selector */
            margin: 0 auto 3rem; /* More margin at bottom */
        }
        
        .form-label {
            font-size: 1.1rem;
            color: var(--dark-text);
            margin-bottom: 1rem !important;
            display: block; /* Ensure it takes full width */
        }

        .ts-wrapper.form-control {
            padding: 0 !important; /* Remove default padding to control inner elements */
            border: none !important; /* Remove outer border */
            box-shadow: none !important; /* Remove outer shadow */
            border-radius: 15px !important; /* Ensure consistent rounding */
        }

        .ts-control {
            padding: 1rem 1.25rem !important; /* More generous padding */
            border-radius: 15px !important; /* Consistent rounding */
            border: 2px solid var(--border-color) !important; /* Defined border */
            font-size: 1.05rem; /* Slightly larger font */
            background-color: var(--card-bg);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            height: auto !important; /* Allow height to adjust */
            min-height: 55px; /* Minimum height for better click area */
        }
        
        .ts-control:focus {
            border-color: var(--primary-color) !important; /* Highlight on focus */
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25) !important; /* Focus glow */
        }

        .ts-dropdown {
            border-radius: 15px !important; /* Consistent rounding */
            border: 1px solid var(--border-color) !important;
            box-shadow: 0 8px 25px var(--shadow-light) !important; /* Dropdown shadow */
            background-color: var(--card-bg);
        }

        .ts-dropdown .ts-dropdown-content {
            padding: 0.5rem 0;
        }

        .ts-dropdown .option {
            padding: 0.75rem 1.5rem;
            transition: background-color 0.2s ease;
        }

        .ts-dropdown .option.active {
            background-color: var(--primary-color);
            color: white;
        }

        .ts-dropdown .option.active .text-primary,
        .ts-dropdown .option.active .text-muted {
            color: white !important;
        }

        /* Footer styling */
        .footer {
            background-color: var(--card-bg); /* White background */
            padding: 2.5rem 0; /* More padding */
            margin-top: 4rem; /* More margin */
            border-top: 1px solid var(--border-color);
            box-shadow: 0 -4px 12px var(--shadow-light); /* Shadow above footer */
        }
        
        .footer .text-muted {
            font-size: 0.95rem;
        }

        .footer a {
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--primary-color) !important; /* Highlight social icons on hover */
        }
        
        /* Toast Notification styling */
        #notifToast {
            position: fixed;
            top: 1.5rem; /* Slightly lower */
            right: 1.5rem; /* Slightly more to the right */
            z-index: 1055;
            border-radius: 12px; /* More rounded */
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Shadow for toast */
        }

        #notifToast .toast-body {
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        #notifToast .btn-close {
            filter: invert(1); /* White close button */
        }
        
        /* Empty State styling */
        .empty-state {
            text-align: center;
            padding: 4rem; /* More padding */
            background-color: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 8px 25px var(--shadow-light);
        }
        
        .empty-state i {
            font-size: 4rem; /* Larger icon */
            color: var(--accent-color); /* Use accent color for icon */
            margin-bottom: 1.5rem;
            display: block; /* Ensure it's block for margin */
        }
        
        .empty-state h4 {
            color: var(--dark-text);
            margin-bottom: 0.75rem;
            font-weight: 600;
            font-size: 1.75rem;
        }
        
        .empty-state p {
            color: var(--muted-text);
            max-width: 600px; /* Wider paragraph */
            margin: 0.5rem auto;
            font-size: 1.05rem;
        }
        
        /* Fullscreen mode for iframe */
        .iframe-container.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            padding-bottom: 0; /* No aspect ratio padding in fullscreen */
            z-index: 9999;
            border-radius: 0;
            background-color: black; /* Dark background in fullscreen */
            box-shadow: none;
        }

        .iframe-container.fullscreen iframe {
            border-radius: 0;
            background-color: black;
        }

        .iframe-container.fullscreen .fullscreen-btn {
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2); /* Lighter background in fullscreen */
            color: white;
        }

        .iframe-container.fullscreen .fullscreen-btn:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0;
                border-radius: 0 0 20px 20px;
            }

            .hero-section h1 {
                font-size: 2.2rem;
            }

            .hero-section .lead {
                font-size: 1rem;
            }
            
            .document-actions {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }
            
            .document-actions .btn {
                width: 90%; /* Adjust width for mobile */
                min-width: unset; /* Remove min-width constraint */
            }

            .card-document .card-title {
                font-size: 1.5rem;
            }

            .empty-state {
                padding: 2rem;
            }

            .empty-state i {
                font-size: 3rem;
            }

            .empty-state h4 {
                font-size: 1.4rem;
            }

            .empty-state p {
                font-size: 0.9rem;
            }

            #notifToast {
                top: 0.5rem;
                right: 0.5rem;
                width: calc(100% - 1rem); /* Full width minus margin */
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-file-earmark-text-fill me-2"></i>CP/ATP Docs
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- Added ms-auto for right alignment -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">
                            <i class="bi bi-house-door-fill me-1"></i> Beranda
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-5 fw-bold mb-3">Dokumen CP/ATP</h1>
            <p class="lead mb-4">
                Akses lengkap dokumen Capaian Pembelajaran (CP) dan Alur Tujuan Pembelajaran (ATP) untuk Teknik Jaringan Komputer dan Telekomunikasi
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container my-4">
        <!-- Document Selector -->
        <div class="select-container">
            <label for="docSelector" class="form-label fw-semibold mb-3">Cari Dokumen:</label>
            <select id="docSelector" placeholder="Pilih atau ketik nama dokumen...">
                <option value="">Pilih Dokumen...</option>
                <option value="ID_DOC_JARINGAN">Sistem Layanan Jaringan</option>
                <option value="ID_DOC_PROSES_BISNIS">Proses bisnis di bidang teknik jaringan komputer dan telekomunikasi</option>
                <option value="ID_DOC_PERKEMBANGAN">Perkembangan teknologi di bidang teknik jaringan komputer dan telekomunikasi</option>
                <option value="ID_DOC_PROFESI">Profesi dan Kewirausahaan</option>
                <option value="ID_DOC_K3LH">Keselamatan dan Kesehatan Kerja Lingkungan Hidup (K3LH)</option>
                <option value="1PqftIKRKcFVVVbx2JGskPRr1KsJ-JNcd">Media dan Jaringan Telekomunikasi</option>
                <option value="ID_DOC_ALAT_UKUR">Penggunaan Alat Ukur</option>
            </select>
        </div>

        <!-- Document Content -->
        <div id="docContent" style="display: none;">
            <!-- Document Preview -->
            <div class="iframe-container" id="iframeContainer">
                <iframe id="cpAtpFrame" allow="autoplay" loading="lazy"></iframe>
                <button class="fullscreen-btn" onclick="toggleFullscreen()">
                    <i class="bi bi-fullscreen"></i> Layar Penuh
                </button>
            </div>

            <!-- Document Actions -->
            <div class="document-actions">
                <a id="downloadLink" href="#" class="btn btn-primary" target="_blank">
                    <i class="bi bi-download"></i> Unduh Dokumen
                </a>
            </div>

            <!-- Document Info -->
            <div class="card card-document">
                <div class="card-body">
                    <h5 class="card-title" id="docTitle">Judul Dokumen</h5>
                    <p class="card-text">Dokumen Capaian Pembelajaran dan Alur Tujuan Pembelajaran untuk mata pelajaran Teknik Jaringan Komputer dan Telekomunikasi.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary">PDF</span>
                        <span class="badge bg-primary bg-opacity-10 text-primary">CP/ATP</span>
                        <span class="badge bg-primary bg-opacity-10 text-primary">Teknik Jaringan</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="empty-state">
            <i class="bi bi-file-earmark-text"></i>
            <h4>Belum ada dokumen dipilih</h4>
            <p>Silakan pilih dokumen dari dropdown di atas untuk melihat pratinjau, mengunduh, atau mencetak dokumen CP/ATP.</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p class="text-muted mb-2">© 2025 Dokumen CP/ATP - Teknik Jaringan Komputer dan Telekomunikasi</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="text-decoration-none text-muted"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-decoration-none text-muted"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-decoration-none text-muted"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-decoration-none text-muted"><i class="bi bi-envelope"></i></a>
            </div>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div class="toast align-items-center text-white bg-success border-0" id="notifToast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-check-circle-fill me-2"></i> Dokumen berhasil dimuat
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    <!-- Tom Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <!-- Bootstrap Bundle JS (with Toast support) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Initialize TomSelect
        new TomSelect("#docSelector", {
            maxItems: 1,
            create: false,
            plugins: ['dropdown_input'],
            render: {
                option: function(data, escape) {
                    return `<div class="d-flex align-items-center p-2">
                        <i class="bi bi-file-earmark-text me-2 text-primary"></i>
                        <div>
                            <div class="fw-semibold">${escape(data.text)}</div>
                            <small class="text-muted">Dokumen CP/ATP</small>
                        </div>
                    </div>`;
                },
                item: function(data, escape) {
                    return `<div class="d-flex align-items-center">
                        <i class="bi bi-file-earmark-text me-1 text-primary"></i>
                        <span>${escape(data.text)}</span>
                    </div>`;
                }
            }
        });

        // Function to change the displayed document
        function changeDoc() {
            const docId = document.getElementById('docSelector').value;
            const iframe = document.getElementById('cpAtpFrame');
            const downloadLink = document.getElementById('downloadLink');
            const docContent = document.getElementById('docContent');
            const emptyState = document.getElementById('emptyState');
            const docTitle = document.getElementById('docTitle');
            const selectedOption = document.querySelector('#docSelector option:checked');

            // Hide the toast if it's currently showing
            const toastElement = document.getElementById('notifToast');
            const toast = bootstrap.Toast.getInstance(toastElement);
            if (toast) {
                toast.hide();
            }

            if (docId) {
                // Construct Google Drive preview and download links
                // Note: 'ID_DOC_JARINGAN' and similar values are placeholders.
                // For actual Google Drive files, these IDs should be valid Google Drive File IDs.
                iframe.src = `https://drive.google.com/file/d/${docId}/preview`;
                downloadLink.href = `https://drive.google.com/uc?export=download&id=${docId}`;
                
                // Show document content and hide empty state
                docContent.style.display = 'block';
                emptyState.style.display = 'none';
                
                // Update document title
                if (selectedOption) {
                    docTitle.textContent = selectedOption.text;
                }

                // Show notification toast after a slight delay to ensure iframe loads
                setTimeout(() => {
                    const newToast = new bootstrap.Toast(toastElement);
                    newToast.show();
                }, 500); // Delay to ensure visual loading perception
            } else {
                // If no document is selected, show empty state and hide document content
                docContent.style.display = 'none';
                emptyState.style.display = 'block';
                iframe.src = ''; // Clear iframe content
                downloadLink.href = '#'; // Reset download link
                docTitle.textContent = 'Judul Dokumen'; // Reset title
            }
        }

        // Function to print the content of the iframe
        function printIframe() {
            const iframe = document.getElementById('cpAtpFrame');
            try {
                // Check if the iframe contentWindow is accessible
                const win = iframe.contentWindow;
                if (win) {
                    win.focus(); // Focus on the iframe content
                    win.print(); // Trigger print dialog for iframe content
                } else {
                    console.error("Could not access iframe contentWindow for printing.");
                    // In a real application, you might show a user-friendly message here.
                }
            } catch (e) {
                console.error("Error attempting to print iframe:", e);
                // Handle security restrictions or other errors during print
            }
        }

        // Function to toggle fullscreen mode for the iframe container
        function toggleFullscreen() {
            const iframeContainer = document.getElementById('iframeContainer');
            if (!iframeContainer.classList.contains('fullscreen')) {
                // Enter fullscreen
                iframeContainer.classList.add('fullscreen');
                if (iframeContainer.requestFullscreen) {
                    iframeContainer.requestFullscreen();
                } else if (iframeContainer.mozRequestFullScreen) { // Firefox
                    iframeContainer.mozRequestFullScreen();
                } else if (iframeContainer.webkitRequestFullscreen) { // Chrome, Safari, Opera
                    iframeContainer.webkitRequestFullscreen();
                } else if (iframeContainer.msRequestFullscreen) { // IE/Edge
                    iframeContainer.msRequestFullscreen();
                }
            } else {
                // Exit fullscreen
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) { // Firefox
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) { // Chrome, Safari, Opera
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { // IE/Edge
                    document.msExitFullscreen();
                }
                iframeContainer.classList.remove('fullscreen');
            }
        }

        // Listen for changes on the document selector to load new documents
        document.getElementById('docSelector').addEventListener('change', changeDoc);

        // Optional: Add a listener for fullscreen change events to update button text/icon
        document.addEventListener('fullscreenchange', () => {
            const fullscreenBtn = document.querySelector('.fullscreen-btn');
            if (document.fullscreenElement) {
                fullscreenBtn.innerHTML = '<i class="bi bi-fullscreen-exit"></i> Keluar Layar Penuh';
            } else {
                document.getElementById('iframeContainer').classList.remove('fullscreen'); // Ensure class is removed on exit
                fullscreenBtn.innerHTML = '<i class="bi bi-fullscreen"></i> Layar Penuh';
            }
        });
        document.addEventListener('mozfullscreenchange', () => {
            const fullscreenBtn = document.querySelector('.fullscreen-btn');
            if (document.mozFullScreenElement) {
                fullscreenBtn.innerHTML = '<i class="bi bi-fullscreen-exit"></i> Keluar Layar Penuh';
            } else {
                document.getElementById('iframeContainer').classList.remove('fullscreen');
                fullscreenBtn.innerHTML = '<i class="bi bi-fullscreen"></i> Layar Penuh';
            }
        });
        document.addEventListener('webkitfullscreenchange', () => {
            const fullscreenBtn = document.querySelector('.fullscreen-btn');
            if (document.webkitFullscreenElement) {
                fullscreenBtn.innerHTML = '<i class="bi bi-fullscreen-exit"></i> Keluar Layar Penuh';
            } else {
                document.getElementById('iframeContainer').classList.remove('fullscreen');
                fullscreenBtn.innerHTML = '<i class="bi bi-fullscreen"></i> Layar Penuh';
            }
        });
        document.addEventListener('msfullscreenchange', () => {
            const fullscreenBtn = document.querySelector('.fullscreen-btn');
            if (document.msFullscreenElement) {
                fullscreenBtn.innerHTML = '<i class="bi bi-fullscreen-exit"></i> Keluar Layar Penuh';
            } else {
                document.getElementById('iframeContainer').classList.remove('fullscreen');
                fullscreenBtn.innerHTML = '<i class="bi bi-fullscreen"></i> Layar Penuh';
            }
        });

    </script>
</body>
</html>
