{{-- resources/views/siswa/materi/prinsip_dasar_layanan_jaringan.blade.php --}}

@extends('siswa.siswa_master')

@section('siswa')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prinsip Dasar Layanan Jaringan</title>
    <!-- Bootstrap CSS -->
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWtIXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f8ff 0%, #e6f7ff 100%); /* Light blueish gradient */
            color: #333;
            font-size: 1.1rem; /* Consistent base font size */
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        /* Adjust default Bootstrap heading sizes for consistency */
        h1 { font-size: 3.5rem; }
        h2 { font-size: 2.2rem; }
        h3 { font-size: 1.8rem; }
        h4 { font-size: 1.5rem; }
        h5 { font-size: 1.3rem; }
        h6 { font-size: 1.1rem; }

        p { font-size: 1.1rem; }
        ol, ul { font-size: 1.1rem; }
        small { font-size: 0.9rem; }


        /* Header Section Styles */
        header {
            background: linear-gradient(135deg, #1a2a3a 0%, #2a4c66 50%, #3a7cac 100%); /* Deeper blue gradient */
            border-bottom: 5px solid #66ccff; /* Bright blue accent */
            min-height: 380px; /* Increased height for better visual impact */
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem !important; /* Larger border-radius */
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5); /* Deeper shadow */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            flex-direction: column;
            animation: header-fade-in 1.2s ease-out forwards; /* Fade in header on load */
        }

        /* Animated network elements */
        .network-connection {
            position: absolute;
            border-radius: 50%;
            border: 2px dashed rgba(102, 204, 255, 0.4); /* Blueish dash line */
            animation: rotate 35s linear infinite, fade-in 1.5s ease-out forwards;
            opacity: 0; /* Start hidden for fade-in */
        }
        .network-connection:nth-child(1) { width: 280px; height: 280px; top: 10%; left: 5%; animation-duration: 30s; animation-delay: 0.5s; }
        .network-connection:nth-child(2) { width: 350px; height: 350px; bottom: 15%; right: 10%; animation-duration: 40s; animation-delay: 0.8s; }
        .network-connection:nth-child(3) { width: 220px; height: 220px; top: 20%; right: 25%; animation-duration: 33s; animation-delay: 1.1s; }
        .network-connection:nth-child(4) { width: 260px; height: 260px; bottom: 5%; left: 35%; animation-duration: 38s; animation-delay: 1.4s; }
        
        .node {
            width: 15px; /* Larger node */
            height: 15px;
            background: #66ccff; /* Bright blue */
            border-radius: 50%;
            box-shadow: 0 0 25px #66ccff, 0 0 10px rgba(102, 204, 255, 0.8); /* More intense glow */
            animation: pulse 2.5s infinite ease-in-out alternate, float-node 7s infinite ease-in-out, fade-in 1s ease-out forwards;
            z-index: 3; /* Ensure nodes are above connections */
            opacity: 0; /* Start hidden for fade-in */
            animation-fill-mode: forwards;
        }
        .node:nth-child(1) { top: 12%; left: 18%; animation-delay: 1s; }
        .node:nth-child(2) { top: 68%; left: 22%; animation-delay: 1.3s; }
        .node:nth-child(3) { top: 32%; right: 28%; animation-delay: 1.6s; }
        .node:nth-child(4) { top: 78%; right: 18%; animation-delay: 1.9s; }

        /* General Fade-in for basic elements */
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Header specific animations */
        @keyframes header-fade-in {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes float {
            0% { transform: translateY(0) rotate(5deg); }
            50% { transform: translateY(-25px) rotate(-5deg); } /* More dynamic float */
            100% { transform: translateY(0) rotate(5deg); }
        }
        @keyframes float-node {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        @keyframes pulse {
            0% { opacity: 0.7; transform: scale(1); box-shadow: 0 0 10px #66ccff; }
            50% { opacity: 1; transform: scale(1.4); box-shadow: 0 0 30px #66ccff, 0 0 12px rgba(102, 204, 255, 0.9); }
            100% { opacity: 0.7; transform: scale(1); box-shadow: 0 0 10px #66ccff; }
        }
        @keyframes titleWord {
            0% { transform: translateY(0); opacity: 0; }
            30% { opacity: 1; }
            50% { transform: translateY(-10px); } /* Stronger bounce */
            100% { transform: translateY(0); opacity: 1; }
        }
        @keyframes text-fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Entrance animations for content */
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slide-in-left {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slide-in-right {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }


        .lead {
            font-weight: 300;
            color: rgba(255, 255, 255, 0.95) !important; /* Almost pure white */
            font-size: 1.3rem; /* Slightly larger lead text */
            animation: text-fade-in 1.2s ease-out 1.6s forwards;
            opacity: 0; /* Start hidden */
        }

        .badge {
            font-size: 0.95em;
            padding: 0.7em 1.2em;
            border-radius: 0.75rem;
            opacity: 0.9;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94); /* Smoother transition */
            font-weight: 500;
            animation: fade-in-up 0.8s ease-out forwards;
            opacity: 0; /* Start hidden */
        }
        .badge:nth-child(1) { animation-delay: 2s; }
        .badge:nth-child(2) { animation-delay: 2.2s; }
        .badge:nth-child(3) { animation-delay: 2.4s; }

        .badge:hover {
            opacity: 1;
            transform: translateY(-5px) scale(1.08); /* More pronounced effect */
            box-shadow: 0 8px 25px rgba(0,0,0,0.4);
        }

        .btn-neon {
            background: linear-gradient(45deg, #66ccff, #0099cc); /* Blueish gradient */
            color: #1a2a3a; /* Dark text */
            border: none;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94); /* Smoother transition */
            box-shadow: 0 0 25px rgba(102, 204, 255, 0.6), 0 8px 20px rgba(0,0,0,0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0.8rem 2rem; /* Larger button */
            animation: fade-in-up 1s ease-out 2.6s forwards;
            opacity: 0; /* Start hidden */
            font-size: 1rem; /* Consistent button text size */
        }
        
        .btn-neon:hover {
            background: linear-gradient(45deg, #99e6ff, #007bb3);
            transform: translateY(-8px) scale(1.05); /* Even more pronounced lift */
            box-shadow: 0 0 40px rgba(102, 204, 255, 0.9), 0 12px 30px rgba(0,0,0,0.6);
            color: #1a2a3a;
        }

        /* Image illustration */
        header img {
            max-height: 250px !important; /* Even larger illustration */
            filter: drop-shadow(0 0 30px rgba(102, 204, 255, 0.8)); /* Stronger glow */
            animation: float 6s ease-in-out infinite, fade-in 1.5s ease-out 1.8s forwards;
            opacity: 0; /* Start hidden */
        }

        /* Card Sections */
        .card {
            border-radius: 1.5rem; /* More rounded corners for cards */
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); /* Smoother transition */
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border: none; /* Remove default card border */
            opacity: 0; /* Start hidden for entrance animation */
            transform: translateY(20px); /* Start slightly below */
            animation: fade-in-up 1s ease-out forwards;
        }
        .card:hover {
            transform: translateY(-10px) scale(1.01); /* More pronounced lift and slight scale */
            box-shadow: 0 18px 45px rgba(0,0,0,0.25);
        }

        /* Staggered animation for cards */
        section.card:nth-of-type(1) { animation-delay: 0.5s; }
        section.card:nth-of-type(2) { animation-delay: 0.7s; }
        section.card:nth-of-type(3) { animation-delay: 0.9s; }
        section.card:nth-of-type(4) { animation-delay: 1.1s; }
        section.card:nth-of-type(5) { animation-delay: 1.3s; } /* For the video card */


        .card-header h2 {
            opacity: 0; /* Start hidden */
            animation: slide-in-left 0.7s ease-out forwards;
            font-size: 1.3rem; /* Consistent with h5 */
        }
        .card-header .badge {
            opacity: 0; /* Start hidden */
            animation: slide-in-right 0.7s ease-out forwards;
            font-size: 0.95em; /* Consistent with other badges */
        }

        .section-sub-title { /* For h3 elements */
            opacity: 0; /* Start hidden */
            animation: fade-in-up 0.6s ease-out forwards;
            font-size: 1.3rem; /* Consistent with h5 */
        }
        .card-body > p.text-dark:first-of-type { /* First paragraph in card body */
            opacity: 0; /* Start hidden */
            animation: fade-in-up 0.7s ease-out forwards;
            font-size: 1.1rem; /* Consistent with body text */
        }
        .list-group-flush li {
            opacity: 0; /* Start hidden */
            animation: slide-in-left 0.5s ease-out forwards;
            font-size: 1.1rem; /* Consistent with body text */
        }
        .list-group-flush li:nth-child(1) { animation-delay: 0.1s; }
        .list-group-flush li:nth-child(2) { animation-delay: 0.2s; }
        .list-group-flush li:nth-child(3) { animation-delay: 0.3s; }
        .list-group-flush li:nth-child(4) { animation-delay: 0.4s; }
        .list-group-flush li:nth-child(5) { animation-delay: 0.5s; }
        /* Add more if needed for longer lists */

        .content-box {
            opacity: 0; /* Start hidden */
            animation: fade-in-up 0.8s ease-out forwards;
            font-size: 1.1rem; /* Consistent with body text */
        }
        .content-box h6 {
            font-size: 1.1rem; /* Consistent with h6 */
        }
        .content-box small {
            font-size: 0.9rem; /* Consistent with small text */
        }
        .alert {
            opacity: 0; /* Start hidden */
            animation: slide-in-right 0.8s ease-out forwards;
            font-size: 1rem; /* Slightly smaller for alerts to be less intrusive */
        }
        .alert h5 {
            font-size: 1.3rem; /* Consistent with h5 */
        }
        .alert p {
            font-size: 1rem; /* Consistent with alert text */
        }
        .mermaid {
            opacity: 0; /* Start hidden */
            animation: fade-in 1s ease-out forwards;
        }
        .video-container {
            opacity: 0; /* Start hidden */
            animation: fade-in-up 0.9s ease-out forwards;
        }
        .table-responsive {
            opacity: 0; /* Start hidden */
            animation: fade-in-up 1s ease-out forwards;
            font-size: 1.1rem; /* Consistent with body text */
        }
        .table-responsive th, .table-responsive td {
            font-size: 1.1rem; /* Consistent with body text */
        }

        /* Styling for other elements (unchanged from previous) */
        .section-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #1a2a3a;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            padding-bottom: 0.75rem;
        }
        .section-title::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: #66ccff;
            border-radius: 2px;
        }
        
        /* Quiz Section */
        .quiz-card {
            background: #ffffff;
            border-radius: 1.5rem;
            padding: 2rem;
            margin: 1rem 0;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border: 1px solid #e0e6ec;
            color: #333;
        }

        .quiz-option {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #333;
            font-size: 1.1rem; /* Consistent with body text */
        }

        .quiz-option:hover {
            border-color: #66ccff;
            background: #e6f7ff;
        }

        /* Styles for selected, correct, and incorrect options */
        .quiz-option.selected {
            border-color: #007bff; /* Primary blue for selected */
            background: #e9f5ff; /* Light blue background */
            font-weight: bold;
        }
        .quiz-option.correct-answer { /* For showing the correct answer after check */
            border-color: #28a745; /* Green for correct */
            background: #e9f8ed; /* Light green background */
            font-weight: bold;
        }
        .quiz-option.incorrect { /* For incorrect answers */
            border-color: #dc3545; /* Red for incorrect */
            background: #fdf0f1; /* Light red background */
            font-weight: bold;
        }
        .quiz-option label {
            cursor: inherit; /* Ensure label cursor is consistent */
            width: 100%;
            display: block;
            font-size: 1.1rem; /* Ensure label inside option is consistent */
        }

        #quiz-feedback {
            font-size: 1.1rem;
        }
        #quiz-feedback.text-success {
            color: #28a745 !important;
        }
        #quiz-feedback.text-danger {
            color: #dc3545 !important;
        }
        #quiz-feedback.text-warning {
            color: #ffc107 !important;
        }

        /* Video Quiz Modal Styles (Copied from TCP/IP page) */
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


        /* Responsive adjustments */
        @media (max-width: 768px) {
            h1 { font-size: 2.5rem; } /* Smaller h1 on mobile */
            h2 { font-size: 1.8rem; }
            h3 { font-size: 1.5rem; }
            h4 { font-size: 1.3rem; }
            h5 { font-size: 1.1rem; }
            p, ol, ul, .quiz-option, .stack-layer p { font-size: 1rem; } /* Slightly smaller body on mobile */
            .badge, .data-packet { font-size: 0.85rem; }
            .btn-neon { font-size: 0.9rem; padding: 10px 20px; }
            
            .card-header h2 {
                font-size: 1.4rem;
            }
            .card-body {
                padding: 1.2rem;
            }
            .col-lg-4.d-none.d-lg-block {
                display: none !important;
            }
            .section-title {
                font-size: 1.8rem;
                margin-bottom: 1.5rem;
            }
            .title-word {
                margin-right: 8px; /* Reduce spacing on small screens */
            }
        }
    </style>
