@extends('guru.guru_master')

@section('guru')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Optik dan WLAN - Materi Pembelajaran</title>
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts: Inter (Consistent with other pages) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWtIXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        /* Define bright color palette (Consistent with other pages) */
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
            --button-shadow-bright: 0 5px 15px rgba(59, 130, 246, 0.3);
            --header-shadow-bright: 0 0 40px rgba(59, 130, 246, 0.2);

            /* Alert backgrounds - made slightly more opaque for light theme */
            --alert-success-bg: rgba(40, 167, 69, 0.15); /* Lighter green */
            --alert-warning-bg: rgba(255, 193, 7, 0.15); /* Lighter yellow */
            --alert-danger-bg: rgba(220, 53, 69, 0.15); /* Lighter red */
            --alert-info-bg: rgba(23, 162, 184, 0.15); /* Lighter cyan */

            /* Specific colors for this page's elements */
            --optik-orange: #F59E0B;
            --wlan-green: #10B981;
            --purple-gradient-start: #8B5CF6;
            --purple-gradient-end: #A855F7;
            --pink-gradient-start: #EC4899;
            --pink-gradient-end: #F472B6;
        }

        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Inter', sans-serif; /* Changed to Inter */
            background: linear-gradient(135deg, var(--light-bg) 0%, var(--lighter-bg) 100%); /* Consistent light background */
            color: var(--text-dark); /* Use consistent dark text variable */
            font-size: 1.1rem; /* Consistent base font size */
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container-fluid { /* Ensures full width layout */
            max-width: 100%;
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


        /* --- Global Animations --- */
        @keyframes fade-in-down {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slide-in-up { /* Renamed from slideInUp to be consistent with fade-in-down */
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float-particle {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        @keyframes float-hero {
            0% { transform: translateY(0px) translateX(0px); }
            50% { transform: translateY(-20px) translateX(10px); }
            100% { transform: translateY(0px) translateX(0px); }
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        @keyframes bounce { /* Kept original bounce for tech-icons */
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }


        /* Floating Particles Background */
        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(59, 130, 246, 0.1); /* Consistent with primary-color */
            border-radius: 50%;
            animation: float-particle 6s ease-in-out infinite;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); /* Using color variables */
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem !important; /* Consistent with other pages */
            box-shadow: var(--header-shadow-bright); /* Consistent with other pages */
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="30" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="70" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="80" r="2.5" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="90" r="1.5" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            animation: float-hero 20s infinite linear;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            animation: slide-in-up 1s ease-out; /* Changed to consistent animation */
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            animation: slide-in-up 1s ease-out 0.2s both; /* Changed to consistent animation */
        }

        .tech-icons {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
            position: relative;
            z-index: 2;
        }

        .tech-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            animation: bounce 2s ease-in-out infinite;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .tech-icon:nth-child(1) { animation-delay: 0s; }
        .tech-icon:nth-child(2) { animation-delay: 0.5s; }
        .tech-icon:nth-child(3) { animation-delay: 1s; }

        /* Content Section General Styling */
        .content-card {
            background: var(--light-bg); /* Use consistent light-bg */
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 2.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(0,0,0,0.05);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0; /* Initial state for reveal animation */
            transform: translateY(30px); /* Initial state for reveal animation */
        }

        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .section-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: 1.5rem;
            animation: pulse 2s infinite;
        }

        .fiber-optic-icon {
            background: linear-gradient(135deg, var(--optik-orange) 0%, #F97316 100%);
        }

        .wifi-icon {
            background: linear-gradient(135deg, var(--wlan-green) 0%, #059669 100%);
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color); /* Consistent primary-color */
            margin-bottom: 1rem;
        }

        .concept-box {
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--light-bg) 100%); /* Use color variables */
            border-radius: 15px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            border-left: 5px solid var(--primary-color); /* Consistent primary-color */
            transition: transform 0.3s ease;
            font-size: 1.1rem; /* Consistent with body text */
        }

        .concept-box:hover {
            transform: translateX(10px);
        }

        .concept-title {
            font-weight: 600;
            color: var(--primary-color); /* Consistent primary-color */
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .animated-illustration {
            text-align: center;
            margin: 2rem 0;
        }

        .fiber-cable {
            width: 300px;
            height: 40px;
            background: linear-gradient(90deg, var(--gray-100) 0%, var(--lighter-bg) 50%, var(--gray-100) 100%); /* Use color variables */
            border-radius: 20px;
            position: relative;
            margin: 2rem auto;
            overflow: hidden;
        }

        .light-pulse {
            width: 20px;
            height: 20px;
            background: radial-gradient(circle, var(--optik-orange) 0%, #F97316 100%);
            border-radius: 50%;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            animation: travel 3s infinite;
            box-shadow: 0 0 20px var(--optik-orange);
        }

        @keyframes travel {
            0% { left: -20px; }
            100% { left: 300px; }
        }

        .wifi-waves {
            display: inline-block;
            position: relative;
        }

        .wave {
            width: 60px;
            height: 60px;
            border: 3px solid var(--wlan-green);
            border-radius: 50%;
            position: absolute;
            opacity: 0;
            animation: waveAnimation 2s infinite;
        }

        .wave:nth-child(1) { animation-delay: 0s; }
        .wave:nth-child(2) { animation-delay: 0.5s; }
        .wave:nth-child(3) { animation-delay: 1s; }

        @keyframes waveAnimation {
            0% {
                transform: scale(0.1);
                opacity: 1;
            }
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
            border: 2px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color); /* Consistent primary-color */
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .speed-icon { background: linear-gradient(135deg, var(--purple-gradient-start) 0%, var(--purple-gradient-end) 100%); }
        .security-icon { background: linear-gradient(135deg, var(--pink-gradient-start) 0%, var(--pink-gradient-end) 100%); }
        .distance-icon { background: linear-gradient(135deg, var(--optik-orange) 0%, #F97316 100%); }
        .flexibility-icon { background: linear-gradient(135deg, var(--wlan-green) 0%, #059669 100%); }

        /* Buttons (Consistent with other pages) */
        .btn-neon {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none; /* No border for filled button */
            box-shadow: var(--button-shadow-bright);
            transition: all 0.4s ease-out;
            padding: 12px 30px; /* Bigger button */
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            font-size: 1rem; /* Consistent button text size */
        }
        .btn-neon:hover {
            background: linear-gradient(45deg, #2563EB, #4F46E5); /* Darker shades on hover */
            box-shadow: 0 0 30px var(--accent-color);
            transform: translateY(-3px) scale(1.02);
            color: white; /* White text on hover */
        }
        
        .btn-outline-neon {
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            background: transparent;
            transition: all 0.4s ease-out;
            padding: 12px 30px; /* Bigger button */
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            font-size: 1rem; /* Consistent button text size */
        }
        .btn-outline-neon:hover {
            background: rgba(59, 130, 246, 0.1);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.6);
            transform: translateY(-3px) scale(1.02);
            color: var(--primary-color); /* Text color stays primary */
        }

        .back-btn { /* Specific back button for hero section, adjusted to be consistent */
            background: linear-gradient(135deg, var(--text-dark) 0%, var(--text-muted-light) 100%); /* Darker gradient */
            border: none;
            border-radius: 15px;
            padding: 1rem 2rem;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            font-size: 1rem; /* Consistent button text size */
        }

        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            color: white;
        }

        .comparison-table {
            background: white;
            border-radius: 15px;
            overflow: hidden; /* Pastikan konten tabel yang overflow tersembunyi */
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin: 2rem 0;
            font-size: 1.1rem; /* Consistent with body text */
        }
        /* Wrapper untuk membuat tabel responsif */
        .table-responsive-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
            border-radius: 15px; /* Sesuaikan border-radius dengan parent */
        }
        .comparison-table table { /* Target tabel di dalam wrapper */
            width: 100%;
            min-width: 600px; /* Minimal lebar agar tidak terlalu sempit di layar kecil */
            border-collapse: collapse;
        }

        .comparison-table th {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); /* Consistent colors */
            color: white;
            padding: 1rem;
            font-weight: 600;
            text-align: left;
        }

        .comparison-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--gray-100); /* Consistent gray */
        }

        .comparison-table tbody tr:hover {
            background-color: var(--light-bg); /* Consistent light background */
        }

        .video-placeholder {
            background: linear-gradient(135deg, var(--gray-100) 0%, var(--light-bg) 100%); /* Consistent gray to white */
            border-radius: 15px;
            padding: 3rem;
            text-align: center;
            margin: 2rem 0;
            border: 2px dashed var(--primary-color); /* Consistent primary-color */
            position: relative; /* Needed for ratio */
        }
        .video-placeholder .video-container { /* Added for HTML5 video ratio */
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .video-placeholder video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .video-icon {
            font-size: 4rem;
            color: var(--optik-orange); /* Using optik-orange */
            margin-bottom: 1rem;
        }

        /* Quiz Section Styles (Consistent with other pages) */
        .quiz-card {
            background: var(--lighter-bg); /* Use lighter-bg */
            border-radius: 1.5rem;
            padding: 2rem;
            margin: 1rem 0;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border: 1px solid rgba(59, 130, 246, 0.2); /* Consistent with primary-color */
            color: var(--text-dark); /* Consistent dark text */
        }

        .quiz-option {
            background: rgba(59, 130, 246, 0.05); /* Very light blue tint for options */
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-dark); /* Consistent dark text */
            font-size: 1.1rem; /* Consistent with body text */
        }

        .quiz-option:hover {
            background: rgba(59, 130, 246, 0.1);
            border-color: var(--primary-color); /* Consistent with primary-color */
        }

        .quiz-option.selected {
            border-color: var(--primary-color); /* Consistent primary color */
            background: rgba(59, 130, 246, 0.2); /* Consistent light blue background */
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2); /* Consistent subtle shadow */
        }
        
        .quiz-option.correct-answer {
            border-color: #28a745;
            background: var(--alert-success-bg);
            font-weight: bold;
        }
        .quiz-option.incorrect {
            border-color: #dc3545;
            background: var(--alert-danger-bg);
            font-weight: bold;
        }
        .quiz-option label {
            width: 100%;
            cursor: pointer;
            display: block;
            font-size: 1.1rem; /* Consistent with body text */
        }

        .quiz-option input[type="radio"] {
            display: none; /* Hide default radio button */
        }
        
        #quiz-feedback {
            font-size: 1.1rem;
            color: var(--text-dark); /* Consistent dark text */
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

        /* Video Quiz Modal Styles (Consistent with other pages) */
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
        @media (max-width: 991.98px) { /* Medium devices (tablets) */
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
            .content-card {
                padding: 2rem;
            }
            .section-title {
                font-size: 1.8rem;
            }
            .section-icon {
                width: 70px;
                height: 70px;
                font-size: 1.8rem;
            }
            .fiber-cable {
                width: 250px; /* Adjust width for smaller screens */
            }
            @keyframes travel {
                0% { left: -20px; }
                100% { left: 250px; } /* Adjust animation end point */
            }
            .feature-grid {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); /* Adapt feature grid */
                gap: 1rem;
            }
            .feature-card {
                padding: 1.2rem;
            }
            .feature-icon {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }
            .comparison-table table {
                min-width: 500px; /* Ensure table remains scrollable but legible */
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 0;
            }
            .hero-title {
                font-size: 2rem;
            }
            .hero-subtitle {
                font-size: 1rem;
            }
            .back-btn {
                width: 100%;
                text-align: center;
                margin-top: 1rem;
            }
            .content-card {
                padding: 1.5rem;
                border-radius: 15px;
            }
            .section-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }
            .section-title {
                font-size: 1.6rem;
                text-align: left; /* Keep left aligned unless specifically requested to center */
            }
            .concept-box {
                padding: 1rem;
                margin: 1rem 0;
            }
            .concept-title {
                font-size: 1rem;
            }
            p, ul, li {
                font-size: 0.95rem;
            }
            .fiber-cable {
                width: 200px; /* Further reduce width for very small screens */
                height: 30px;
            }
            .light-pulse {
                width: 15px;
                height: 15px;
            }
            @keyframes travel {
                0% { left: -15px; }
                100% { left: 200px; }
            }
            .wifi-waves {
                width: 50px;
                height: 50px;
            }
            .wave {
                width: 50px;
                height: 50px;
            }
            .feature-grid {
                grid-template-columns: 1fr; /* Stack features on small screens */
            }
            .feature-card {
                padding: 1rem;
            }
            .feature-icon {
                width: 45px;
                height: 45px;
                font-size: 1.2rem;
                margin-bottom: 0.8rem;
            }
            .feature-card h6 {
                font-size: 0.95rem;
            }
            .feature-card p {
                font-size: 0.8rem;
            }
            .comparison-table table {
                min-width: 400px; /* Adjust min-width for mobile */
            }
            .comparison-table th, .comparison-table td {
                padding: 0.8rem;
                font-size: 0.9rem;
            }
            .video-placeholder {
                padding: 2rem 1rem;
            }
            .video-icon {
                font-size: 3rem;
            }
            .quiz-card {
                padding: 1.2rem;
            }
            .quiz-card h2 {
                font-size: 1.5rem;
            }
            .quiz-option {
                padding: 0.75rem;
                font-size: 0.9rem;
            }
            #quiz-feedback {
                font-size: 1rem;
            }
            .btn-primary, .btn-success {
                padding: 0.75rem;
                font-size: 1rem;
            }
        }
        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.6rem;
            }
            .hero-subtitle {
                font-size: 0.9rem;
            }
            .section-title {
                font-size: 1.4rem;
            }
            .section-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
            .fiber-cable {
                width: 150px;
            }
            @keyframes travel {
                0% { left: -10px; }
                100% { left: 150px; }
            }
            .comparison-table table {
                min-width: 320px; /* Minimum width for very small phones */
            }
        }
    </style>
