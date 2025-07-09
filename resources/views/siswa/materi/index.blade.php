@extends('siswa.siswa_master')
@section('siswa')

    <style>
        :root {
            --primary-color: #007bff; /* Professional Blue */
            --secondary-color: #6610f2; /* Deep Purple */
            --success-color: #28a745; /* Professional Green */
            --danger-color: #dc3545; /* Professional Red */
            --warning-color: #ffc107; /* Professional Yellow */
            --info-color: #17a2b8; /* Professional Cyan */

            --light-bg-start: #f8f9fa; /* Very Light Gray */
            --light-bg-end: #e9ecef; /* Slightly Darker Light Gray */
            --card-bg-light: #ffffff; /* Pure White Card */
            --border-light: #dee2e6; /* Light Gray Border */
            --text-dark-primary: #212529; /* Dark Gray Text */
            --text-dark-secondary: #6c757d; /* Medium Gray Text */
            --shadow-light: 0 4px 15px rgba(0, 0, 0, 0.08); /* Subtle Shadow */
            --header-glow: 0 0 30px rgba(0, 123, 255, 0.2); /* Soft blue glow */
            --button-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--light-bg-start) 0%, var(--light-bg-end) 100%);
            color: var(--text-dark-primary);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background particles for light theme */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(0, 123, 255, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(102, 16, 242, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(40, 167, 69, 0.03) 0%, transparent 50%);
            z-index: -1;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .main-title {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: center;
            font-weight: 800;
            /* Perbesar font judul utama */
            font-size: 2.75rem; 
            margin-bottom: 2rem;
            text-shadow: 0 0 20px rgba(0, 123, 255, 0.3);
        }

        .search-container {
            background: var(--card-bg-light);
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid var(--border-light);
            box-shadow: var(--shadow-light);
            margin-bottom: 3rem;
        }

        .search-input {
            background: #f1f3f5;
            border: 1px solid var(--border-light);
            color: var(--text-dark-primary);
            border-radius: 15px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            background: #ffffff;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
            color: var(--text-dark-primary);
        }

        .search-input::placeholder {
            color: var(--text-dark-secondary);
        }

        .btn-search {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 15px;
            padding: 0.75rem 2rem;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--button-shadow);
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.2);
            color: white;
        }

        .btn-add-material {
            background: linear-gradient(135deg, var(--success-color), #218838);
            border: none;
            border-radius: 15px;
            padding: 0.75rem 2rem;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--button-shadow);
        }

        .btn-add-material:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.2);
            color: white;
        }

        .material-card {
            background: var(--card-bg-light);
            border: 1px solid var(--border-light);
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            height: 100%;
        }

        .material-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .material-card:hover::before {
            transform: scaleX(1);
        }

        .material-card:hover:not(.locked-overlay) {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 0 30px rgba(0, 123, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
            border-color: rgba(0, 123, 255, 0.3);
        }

        .material-card.locked-overlay:hover {
            transform: translateY(-5px) scale(1.01);
            box-shadow: 
                0 10px 20px rgba(0, 0, 0, 0.05),
                0 0 15px rgba(255, 193, 7, 0.05);
            border-color: rgba(255, 193, 7, 0.1);
        }

        .core-badge {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            /* Perbesar font badge inti */
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.1);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .material-icon {
            /* Perbesar ikon materi */
            font-size: 2.25rem;
            margin-bottom: 1rem;
            display: block;
        }

        .icon-tcp { color: var(--primary-color); }
        .icon-network { color: var(--success-color); }
        .icon-security { color: var(--danger-color); }
        .icon-telecom { color: #6f42c1; } /* Darker purple for telecom */
        .icon-optic-wlan { color: #17a2b8; } /* Cyan for optic/wlan */

        .progress-indicator {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            /* Perbesar font indikator progres */
            font-size: 1.3rem;
            font-weight: bold;
            z-index: 10;
        }

        .progress-completed {
            background: linear-gradient(135deg, var(--success-color), #218838);
            color: white;
            box-shadow: 0 0 15px rgba(40, 167, 69, 0.2);
        }

        .progress-locked {
            background: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
            border: 2px solid var(--warning-color);
        }

        .progress-available {
            background: rgba(0, 123, 255, 0.1);
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from { box-shadow: 0 0 10px rgba(0, 123, 255, 0.2); }
            to { box-shadow: 0 0 20px rgba(0, 123, 255, 0.4); }
        }

        .score-display {
            position: absolute;
            top: 4rem;
            right: 1rem;
            background: rgba(40, 167, 69, 0.9);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            /* Perbesar font tampilan skor */
            font-size: 0.9rem;
            font-weight: 600;
            z-index: 10;
        }

        .locked-overlay {
            position: relative;
        }

        .locked-overlay::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.85); /* Lighter overlay */
            backdrop-filter: blur(8px);
            border-radius: 20px;
            z-index: 2;
        }

        .lock-indicator {
            position: absolute;
            top: 50%; /* Center vertically */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Adjust for exact centering */
            z-index: 3;
            text-align: center;
            color: var(--warning-color);
            pointer-events: none;
            display: flex; /* Use flexbox for internal alignment */
            flex-direction: column; /* Stack elements vertically */
            align-items: center; /* Center horizontally in flex container */
            justify-content: center; /* Center vertically in flex container */
            width: 80%; /* Limit width to ensure wrapping */
            max-width: 250px; /* Max width for consistency */
        }

        .lock-icon {
            /* Perbesar ikon kunci */
            font-size: 4.5rem;
            margin-bottom: 0.75rem; /* Reduced margin */
            animation: shake 0.5s ease-in-out infinite alternate;
            filter: drop-shadow(0 0 10px rgba(255, 193, 7, 0.5));
        }

        @keyframes shake {
            0% { transform: rotate(-5deg); }
            100% { transform: rotate(5deg); }
        }

        .lock-text {
            /* Perbesar font teks kunci */
            font-size: 1.2rem;
            font-weight: 600;
            text-shadow: 0 0 10px rgba(255, 193, 7, 0.3);
            margin-bottom: 0.75rem; /* Added margin for separation */
        }

        .unlock-requirements {
            /* Perbesar font persyaratan buka kunci */
            font-size: 1rem;
            color: var(--text-dark-secondary);
            /* margin-top: 0.5rem; Removed as flex handles it */
            max-width: 250px; /* Ensure text wraps */
            line-height: 1.4;
            color: #6c757d; /* Ensuring muted color */
            text-shadow: 0 0 5px rgba(255, 193, 7, 0.1); /* Subtle glow */
        }

        .btn-material {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 15px;
            padding: 0.75rem 1.5rem;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            box-shadow: var(--button-shadow);
        }

        .btn-material:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.2);
            color: white;
        }

        .btn-material:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
            background: #e0e0e0; /* Lighter disabled button */
            color: #999;
            box-shadow: none;
        }

        .btn-material.btn-success {
            background: linear-gradient(135deg, var(--success-color), #218838);
            box-shadow: var(--button-shadow);
        }

        .btn-material.btn-success:hover:not(:disabled) {
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.2);
        }

        .btn-material.btn-danger {
            background: linear-gradient(135deg, var(--danger-color), #c82333);
            box-shadow: var(--button-shadow);
        }

        .btn-material.btn-danger:hover:not(:disabled) {
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.2);
        }

        .section-divider {
            display: flex;
            align-items: center;
            margin: 4rem 0;
            opacity: 0.7;
        }

        .section-divider::before,
        .section-divider::after {
            content: '';
            flex: 1;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--border-light), transparent);
        }

        .section-divider span {
            padding: 0 2rem;
            /* Perbesar font teks pembagi bagian */
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-dark-secondary);
            background: var(--card-bg-light);
            border-radius: 25px;
            border: 1px solid var(--border-light);
        }

        .simulation-controls {
            background: var(--card-bg-light);
            border-radius: 20px;
            padding: 2rem;
            margin: 3rem 0;
            border: 1px solid var(--border-light);
            box-shadow: var(--shadow-light);
        }

        .btn-simulate {
            margin: 0.25rem;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            /* Perbesar font tombol simulasi */
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: var(--button-shadow);
        }

        .btn-simulate.btn-info {
            background: linear-gradient(135deg, var(--info-color), #138496);
            border: none;
            color: white;
        }

        .btn-simulate.btn-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            border: none;
            color: white;
        }

        .btn-simulate.btn-warning {
            background: linear-gradient(135deg, var(--warning-color), #d39e00);
            border: none;
            color: white;
        }

        .alert {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            color: var(--text-dark-primary); /* Ensure text is dark on light alerts */
            /* Perbesar font alert */
            font-size: 1.1rem;
        }
        .alert-success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
        .alert-warning { background-color: #fff3cd; border-color: #ffeeba; color: #856404; }
        .alert-info { background-color: #d1ecf1; border-color: #bee5eb; color: #0c5460; }
        .alert-danger { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }


        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(0, 0, 0, 0.3); /* Darker spinner for light background */
            border-top: 2px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Styles for CP/TP Section */
        .cp-tp-section {
            background: linear-gradient(135deg, #e0f2f7 0%, #cce7f0 100%); /* Soft blue gradient */
            border-radius: 25px; /* More rounded */
            padding: 3rem; /* More padding */
            border: 2px solid var(--primary-color); /* Stronger primary color border */
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.2); /* More prominent shadow */
            margin-bottom: 3.5rem; /* Increased space below */
            position: relative;
            overflow: hidden;
        }

        .cp-tp-section::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            width: 80px;
            height: 80px;
            background: var(--secondary-color);
            border-radius: 50%;
            opacity: 0.1;
            filter: blur(20px);
            animation: move-particle-1 15s ease-in-out infinite alternate;
        }
        .cp-tp-section::after {
            content: '';
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 100px;
            height: 100px;
            background: var(--primary-color);
            border-radius: 50%;
            opacity: 0.1;
            filter: blur(25px);
            animation: move-particle-2 18s ease-in-out infinite alternate-reverse;
        }

        @keyframes move-particle-1 {
            from { transform: translate(0, 0); }
            to { transform: translate(50px, 30px); }
        }
        @keyframes move-particle-2 {
            from { transform: translate(0, 0); }
            to { transform: translate(-40px, -60px); }
        }


        .cp-tp-section h2 {
            font-size: 2.2rem; /* Larger font */
            font-weight: 800; /* Extra bold */
            color: #0056b3; /* Darker blue for heading */
            margin-bottom: 2rem; /* More space below */
            text-align: center;
            position: relative;
            padding-bottom: 0.75rem; /* Space for underline effect */
        }
        .cp-tp-section h2::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 80px; /* Short underline */
            height: 4px; /* Thicker underline */
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        .cp-tp-section h3 {
            font-size: 1.5rem; /* Larger font for subheadings */
            font-weight: 700; /* Bolder */
            color: var(--text-dark-primary);
            margin-bottom: 1.25rem; /* More space below */
            border-left: 5px solid var(--success-color); /* Green accent border */
            padding-left: 1rem;
            padding-bottom: 0; /* Remove bottom padding as border is left */
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .cp-tp-section h3 i {
            font-size: 1.5rem; /* Larger icon */
            color: var(--success-color); /* Green icon */
        }

        .cp-tp-section ul {
            list-style: none; /* Remove default list bullets */
            padding-left: 0; /* Remove default padding */
            margin-left: 0;
            border-left: 1px dashed var(--border-light); /* Subtle dashed line for list structure */
            padding-left: 1.5rem; /* Padding for the dashed line */
        }

        .cp-tp-section ul li {
            font-size: 1.05rem; /* Slightly larger list items */
            color: var(--text-dark-secondary);
            margin-bottom: 0.75rem; /* More space between list items */
            display: flex;
            align-items: flex-start;
            line-height: 1.6; /* Better line height */
        }

        .cp-tp-section ul li i {
            color: var(--success-color); /* Checkmark icon color */
            margin-right: 0.75rem;
            margin-top: 0.2rem; /* Align icon with text */
            font-size: 1.2rem; /* Larger icon */
            flex-shrink: 0; /* Prevent icon from shrinking */
        }
        
        .cp-tp-section p { /* For the Capaian Pembelajaran description */
            font-size: 1.05rem;
            color: var(--text-dark-primary);
            line-height: 1.6;
            margin-bottom: 1.5rem; /* Space below description */
            padding: 0 0.5rem; /* Slight horizontal padding */
        }


        @media (max-width: 768px) {
            .main-title {
                font-size: 2.25rem; /* Slightly larger on small screens */
            }
            
            .search-container {
                padding: 1rem;
            }
            
            .material-card:hover:not(.locked-overlay) {
                transform: translateY(-5px) scale(1.01);
            }

            .progress-indicator {
                width: 45px; /* Slightly larger */
                height: 45px; /* Slightly larger */
                font-size: 1.1rem; /* Slightly larger */
            }

            .score-display {
                top: 3.75rem; /* Adjusted position */
                font-size: 0.8rem; /* Slightly larger */
                padding: 0.2rem 0.6rem; /* Slightly larger padding */
            }

            .lock-indicator {
                width: 90%; /* Wider on small screens */
            }

            .lock-icon {
                font-size: 3.5rem; /* Slightly smaller icon on small screens */
            }

            .lock-text {
                font-size: 1.1rem; /* Slightly smaller */
            }

            .unlock-requirements {
                font-size: 0.9rem; /* Slightly larger */
            }

            .core-badge {
                font-size: 0.8rem; /* Adjusted for smaller screens */
            }

            .material-icon {
                font-size: 2rem; /* Adjusted for smaller screens */
            }

            .card-title.fw-bold.mb-3 { /* For h5 in cards */
                font-size: 1.2rem !important; /* Specific override for card titles on mobile */
            }

            .card-text.text-muted.mb-4 { /* For p in cards */
                font-size: 0.9rem !important; /* Specific override for card text on mobile */
            }

            .btn-material {
                font-size: 0.95rem; /* Adjusted for smaller screens */
                padding: 0.6rem 1.2rem;
            }

            .section-divider span {
                font-size: 1.1rem; /* Adjusted for smaller screens */
                padding: 0 1.5rem;
            }

            .simulation-controls h6 {
                font-size: 1.1rem; /* Adjusted for smaller screens */
            }

            .btn-simulate {
                font-size: 0.85rem; /* Adjusted for smaller screens */
                padding: 0.4rem 0.8rem;
            }

            .alert {
                font-size: 1rem; /* Adjusted for smaller screens */
            }

            .cp-tp-section {
                padding: 1.5rem;
                border-radius: 15px;
            }
            .cp-tp-section h2 {
                font-size: 1.8rem;
                margin-bottom: 1.5rem;
            }
            .cp-tp-section h2::after {
                width: 60px;
                height: 3px;
            }
            .cp-tp-section h3 {
                font-size: 1.2rem;
                margin-bottom: 1rem;
                padding-left: 0.75rem;
            }
            .cp-tp-section h3 i {
                font-size: 1.3rem;
            }
            .cp-tp-section p {
                font-size: 0.95rem;
                margin-bottom: 1rem;
            }
            .cp-tp-section ul li {
                font-size: 0.95rem;
                margin-bottom: 0.4rem;
            }
            .cp-tp-section ul li i {
                font-size: 1.05rem;
                margin-top: 0.15rem;
            }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="main-title">
            <i class="bi bi-cpu me-3"></i>
            Media dan Jaringan Telekomunikasi
        </h1>        
        <h2 class="text-center mb-5" style="color: var(--text-dark-primary); font-weight: 700; font-size: 1.75rem;">
            Kelas X TJKT | Semester Genap
        </h2>

        <!-- Search Section -->
        <div class="search-container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <form method="GET" class="d-flex w-100 w-md-75" role="search">
                    <input 
                        type="search" 
                        name="search" 
                        class="form-control search-input me-3" 
                        placeholder="🔍 Cari materi pembelajaran..." 
                        aria-label="Search materials"
                    >
                    <button class="btn btn-search" type="submit">
                        <i class="bi bi-search me-2"></i> Cari
                    </button>
                </form>
            </div>
        </div>

        <!-- Capaian Pembelajaran (CP) and Tujuan Pembelajaran (TP) Section -->
        <div class="cp-tp-section">
            <h2>Capaian Pembelajaran</h2>
            
            <h3>Capaian Pembelajaran</h3>
            <p style="color: var(--text-dark-secondary); font-size: 1rem; line-height: 1.5;">
                Pada akhir fase E, peserta didik mampu memahami prinsip dasar sistem IPV4/IPV6, TCP IP, Networking Service, Sistem Keamanan Jaringan Telekomunikasi, Sistem Seluler, Sistem Microwave, Sistem VSAT IP, Sistem Optik, dan Sistem WLAN.
            </p>

            {{-- <h3 class="mt-4"><i class="bi bi-list-check"></i>Tujuan Pembelajaran</h3>
            <ul>
                <li><i class="bi bi-check-circle-fill"></i>6.1 Memahami prinsip dasar sistem IPV4/IPV6, TCP IP, Networking Service, Sistem Keamanan Jaringan Telekomunikasi.</li>
                <li><i class="bi bi-check-circle-fill"></i>6.2 Memahami prinsip dasar Sistem Seluler, Sistem Microwave, Sistem VSAT IP.</li>
                <li><i class="bi bi-check-circle-fill"></i>6.3 Memahami prinsip dasar Sistem Optik dan Sistem WLAN.</li>
            </ul> --}}
        </div>

        <!-- Core Materials -->
        <div class="row g-4 mb-4">
            <!-- Material 1: TCP/IP (Always Available) -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="material-card" id="material-1" data-material="1">
                    <div class="progress-indicator progress-available">
                        <i class="bi bi-play-fill"></i>
                    </div>
                    <div class="score-display" id="score-1" style="display: none;">
                        Skor: <span class="score-value">0</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="core-badge mb-3">
                            <i class="bi bi-star-fill"></i>
                            <span>Indikator 6.1</span>
                        </div>
                        
                        <i class="bi bi-diagram-3 material-icon icon-tcp"></i>
                        
                        <h5 class="card-title fw-bold mb-3" style="color: var(--text-dark-primary); font-size: 1.3rem;">
                            Prinsip Dasar TCP/IP
                        </h5>

                        <p class="card-text text-muted mb-4" style="color: var(--text-dark-secondary) !important; font-size: 0.95rem;">
                            Memahami model referensi TCP/IP, lapisan jaringan, serta protokol-protokol utama yang digunakan dalam komunikasi data.
                        </p>

                        <div class="d-grid">
                          <a href="{{ route('siswa.materi.tcp_ip', ['id' => 1]) }}" class="btn btn-material">
                            <i class="bi bi-journal-text me-2"></i> Pelajari Materi
                          </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Material 2: Network Services -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="material-card locked-overlay" id="material-2" data-material="2">
                    <div class="progress-indicator progress-locked">
                        <i class="bi bi-lock-fill"></i>
                    </div>
                    <div class="score-display" id="score-2" style="display: none;">
                        Skor: <span class="score-value">0</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="core-badge mb-3">
                            <i class="bi bi-star-fill"></i>
                            <span>Indikator 6.1</span>
                        </div>
                        
                        <i class="bi bi-server material-icon icon-network"></i>
                        
                        <h5 class="card-title fw-bold mb-3" style="color: var(--text-dark-primary); font-size: 1.3rem;">
                            Prinsip Dasar Layanan Jaringan
                        </h5>

                        <p class="card-text text-muted mb-4" style="color: var(--text-dark-secondary) !important; font-size: 0.95rem;">
                            Memahami fungsi dan prinsip kerja layanan jaringan seperti HTTP, DHCP, DNS, FTP, dan Email beserta port yang digunakan.
                        </p>

                        <div class="d-grid">
                          <a href="{{ route('siswa.materi.layanan_jaringan', ['id' => 2]) }}" class="btn btn-material btn-success" onclick="materialSystem.openMaterial(event, 2)" disabled>
                            <i class="bi bi-journal-text me-2"></i> Pelajari Materi
                          </a>
                        </div>
                    </div>
                    <div class="lock-indicator">
                        <i class="bi bi-lock-fill lock-icon"></i>
                        <div class="lock-text">Terkunci</div>
                        <div class="unlock-requirements">Selesaikan kuis Materi 1 dengan skor minimal 80 untuk membuka materi ini</div>
                    </div>
                </div>
            </div>

            <!-- Material 3: Network Security -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="material-card locked-overlay" id="material-3" data-material="3">
                    <div class="progress-indicator progress-locked">
                        <i class="bi bi-lock-fill"></i>
                    </div>
                    <div class="score-display" id="score-3" style="display: none;">
                        Skor: <span class="score-value">0</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="core-badge mb-3">
                            <i class="bi bi-star-fill"></i>
                            <span>Indikator 6.1</span>
                        </div>
                        
                        <i class="bi bi-shield-lock material-icon icon-security"></i>
                        
                        <h5 class="card-title fw-bold mb-3" style="color: var(--text-dark-primary); font-size: 1.3rem;">
                            Prinsip Dasar Keamanan Jaringan
                        </h5>

                        <p class="card-text text-muted mb-4" style="color: var(--text-dark-secondary) !important; font-size: 0.95rem;">
                            Memahami ancaman jaringan, konsep enkripsi, proteksi keamanan fisik/logis, dan simulasi serangan sederhana.
                        </p>

                        <div class="d-grid">
                          <a href="{{ route('siswa.materi.keamanan_jaringan', ['id' => 3]) }}" class="btn btn-material btn-danger" onclick="materialSystem.openMaterial(event, 3)" disabled>
                            <i class="bi bi-journal-text me-2"></i> Pelajari Materi
                          </a>
                        </div>
                    </div>
                    <div class="lock-indicator">
                        <i class="bi bi-lock-fill lock-icon"></i>
                        <div class="lock-text">Terkunci</div>
                        <div class="unlock-requirements">Selesaikan kuis Materi 1 & 2 dengan skor minimal 80 untuk membuka materi ini</div>
                    </div>
                </div>
            </div>

            <!-- Material 4: Sistem Seluler, Microwave, VSAT IP (TP 6.2) -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="material-card locked-overlay" id="material-4" data-material="4">
                    <div class="progress-indicator progress-locked">
                        <i class="bi bi-lock-fill"></i>
                    </div>
                    <div class="score-display" id="score-4" style="display: none;">
                        Skor: <span class="score-value">0</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="core-badge mb-3">
                            <i class="bi bi-star-fill"></i>
                            <span> Indikator 6.2</span>
                        </div>
                        
                        <i class="bi bi-broadcast material-icon icon-telecom"></i>
                        
                        <h5 class="card-title fw-bold mb-3" style="color: var(--text-dark-primary); font-size: 1.3rem;">
                            Sistem Seluler, Microwave, & VSAT IP
                        </h5>

                        <p class="card-text text-muted mb-4" style="color: var(--text-dark-secondary) !important; font-size: 0.95rem;">
                            Pelajari prinsip kerja, arsitektur, dan aplikasi teknologi komunikasi nirkabel jarak jauh seperti jaringan seluler, transmisi gelombang mikro, dan satelit VSAT IP.
                        </p>

                        <div class="d-grid">
                          <a href="{{ route('siswa.materi.seluler', ['id' => 4]) }}" class="btn btn-material btn-info" onclick="materialSystem.openMaterial(event, 4)" disabled>
                            <i class="bi bi-journal-text me-2"></i> Pelajari Materi
                          </a>
                        </div>
                    </div>
                    <div class="lock-indicator">
                        <i class="bi bi-lock-fill lock-icon"></i>
                        <div class="lock-text">Terkunci</div>
                        <div class="unlock-requirements">Selesaikan kuis Materi 3 dengan skor minimal 80 untuk membuka materi ini</div>
                    </div>
                </div>
            </div>

            <!-- Material 5: Sistem Optik dan WLAN (TP 6.3) -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="material-card locked-overlay" id="material-5" data-material="5">
                    <div class="progress-indicator progress-locked">
                        <i class="bi bi-lock-fill"></i>
                    </div>
                    <div class="score-display" id="score-5" style="display: none;">
                        Skor: <span class="score-value">0</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="core-badge mb-3">
                            <i class="bi bi-star-fill"></i>
                            <span>Indikator 6.3</span>
                        </div>
                        
                        <i class="bi bi-lightbulb material-icon icon-optic-wlan"></i>
                        
                        <h5 class="card-title fw-bold mb-3" style="color: var(--text-dark-primary); font-size: 1.3rem;">
                            Sistem Optik dan WLAN
                        </h5>

                        <p class="card-text text-muted mb-4" style="color: var(--text-dark-secondary) !important; font-size: 0.95rem;">
                            Jelajahi dasar-dasar teknologi komunikasi berbasis cahaya (serat optik) dan jaringan nirkabel lokal (WLAN), termasuk standar dan implementasinya.
                        </p>

                        <div class="d-grid">
                          <a href="{{ route('siswa.materi.optik', ['id' => 5]) }}" class="btn btn-material btn-info" onclick="materialSystem.openMaterial(event, 5)" disabled>
                            <i class="bi bi-journal-text me-2"></i> Pelajari Materi
                          </a>
                        </div>
                    </div>
                    <div class="lock-indicator">
                        <i class="bi bi-lock-fill lock-icon"></i>
                        <div class="lock-text">Terkunci</div>
                        <div class="unlock-requirements">Selesaikan kuis Materi 4 dengan skor minimal 80 untuk membuka materi ini</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Simulation Controls -->
        {{-- <div class="simulation-controls">
            <h6 class="mb-3" style="color: var(--text-dark-secondary); font-size: 1.25rem;">
                <i class="bi bi-gear-fill me-2"></i>Kontrol Simulasi (Demo)
            </h6>
            <div class="d-flex justify-content-center flex-wrap gap-2">
                <button class="btn btn-simulate btn-info" onclick="materialSystem.simulateQuizResult(1, 85)">
                    <i class="bi bi-check-circle-fill me-1"></i>Lulus Kuis 1 (Skor: 85)
                </button>
                <button class="btn btn-simulate btn-secondary" onclick="materialSystem.simulateQuizResult(1, 65)">
                    <i class="bi bi-x-circle-fill me-1"></i>Gagal Kuis 1 (Skor: 65)
                </button>
                <button class="btn btn-simulate btn-info" onclick="materialSystem.simulateQuizResult(2, 90)">
                    <i class="bi bi-check-circle-fill me-1"></i>Lulus Kuis 2 (Skor: 90)
                </button>
                <button class="btn btn-simulate btn-secondary" onclick="materialSystem.simulateQuizResult(2, 70)">
                    <i class="bi bi-x-circle-fill me-1"></i>Gagal Kuis 2 (Skor: 70)
                </button>
                <button class="btn btn-simulate btn-info" onclick="materialSystem.simulateQuizResult(3, 88)">
                    <i class="bi bi-check-circle-fill me-1"></i>Lulus Kuis 3 (Skor: 88)
                </button>
                <button class="btn btn-simulate btn-secondary" onclick="materialSystem.simulateQuizResult(3, 75)">
                    <i class="bi bi-x-circle-fill me-1"></i>Gagal Kuis 3 (Skor: 75)
                </button>
                <button class="btn btn-simulate btn-info" onclick="materialSystem.simulateQuizResult(4, 82)">
                    <i class="bi bi-check-circle-fill me-1"></i>Lulus Kuis 4 (Skor: 82)
                </button>
                <button class="btn btn-simulate btn-secondary" onclick="materialSystem.simulateQuizResult(4, 60)">
                    <i class="bi bi-x-circle-fill me-1"></i>Gagal Kuis 4 (Skor: 60)
                </button>
                <button class="btn btn-simulate btn-info" onclick="materialSystem.simulateQuizResult(5, 95)">
                    <i class="bi bi-check-circle-fill me-1"></i>Lulus Kuis 5 (Skor: 95)
                </button>
                <button class="btn btn-simulate btn-warning" onclick="materialSystem.resetAllProgress()">
                    <i class="bi bi-arrow-clockwise me-1"></i>Reset Semua
                </button>
            </div>
            <p class="text-muted small mt-3 mb-0" style="color: var(--text-dark-secondary) !important; font-size: 0.9rem;">
                <i class="bi bi-info-circle-fill me-1"></i>
                Kontrol ini hanya untuk demonstrasi. Skor minimal 80 diperlukan untuk membuka materi berikutnya.
            </p>
        </div> --}}

        <!-- Section Divider -->
        <div class="section-divider">
            <span>
                <i class="bi bi-collection me-2"></i>
                Materi Tambahan
            </span>
        </div>

        <!-- Additional Materials -->
        @if($materi->count() > 0)
          <div class="row g-4">
            @foreach ($materi as $item)
              <div class="col-12 col-md-6 col-lg-4">
            <div class="material-card" id="additional-material-{{ $item->id }}">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
              <h5 class="card-title fw-bold mb-3" style="color: var(--text-dark-primary); font-size: 1.3rem;">
              <i class="bi bi-file-earmark-text me-2" style="color: var(--text-dark-secondary);"></i> {{ $item->judul }}
              </h5>

              @if ($item->file)
              @php
                $ext = strtolower(pathinfo($item->file, PATHINFO_EXTENSION));
              @endphp

              @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
                <a href="{{ asset('storage/' . $item->file) }}" target="_blank">
                <img src="{{ asset('storage/' . $item->file) }}" alt="Preview Gambar"
                  class="img-fluid rounded mb-3" style="max-height: 180px; object-fit: cover;">
                </a>
              @elseif ($ext === 'mp4')
                <video class="w-100 mb-3 rounded" style="max-height: 180px;" controls>
                <source src="{{ asset('storage/' . $item->file) }}" type="video/mp4">
                Browser tidak mendukung video.
                </video>
              @elseif ($ext === 'pdf')
                <embed src="{{ asset('storage/' . $item->file) }}" type="application/pdf" width="100%" height="180px" class="rounded mb-3"/>
              @else
                <div class="file-preview mb-3 rounded border p-2 text-center" style="height: 180px; background-color: #f1f3f5; border-color: var(--border-light);">
                <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="text-decoration-none">
                  <i class="bi bi-file-earmark-text display-4 mb-2" style="color: var(--text-dark-secondary);"></i>
                  <p class="mb-0" style="color: var(--text-dark-primary);">{{ basename($item->file) }}</p>
                  <small style="color: var(--text-dark-secondary);">({{ strtoupper($ext) }})</small>
                </a>
                </div>
              @endif
              @endif

              <p class="card-text text-muted mb-4" style="min-height: 3rem; color: var(--text-dark-secondary) !important; font-size: 0.95rem;">
              {{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 100, '...') }}
              </p>

              <div class="mb-3">
              <small class="text-muted" style="color: var(--text-dark-secondary) !important; font-size: 0.9rem;">
                <i class="bi bi-calendar3 me-1"></i>
                Diunggah: <strong>{{ $item->created_at->format('d M Y') }}</strong>
              </small>
              </div>

              <div class="d-grid gap-2">
              <a href="{{ asset('storage/' . $item->file) }}" class="btn btn-material" style="background: var(--info-color);">
                <i class="bi bi-eye me-2"></i> Lihat File
              </a>
              </div>
            </div>
            </div>
              </div>
            @endforeach
          </div>
        @else
          <p class="text-center text-muted" style="font-size: 1.1rem;">Belum ada materi tambahan yang dibuat.</p>
        @endif
    </div>

    <!-- Alert Template -->
    <div class="alert alert-success alert-dismissible fade position-fixed" role="alert" id="alert-notification" style="display: none; top: 20px; right: 20px; z-index: 1050; min-width: 350px;">
        <i class="bi bi-check-circle-fill me-2"></i>
        <span id="alert-message"></span>
        <button type="button" class="btn-close" onclick="materialSystem.closeAlert()"></button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sistem Penguncian Materi yang Ditingkatkan
        class MaterialLockingSystem {
            constructor() {
                this.MINIMUM_SCORE = 80; // Skor minimal yang diperlukan untuk membuka materi berikutnya
                this.STORAGE_PREFIX = 'material_'; // Prefix untuk kunci localStorage
                // Data materi, termasuk prasyarat dan status skor
                this.materials = {
                    1: { name: 'TCP/IP', prerequisite: null, score: 0, completed: false },
                    2: { name: 'Layanan Jaringan', prerequisite: [1], score: 0, completed: false },
                    3: { name: 'Keamanan Jaringan', prerequisite: [1, 2], score: 0, completed: false },
                    4: { name: 'Seluler, Microwave, & VSAT IP', prerequisite: [3], score: 0, completed: false }, // New Material 4
                    5: { name: 'Optik dan WLAN', prerequisite: [4], score: 0, completed: false } // New Material 5
                };
                this.init(); // Inisialisasi sistem saat objek dibuat
            }

            // Metode inisialisasi utama
            init() {
                this.loadProgress(); // Muat progress dari localStorage
                this.updateAllMaterialStates(); // Perbarui status UI semua materi
            }

            // Memuat skor dan status completed dari localStorage
            loadProgress() {
                for (let materialId in this.materials) {
                    const scoreKey = `${this.STORAGE_PREFIX}${materialId}_score`;
                    
                    // Ambil skor dari localStorage, default ke 0 jika tidak ada atau tidak valid
                    const savedScore = parseInt(localStorage.getItem(scoreKey)) || 0;
                    this.materials[materialId].score = savedScore;
                    // Tentukan status completed berdasarkan skor minimal
                    this.materials[materialId].completed = savedScore >= this.MINIMUM_SCORE;
                }
            }

            // Memperbarui status UI untuk semua materi
            updateAllMaterialStates() {
                // Iterasi dalam urutan memastikan prasyarat dihitung terlebih dahulu
                for (let i = 1; i <= Object.keys(this.materials).length; i++) {
                    this.updateMaterialState(i);
                }
            }

            // Memperbarui status UI materi individual (terkunci, tersedia, selesai)
            updateMaterialState(materialId) {
                const material = this.materials[materialId];
                const card = document.getElementById(`material-${materialId}`);
                if (!card) return; // Keluar jika elemen kartu tidak ditemukan

                const lockIndicator = card.querySelector('.lock-indicator');
                const button = card.querySelector('.btn-material');
                const progressIndicator = card.querySelector('.progress-indicator');
                const scoreDisplay = card.querySelector('.score-display');
                const scoreValueSpan = scoreDisplay ? scoreDisplay.querySelector('.score-value') : null;

                // Perbarui tampilan skor
                if (scoreValueSpan) {
                    scoreValueSpan.textContent = material.score;
                    // Tampilkan skor jika sudah ada data kuis (baik lulus atau gagal)
                    if (material.score > 0 || material.completed) {
                        scoreDisplay.style.display = 'block';
                        // Sesuaikan warna latar belakang skor berdasarkan apakah lulus atau tidak
                        if (material.completed) {
                            scoreDisplay.style.background = 'linear-gradient(135deg, var(--success-color), #218838)';
                        } else {
                            scoreDisplay.style.background = 'linear-gradient(135deg, var(--danger-color), #c82333)';
                        }
                    } else {
                        scoreDisplay.style.display = 'none'; // Sembunyikan jika belum ada skor
                    }
                }

                // Materi 1 selalu tersedia
                if (materialId === 1) {
                    this.unlockMaterial(materialId); // Pastikan Material 1 tidak terkunci secara visual
                    if (progressIndicator) {
                        if (material.completed) {
                            progressIndicator.className = 'progress-indicator progress-completed';
                            progressIndicator.querySelector('i').className = 'bi bi-check-circle-fill';
                        } else {
                            progressIndicator.className = 'progress-indicator progress-available';
                            progressIndicator.querySelector('i').className = 'bi bi-play-fill';
                        }
                    }
                    return; // Tidak perlu memeriksa prasyarat untuk Materi 1
                }

                // Cek prasyarat untuk materi lain
                let allPrerequisitesMet = true;
                let unlockMessage = '';
                if (material.prerequisite) {
                    const missingPrereqNames = [];
                    for (const prereqId of material.prerequisite) {
                        const prereqMaterial = this.materials[prereqId];
                        if (!prereqMaterial || prereqMaterial.score < this.MINIMUM_SCORE) {
                            allPrerequisitesMet = false;
                            missingPrereqNames.push(`Materi ${prereqId}`);
                        }
                    }
                    if (!allPrerequisitesMet) {
                        unlockMessage = `Selesaikan kuis ${missingPrereqNames.join(' & ')} dengan skor minimal ${this.MINIMUM_SCORE} untuk membuka materi ini`;
                    }
                }

                if (allPrerequisitesMet) {
                    this.unlockMaterial(materialId); // Buka materi
                    if (progressIndicator) {
                        if (material.completed) {
                            progressIndicator.className = 'progress-indicator progress-completed';
                            progressIndicator.querySelector('i').className = 'bi bi-check-circle-fill';
                        } else {
                            progressIndicator.className = 'progress-indicator progress-available';
                            progressIndicator.querySelector('i').className = 'bi bi-play-fill';
                        }
                    }
                } else {
                    this.lockMaterial(materialId, unlockMessage); // Kunci materi dengan pesan
                    if (progressIndicator) {
                        progressIndicator.className = 'progress-indicator progress-locked';
                        progressIndicator.querySelector('i').className = 'bi bi-lock-fill';
                    }
                }
            }

            // Membuka materi (menghapus overlay terkunci dan mengaktifkan tombol)
            unlockMaterial(materialId) {
                const card = document.getElementById(`material-${materialId}`);
                if (!card) return;
                const lockIndicator = card.querySelector('.lock-indicator');
                const button = card.querySelector('.btn-material');
                
                card.classList.remove('locked-overlay');
                if (lockIndicator) {
                    lockIndicator.style.display = 'none';
                }
                if (button) {
                    button.disabled = false; // Aktifkan tombol
                }
            }

            // Mengunci materi (menambahkan overlay terkunci dan menonaktifkan tombol)
            lockMaterial(materialId, message) {
                const card = document.getElementById(`material-${materialId}`);
                if (!card) return;
                const lockIndicator = card.querySelector('.lock-indicator');
                const button = card.querySelector('.btn-material');
                
                card.classList.add('locked-overlay');
                if (lockIndicator) {
                    lockIndicator.style.display = 'flex';
                    const unlockRequirements = lockIndicator.querySelector('.unlock-requirements');
                    if (unlockRequirements) {
                        unlockRequirements.textContent = message;
                    }
                }
                if (button) {
                    button.disabled = true; // Nonaktifkan tombol
                }
            }

            // Fungsi untuk membuka materi (dengan simulasi loading)
            openMaterial(event, materialId) { // Menerima event object
                const card = document.getElementById(`material-${materialId}`);
                if (!card) return;

                const buttonElement = card.querySelector('.btn-material');

                if (card.classList.contains('locked-overlay')) {
                    event.preventDefault(); // Mencegah navigasi jika terkunci
                    this.showAlert('Materi ini masih terkunci. Selesaikan materi sebelumnya terlebih dahulu.', 'warning');
                    return;
                }

                // Mencegah navigasi langsung oleh href untuk menampilkan simulasi loading
                event.preventDefault(); 

                if (buttonElement) {
                    const originalText = buttonElement.innerHTML;
                    const originalHref = buttonElement.href; // Simpan href asli
                    // Ganti teks tombol dengan spinner loading
                    buttonElement.innerHTML = '<div class="loading-spinner me-2"></div>Memuat...';
                    buttonElement.disabled = true;

                    // Simulasi penundaan untuk "membuka" materi
                    setTimeout(() => {
                        buttonElement.innerHTML = originalText; // Kembalikan teks asli tombol
                        buttonElement.disabled = false; // Aktifkan kembali tombol
                        this.showAlert(`Membuka materi ${materialId}: ${this.materials[materialId].name}...`, 'success');
                        window.location.href = originalHref; // Navigasi secara manual setelah simulasi
                    }, 1500);
                }
            }

            // Mensimulasikan hasil kuis (lulus/gagal)
            simulateQuizResult(materialId, score) {
                const storageKey = `${this.STORAGE_PREFIX}${materialId}_score`;
                localStorage.setItem(storageKey, score.toString()); // Simpan skor
                this.materials[materialId].score = score; // Perbarui progres di memori
                this.materials[materialId].completed = score >= this.MINIMUM_SCORE; // Perbarui status completed

                this.updateAllMaterialStates(); // Hitung ulang dan perbarui status UI semua materi

                let message;
                let type;
                if (score >= this.MINIMUM_SCORE) {
                    message = `Selamat! Anda telah lulus kuis Materi ${materialId} (${this.materials[materialId].name}) dengan skor ${score}. Materi selanjutnya telah terbuka.`;
                    type = 'success';
                } else {
                    message = `Kuis Materi ${materialId} (${this.materials[materialId].name}) gagal dengan skor ${score}. Silakan coba lagi untuk membuka materi selanjutnya.`;
                    type = 'warning';
                }
                this.showAlert(message, type);
            }

            // Mengatur ulang semua progres kuis (untuk tujuan demo)
            resetAllProgress() {
                for (let materialId in this.materials) {
                    localStorage.removeItem(`${this.STORAGE_PREFIX}${materialId}_score`);
                    this.materials[materialId].score = 0;
                    this.materials[materialId].completed = false;
                }
                this.updateAllMaterialStates(); // Muat ulang progres dan perbarui UI
                this.showAlert('Semua progres kuis telah direset. Materi telah kembali terkunci.', 'info');
            }

            // Menampilkan pesan notifikasi kustom
            showAlert(message, type = 'success') {
                const alertElement = document.getElementById('alert-notification');
                const messageElement = document.getElementById('alert-message');
                
                if (!alertElement || !messageElement) return;

                // Perbarui gaya dan ikon alert berdasarkan jenis
                alertElement.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
                messageElement.textContent = message;
                
                const icon = alertElement.querySelector('i');
                // Menggunakan Bootstrap Icons (bi) untuk ikon
                if (type === 'success') {
                    icon.className = 'bi bi-check-circle-fill me-2';
                } else if (type === 'warning') {
                    icon.className = 'bi bi-exclamation-triangle-fill me-2';
                } else if (type === 'danger') {
                    icon.className = 'bi bi-x-circle-fill me-2';
                } else if (type === 'info') {
                    icon.className = 'bi bi-info-circle-fill me-2';
                }
                
                alertElement.style.display = 'block'; // Tampilkan alert
                
                // Otomatis tutup setelah 4 detik
                setTimeout(() => {
                    this.closeAlert();
                }, 4000);
            }

            // Menutup pesan notifikasi kustom
            closeAlert() {
                const alertElement = document.getElementById('alert-notification');
                if (alertElement) {
                    alertElement.classList.remove('show');
                    alertElement.classList.add('fade');
                    // Sembunyikan setelah animasi fade out
                    setTimeout(() => {
                        alertElement.style.display = 'none';
                    }, 150); 
                }
            }
        }

        // Inisialisasi sistem penguncian materi saat DOM selesai dimuat
        let materialSystem;
        document.addEventListener('DOMContentLoaded', () => {
            materialSystem = new MaterialLockingSystem();
        });
    </script>
@endsection