</head>
<body>

<div class="bg-light min-h-screen">
    <div class="container-fluid py-5"> <!-- Changed to container-fluid -->
        <!-- Header dengan Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 px-4"> <!-- Added px-4 -->
            <ol class="breadcrumb" style="opacity: 0; animation: fade-in-up 0.6s ease-out forwards;">
                <li class="breadcrumb-item"><a href="{{ route('siswa.siswa_master')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('siswa.materi.index')}}">Materi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Prinsip Dasar Layanan Jaringan</li>
            </ol>
        </nav>

        <!-- Header Utama -->
        <header class="position-relative overflow-hidden rounded-4 shadow-lg mb-5">
            <!-- Animated network connections -->
            <div class="position-absolute w-100 h-100" style="overflow: hidden;">
                <div class="network-connection"></div>
                <div class="network-connection"></div>
                <div class="network-connection"></div>
                <div class="network-connection"></div>
            </div>

            <!-- Floating nodes -->
            <div class="position-absolute node"></div>
            <div class="position-absolute node"></div>
            <div class="position-absolute node"></div>
            <div class="position-absolute node"></div>

            <div class="container-fluid h-100 position-relative" style="z-index: 2;"> <!-- Changed to container-fluid -->
                <div class="row align-items-center h-100 py-4">
                    <div class="col-12 mx-auto"> {{-- Changed col-lg-8 to col-12 --}}
                        <h1 class="display-3 fw-bold text-white mb-3" style="text-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                            <span class="title-word">Prinsip Dasar</span>
                            <span class="title-word">Layanan</span>
                            <span class="title-word">Jaringan</span>
                        </h1>
                        
                        <p class="lead mb-4">
                            Modul Pembelajaran Jaringan Komputer Kelas X
                        </p>
                        
                        <div class="d-flex flex-wrap gap-3 justify-content-center mt-4">
                            <span class="badge bg-dark bg-opacity-50 text-white border border-light border-opacity-10 py-2 px-3">
                                <i class="fas fa-network-wired me-2"></i>Jaringan Komputer
                            </span>
                            <span class="badge bg-dark bg-opacity-50 text-white border border-light border-opacity-10 py-2 px-3">
                                <i class="fas fa-rss me-2"></i>Protokol Jaringan
                            </span>
                            <span class="badge bg-dark bg-opacity-50 text-white border border-light border-opacity-10 py-2 px-3">
                                <i class="fas fa-globe me-2"></i>Layanan Internet
                            </span>
                        </div>
                        
                        <button class="btn btn-neon mt-4 px-4 py-2" onclick="scrollToSection('materi-content')">
                            <i class="fas fa-book-open me-2"></i>Mulai Belajar
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main id="materi-content" class="px-4"> <!-- Added px-4 for main content padding -->
            
            <!-- Fungsi dan Cara Kerja DNS -->
            <section class="card mb-5 border-info border-2">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0 fw-bold">
                        <i class="fas fa-address-book me-2"></i>Fungsi dan Cara Kerja DNS (Domain Name System)
                    </h2>
                    <span class="badge bg-white text-info">Port 53 (UDP/TCP)</span>
                </div>
                <div class="card-body">
                    <h3 class="h5 fw-bold text-info section-sub-title">Konsep Dasar DNS</h3>
                    <p class="text-dark">DNS adalah sistem terdistribusi yang menerjemahkan nama domain (seperti <code>google.com</code>) menjadi alamat IP (seperti <code>172.217.0.46</code>). DNS berfungsi sebagai "buku telepon" internet, memungkinkan pengguna mengakses situs web dengan nama yang mudah diingat daripada deretan angka IP.</p>

                    <h3 class="h5 fw-bold text-info mt-4 section-sub-title">Komponen DNS</h3>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded h-100 content-box">
                                <h6 class="fw-bold text-dark">Resolver DNS (Klien)</h6>
                                <small class="text-dark">Program atau aplikasi yang mengajukan permintaan ke server DNS untuk menerjemahkan nama domain menjadi alamat IP.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded h-100 content-box">
                                <h6 class="fw-bold text-dark">Root Name Server</h6>
                                <small class="text-dark">Server tingkat paling atas dalam hierarki DNS. Mereka merespons permintaan untuk TLD (Top Level Domain) server.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded h-100 content-box">
                                <h6 class="fw-bold text-dark">TLD (Top-Level Domain) Server</h6>
                                <small class="text-dark">Mengelola semua nama domain di bawah TLD tertentu (.com, .org, .id, dll.) dan merespons dengan Authoritative Name Server.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded h-100 content-box">
                                <h6 class="fw-bold text-dark">Authoritative Name Server</h6>
                                <small class="text-dark">Server yang bertanggung jawab atas informasi domain tertentu (misalnya, <code>smk.sch.id</code>). Mereka menyimpan catatan DNS aktual untuk domain tersebut.</small>
                            </div>
                        </div>
                    </div>

                    <h3 class="h5 fw-bold text-info mt-4 section-sub-title">Proses DNS Lookup (Pencarian DNS)</h3>
                    <div class="mermaid">
                        sequenceDiagram
                            participant Client
                            participant Resolver
                            participant Root
                            participant TLD
                            participant Auth
                            Client->>Resolver: Query: www.smk.sch.id
                            Resolver->>Root: Query .id
                            Root->>Resolver: Refer to .id TLD Server
                            Resolver->>TLD: Query sch.id
                            TLD->>Resolver: Refer to Auth Server for smk.sch.id
                            Resolver->>Auth: Query www.smk.sch.id
                            Auth->>Resolver: Response IP: 192.168.25.2
                            Resolver->>Client: Response IP: 192.168.25.2
                    </div>
                    <p class="text-dark mt-3">Proses ini adalah bagaimana sebuah nama domain diterjemahkan menjadi alamat IP. Cache DNS juga berperan penting untuk mempercepat proses ini.</p>

                    <h3 class="h5 fw-bold text-info mt-4 section-sub-title">Jenis Record DNS Penting</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-info text-white">
                                <tr>
                                    <th>Record</th>
                                    <th>Fungsi</th>
                                    <th>Contoh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>A</td>
                                    <td>Mengarahkan nama domain ke alamat IPv4</td>
                                    <td><code>example.com</code> &rarr; <code>93.184.216.34</code></td>
                                </tr>
                                <tr>
                                    <td>AAAA</td>
                                    <td>Mengarahkan nama domain ke alamat IPv6</td>
                                    <td><code>example.com</code> &rarr; <code>2606:2800:220:1::1</code></td>
                                </tr>
                                <tr>
                                    <td>CNAME</td>
                                    <td>Membuat alias untuk nama domain lain</td>
                                    <td><code>www.example.com</code> &rarr; <code>example.com</code></td>
                                </tr>
                                <tr>
                                    <td>MX</td>
                                    <td>Menentukan server mail yang bertanggung jawab untuk domain</td>
                                    <td><code>example.com</code> &rarr; <code>mail.example.com</code></td>
                                </tr>
                                <tr>
                                    <td>NS</td>
                                    <td>Menentukan name server untuk domain</td>
                                    <td><code>example.com</code> &rarr; <code>ns1.example.com</code></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="alert alert-warning mt-4">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                        <div>
                            <strong>Ancaman Keamanan: DNS Spoofing</strong>
                            <p class="mb-0">Serangan ini mengarahkan lalu lintas internet ke situs web palsu yang dikendalikan oleh penyerang, sering kali dengan memanipulasi cache DNS atau server DNS itu sendiri.</p>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-light rounded shadow-sm">
                        <h4 class="h6 fw-bold text-info">Contoh Kasus Nyata:</h4>
                        <p class="text-dark">Saat Anda mengetik "youtube.com" di browser, komputer Anda menggunakan DNS untuk menemukan alamat IP server YouTube, memungkinkan browser terhubung dan memuat halaman video.</p>
                    </div>
                </div>
            </section>

            <!-- Manajemen IP dengan DHCP -->
            <section class="card mb-5 border-success border-2">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0 fw-bold">
                        <i class="fas fa-ethernet me-2"></i>Manajemen IP dengan DHCP (Dynamic Host Configuration Protocol)
                    </h2>
                    <span class="badge bg-white text-success">Port 67/68 (UDP)</span>
                </div>
                <div class="card-body">
                    <h3 class="h5 fw-bold text-success section-sub-title">Konsep Dasar DHCP</h3>
                    <p class="text-dark">DHCP adalah protokol yang memungkinkan perangkat dalam jaringan mendapatkan alamat IP, subnet mask, gateway default, dan server DNS secara otomatis dari server DHCP. Ini menghilangkan kebutuhan konfigurasi IP manual untuk setiap perangkat.</p>
                    
                    <h3 class="h5 fw-bold text-success mt-4 section-sub-title">Proses DORA (Discover, Offer, Request, Acknowledge)</h3>
                    <div class="mermaid">
                        sequenceDiagram
                            participant Client
                            participant DHCP Server
                            Note over Client: 1. DHCP Discover (Broadcast)
                            Client->>DHCP Server: Saya butuh alamat IP! (Broadcast)
                            Note over DHCP Server: 2. DHCP Offer (Unicast/Broadcast)
                            DHCP Server->>Client: Ini alamat IP yang tersedia (Offer)
                            Note over Client: 3. DHCP Request (Broadcast)
                            Client->>DHCP Server: Saya pilih alamat ini (Request)
                            Note over DHCP Server: 4. DHCP ACK (Unicast)
                            DHCP Server->>Client: OK, alamat IP ini resmi untukmu (ACK)
                    </div>
                    <p class="text-dark mt-3">Proses DORA adalah empat langkah utama yang dilakukan client dan server DHCP untuk mengalokasikan alamat IP secara dinamis.</p>

                    <h3 class="h5 fw-bold text-success mt-4 section-sub-title">Keuntungan Menggunakan DHCP</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Mengurangi kesalahan konfigurasi IP manual.</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Memudahkan administrasi jaringan, terutama untuk jaringan besar.</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Mendukung perangkat seluler yang sering berpindah jaringan.</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Pengelolaan alamat IP menjadi lebih efisien dengan sistem lease time.</span>
                        </li>
                    </ul>

                    <div class="alert alert-warning mt-4">
                        <i class="fas fa-shield-alt fa-2x"></i>
                        <div>
                            <strong>Ancaman Keamanan: DHCP Starvation / Rogue DHCP Server</strong>
                            <p class="mb-0">Penyerang dapat menghabiskan pool alamat IP yang tersedia (Starvation) atau menyamar sebagai server DHCP resmi (Rogue DHCP) untuk memberikan konfigurasi jaringan yang salah kepada klien.</p>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-light rounded shadow-sm">
                        <h4 class="h6 fw-bold text-success">Contoh Kasus Nyata:</h4>
                        <p class="text-dark">Setiap kali Anda menghubungkan smartphone atau laptop ke jaringan WiFi baru (misalnya di rumah, kafe, atau kampus), perangkat Anda mendapatkan alamat IP secara otomatis berkat server DHCP yang berjalan di router WiFi tersebut.</p>
                    </div>
                </div>
            </section>

            <!-- Layanan Berbagi Berkas (File Sharing) -->
            <section class="card mb-5 border-primary border-2">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0 fw-bold">
                        <i class="fas fa-folder-open me-2"></i>Layanan Berbagi Berkas (File Sharing) dengan FTP
                    </h2>
                    <span class="badge bg-white text-primary">Port 20/21 (TCP)</span>
                </div>
                <div class="card-body">
                    <h3 class="h5 fw-bold text-primary section-sub-title">Konsep Dasar FTP (File Transfer Protocol)</h3>
                    <p class="text-dark">FTP adalah protokol standar jaringan yang digunakan untuk mentransfer berkas antara klien dan server di jaringan komputer. Ini adalah salah satu protokol tertua di internet, dirancang untuk menyalin file dari satu host ke host lain.</p>
                    
                    <h3 class="h5 fw-bold text-primary mt-4 section-sub-title">Prinsip Kerja FTP</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-sign-in-alt text-primary me-2"></i>
                            <span>Klien FTP memulai koneksi ke server FTP, biasanya pada port 21 (control connection) untuk perintah.</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-user-lock text-primary me-2"></i>
                            <span>Klien mengautentikasi diri dengan nama pengguna dan kata sandi.</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-exchange-alt text-primary me-2"></i>
                            <span>Untuk transfer data (upload/download), koneksi data terpisah dibuat (port 20 atau port acak) antara klien dan server.</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-cloud-upload-alt text-primary me-2"></i>
                            <span>Klien dapat mengunggah (upload) atau mengunduh (download) berkas, membuat direktori, menghapus file, dll.</span>
                        </li>
                    </ul>

                    <h3 class="h5 fw-bold text-primary mt-4 section-sub-title">Mode Koneksi FTP</h3>
                    <div class="row g-2 mb-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded h-100 content-box">
                                <h6 class="fw-bold text-dark">Mode Aktif (Active Mode)</h6>
                                <small class="text-dark">Klien memberitahu server port mana yang akan didengarkan untuk koneksi data. Server memulai koneksi data kembali ke klien.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded h-100 content-box">
                                <h6 class="fw-bold text-dark">Mode Pasif (Passive Mode)</h6>
                                <small class="text-dark">Klien meminta server untuk membuka port acak, kemudian klien memulai koneksi data ke port tersebut. Ini lebih ramah firewall.</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning mt-4">
                        <i class="fas fa-lock fa-2x"></i>
                        <div>
                            <strong>Ancaman Keamanan: FTP Plaintext Credentials</strong>
                            <p class="mb-0">FTP standar mengirimkan nama pengguna dan kata sandi dalam bentuk plaintext (tidak terenkripsi), membuatnya rentan terhadap penyadapan. Gunakan SFTP (SSH File Transfer Protocol) atau FTPS (FTP over SSL/TLS) untuk keamanan yang lebih baik.</p>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-light rounded shadow-sm">
                        <h4 class="h6 fw-bold text-primary">Contoh Kasus Nyata:</h4>
                        <p class="text-dark">Seorang web developer menggunakan FTP client (seperti FileZilla) untuk mengunggah file situs web baru ke server web hosting.</p>
                        <p class="text-dark mt-3">
                            {{-- <img src="https://placehold.co/400x200/cccccc/333333?text=FTP+Client+Server" alt="FTP client and server transferring files" class="img-fluid rounded shadow-sm"> --}}
                        </p>
                    </div>
                </div>
            </section>

            <!-- Layanan Server Web dan Email -->
            <section class="card mb-5 border-danger border-2">
                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0 fw-bold">
                        <i class="fas fa-server me-2"></i>Layanan Server Web dan Email
                    </h2>
                    <span class="badge bg-white text-danger">Web (80/443), Email (25/110/143)</span>
                </div>
                <div class="card-body">
                    <h3 class="h5 fw-bold text-danger section-sub-title">Layanan Server Web (HTTP/HTTPS)</h3>
                    <p class="text-dark">Server Web adalah program komputer yang menyimpan file situs web (HTML, CSS, JavaScript, gambar) dan mengirimkannya ke browser klien berdasarkan permintaan HTTP/HTTPS.</p>
                    
                    <h4 class="h6 fw-bold text-danger mt-3">HTTP (Hypertext Transfer Protocol)</h4>
                    <p class="text-dark">Protokol dasar untuk World Wide Web. Tidak terenkripsi.</p>
                    <div class="mermaid mb-4">
                        sequenceDiagram
                            participant Web Browser
                            participant Web Server
                            Web Browser->>Web Server: HTTP GET /index.html
                            Web Server-->>Web Browser: HTTP 200 OK + index.html content
                    </div>

                    <h4 class="h6 fw-bold text-danger mt-3">HTTPS (HTTP Secure)</h4>
                    <p class="text-dark">Versi aman dari HTTP yang menggunakan SSL/TLS untuk enkripsi komunikasi. Penting untuk transaksi sensitif dan privasi data.</p>
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-lock fa-2x"></i>
                        <div>
                            <strong>Penting: Selalu Gunakan HTTPS!</strong>
                            <p class="mb-0">HTTPS melindungi data yang ditransmisikan dari penyadapan dan manipulasi. Ini adalah standar industri untuk keamanan web.</p>
                        </div>
                    </div>
                    
                    <h3 class="h5 fw-bold text-danger mt-4 section-sub-title">Layanan Server Email (SMTP, POP3, IMAP)</h3>
                    <p class="text-dark">Server Email mengelola pengiriman, penerimaan, dan penyimpanan email. Ada tiga protokol utama yang bekerja sama dalam sistem email:</p>

                    <h4 class="h6 fw-bold text-danger mt-3">SMTP (Simple Mail Transfer Protocol)</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center text-dark">
                            <i class="fas fa-paper-plane text-danger me-2"></i>
                            <span>Digunakan untuk <strong>mengirim</strong> email dari klien ke server dan antar server. (Port 25, 587)</span>
                        </li>
                    </ul>

                    <h4 class="h6 fw-bold text-danger mt-3">POP3 (Post Office Protocol version 3)</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center text-dark">
                            <i class="fas fa-inbox text-danger me-2"></i>
                            <span>Digunakan untuk <strong>mengunduh</strong> email dari server ke klien. Secara default, email akan dihapus dari server setelah diunduh. (Port 110)</span>
                        </li>
                    </ul>

                    <h4 class="h6 fw-bold text-danger mt-3">IMAP (Internet Message Access Protocol)</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center text-dark">
                            <i class="fas fa-mail-bulk text-danger me-2"></i>
                            <span>Digunakan untuk <strong>mengakses</strong> email di server. Email tetap ada di server, memungkinkan sinkronisasi di berbagai perangkat. (Port 143)</span>
                        </li>
                    </ul>

                    <div class="mermaid mt-4">
                        sequenceDiagram
                            participant Pengirim_MUA as Pengirim (MUA)
                            participant Server_Pengirim as Server Email Pengirim
                            participant Server_Penerima as Server Email Penerima
                            participant Penerima_MUA as Penerima (MUA)

                            Pengirim_MUA->>Server_Pengirim: Kirim Email (SMTP)
                            Server_Pengirim->>Server_Penerima: Relay Email (SMTP)
                            Server_Penerima->>Penerima_MUA: Unduh/Akses Email (POP3/IMAP)
                    </div>

                    <div class="mt-4 p-3 bg-light rounded shadow-sm">
                        <h4 class="h6 fw-bold text-danger">Contoh Kasus Nyata:</h4>
                        <p class="text-dark">Ketika Anda mengirim email dari Gmail, SMTP digunakan untuk mengirim email dari komputer Anda ke server Gmail, dan dari server Gmail ke server penerima. Penerima kemudian menggunakan POP3 atau IMAP untuk mengambil email tersebut ke aplikasi email mereka.</p>
                        <p class="text-dark mt-3">
                            {{-- <img src="https://placehold.co/400x200/cccccc/333333?text=Email+Flow" alt="Email flow with SMTP, POP3, IMAP" class="img-fluid rounded shadow-sm"> --}}
                        </p>
                    </div>
                </div>
            </section>

            <!-- Video Pembelajaran Umum Jaringan -->
            <section class="card mb-5 border-dark border-2">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0 fw-bold">
                        <i class="fas fa-video me-2"></i>Video Pembelajaran: Layanan Jaringan
                    </h2>
                </div>
                <div class="card-body">
                    <h3 class="h5 fw-bold text-dark section-sub-title">Memahami Lebih Dalam Protokol Jaringan</h3>
                    <p class="text-dark">Video ini memberikan gambaran umum tentang bagaimana berbagai layanan jaringan bekerja dan pentingnya mereka dalam kehidupan kita sehari-hari.</p>
                    <div class="video-container mt-3 ratio ratio-16x9 rounded-lg overflow-hidden shadow-lg"> <!-- Added ratio classes -->
                        <!-- Changed from iframe to video tag for local video control -->
                        <video id="video-player-layanan-jaringan" controls preload="metadata" style="width: 100%; height: 100%;">
                            <source src="{{asset ('homepage/img/bentuk internet.mp4')}}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <small class="text-muted mt-2 d-block">Sumber: Kok Bisa? (YouTube)</small>
                </div>
            </section>

            <!-- Tabel Perbandingan Protokol -->
            <section class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title h4 fw-bold text-primary mb-3">
                        <i class="fas fa-table me-2"></i>Perbandingan Protokol Layanan Jaringan
                    </h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>Layanan</th>
                                    <th>Protokol Transport</th>
                                    <th>Port Standar</th>
                                    <th>Fungsi Utama</th>
                                    <th>Enkripsi</th>
                                    <th>Contoh Aplikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Web</td>
                                    <td>TCP</td>
                                    <td>80 (HTTP) / 443 (HTTPS)</td>
                                    <td>Menyajikan halaman web</td>
                                    <td><span class="badge bg-success">HTTPS (SSL/TLS)</span></td>
                                    <td>Web Browser, Web Server</td>
                                </tr>
                                <tr>
                                    <td>DHCP</td>
                                    <td>UDP</td>
                                    <td>67 (Server) / 68 (Client)</td>
                                    <td>Alokasi IP otomatis</td>
                                    <td><span class="badge bg-danger">Tidak</span></td>
                                    <td>Router, DHCP Server</td>
                                </tr>
                                <tr>
                                    <td>DNS</td>
                                    <td>UDP/TCP</td>
                                    <td>53</td>
                                    <td>Terjemah nama domain ke IP</td>
                                    <td><span class="badge bg-warning text-dark">Optional (DoH/DoT)</span></td>
                                    <td>DNS Server, Web Browser</td>
                                </tr>
                                <tr>
                                    <td>File Sharing</td>
                                    <td>TCP</td>
                                    <td>20, 21 (FTP)</td>
                                    <td>Transfer file antar host</td>
                                    <td><span class="badge bg-danger">Tidak (FTP), <span class="badge bg-success">SFTP/FTPS</span></span></td>
                                    <td>FileZilla, Windows Explorer (SMB)</td>
                                </tr>
                                <tr>
                                    <td>Email Pengirim</td>
                                    <td>TCP</td>
                                    <td>25 (SMTP) / 587 (SMTPS)</td>
                                    <td>Mengirim email</td>
                                    <td><span class="badge bg-warning text-dark">Optional (STARTTLS)</span></td>
                                    <td>Mail Client, Mail Server</td>
                                </tr>
                                <tr>
                                    <td>Email Penerima (Unduh)</td>
                                    <td>TCP</td>
                                    <td>110 (POP3) / 995 (POP3S)</td>
                                    <td>Mengunduh email (hapus dari server)</td>
                                    <td><span class="badge bg-warning text-dark">Optional (POP3S)</span></td>
                                    <td>Mail Client</td>
                                </tr>
                                <tr>
                                    <td>Email Penerima (Akses)</td>
                                    <td>TCP</td>
                                    <td>143 (IMAP) / 993 (IMAPS)</td>
                                    <td>Mengakses email (email di server)</td>
                                    <td><span class="badge bg-warning text-dark">Optional (IMAPS)</span></td>
                                    <td>Mail Client</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Quiz Sederhana Section -->
            <section id="quiz-section" class="mb-5">
                <div class="quiz-card">
                    <h2 class="h3 mb-4 text-primary text-center">
                        <i class="fas fa-question-circle me-3"></i>Uji Pemahaman: Kuis Sederhana
                    </h2>
                    <div id="quiz-container">
                        <!-- Question 1 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>1. Apa fungsi utama dari Domain Name System (DNS)?</strong></p>
                            <div class="quiz-option" data-question="q1" data-choice="a">
                                <label class="w-100 cursor-pointer">a. Mengalokasikan alamat IP secara otomatis.</label>
                            </div>
                            <div class="quiz-option" data-question="q1" data-choice="b">
                                <label class="w-100 cursor-pointer">b. Menerjemahkan nama domain menjadi alamat IP.</label>
                            </div>
                            <div class="quiz-option" data-question="q1" data-choice="c">
                                <label class="w-100 cursor-pointer">c. Mentransfer file antar host.</label>
                            </div>
                            <div class="quiz-option" data-question="q1" data-choice="d">
                                <label class="w-100 cursor-pointer">d. Mengirim dan menerima email.</label>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>2. Protokol mana yang digunakan DHCP untuk komunikasi antara server dan klien?</strong></p>
                            <div class="quiz-option" data-question="q2" data-choice="a">
                                <label class="w-100 cursor-pointer">a. TCP</label>
                            </div>
                            <div class="quiz-option" data-question="q2" data-choice="b">
                                <label class="w-100 cursor-pointer">b. UDP</label>
                            </div>
                            <div class="quiz-option" data-question="q2" data-choice="c">
                                <label class="w-100 cursor-pointer">c. ICMP</label>
                            </div>
                            <div class="quiz-option" data-question="q2" data-choice="d">
                                <label class="w-100 cursor-pointer">d. ARP</label>
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>3. Port standar berapakah yang digunakan oleh FTP untuk *control connection* (koneksi perintah)?</strong></p>
                            <div class="quiz-option" data-question="q3" data-choice="a">
                                <label class="w-100 cursor-pointer">a. 20</label>
                            </div>
                            <div class="quiz-option" data-question="q3" data-choice="b">
                                <label class="w-100 cursor-pointer">b. 21</label>
                            </div>
                            <div class="quiz-option" data-question="q3" data-choice="c">
                                <label class="w-100 cursor-pointer">c. 23</label>
                            </div>
                            <div class="quiz-option" data-question="q3" data-choice="d">
                                <label class="w-100 cursor-pointer">d. 25</label>
                            </div>
                        </div>

                        <!-- Question 4 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>4. Mengapa HTTPS lebih aman untuk digunakan daripada HTTP?</strong></p>
                            <div class="quiz-option" data-question="q4" data-choice="a">
                                <label class="w-100 cursor-pointer">a. HTTPS menggunakan port yang berbeda.</label>
                            </div>
                            <div class="quiz-option" data-question="q4" data-choice="b">
                                <label class="w-100 cursor-pointer">b. HTTPS mengenkripsi komunikasi menggunakan SSL/TLS.</label>
                            </div>
                            <div class="quiz-option" data-question="q4" data-choice="c">
                                <label class="w-100 cursor-pointer">c. HTTPS memiliki kecepatan transfer data yang lebih tinggi.</label>
                            </div>
                            <div class="quiz-option" data-question="q4" data-choice="d">
                                <label class="w-100 cursor-pointer">d. HTTPS memiliki fitur caching yang lebih baik.</label>
                            </div>
                        </div>

                        <!-- Question 5 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>5. Protokol email mana yang memungkinkan pengguna untuk mengakses dan mengelola email langsung di server, sehingga email tidak dihapus dari server setelah dibaca?</strong></p>
                            <div class="quiz-option" data-question="q5" data-choice="a">
                                <label class="w-100 cursor-pointer">a. SMTP</label>
                            </div>
                            <div class="quiz-option" data-question="q5" data-choice="b">
                                <label class="w-100 cursor-pointer">b. POP3</label>
                            </div>
                            <div class="quiz-option" data-question="q5" data-choice="c">
                                <label class="w-100 cursor-pointer">c. IMAP</label>
                            </div>
                            <div class="quiz-option" data-question="q5" data-choice="d">
                                <label class="w-100 cursor-pointer">d. FTP</label>
                            </div>
                        </div>
                        
                        <button onclick="checkQuiz()" class="btn btn-primary w-100 mt-3 fw-bold">Periksa Jawaban</button>
                        <p id="quiz-feedback" class="mt-4 font-weight-bold text-center"></p>
                        <a href="{{ route('siswa.materi.index') }}" id="nextMaterialBtn" class="btn btn-success w-100 mt-3 d-none fw-bold">Lanjut ke Materi Berikutnya <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </section>

        </main>
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
        <button id="videoQuizContinueBtn" class="btn btn-primary mt-3 d-none" onclick="continueVideo()">Lanjutkan Video</button>
    </div>