</head>
<body>
    <!-- Floating Particles Background -->
    <div class="floating-particles"></div> 

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container-fluid px-4"> <!-- Changed to container-fluid and added px-4 -->
            <div class="hero-content">
                <div class="row align-items-center">
                    <div class="col-12 text-center"> <!-- Changed col-lg-8 to col-12 and centered text -->
                        <h1 class="hero-title">Sistem Optik & WLAN</h1>
                        <p class="hero-subtitle">Mari belajar tentang teknologi super cepat yang menghubungkan dunia!</p>
                    </div>
                    <div class="col-12 text-end mt-3"> <!-- Changed col-lg-4 to col-12 and added margin-top -->
                        <a href="{{route('guru.materi.index')}}" class="back-btn">
                            <i class="bi bi-arrow-left"></i>
                            Kembali ke Daftar Materi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4 px-4"> <!-- Changed to container-fluid and added px-4 -->
        <!-- Introduction Card -->
        <div class="content-card">
            <div class="animated-illustration">
                <h2 class="section-title text-center mb-4">Apa yang Akan Kita Pelajari?</h2>
                <div class="video-placeholder">
                    <div class="video-container">
                        <!-- Changed to HTML5 video tag -->
                        <video id="video-player-optik-wlan" controls preload="metadata" style="width: 100%; height: 100%;">
                            <source src="{{asset ('homepage/img/perkembangan.mp4')}}" type="video/mp4">
                            Your browser does not not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
            
            <p style="font-size: 1.1rem; text-align: center; margin-top: 2rem;">
                Pernahkah kamu bertanya-tanya bagaimana internet bisa sampai ke rumahmu? 
                Atau bagaimana smartphone bisa terhubung ke WiFi tanpa kabel? 
                Hari ini kita akan menjelajahi dua teknologi amazing yang membuat semua itu mungkin! 🚀
            </p>
        </div>

        <!-- Fiber Optic Section -->
        <div class="content-card">
            <div class="d-flex align-items-center mb-4">
                <div class="section-icon fiber-optic-icon">
                    <i class="bi bi-lightbulb"></i>
                </div>
                <div class="ms-3">
                    <h2 class="section-title mb-0">1. Sistem Optik (Serat Optik)</h2>
                    <p class="mb-0">Internet Super Cepat dengan Kekuatan Cahaya! ✨</p>
                </div>
            </div>

            <div class="animated-illustration">
                <h5>Lihat bagaimana cahaya "berlari" di dalam kabel optik:</h5>
                <div class="fiber-cable">
                    <div class="light-pulse"></div>
                </div>
                <small class="text-muted">Animasi: Cahaya bergerak dengan kecepatan 300 juta meter per detik!</small>
            </div>

            <div class="concept-box">
                <div class="concept-title">🤔 Apa itu Serat Optik?</div>
                <p>Bayangkan sebuah "selang air" yang sangat tipis, tapi bukannya air yang mengalir di dalamnya, melainkan cahaya! Serat optik adalah kabel super tipis yang terbuat dari kaca khusus yang bisa mengirim data menggunakan cahaya.</p>
            </div>

            <div class="concept-box">
                <div class="concept-title">🔬 Cara Kerjanya (Simple Version):</div>
                <ul>
                    <li><strong>Seperti Bermain Laser Tag:</strong> Data diubah menjadi sinyal cahaya (seperti senter yang nyala-mati cepat)</li>
                    <li><strong>Cahaya "Memantul-mantul":</strong> Cahaya bergerak di dalam kabel dengan cara memantul-mantul di dinding (seperti bola pingpong)</li>
                    <li><strong>Sampai Tujuan:</strong> Di ujung lain, cahaya diubah kembali menjadi data yang bisa kita gunakan</li>
                </ul>
            </div>

            <h4 style="color: var(--primary-color); margin-top: 2rem;">🎯 Keunggulan Serat Optik:</h4> <!-- Changed to primary-color -->
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon speed-icon">
                        <i class="bi bi-lightning"></i>
                    </div>
                    <h5>Super Cepat</h5>
                    <p>Download film 1GB cuma butuh beberapa detik!</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon distance-icon">
                        <i class="bi bi-globe"></i>
                    </div>
                    <h5>Jarak Jauh</h5>
                    <p>Bisa kirim data sampai ke benua lain tanpa kehilangan kualitas!</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon security-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5>Aman & Stabil</h5>
                    <p>Tidak terpengaruh cuaca atau gangguan listrik!</p>
                </div>
            </div>

            <div class="table-responsive-wrapper">
                <table class="table comparison-table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Jenis Serat Optik</th>
                            <th>Ukuran Inti</th>
                            <th>Digunakan Untuk</th>
                            <th>Analogi Sederhana</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Single-Mode</strong></td>
                            <td>9 mikrometer (super kecil!)</td>
                            <td>Internet antar kota/negara</td>
                            <td>Seperti sedotan kecil, cahaya jalan lurus</td>
                        </tr>
                        <tr>
                            <td><strong>Multi-Mode</strong></td>
                            <td>50-62.5 mikrometer</td>
                            <td>Jaringan dalam gedung</td>
                            <td>Seperti terowongan, cahaya bisa zigzag</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- WLAN Section -->
        <div class="content-card">
            <div class="d-flex align-items-center mb-4">
                <div class="section-icon wifi-icon">
                    <i class="bi bi-wifi"></i>
                </div>
                <div class="ms-3">
                    <h2 class="section-title mb-0">2. WLAN (WiFi)</h2>
                    <p class="mb-0">Internet Tanpa Kabel - Kebebasan Digital! 📶</p>
                </div>
            </div>

            <div class="animated-illustration" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                <h5>Lihat bagaimana sinyal WiFi menyebar:</h5>
                <div class="wifi-waves" style="position: relative; width: 60px; height: 60px; margin: 2rem 0;">
                    <div style="width: 20px; height: 20px; background: var(--wlan-green); border-radius: 50%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                </div>
                <small class="text-muted">Animasi: Sinyal radio menyebar ke segala arah dari router</small>
            </div>

            <div class="concept-box">
                <div class="concept-title">📡 Apa itu WLAN/WiFi?</div>
                <p>WLAN adalah singkatan dari "Wireless Local Area Network" - atau dalam bahasa sederhana: "Jaringan tanpa kabel di area terbatas". Seperti radio yang menangkap siaran musik, perangkatmu menangkap sinyal internet dari router WiFi!</p>
            </div>

            <div class="concept-box">
                <div class="concept-title">🎵 Cara Kerja WiFi (Seperti Radio Magic):</div>
                <ul>
                    <li><strong>Router = Stasiun Radio:</strong> Mengirim sinyal internet melalui gelombang radio</li>
                    <li><strong>Perangkatmu = Radio:</strong> Menangkap sinyal dan mengubahnya jadi internet</li>
                    <li><strong>Dua Arah:</strong> Bukan cuma terima, tapi juga bisa kirim balik (seperti walkie-talkie)</li>
                </ul>
            </div>

            <h4 style="color: var(--wlan-green); margin-top: 2rem;">🌟 Komponen Utama WiFi:</h4> <!-- Changed to wlan-green -->
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon flexibility-icon">
                        <i class="bi bi-router"></i>
                    </div>
                    <h5>Access Point (AP)</h5>
                    <p>Seperti "portal ajaib" yang mengubah kabel jadi sinyal nirkabel</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon speed-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                    <h5>Perangkat Klien</h5>
                    <p>HP, laptop, tablet - semua yang bisa "nangkep" WiFi</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon security-icon">
                        <i class="bi bi-hdd-network"></i>
                    </div>
                    <h5>Wireless Router</h5>
                    <p>All-in-one: AP + router + switch jadi satu perangkat</p>
                </div>
            </div>

            <div class="concept-box">
                <div class="concept-title">📈 Evolusi WiFi - Semakin Cepat!</div>
                <div class="table-responsive-wrapper">
                    <table class="table comparison-table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Standar WiFi</th>
                                <th>Nama Mudah</th>
                                <th>Kecepatan Max</th>
                                <th>Analogi Kecepatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>802.11b</td>
                                <td>WiFi Jadul</td>
                                <td>11 Mbps</td>
                                <td>Seperti jalan desa</td>
                            </tr>
                            <tr>
                                <td>802.11g</td>
                                <td>WiFi Standar</td>
                                <td>54 Mbps</td>
                                <td>Seperti jalan kota</td>
                            </tr>
                            <tr>
                                <td>802.11n</td>
                                <td>WiFi Cepat</td>
                                <td>600 Mbps</td>
                                <td>Seperti jalan tol</td>
                            </tr>
                            <tr>
                                <td>802.11ac</td>
                                <td>WiFi Super</td>
                                <td>6.93 Gbps</td>
                                <td>Seperti jalan tol 8 jalur</td>
                            </tr>
                            <tr>
                                <td>802.11ax</td>
                                <td>WiFi 6</td>
                                <td>9.6 Gbps</td>
                                <td>Seperti hyperloop!</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="content-card">
            <h2 class="section-title text-center">🎉 Kesimpulan: Dua Teknologi, Satu Tujuan</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="concept-box">
                        <div class="concept-title">🌟 Serat Optik</div>
                        <ul>
                            <li>Menggunakan cahaya untuk kirim data</li>
                            <li>Super cepat dan bisa jarak jauh</li>
                            <li>Dipakai untuk internet backbone</li>
                            <li>Seperti "jalan tol super" untuk data</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="concept-box">
                        <div class="concept-title">📶 WLAN/WiFi</div>
                        <ul>
                            <li>Menggunakan gelombang radio</li>
                            <li>Memberikan kebebasan bergerak</li>
                            <li>Cocok untuk area terbatas</li>
                            <li>Seperti "radio internet" di rumah</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <div class="video-placeholder">
                    <i class="bi bi-trophy video-icon" style="color: var(--optik-orange);"></i> <!-- Changed to optik-orange -->
                    <h4>🎯 Kuis Interaktif</h4>
                    <p>Uji pemahamanmu dengan kuis seru tentang Sistem Optik dan WLAN!</p>
                    <button id="startQuizBtn" class="btn btn-neon btn-lg"> <!-- Changed to btn-neon -->
                        <i class="bi bi-play-fill me-2"></i>Mulai Kuis
                    </button>
                </div>
            </div>
        </div>

        <!-- Quiz Section (Added) -->
        <section id="quiz-section" class="mb-5 d-none">
            <div class="quiz-card">
                <h2 class="h3 mb-4" style="color: var(--primary-color); text-align: center;"> <!-- Changed to primary-color -->
                    <i class="fas fa-question-circle me-3"></i>Uji Pemahaman: Kuis Sederhana
                </h2>
                <div id="quiz-container">
                    <!-- Question 1 -->
                    <div class="question-block mb-4">
                        <p class="mb-3"><strong>1. Apa media transmisi utama yang digunakan dalam sistem serat optik?</strong></p>
                        <div class="quiz-option" data-question="q1" data-choice="a">
                            <label class="w-100 cursor-pointer">a. Gelombang radio</label>
                        </div>
                        <div class="quiz-option" data-question="q1" data-choice="b">
                            <label class="w-100 cursor-pointer">b. Cahaya</label>
                        </div>
                        <div class="quiz-option" data-question="q1" data-choice="c">
                            <label class="w-100 cursor-pointer">c. Sinyal listrik</label>
                        </div>
                        <div class="quiz-option" data-question="q1" data-choice="d">
                            <label class="w-100 cursor-pointer">d. Gelombang mikro</label>
                        </div>
                    </div>

                    <!-- Question 2 -->
                    <div class="question-block mb-4">
                        <p class="mb-3"><strong>2. Keunggulan utama serat optik dibandingkan kabel tembaga adalah...</strong></p>
                        <div class="quiz-option" data-question="q2" data-choice="a">
                            <label class="w-100 cursor-pointer">a. Lebih murah dan mudah dipasang</label>
                        </div>
                        <div class="quiz-option" data-question="q2" data-choice="b">
                            <label class="w-100 cursor-pointer">b. Lebih lambat tetapi lebih aman</label>
                        </div>
                        <div class="quiz-option" data-question="q2" data-choice="c">
                            <label class="w-100 cursor-pointer">c. Kecepatan transfer data sangat tinggi dan jangkauan jauh</label>
                        </div>
                        <div class="quiz-option" data-question="q2" data-choice="d">
                            <label class="w-100 cursor-pointer">d. Tidak memerlukan daya listrik</label>
                        </div>
                    </div>

                    <!-- Question 3 -->
                    <div class="question-block mb-4">
                        <p class="mb-3"><strong>3. Apa singkatan dari WLAN?</strong></p>
                        <div class="quiz-option" data-question="q3" data-choice="a">
                            <label class="w-100 cursor-pointer">a. Wide Local Area Network</label>
                        </div>
                        <div class="quiz-option" data-question="q3" data-choice="b">
                            <label class="w-100 cursor-pointer">b. Wireless Light Access Network</label>
                        </div>
                        <div class="quiz-option" data-question="q3" data-choice="c">
                            <label class="w-100 cursor-pointer">c. Wireless Local Area Network</label>
                        </div>
                        <div class="quiz-option" data-question="q3" data-choice="d">
                            <label class="w-100 cursor-pointer">d. Web Local Area Network</label>
                        </div>
                    </div>

                    <!-- Question 4 -->
                    <div class="question-block mb-4">
                        <p class="mb-3"><strong>4. Komponen apa yang berfungsi sebagai "portal ajaib" yang mengubah sinyal kabel menjadi sinyal nirkabel pada jaringan WiFi?</strong></p>
                        <div class="quiz-option" data-question="q4" data-choice="a">
                            <label class="w-100 cursor-pointer">a. Wireless Adapter</label>
                        </div>
                        <div class="quiz-option" data-question="q4" data-choice="b">
                            <label class="w-100 cursor-pointer">b. Router</label>
                        </div>
                        <div class="quiz-option" data-question="q4" data-choice="c">
                            <label class="w-100 cursor-pointer">c. Access Point (AP)</label>
                        </div>
                        <div class="quiz-option" data-question="q4" data-choice="d">
                            <label class="w-100 cursor-pointer">d. Modem</label>
                        </div>
                    </div>

                    <!-- Question 5 -->
                    <div class="question-block mb-4">
                        <p class="mb-3"><strong>5. Standar WiFi yang menawarkan kecepatan tertinggi di antara pilihan berikut adalah...</strong></p>
                        <div class="quiz-option" data-question="q5" data-choice="a">
                            <label class="w-100 cursor-pointer">a. 802.11b</label>
                        </div>
                        <div class="quiz-option" data-question="q5" data-choice="b">
                            <label class="w-100 cursor-pointer">b. 802.11g</label>
                        </div>
                        <div class="quiz-option" data-question="q5" data-choice="c">
                            <label class="w-100 cursor-pointer">c. 802.11n</label>
                        </div>
                        <div class="quiz-option" data-question="q5" data-choice="d">
                            <label class="w-100 cursor-pointer">d. 802.11ax (WiFi 6)</label>
                        </div>
                    </div>
                    
                    <button onclick="checkQuiz()" class="btn btn-neon w-100 mt-3 fw-bold">Periksa Jawaban</button>
                    <p id="quiz-feedback" class="mt-4 font-weight-bold text-center"></p>
                    {{-- Tombol Lanjut ke Materi Berikutnya akan mengarah kembali ke halaman indeks utama --}}
                    <a href="{{ route('guru.materi.index') }}" id="nextMaterialBtn" class="btn btn-outline-neon w-100 mt-3 d-none fw-bold">Kembali ke Daftar Materi <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </section>
    </div>

    <!-- Video Quiz Modal Structure (Consistent with other pages) -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigF/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- Mermaid JS (Jika ada diagram Mermaid di konten) -->
    <script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>
    <script>
        // Inisialisasi Mermaid (jika ada diagram Mermaid)
        mermaid.initialize({ startOnLoad: true });

        // Fungsi untuk scroll ke bagian tertentu (jika ada tombol "Mulai Belajar")
        function scrollToSection(id) {
            const element = document.getElementById(id);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // Jawaban Kuis untuk halaman "Sistem Optik dan WLAN"
        const quizAnswers = {
            q1: 'b', // Cahaya
            q2: 'c', // Kecepatan transfer data sangat tinggi dan jangkauan jauh
            q3: 'c', // Wireless Local Area Network
            q4: 'c', // Access Point (AP)
            q5: 'd'  // 802.11ax (WiFi 6)
        };

        // Skor minimum untuk melanjutkan ke materi berikutnya
        const REQUIRED_SCORE = 80; // Misalnya, 80%

        // Fungsi untuk membuat partikel mengambang di latar belakang
        function createParticles() {
            const particlesContainer = document.querySelector('.floating-particles');
            const numberOfParticles = 50; 

            // Pastikan container partikel ditemukan
            if (!particlesContainer) {
                console.error("Elemen '.floating-particles' tidak ditemukan di DOM.");
                return; // Hentikan fungsi jika elemen tidak ada
            }

            for (let i = 0; i < numberOfParticles; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                const size = Math.random() * 5 + 2; 
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                const animationDuration = Math.random() * 3 + 3;
                particle.style.animationDuration = `${animationDuration}s`;
                const animationDelay = Math.random() * 2;
                particle.style.animationDelay = `${animationDelay}s`;
                particlesContainer.appendChild(particle);
            }
        }

        // Fungsi untuk memeriksa jawaban kuis
        function checkQuiz() {
            let score = 0;
            const totalQuestions = Object.keys(quizAnswers).length;
            const feedback = document.getElementById('quiz-feedback');
            const nextMaterialBtn = document.getElementById('nextMaterialBtn');

            let allAnswered = true;

            document.querySelectorAll('.question-block').forEach(questionBlock => {
                const qId = questionBlock.querySelector('.quiz-option').dataset.question;
                const selectedOption = questionBlock.querySelector(`.quiz-option.selected`);
                const correctAnswer = quizAnswers[qId];

                questionBlock.querySelectorAll('.quiz-option').forEach(opt => {
                    opt.classList.remove('correct-answer', 'incorrect', 'selected');
                    opt.disabled = true; // Nonaktifkan opsi setelah diperiksa
                });

                if (!selectedOption) {
                    allAnswered = false;
                    return;
                }

                const selectedChoice = selectedOption.dataset.choice;

                if (selectedChoice === correctAnswer) {
                    score += 1;
                    selectedOption.classList.add('correct-answer');
                } else {
                    selectedOption.classList.add('incorrect');
                    const correctOption = questionBlock.querySelector(`.quiz-option[data-choice="${correctAnswer}"]`);
                    if (correctOption) {
                        correctOption.classList.add('correct-answer');
                    }
                }
            });

            if (!allAnswered) {
                showAlert("Mohon jawab semua pertanyaan sebelum memeriksa.", 'warning');
                nextMaterialBtn.classList.add('d-none');
                nextMaterialBtn.disabled = true;
                
                document.querySelectorAll('.question-block').forEach(block => {
                    const selected = block.querySelector('.quiz-option.selected');
                    if (!selected) {
                        block.querySelectorAll('.quiz-option').forEach(opt => opt.disabled = false);
                    }
                });
                return;
            }

            const percentage = (score / totalQuestions) * 100;
            feedback.innerHTML = `Skor Anda: ${score} dari ${totalQuestions} (${percentage.toFixed(0)}%).<br>`;

            if (percentage >= REQUIRED_SCORE) {
                feedback.innerHTML += `Selamat! Anda berhasil memahami materi ini dengan baik!`;
                feedback.className = "mt-4 fw-bold text-success";
                nextMaterialBtn.classList.remove('d-none');
                nextMaterialBtn.disabled = false;
                // Mengubah kunci localStorage menjadi 'material_5_score'
                localStorage.setItem('material_5_score', percentage.toFixed(0)); 
            } else {
                feedback.innerHTML += `Terus semangat belajar! Anda perlu mencapai setidaknya ${REQUIRED_SCORE}% untuk melanjutkan.`;
                feedback.className = "mt-4 fw-bold text-danger";
                nextMaterialBtn.classList.add('d-none');
                nextMaterialBtn.disabled = true;
                // Mengubah kunci localStorage menjadi 'material_5_score'
                localStorage.setItem('material_5_score', percentage.toFixed(0));
                
                setTimeout(() => {
                    resetQuizUI();
                }, 3000);
            }
        }

        // Fungsi untuk mereset tampilan kuis
        function resetQuizUI() {
            document.querySelectorAll('.quiz-option').forEach(option => {
                option.classList.remove('selected', 'correct-answer', 'incorrect');
                option.disabled = false;
            });
            document.getElementById('quiz-feedback').textContent = "";
            document.getElementById('nextMaterialBtn').classList.add('d-none');
            document.getElementById('nextMaterialBtn').disabled = true;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('.content-card');

            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
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

            // Initialize floating particles
            createParticles();

            // Hover effects for feature cards
            document.querySelectorAll('.feature-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Enable/disable 'Next Material' button based on stored score
            // Mengubah kunci localStorage yang dibaca menjadi 'material_5_score'
            const savedScore = parseInt(localStorage.getItem('material_5_score')) || 0;
            const nextMaterialBtn = document.getElementById('nextMaterialBtn');
            if (savedScore >= REQUIRED_SCORE) {
                nextMaterialBtn.classList.remove('d-none');
            } else {
                nextMaterialBtn.classList.add('d-none');
            }

            // Button "Mulai Kuis" functionality
            const startQuizBtn = document.getElementById('startQuizBtn');
            const quizSection = document.getElementById('quiz-section');
            if (startQuizBtn && quizSection) {
                startQuizBtn.addEventListener('click', function() {
                    quizSection.classList.remove('d-none'); // Tampilkan bagian kuis
                    quizSection.scrollIntoView({ behavior: 'smooth' }); // Gulir ke bagian kuis
                    resetQuizUI(); // Pastikan kuis dalam keadaan reset saat dimulai
                });
            }

            // Delegate event listener for quiz options on quiz-container
            document.getElementById('quiz-container').addEventListener('click', function(event) {
                const option = event.target.closest('.quiz-option');
                if (option && !option.disabled) {
                    const questionBlock = option.closest('.question-block');
                    if (questionBlock) {
                        questionBlock.querySelectorAll('.quiz-option').forEach(opt => {
                            opt.classList.remove('selected');
                        });
                        option.classList.add('selected');
                    }
                }
            });
        });

        // HTML5 Video Player reference
        let videoPlayerOptikWLAN; 
        let videoQuizInterval;

        // Define quiz points for the video (perkembangan.mp4)
        var videoQuizPointsOptikWLAN = [
            {
                time: 15, // Example: at 15 seconds
                question: "Menurut video, apa yang menjadi dasar perkembangan teknologi komunikasi?",
                options: [
                    "Penemuan roda",
                    "Kebutuhan manusia untuk terhubung",
                    "Perkembangan transportasi",
                    "Perubahan iklim"
                ],
                correctAnswerIndex: 1, // "Kebutuhan manusia untuk terhubung"
                answered: false
            },
            {
                time: 30, // Example: at 30 seconds
                question: "Apa yang membuat komunikasi menjadi lebih cepat dan efisien menurut video?",
                options: [
                    "Penggunaan surat",
                    "Teknologi kabel tembaga",
                    "Inovasi dalam transmisi data",
                    "Peningkatan jumlah menara sinyal"
                ],
                correctAnswerIndex: 2, // "Inovasi dalam transmisi data"
                answered: false
            }
        ];
        var currentVideoQuizQuestionOptikWLAN = null;

        document.addEventListener('DOMContentLoaded', () => {
            // Initialize HTML5 video player
            videoPlayerOptikWLAN = document.getElementById('video-player-optik-wlan');

            // Add event listeners for the video for quiz functionality
            if (videoPlayerOptikWLAN) {
                videoPlayerOptikWLAN.addEventListener('play', onVideoPlayOptikWLAN);
                videoPlayerOptikWLAN.addEventListener('pause', onVideoPauseOptikWLAN);
                videoPlayerOptikWLAN.addEventListener('ended', onVideoEndedOptikWLAN);
                videoPlayerOptikWLAN.addEventListener('timeupdate', checkVideoTimeOptikWLAN);
            }
        });

        function onVideoPlayOptikWLAN() {
            videoQuizInterval = setInterval(checkVideoTimeOptikWLAN, 250); 
        }

        function onVideoPauseOptikWLAN() {
            clearInterval(videoQuizInterval);
        }

        function onVideoEndedOptikWLAN() {
            clearInterval(videoQuizInterval);
            videoQuizPointsOptikWLAN.forEach(point => point.answered = false);
        }

        function checkVideoTimeOptikWLAN() {
            if (videoPlayerOptikWLAN && !videoPlayerOptikWLAN.paused && !videoPlayerOptikWLAN.ended) {
                var currentTime = videoPlayerOptikWLAN.currentTime;
                for (let i = 0; i < videoQuizPointsOptikWLAN.length; i++) {
                    const quizPoint = videoQuizPointsOptikWLAN[i];
                    if (!quizPoint.answered && currentTime >= quizPoint.time && currentTime < quizPoint.time + 0.5) {
                        videoPlayerOptikWLAN.pause();
                        showVideoQuizOptikWLAN(quizPoint, i);
                        quizPoint.answered = true;
                        clearInterval(videoQuizInterval);
                        break;
                    }
                }
            }
        }

        function showVideoQuizOptikWLAN(quizData, index) {
            currentVideoQuizQuestionOptikWLAN = { data: quizData, index: index };
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
            optionsElement.innerHTML = '';
            feedbackElement.textContent = '';
            continueBtn.classList.add('d-none');

            quizData.options.forEach((optionText, idx) => {
                const optionDiv = document.createElement('div');
                optionDiv.classList.add('quiz-option');
                optionDiv.setAttribute('data-index', idx);
                optionDiv.innerHTML = `
                    <label class="w-100 cursor-pointer">
                        ${String.fromCharCode(97 + idx)}. ${optionText}
                    </label>
                `;  
                optionDiv.onclick = (e) => {
                    if (e.target.tagName === 'INPUT') return;
                    selectVideoQuizOptionOptikWLAN(optionDiv, idx);
                };
                optionsElement.appendChild(optionDiv);
            });

            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.add('show');
            }, 50);
        }

        function selectVideoQuizOptionOptikWLAN(selectedOptionDiv, selectedIndex) {
            const optionsContainer = selectedOptionDiv.closest('.video-quiz-modal-options');
            optionsContainer.querySelectorAll('.quiz-option').forEach(opt => {
                opt.classList.remove('selected', 'correct-answer', 'incorrect');
            });

            selectedOptionDiv.classList.add('selected');

            const quizData = currentVideoQuizQuestionOptikWLAN.data;
            const feedbackElement = document.getElementById('videoQuizFeedback');
            const continueBtn = document.getElementById('videoQuizContinueBtn');

            optionsContainer.querySelectorAll('.quiz-option').forEach(opt => {
                opt.onclick = null;
                opt.style.cursor = 'default';
            });

            if (selectedIndex === quizData.correctAnswerIndex) {
                selectedOptionDiv.classList.add('correct-answer');
                feedbackElement.textContent = "Jawaban Benar!";
                feedbackElement.classList.remove('text-danger');
                feedbackElement.classList.add('text-success');
                continueBtn.classList.remove('d-none');
            } else {
                selectedOptionDiv.classList.add('incorrect');
                optionsContainer.querySelector(`.quiz-option[data-index="${quizData.correctAnswerIndex}"]`).classList.add('correct-answer');
                feedbackElement.textContent = "Jawaban Salah. Jawaban yang benar sudah ditandai.";
                feedbackElement.classList.remove('text-success');
                feedbackElement.classList.add('text-danger');
                continueBtn.classList.remove('d-none');
            }
        }

        function continueVideo() {
            const modal = document.getElementById('videoQuizModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);

            if (videoPlayerOptikWLAN && videoPlayerOptikWLAN.play) {
                videoPlayerOptikWLAN.play();
                videoQuizInterval = setInterval(checkVideoTimeOptikWLAN, 250);
            }
        }
    </script>
</body>
</html>
@endsection