</div>


<!-- Bootstrap JS Bundle (popper included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eP7In6jI3RxhqQ" crossorigin="anonymous"></script>
<!-- Mermaid JS -->
<script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>
<script>
    // HTML5 Video Player reference
    let layananJaringanVideoPlayer; 
    let quizInterval;

    // Define quiz points for the Layanan Jaringan video
    var videoQuizPoints = [
        {
            time: 20, // Approx. 20 seconds into the video
            question: "Berdasarkan video, apa fungsi utama dari jaringan komputer?",
            options: [
                "Untuk bermain game online",
                "Untuk berbagi sumber daya dan informasi",
                "Untuk mengirim pesan singkat",
                "Untuk menonton film saja"
            ],
            correctAnswerIndex: 1, // "Untuk berbagi sumber daya dan informasi"
            answered: false
        },
        {
            time: 45, // Approx. 45 seconds into the video
            question: "Apa yang dimaksud dengan protokol dalam jaringan komputer?",
            options: [
                "Nama lain untuk kabel jaringan",
                "Aturan dan standar komunikasi antar perangkat",
                "Jenis perangkat keras jaringan",
                "Software untuk mengelola jaringan"
            ],
            correctAnswerIndex: 1, // "Aturan dan standar komunikasi antar perangkat"
            answered: false
        }
        // Add more quiz points as needed
    ];
    var currentVideoQuizQuestion = null;

    document.addEventListener('DOMContentLoaded', () => {
        // Initialize HTML5 video player
        layananJaringanVideoPlayer = document.getElementById('video-player-layanan-jaringan');

        // Add event listeners for the video for quiz functionality
        if (layananJaringanVideoPlayer) {
            layananJaringanVideoPlayer.addEventListener('play', onVideoPlay);
            layananJaringanVideoPlayer.addEventListener('pause', onVideoPause);
            layananJaringanVideoPlayer.addEventListener('ended', onVideoEnded);
            layananJaringanVideoPlayer.addEventListener('timeupdate', checkVideoTime);
        }

        // Initialize Mermaid
        mermaid.initialize({ startOnLoad: true });

        // On page load, check if quiz was already passed and show "next material" button
        const savedScore = parseInt(localStorage.getItem('material_2_score')) || 0;
        const nextMaterialBtn = document.getElementById('nextMaterialBtn');
        if (savedScore >= REQUIRED_SCORE) {
            nextMaterialBtn.classList.remove('d-none');
        } else {
            nextMaterialBtn.classList.add('d-none');
        }
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
        if (layananJaringanVideoPlayer && !layananJaringanVideoPlayer.paused && !layananJaringanVideoPlayer.ended) {
            var currentTime = layananJaringanVideoPlayer.currentTime;
            for (let i = 0; i < videoQuizPoints.length; i++) {
                const quizPoint = videoQuizPoints[i];
                // Trigger quiz if current time is at or past the quiz point, and it hasn't been answered yet
                // Adding a small buffer (e.g., < quizPoint.time + 0.5) to ensure it triggers if time is slightly off
                if (!quizPoint.answered && currentTime >= quizPoint.time && currentTime < quizPoint.time + 0.5) {
                    layananJaringanVideoPlayer.pause(); // Pause the HTML5 video
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
            // Using a label inside the custom styled div
            optionDiv.innerHTML = `
                <label class="w-100 cursor-pointer">
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
        });

        selectedOptionDiv.classList.add('selected');

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

        if (layananJaringanVideoPlayer && layananJaringanVideoPlayer.play) {
            layananJaringanVideoPlayer.play();
            // Restart the time checking interval after video resumes
            quizInterval = setInterval(checkVideoTime, 250); // Use 250ms interval
        }
    }


    // Function to scroll to a specific section
    function scrollToSection(id) {
        const element = document.getElementById(id);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // Quiz Answers (for the main page quiz)
    const quizAnswers = {
        q1: 'b', // DNS: Menerjemahkan nama domain menjadi alamat IP.
        q2: 'b', // DHCP: UDP
        q3: 'b', // FTP Control: 21
        q4: 'b', // HTTPS: mengenkripsi komunikasi menggunakan SSL/TLS
        q5: 'c'  // IMAP
    };

    // Minimum score to unlock next material
    const REQUIRED_SCORE = 80;

    // Attach event listeners to quiz options using delegation (for the main page quiz)
    document.getElementById('quiz-container').addEventListener('click', function(event) {
        const option = event.target.closest('.quiz-option');
        // Ensure it's not the video quiz options and it's a valid quiz option
        if (option && option.dataset.question && !option.closest('.video-quiz-modal-options')) {
            selectQuizOption(option);
        }
    });

    function selectQuizOption(selectedOption) {
        const questionBlock = selectedOption.closest('.question-block');
        
        // Remove 'selected' class from all options in this question block
        questionBlock.querySelectorAll('.quiz-option').forEach(opt => {
            opt.classList.remove('selected');
        });

        // Add 'selected' class to the clicked option
        selectedOption.classList.add('selected');
    }

    // Function to reset the quiz UI
    function resetQuizUI() {
        document.querySelectorAll('.quiz-option').forEach(option => {
            option.classList.remove('selected', 'correct-answer', 'incorrect');
        });
        document.getElementById('quiz-feedback').textContent = "";
        document.getElementById('nextMaterialBtn').classList.add('d-none'); // Hide button
        document.getElementById('nextMaterialBtn').disabled = true; // Disable button
    }

    function checkQuiz() {
        let score = 0;
        const totalQuestions = Object.keys(quizAnswers).length;
        const feedback = document.getElementById('quiz-feedback');
        const nextMaterialBtn = document.getElementById('nextMaterialBtn');

        // Clear previous results
        document.querySelectorAll('.quiz-option').forEach(option => {
            option.classList.remove('correct-answer', 'incorrect');
        });
        
        let allAnswered = true;

        for (const qId in quizAnswers) {
            // Get the selected option using data-question and selected class
            const selectedOption = document.querySelector(`.quiz-option[data-question="${qId}"].selected`);
            const correctAnswer = quizAnswers[qId]; // e.g., 'b' for q1

            if (!selectedOption) {
                allAnswered = false;
                break; // Exit loop if any question is not answered
            }

            // Get the chosen option's letter from data-choice
            const selectedChoice = selectedOption.dataset.choice;

            if (selectedChoice === correctAnswer) {
                score += 1;
                selectedOption.classList.add('correct-answer');
            } else {
                selectedOption.classList.add('incorrect');
                // Highlight the correct answer for clarity using data-choice
                document.querySelector(`.quiz-option[data-question="${qId}"][data-choice="${correctAnswer}"]`).classList.add('correct-answer');
            }
        }

        if (!allAnswered) {
            showAlert("Mohon jawab semua pertanyaan sebelum memeriksa.", 'warning');
            nextMaterialBtn.classList.add('d-none'); // Hide button
            nextMaterialBtn.disabled = true;
            return;
        }

        const percentage = (score / totalQuestions) * 100;
        feedback.innerHTML = `Skor Anda: ${score} dari ${totalQuestions} (${percentage.toFixed(0)}%).<br>`;

        if (percentage >= REQUIRED_SCORE) { // Passing score
            feedback.innerHTML += `Selamat! Anda berhasil memahami materi ini dengan baik!`;
            feedback.className = "mt-4 fw-bold text-success";
            nextMaterialBtn.classList.remove('d-none'); // Show button
            nextMaterialBtn.disabled = false;
            // Store the score for Material 2 in localStorage using the correct key
            localStorage.setItem('material_2_score', percentage.toFixed(0)); // Key for Material 2
        } else {
            feedback.innerHTML += `Terus semangat belajar! Anda perlu mencapai setidaknya ${REQUIRED_SCORE}% untuk melanjutkan.`;
            feedback.className = "mt-4 fw-bold text-danger";
            nextMaterialBtn.classList.add('d-none'); // Hide button
            nextMaterialBtn.disabled = true;
            // Ensure score is reset/removed if failed
            localStorage.setItem('material_2_score', percentage.toFixed(0)); // Store score, even if failed
            
            // Reset quiz for retake after a short delay
            setTimeout(() => {
                resetQuizUI();
            }, 3000); // Reset after 3 seconds so user can see results briefly
        }
    }

    // Show a custom alert message (success, warning, danger, or info)
    function showAlert(message, type = 'success') {
        const alertDiv = document.getElementById('page-alert-notification');
        if (!alertDiv) {
            // Create the alert div if it doesn't exist
            const newAlertDiv = document.createElement('div');
            newAlertDiv.id = 'page-alert-notification';
            newAlertDiv.classList.add('alert', 'position-fixed', 'fade');
            newAlertDiv.style.top = '20px';
            newAlertDiv.style.right = '20px';
            newAlertDiv.style.zIndex = '1050';
            newAlertDiv.style.minWidth = '300px';
            newAlertDiv.style.display = 'flex';
            newAlertDiv.style.alignItems = 'center';
            newAlertDiv.innerHTML = `<i class="me-2"></i><span id="page-alert-message"></span><button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>`;
            document.body.appendChild(newAlertDiv);
            // Re-select the alertDiv after creation
            const alertElement = document.getElementById('page-alert-notification');
            const messageElement = alertElement.querySelector('#page-alert-message');
            const iconElement = alertElement.querySelector('i');

            // Update alert style and icon based on type
            alertElement.classList.remove('alert-success', 'alert-warning', 'alert-danger', 'alert-info');
            alertElement.classList.add(`alert-${type}`);
            
            messageElement.textContent = message;
            
            if (type === 'success') {
                iconElement.className = 'fas fa-check-circle me-2';
            } else if (type === 'warning') {
                iconElement.className = 'fas fa-exclamation-triangle me-2';
            } else if (type === 'danger') {
                iconElement.className = 'fas fa-times-circle me-2';
            } else if (type === 'info') {
                iconElement.className = 'fas fa-info-circle me-2';
            }
            
            alertElement.classList.add('show'); // Trigger fade-in

            // Auto close after 4 seconds
            setTimeout(() => {
                alertElement.classList.remove('show');
                setTimeout(() => {
                    alertElement.style.display = 'none';
                }, 150); // Give time for fade animation
            }, 4000);

        } else {
            // If alertDiv already exists, just update its content and show it
            const messageElement = alertDiv.querySelector('#page-alert-message');
            const iconElement = alertDiv.querySelector('i');

            alertDiv.classList.remove('alert-success', 'alert-warning', 'alert-danger', 'alert-info');
            alertDiv.classList.add(`alert-${type}`);
            
            messageElement.textContent = message;
            
            if (type === 'success') {
                iconElement.className = 'fas fa-check-circle me-2';
            } else if (type === 'warning') {
                iconElement.className = 'fas fa-exclamation-triangle me-2';
            } else if (type === 'danger') {
                iconElement.className = 'fas fa-times-circle me-2';
            } else if (type === 'info') {
                iconElement.className = 'fas fa-info-circle me-2';
            }
            
            alertDiv.style.display = 'flex'; // Ensure it's displayed
            alertDiv.classList.add('show'); // Trigger fade-in

            // Clear any existing timeout and set a new one
            clearTimeout(alertDiv.dataset.timeoutId);
            const timeoutId = setTimeout(() => {
                alertDiv.classList.remove('show');
                setTimeout(() => {
                    alertDiv.style.display = 'none';
                }, 150); // Give time for fade animation
            }, 4000);
            alertDiv.dataset.timeoutId = timeoutId;
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
        const headerContentElements = document.querySelectorAll('header h1, header p, header .badge, header .btn-neon');
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
        // Use 'material_2_score' for this page
        const savedScore = parseInt(localStorage.getItem('material_2_score')) || 0;
        const nextMaterialBtn = document.getElementById('nextMaterialBtn');
        if (savedScore >= REQUIRED_SCORE) {
            nextMaterialBtn.classList.remove('d-none');
        } else {
            nextMaterialBtn.classList.add('d-none');
        }
    });
</script>
</body>
</html>
@endsection
