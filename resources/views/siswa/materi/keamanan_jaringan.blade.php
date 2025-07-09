{{-- resources/views/siswa/materi/prinsip_dasar_keamanan_jaringan.blade.php --}}

@extends('siswa.siswa_master')

@section('siswa')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prinsip Dasar Keamanan Jaringan</title>
    <!-- Bootstrap CSS -->
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWtIXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Define bright color palette */
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
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #E0F2FE 0%, #BFDBFE 100%); /* Light blue gradient */
            color: var(--text-dark); /* Dark text */
            overflow-x: hidden; /* Prevent horizontal scroll due to animations */
            font-size: 1.1rem; /* Consistent base font size */
        }

        .container-fluid { /* Changed from .container to .container-fluid for full width */
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
        @keyframes slide-in-left {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slide-in-right {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Animation classes - these are added by JS when element becomes visible */
        .animate-fade-in-down {
            animation: fade-in-down 0.8s ease-out forwards;
        }
        .animate-slide-in-left {
            animation: slide-in-left 0.7s ease-out forwards;
        }
        .animate-slide-in-right {
            animation: slide-in-right 0.7s ease-out forwards;
        }


        /* --- Hero Section Specific Styles and Animations --- */
        .hero-section {
            min-height: 90vh;
            background: linear-gradient(135deg, #E0F2FE 0%, #BFDBFE 100%); /* Light blue gradient */
            border-bottom: 1px solid rgba(59, 130, 246, 0.3); /* Lighter border */
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--header-shadow-bright);
        }

        @keyframes gridScroll {
            0% { background-position: 0 0; }
            100% { background-position: 1000px 1000px; } /* Increased distance for smoother, less repetitive scroll */
        }
        .hero-section > div:first-child { /* Animated grid background */
            background-image: 
                linear-gradient(rgba(59, 130, 246, 0.1) 1px, transparent 1px), /* Lighter grid lines */
                linear-gradient(90deg, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
            background-size: 40px 40px;
            animation: gridScroll 60s linear infinite; /* Faster scroll */
            z-index: 0; /* Ensure it's behind content */
        }
        
        .node-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .network-node {
            position: absolute;
            width: 14px; /* Slightly larger nodes */
            height: 14px;
            background: var(--primary-color); /* Bright blue */
            border-radius: 50%;
            box-shadow: 0 0 10px var(--primary-color), 0 0 20px rgba(59, 130, 246, 0.5); /* More prominent glow */
            animation: pulse-node 2s infinite ease-in-out alternate, float-node 8s infinite ease-in-out;
        }
        .network-node:nth-child(1) { top: 20%; left: 15%; animation-delay: 1s; }
        .network-node:nth-child(2) { top: 70%; left: 25%; animation-delay: 1.2s; }
        .network-node:nth-child(3) { top: 40%; left: 75%; animation-delay: 1.4s; }
        .network-node:nth-child(4) { top: 80%; left: 85%; animation-delay: 1.6s; }
        .network-node:nth-child(5) { top: 30%; left: 50%; animation-delay: 1.8s; }

        @keyframes pulse-node {
            0% { opacity: 0.3; transform: scale(0.9); }
            50% { opacity: 1; transform: scale(1.1); }
            100% { opacity: 0.3; transform: scale(0.9); }
        }
        @keyframes float-node {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        
        .connection-line {
            stroke: rgba(59, 130, 246, 0.2); /* Lighter lines */
            stroke-width: 1.5px; /* Slightly thicker lines */
            stroke-dasharray: 1000; /* Long enough to animate draw */
            stroke-dashoffset: 1000; /* Start hidden */
            animation: draw-line 8s ease-out forwards; /* Slower drawing */
        }
        /* Staggered delays for lines */
        .connection-line:nth-child(1) { animation-delay: 2.0s; }
        .connection-line:nth-child(2) { animation-delay: 2.3s; }
        .connection-line:nth-child(3) { animation-delay: 2.6s; }
        .connection-line:nth-child(4) { animation-delay: 2.9s; }

        @keyframes draw-line {
            to { stroke-dashoffset: 0; opacity: 1; }
        }

        .hero-section h1 {
            color: var(--text-dark); /* Dark text for contrast */
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for dark text */
        }

        .title-word {
            display: inline-block;
            margin: 0 5px;
            animation: titleWord 4s infinite ease-in-out;
            transform-origin: bottom; /* For better bounce effect */
        }
        @keyframes titleWord {
            0% { transform: translateY(0); }
            50% { transform: translateY(-8px); } /* Stronger bounce */
            100% { transform: translateY(0); }
        }
        .title-word:nth-child(1) { animation-delay: 0s; }
        .title-word:nth-child(2) { animation-delay: 0.2s; }
        .title-word:nth-child(3) { animation-delay: 0.4s; }
        .title-word:nth-child(4) { animation-delay: 0.6s; }
        .title-word:nth-child(5) { animation-delay: 0.8s; }

        .hero-section .lead {
            font-size: 1.35rem;
            max-width: 700px;
            margin: 0 auto;
            position: relative;
            color: var(--text-muted-light); /* Muted dark text */
        }
        .text-gradient {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
            font-weight: 500;
        }

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
        
        .tags-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 40px;
        }
        .tag-bubble {
            padding: 8px 20px;
            background: rgba(59, 130, 246, 0.1); /* Light background */
            color: var(--primary-color); /* Bright text */
            border-radius: 50px;
            border: 1px solid rgba(59, 130, 246, 0.3);
            font-size: 0.95rem; /* Slightly larger text */
            animation: float-node 6s infinite ease-in-out; /* Combined animations */
            animation-fill-mode: forwards;
        }
        .tag-bubble:nth-child(1) { animation-delay: 2.0s; }
        .tag-bubble:nth-child(2) { animation-delay: 2.2s; }
        .tag-bubble:nth-child(3) { animation-delay: 2.4s; }
        .tag-bubble:nth-child(4) { animation-delay: 2.6s; }
        .tag-bubble:nth-child(5) { animation-delay: 2.8s; }

        /* Three.js sphere container */
        #cyber-sphere {
            width: 100%;
            height: 100%;
        }

        /* --- Main Content Section Styles --- */
        .breadcrumb {
            /* No specific animation for breadcrumb, using default fade-in-up from body */
        }
        
        .section-title {
            font-size: 2.5rem; /* Larger section titles */
            font-weight: 700;
            color: var(--primary-color); /* Bright blue for titles */
            margin-bottom: 2.5rem;
            text-align: center;
            position: relative;
            padding-bottom: 0.75rem;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for dark text */
        }
        .section-title::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 100px; /* Wider underline */
            height: 5px; /* Thicker underline */
            background-color: var(--primary-color); /* Bright blue underline */
            border-radius: 3px;
            box-shadow: 0 0 10px var(--primary-color);
        }

        .card {
            background: var(--lighter-bg); /* Lighter background for cards */
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 1rem;
            box-shadow: var(--shadow-bright-blue); /* Bright shadow */
            margin-bottom: 2rem; /* Consistent spacing */
        }
        .card:hover {
            transform: translateY(-5px) scale(1.01);
            box-shadow: var(--shadow-bright-indigo), 0 0 20px rgba(59, 130, 246, 0.4);
        }

        .card-header {
            background: rgba(59, 130, 246, 0.1); /* Lighter header for cards */
            border-bottom: 1px solid rgba(59, 130, 246, 0.3);
            color: var(--primary-color); /* Bright text for header */
            font-weight: 600;
            padding: 1.2rem 1.5rem;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        .card-header h2, .card-header .fas {
            color: var(--primary-color) !important;
            text-shadow: 0 0 5px rgba(59, 130, 246, 0.2);
        }
        .card-header .badge {
            background-color: rgba(59, 130, 246, 0.2) !important;
            color: var(--primary-color) !important;
            border: 1px solid rgba(59, 130, 246, 0.4);
            font-weight: 500;
            padding: 0.5em 1em;
            border-radius: 0.5rem;
        }

        .card-body {
            color: var(--text-dark); /* Dark text */
            padding: 1.5rem;
        }
        .card-body h5, .card-body h6 {
            color: var(--primary-color); /* Bright blue for sub-titles */
            text-shadow: 0 0 3px rgba(59, 130, 246, 0.2);
        }
        .card-body p, .card-body ul, .card-body ol, .card-body li, .card-body span {
            color: var(--text-dark); /* Ensure body text is dark */
            font-size: 1.1rem; /* Consistent with body text */
        }
        .card-body .fas {
            color: var(--primary-color);
        }

        .alert-info {
            background-color: var(--alert-info-bg); /* Lighter cyan alert */
            border-color: rgba(23, 162, 184, 0.3);
            color: #17a2b8;
        }
        .alert-warning {
            background-color: var(--alert-warning-bg); /* Lighter yellow alert */
            border-color: rgba(255, 193, 7, 0.3);
            color: #ffc107;
        }
        .alert-info .fas, .alert-warning .fas {
            color: inherit; /* Inherit color from alert */
        }

        .diagram-container {
            text-align: center;
            background: var(--lighter-bg); /* Lighter background for diagram container */
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--shadow-bright-blue);
        }
        .diagram-container img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            margin-top: 1rem;
        }
        .diagram-container p.text-muted {
            color: var(--text-muted-light) !important; /* Muted dark text */
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        /* Three.js Model Viewer Styling */
        model-viewer {
            width: 100%;
            height: 500px;
            background-color: transparent; /* Keep transparent background */
            border-radius: 1rem;
            box-shadow: var(--shadow-bright-blue); /* Bright shadow */
        }
        .model-viewer-description {
            color: var(--text-dark); /* Ensure text is dark */
            font-size: 1.1rem; /* Consistent with body text */
        }

        /* Binary background animation for content sections */
        .binary-animation-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 0.8em;
            color: rgba(0, 0, 0, 0.03); /* Very subtle binary on light background */
            line-height: 1.2;
            pointer-events: none;
        }

        /* Timeline for WLAN evolution */
        .timeline {
            position: relative;
            padding: 20px 0;
            list-style: none;
        }
        .timeline:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 2px;
            background-color: rgba(59, 130, 246, 0.3); /* Light blue line */
            margin-left: -1px;
        }
        .timeline-item {
            margin-bottom: 20px;
            position: relative;
        }
        .timeline-item:before, .timeline-item:after {
            content: '';
            display: table;
        }
        .timeline-item:after {
            clear: both;
        }
        .timeline-item:nth-child(even) {
            text-align: right;
        }
        .timeline-badge {
            color: #fff;
            width: 40px;
            height: 40px;
            line-height: 40px;
            font-size: 1.2em;
            text-align: center;
            position: absolute;
            top: 16px;
            left: 50%;
            margin-left: -20px;
            background-color: var(--primary-color); /* Bright blue badge */
            border-radius: 50%;
            z-index: 100;
            box-shadow: 0 0 10px var(--primary-color);
        }
        .timeline-panel {
            width: 45%;
            float: left;
            border: 1px solid rgba(59, 130, 246, 0.2); /* Light blue border */
            border-radius: 8px;
            padding: 15px;
            position: relative;
            background: var(--lighter-bg); /* Lighter background */
            box-shadow: var(--shadow-bright-blue);
            color: var(--text-dark);
            font-size: 1.1rem; /* Consistent with body text */
        }
        .timeline-item:nth-child(even) .timeline-panel {
            float: right;
        }
        .timeline-panel:before {
            content: '';
            position: absolute;
            top: 26px;
            right: -10px;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-left: 10px solid rgba(59, 130, 246, 0.2); /* Light blue border */
        }
        .timeline-item:nth-child(even) .timeline-panel:before {
            border-left-width: 0;
            border-right: 10px solid rgba(59, 130, 246, 0.2); /* Light blue border */
            left: -10px;
            right: auto;
        }
        .timeline-heading h5 {
            color: var(--primary-color); /* Bright blue */
            font-weight: bold;
        }
        .timeline-body p {
            font-size: 0.95rem;
            color: var(--text-dark); /* Dark text */
        }

        /* Specific card color adjustments for the new sections */
        #firewall-ids-ips .card, #kebijakan-backup .card, #switch-arp .card, #dns-dhcp .card {
            background: var(--lighter-bg); /* Use lighter-bg for these content cards */
        }
        #firewall-ids-ips .card-header h2, #kebijakan-backup .card-header h2, #switch-arp .card-header h2, #dns-dhcp .card-header h2 {
             color: var(--primary-color) !important; /* Keep primary blue for general headers */
        }
        /* Specific header text color for danger/red cards, to match the original theme intention for danger */
        #switch-arp .card-header.bg-danger h2, #dns-dhcp .card-header.bg-danger h2 {
            color: #dc3545 !important; /* Keep red for danger headers */
        }
        #switch-arp .card-header.bg-danger {
            background-color: var(--alert-danger-bg) !important;
            border-color: #dc3545;
        }
        #dns-dhcp .card-header.bg-danger {
            background-color: var(--alert-danger-bg) !important;
            border-color: #dc3545;
        }

        #ancaman-keamanan .card-header h2, #ancaman-keamanan .card-header .fas {
            color: var(--primary-color) !important; /* Keep primary blue for initial threat section */
        }
        #ancaman-keamanan .card-header .badge {
            background-color: rgba(59, 130, 246, 0.2) !important;
            color: var(--primary-color) !important;
        }
        #ancaman-keamanan .card-body .text-danger { /* For the danger icons in "Jenis Serangan" */
            color: #dc3545 !important;
        }
        #ancaman-keamanan .card-body .bg-dark { /* Inner boxes for attack types */
            background-color: rgba(0,0,0,0.05) !important; /* Very light transparent black */
            border-color: rgba(0,0,0,0.1);
            color: var(--text-dark) !important;
        }


        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .hero-section {
                min-height: 70vh;
            }
            .hero-section h1 {
                font-size: 2.5rem;
            }
            .hero-section .lead {
                font-size: 1.1rem;
            }
            .btn-neon, .btn-outline-neon {
                padding: 10px 25px;
                font-size: 0.9rem;
            }
            .tag-bubble {
                font-size: 0.85rem;
                padding: 6px 15px;
            }
            .hero-section .d-lg-block { /* Hide 3D sphere on small screens */
                display: none !important;
            }
            .section-title {
                font-size: 2rem;
            }
            .card-header h2 {
                font-size: 1.2rem;
            }
            .card-body {
                padding: 1rem;
            }
            .timeline:before {
                left: 18px;
            }
            .timeline-badge {
                left: 18px;
                margin-left: 0;
            }
            .timeline-panel {
                width: calc(100% - 70px);
                float: right;
            }
            .timeline-panel:before {
                border-left: 0;
                border-right: 10px solid transparent;
                border-top: 10px solid transparent;
                border-bottom: 10px solid transparent;
                left: -10px;
                right: auto;
            }
            .timeline-item:nth-child(even) .timeline-panel {
                float: right;
            }
            .timeline-item:nth-child(even) .timeline-panel:before {
                border-left-width: 0;
                border-right: 10px solid rgba(59, 130, 246, 0.2); /* Light blue border */
                left: -10px;
                right: auto;
            }
        }
        /* Quiz Section styles */
        .quiz-card {
            background: var(--lighter-bg); /* Lighter background */
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 1rem;
            box-shadow: var(--shadow-bright-blue);
            margin-bottom: 2rem;
            padding: 2rem;
            color: var(--text-dark); /* Dark text */
        }

        .quiz-option {
            background: rgba(59, 130, 246, 0.05); /* Very light blue tint for options */
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-dark); /* Dark text */
            font-size: 1.1rem; /* Consistent with body text */
        }

        .quiz-option:hover {
            background: rgba(59, 130, 246, 0.1);
            border-color: var(--primary-color);
        }

        .quiz-option.selected {
            background: rgba(59, 130, 246, 0.2);
            border-color: var(--primary-color);
            font-weight: bold;
        }

        .quiz-option.correct-answer {
            background: var(--alert-success-bg); /* Green */
            border-color: #28a745;
            font-weight: bold;
        }

        .quiz-option.incorrect {
            background: var(--alert-danger-bg); /* Red */
            border-color: #dc3545;
            font-weight: bold;
        }

        .quiz-option label {
            width: 100%;
            cursor: pointer;
            display: block;
            font-size: 1.1rem; /* Ensure label inside option is consistent */
        }

        .quiz-option input[type="radio"] {
            display: none; /* Hide default radio button */
        }
        
        #quiz-feedback {
            font-size: 1.1rem;
            color: var(--text-dark); /* Ensure text is dark */
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


        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .hero-section {
                min-height: 70vh;
            }
            h1 { font-size: 2.5rem; } /* Smaller h1 on mobile */
            h2 { font-size: 1.8rem; }
            h3 { font-size: 1.5rem; }
            h4 { font-size: 1.3rem; }
            h5 { font-size: 1.1rem; }
            p, ol, ul, .quiz-option, .timeline-panel p, .card-body p, .card-body ul, .card-body ol, .card-body li, .card-body span { font-size: 1rem; } /* Slightly smaller body on mobile */
            .badge, .tag-bubble, .timeline-body p { font-size: 0.85rem; }
            .btn-neon, .btn-outline-neon { font-size: 0.9rem; padding: 10px 20px; }
            
            .card-header h2 {
                font-size: 1.2rem;
            }
            .card-body {
                padding: 1rem;
            }
            .hero-section .d-lg-block { /* Hide 3D sphere on small screens */
                display: none !important;
            }
            .section-title {
                font-size: 2rem;
            }
            .title-word {
                margin-right: 8px; /* Reduce spacing on small screens */
            }
            .timeline:before {
                left: 18px;
            }
            .timeline-badge {
                left: 18px;
                margin-left: 0;
            }
            .timeline-panel {
                width: calc(100% - 70px);
                float: right;
            }
            .timeline-panel:before {
                border-left: 0;
                border-right: 10px solid transparent;
                border-top: 10px solid transparent;
                border-bottom: 10px solid transparent;
                left: -10px;
                right: auto;
            }
            .timeline-item:nth-child(even) .timeline-panel {
                float: right;
            }
            .timeline-item:nth-child(even) .timeline-panel:before {
                border-left-width: 0;
                border-right: 10px solid rgba(59, 130, 246, 0.2); /* Light blue border */
                left: -10px;
                right: auto;
            }
        }
    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="container-fluid py-5"> <!-- Changed to container-fluid -->
        <!-- Header dengan Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 px-4"> <!-- Added px-4 -->
            <ol class="breadcrumb" style="opacity: 0; animation: fade-in-down 0.6s ease-out forwards;">
                <li class="breadcrumb-item"><a href="{{ route('siswa.siswa_master')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('siswa.materi.index')}}">Materi</a></li>
                <li class="breadcrumb-item active" style="color: var(--text-dark);" aria-current="page">Prinsip Dasar Keamanan Jaringan</li>
            </ol>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section position-relative overflow-hidden mb-5">
            <!-- Animated grid background -->
            <div class="position-absolute w-100 h-100" style="
                background-image: 
                    linear-gradient(rgba(59, 130, 246, 0.1) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
                background-size: 40px 40px;
                animation: gridScroll 60s linear infinite;
                z-index: 0;
            "></div>

            <!-- Floating network nodes -->
            <div class="position-absolute top-0 left-0 w-100 h-100 node-container">
                <div class="network-node" style="top: 20%; left: 15%"></div>
                <div class="network-node" style="top: 70%; left: 25%"></div>
                <div class="network-node" style="top: 40%; left: 75%"></div>
                <div class="network-node" style="top: 80%; left: 85%"></div>
                <div class="network-node" style="top: 30%; left: 50%"></div>
            </div>

            <!-- Connection lines (rendered via JS for animation timing) -->
            <svg class="position-absolute top-0 left-0 w-100 h-100" style="z-index: 1;" id="connection-lines-svg">
                <!-- Lines will be dynamically created here for staggered animation -->
            </svg>

            <div class="container-fluid position-relative z-2 h-100 d-flex align-items-center"> <!-- Changed to container-fluid -->
                <div class="row w-100 align-items-center">
                    <div class="col-12 mx-auto text-center py-5"> <!-- Changed to col-12 -->
                        <!-- Animated title -->
                        <h1 class="display-3 fw-bold mb-4" style="text-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                            <span class="title-word">Keamanan</span>
                            <span class="title-word">Jaringan</span>
                            <span class="title-word">Komputer</span>
                            <span class="title-word">&</span>
                            <span class="title-word">Telekomunikasi</span>
                        </h1>

                        <!-- Glowing description -->
                        <p class="lead mb-5">
                            <span class="text-gradient">Mempelajari prinsip dasar keamanan jaringan, celah keamanan, dan teknik pengamanan untuk melindungi infrastruktur jaringan.</span>
                        </p>

                        <!-- Interactive buttons -->
                        <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">
                            <a href="#ancaman-keamanan" class="btn btn-neon btn-lg px-4 fw-bold">
                                <i class="fas fa-shield-alt me-2"></i>Mulai Belajar
                            </a>
                            <a href="#video-pengantar-full" class="btn btn-outline-neon btn-lg px-4 fw-bold">
                                <i class="fas fa-play-circle me-2"></i>Video Pengantar
                            </a>
                        </div>

                        <!-- Animated tags -->
                        <div class="tags-container">
                            <div class="tag-bubble">Firewall</div>
                            <div class="tag-bubble">Enkripsi</div>
                            <div class="tag-bubble">VPN</div>
                            <div class="tag-bubble">IDS/IPS</div>
                            <div class="tag-bubble">Ethical Hacking</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating 3D sphere -->
            <div class="position-absolute d-none d-lg-block" style="
                width: 300px;
                height: 300px;
                right: 5%;
                top: 50%;
                transform: translateY(-50%);
                z-index: 1;
            ">
                <div class="h-100 w-100" id="cyber-sphere"></div>
            </div>
        </section>

        <!-- Main Content -->
        <main class="px-4"> <!-- Added px-4 for main content padding -->
            <!-- Ancaman Keamanan Jaringan Section -->
            <section id="ancaman-keamanan" class="py-5 position-relative">
                <div class="binary-animation-bg" id="binary-bg-1"></div>
                <h2 class="section-title">Ancaman Keamanan Jaringan Komputer dan Telekomunikasi</h2>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h2 class="h5 mb-0 fw-bold"><i class="fas fa-bug me-2"></i>Pengenalan Celah Keamanan</h2>
                            </div>
                            <div class="card-body">
                                <p>Jaringan komputer memiliki berbagai celah keamanan yang dapat dieksploitasi oleh pihak yang tidak bertanggung jawab. Celah ini muncul dari cara kerja protokol jaringan, konfigurasi perangkat, atau bahkan dari media komunikasi yang digunakan.</p>
                                <p>Beberapa prinsip dasar jaringan yang memiliki celah keamanan:</p>
                                <ul>
                                    <li>Prinsip komunikasi TCP/IP dengan three-way handshake</li>
                                    <li>Cara kerja switch dan tabel ARP</li>
                                    <li>Layanan jaringan seperti DHCP dan DNS</li>
                                    <li>Media komunikasi nirkabel</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0 fw-bold"><i class="fas fa-eye me-2"></i>Jenis Serangan Jaringan</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="p-3 border rounded bg-dark text-white" style="background-color: rgba(0,0,0,0.05) !important; border-color: rgba(0,0,0,0.1); color: var(--text-dark) !important;">
                                            <h5 style="color: #dc3545 !important;"><i class="fas fa-user-secret me-2"></i>Sniffing Pasif</h5>
                                            <p class="small" style="color: var(--text-dark) !important;">Hanya memantau lalu lintas jaringan tanpa memanipulasi</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="p-3 border rounded bg-dark text-white" style="background-color: rgba(0,0,0,0.05) !important; border-color: rgba(0,0,0,0.1); color: var(--text-dark) !important;">
                                            <h5 style="color: #dc3545 !important;"><i class="fas fa-user-ninja me-2"></i>Sniffing Aktif</h5>
                                            <p class="small" style="color: var(--text-dark) !important;">Melakukan rekayasa jaringan untuk mencuri data</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="p-3 border rounded bg-dark text-white" style="background-color: rgba(0,0,0,0.05) !important; border-color: rgba(0,0,0,0.1); color: var(--text-dark) !important;">
                                            <h5 style="color: #dc3545 !important;"><i class="fas fa-virus me-2"></i>ARP Poisoning</h5>
                                            <p class="small" style="color: var(--text-dark) !important;">Meracuni tabel ARP untuk mencuri data</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="p-3 border rounded bg-dark text-white" style="background-color: rgba(0,0,0,0.05) !important; border-color: rgba(0,0,0,0.1); color: var(--text-dark) !important;">
                                            <h5 style="color: #dc3545 !important;"><i class="fas fa-ghost me-2"></i>DNS Spoofing</h5>
                                            <p class="small" style="color: var(--text-dark) !important;">Mengalihkan lalu lintas ke server palsu</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="diagram-container">
                            <img src="https://www.zenarmor.com/docs/assets/images/what-are-the-top-network-security-threats-8770c96ad94d0caf3c518eec63845dfd.png" alt="Ilustrasi Ancaman Jaringan" class="img-fluid" onerror="this.onerror=null;this.src='https://placehold.co/800x500/F0F8FF/1F2937?text=Ilustrasi+Ancaman+Jaringan'">
                            <p class="text-center mt-3 text-muted model-viewer-description"><small>Gambar 1. Ilustrasi Berbagai Ancaman Keamanan Jaringan</small></p>
                            <p class="mt-3 model-viewer-description">Ilustrasi ini menggambarkan berbagai ancaman yang dapat menyerang jaringan komputer Anda, mulai dari malware hingga serangan siber yang kompleks.</p>
                            <p class="model-viewer-description">Untuk melindungi jaringan dari celah keamanan ini, diperlukan pemahaman mendalam tentang cara kerja jaringan dan penerapan alat keamanan yang tepat.</p>        
                        </div>        
                    </div>
                </div>
            </section>

            <!-- Firewall dan IDS/IPS Section (NEW) -->
            <section id="firewall-ids-ips" class="py-5 position-relative">
                <div class="binary-animation-bg" id="binary-bg-firewall"></div>
                <div class="container-fluid"> <!-- Changed to container-fluid -->
                    <h2 class="section-title">Firewall dan Intrusion Detection/Prevention Systems (IDS/IPS)</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h2 class="h5 mb-0 fw-bold"><i class="fas fa-firewall me-2"></i>Firewall</h2>
                                </div>
                                <div class="card-body">
                                    <p>Firewall adalah sistem keamanan jaringan yang memantau dan mengontrol lalu lintas jaringan masuk dan keluar berdasarkan aturan keamanan yang telah ditentukan. Firewall bertindak sebagai penghalang antara jaringan internal yang aman dan jaringan eksternal yang tidak tepercaya (misalnya, internet).</p>
                                    <h6 class="mt-3">Fungsi Utama Firewall:</h6>
                                    <ul>
                                        <li>Menyaring paket data berdasarkan aturan (port, IP, protokol).</li>
                                        <li>Mencegah akses tidak sah ke jaringan internal.</li>
                                        <li>Melindungi data sensitif dan sumber daya jaringan.</li>
                                        <li>Mencatat aktivitas jaringan untuk audit dan analisis.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h2 class="h5 mb-0 fw-bold"><i class="fas fa-search-dollar me-2"></i>IDS/IPS (Intrusion Detection/Prevention Systems)</h2>
                                </div>
                                <div class="card-body">
                                    <p><strong>Intrusion Detection System (IDS)</strong> adalah sistem yang memantau lalu lintas jaringan untuk aktivitas jahat atau pelanggaran kebijakan, lalu memberikan peringatan.</p>
                                    <p><strong>Intrusion Prevention System (IPS)</strong> melangkah lebih jauh dari IDS dengan tidak hanya mendeteksi tetapi juga secara otomatis mencegah atau memblokir ancaman yang terdeteksi secara real-time.</p>
                                    <h6 class="mt-3">Perbedaan Utama:</h6>
                                    <ul>
                                        <li><strong>IDS:</strong> Deteksi dan Peringatan (Passive).</li>
                                        <li><strong>IPS:</strong> Deteksi, Peringatan, dan Pencegahan (Active).</li>
                                    </ul>
                                    <div class="alert alert-info">
                                        <i class="fas fa-lightbulb me-2"></i>
                                        <strong>Best Practice:</strong> Firewall, IDS, dan IPS sering digunakan bersamaan untuk menciptakan pertahanan berlapis (defense-in-depth).
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="diagram-container">
                        <img src="https://www.tops.hk/images/ips-and-ids-in-network-security.png" alt="Ilustrasi Fungsi Firewall dan IDS/IPS" class="img-fluid" onerror="this.onerror=null;this.src='https://placehold.co/800x400/F0F8FF/1F2937?text=Ilustrasi+Fungsi+Firewall+dan+IDS-IPS'">
                        <p class="text-center mt-2 text-muted"><small>Gambar 2. Ilustrasi Fungsi Firewall dan IDS/IPS dalam Jaringan</small></p>
                    </div>
                </div>
            </section>

            <!-- Kebijakan Keamanan dan Pentingnya Backup Section (NEW) -->
            <section id="kebijakan-backup" class="py-5 position-relative">
                <div class="binary-animation-bg" id="binary-bg-backup"></div>
                <div class="container-fluid"> <!-- Changed to container-fluid -->
                    <h2 class="section-title">Kebijakan Keamanan dan Pentingnya Backup</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h2 class="h5 mb-0 fw-bold"><i class="fas fa-clipboard-list me-2"></i>Kebijakan Keamanan Jaringan</h2>
                                </div>
                                <div class="card-body">
                                    <p>Kebijakan keamanan jaringan adalah seperangkat aturan, prosedur, dan pedoman yang dirancang untuk melindungi aset informasi dan sumber daya jaringan dari ancaman. Kebijakan ini harus jelas, komprehensif, dan secara teratur diperbarui.</p>
                                    <h6 class="mt-3">Elemen Kunci Kebijakan Keamanan:</h6>
                                    <ul>
                                        <li>Manajemen Kata Sandi yang Kuat</li>
                                        <li>Akses Jaringan Berbasis Peran</li>
                                        <li>Penggunaan Perangkat Lunak Antivirus/Anti-Malware</li>
                                        <li>Edukasi Kesadaran Keamanan bagi Pengguna</li>
                                        <li>Prosedur Penanganan Insiden Keamanan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h2 class="h5 mb-0 fw-bold"><i class="fas fa-save me-2"></i>Pentingnya Backup Data</h2>
                                </div>
                                <div class="card-body">
                                    <p>Backup data adalah proses membuat salinan data untuk tujuan pemulihan jika data asli hilang atau rusak. Ini adalah salah satu langkah paling penting dalam strategi keamanan siber.</p>
                                    <h6 class="mt-3">Mengapa Backup Penting?</h6>
                                    <ul>
                                        <li><strong>Melindungi dari Kehilangan Data:</strong> Akibat serangan siber, kegagalan perangkat keras, atau kesalahan manusia.</li>
                                        <li><strong>Pemulihan Bencana:</strong> Memungkinkan sistem untuk kembali beroperasi setelah insiden besar.</li>
                                        <li><strong>Kepatuhan Regulasi:</strong> Banyak peraturan industri dan pemerintah mewajibkan backup data.</li>
                                        <li><strong>Kontinuitas Bisnis:</strong> Memastikan operasional bisnis tidak terhenti lama.</li>
                                    </ul>
                                    <div class="alert alert-warning">
                                        <i class="fas fa-cloud-upload-alt me-2"></i>
                                        <strong>Strategi 3-2-1 Backup:</strong> Simpan 3 salinan data, pada 2 jenis media berbeda, dengan 1 salinan di lokasi offsite.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="diagram-container">
                        <img src="https://uploads-ssl.webflow.com/60097b44c2634351b9b7672f/60e2fc8ba281f9185b7aefff_shQ9oeBZtuQ380glM-woq_UmyP_6HCkU36bBNr753kStYYu_EzMEwdLT59R_IjZI0bs9i79MMr6u78_1CmyixTtzxTJAKvRi3YL8d3InmI9aETAWBS-FHBQw2_BKGSLIoMyWFyvy.jpeg" alt="Backup Strategy Diagram" class="img-fluid" onerror="this.onerror=null;this.src='https://placehold.co/800x400/F0F8FF/1F2937?text=Backup+Strategy+Diagram'">
                        <p class="text-center mt-2 text-muted"><small>Gambar 3. Ilustrasi Strategi Backup Data</small></p>
                    </div>
                </div>
            </section>

            <!-- Switch dan ARP Section -->
            <section id="switch-arp" class="py-5 position-relative">
                <div class="binary-animation-bg" id="binary-bg-2"></div>
                <div class="container-fluid"> <!-- Changed to container-fluid -->
                    <h2 class="section-title">Celah Keamanan pada Switch dan Tabel ARP</h2>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h2 class="h5 mb-0 fw-bold"><i class="fas fa-network-wired me-2"></i>Cara Kerja Switch</h2>
                                </div>
                                <div class="card-body">
                                    <p>Switch memiliki memori CAM (Content Addressable Memory) yang berfungsi menyimpan informasi tentang alamat MAC, alamat IP, dan port yang digunakan sebuah komputer.</p>
                                    <p>Berbeda dengan hub yang melakukan broadcast ke semua perangkat, switch hanya melakukan broadcast ARP (Address Resolution Protocol) untuk menemukan alamat MAC tujuan.</p>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <strong>Fakta:</strong> Switch tidak dapat membaca alamat IP. Switch bekerja pada Layer 1 dan Layer 2 dari TCP/IP, sedangkan IP address bekerja pada Layer 3.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="h5 mb-0 fw-bold"><i class="fas fa-table me-2"></i>Tabel ARP</h2>
                                </div>
                                <div class="card-body">
                                    <p>ARP (Address Resolution Protocol) adalah jembatan antara Layer 2 dan Layer 3 pada TCP/IP. Fungsi ARP adalah menemukan alamat MAC berdasarkan informasi dari alamat IP.</p>
                                    <p>ARP akan mencatat alamat IP berikut alamat MAC dalam sebuah tabel yang disebut Tabel ARP (ARP Table). Jika sebuah komputer berkomunikasi dengan komputer lainnya, komputer tersebut akan mencatat alamat IP beserta alamat MAC komputer itu sendiri sebagai sumber dan komputer lain sebagai tujuannya.</p>
                                    <div class="text-center">
                                        <img src="{{asset('homepage/img/Tabel ARP.jpg')}}" alt="Contoh Tabel ARP" class="img-fluid mt-3" onerror="this.onerror=null;this.src='https://placehold.co/600x300/F0F8FF/1F2937?text=Tabel+ARP'">
                                    </div>
                                    <p class="text-center text-muted"><small>Gambar 4. Contoh Tabel ARP</small></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header bg-danger">
                                    <h2 class="h5 mb-0 fw-bold" style="color: #dc3545 !important;"><i class="fas fa-exclamation-triangle me-2"></i>Eksploitasi Keamanan</h2>
                                </div>
                                <div class="card-body">
                                    <h5 style="color: var(--primary-color) !important;">MAC Flooding</h5>
                                    <p>Switch memiliki keterbatasan pada kapasitas MAC Address Table. Jika tabel ini penuh, switch akan kembali berperilaku seperti hub dan melakukan broadcast ke semua port.</p>
                                    <p>Alat seperti <strong>Macof</strong> dapat digunakan untuk membanjiri switch dengan paket yang memiliki alamat MAC acak sehingga tabel MAC penuh.</p>
                                    
                                    <h5 class="mt-4" style="color: var(--primary-color) !important;">ARP Poisoning</h5>
                                    <p>Alamat MAC pada tabel ARP bersifat <em>dynamic</em> dan dapat diubah. ARP Poisoning adalah teknik dimana penyerang mengirimkan balasan ARP palsu ke komputer korban.</p>
                                    <p>Dengan teknik ini, penyerang dapat:</p>
                                    <ul>
                                        <li>Mengalihkan lalu lintas jaringan melalui komputer penyerang</li>
                                        <li>Melakukan sniffing aktif terhadap data yang lewat</li>
                                        <li>Melakukan serangan Man-in-the-Middle (MITM)</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="diagram-container">
                                <img src="https://www.crowe.com/-/media/crowe/llp/sc10-media/insights/publications/cybersecurity-watch/content-2000x1125/content_cc2011-002j-poisoning-attacks-arp-diagram.jpg?hash=82E18B75A1658C582F7E86B8A095C9981B9E693F&modified=20200305212751&rev=a89e691c54f84d398eea46219e29e60a&w=800" alt="Ilustrasi ARP Poisoning" class="img-fluid" onerror="this.onerror=null;this.src='https://placehold.co/600x400/F0F8FF/1F2937?text=Ilustrasi+ARP+Poisoning'">
                                <p class="text-center mt-2 text-muted"><small>Gambar 5. Ilustrasi serangan ARP Poisoning</small></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="h5 mb-0 fw-bold"><i class="fas fa-tools me-2"></i>Alat untuk ARP Poisoning</h2>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <div class="text-center">
                                                <img src="https://www.kali.org/tools/ettercap/images/ettercap-logo.svg" alt="Ettercap Logo" style="height: 80px;" class="mb-3" onerror="this.onerror=null;this.src='https://placehold.co/80x80/F0F8FF/1F2937?text=Ettercap'">
                                                <h5 style="color: var(--primary-color) !important;">Ettercap</h5>
                                                <p style="color: var(--text-dark) !important;">Tool komprehensif untuk serangan MITM termasuk ARP poisoning dan DNS spoofing</p>
                                                <a href="https://www.ettercap-project.org/" target="_blank" class="btn btn-sm btn-outline-primary">Website</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="text-center">
                                                <img src="https://www.kali.org/tools/dsniff/images/dsniff-logo.svg" alt="dsniff Logo" style="height: 80px;" class="mb-3" onerror="this.onerror=null;this.src='https://placehold.co/80x80/F0F8FF/1F2937?text=dsniff'">
                                                <h5 style="color: var(--primary-color) !important;">dsniff</h5>
                                                <p style="color: var(--text-dark) !important;">Koleksi tools untuk sniffing password dan serangan jaringan lainnya</p>
                                                <a href="https://www.monkey.org/~dugsong/dsniff/" target="_blank" class="btn btn-sm btn-outline-primary">Website</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="text-center">
                                                <img src="https://www.kali.org/images/kali-logo.svg" alt="Kali Linux Logo" style="height: 80px;" class="mb-3" onerror="this.onerror=null;this.src='https://placehold.co/80x80/F0F8FF/1F2937?text=Kali+Linux'">
                                                <h5 style="color: var(--primary-color) !important;">Kali Linux</h5>
                                                <p style="color: var(--text-dark) !important;">Distro Linux yang berisi berbagai tools keamanan jaringan</p>
                                                <a href="https://www.kali.org/" target="_blank" class="btn btn-sm btn-outline-primary">Website</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- DNS dan DHCP Section -->
            <section id="dns-dhcp" class="py-5 position-relative">
                <div class="binary-animation-bg" id="binary-bg-3"></div>
                <div class="container-fluid"> <!-- Changed to container-fluid -->
                    <h2 class="section-title">Celah Keamanan pada Layanan DNS dan DHCP</h2>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h2 class="h5 mb-0 fw-bold"><i class="fas fa-globe me-2"></i>DNS Spoofing</h2>
                                </div>
                                <div class="card-body">
                                    <p>DNS Spoofing adalah teknik dimana penyerang mengalihkan permintaan DNS ke server palsu dengan memanipulasi cache DNS atau melakukan ARP Poisoning terhadap server DNS.</p>
                                    <p>Dengan teknik ini, penyerang dapat:</p>
                                    <ul>
                                        <li>Mengarahkan pengguna ke website palsu yang mirip aslinya</li>
                                        <li>Mencuri informasi login dan data sensitif lainnya</li>
                                        <li>Menyebarkan malware melalui website palsu</li>
                                    </ul>
                                    
                                    <div class="alert alert-warning mt-3">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <strong>Contoh:</strong> Pengguna ingin mengakses www.bank.com tetapi diarahkan ke server palsu yang tampilannya persis sama.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="h5 mb-0 fw-bold"><i class="fas fa-server me-2"></i>DNS Spoofing dengan Ettercap</h2>
                                </div>
                                <div class="card-body">
                                    <p>Ettercap dapat digunakan untuk melakukan DNS Spoofing dengan langkah-langkah:</p>
                                    <ol>
                                        <li>Menjalankan ARP Poisoning terhadap target dan gateway</li>
                                        <li>Aktifkan plugin dns_spoof</li>
                                        <li>Konfigurasi file etter.dns dengan mapping DNS palsu</li>
                                        <li>Mulai serangan dan monitor lalu lintas</li>
                                    </ol>
                                    <div class="text-center">
                                        <img src="https://openmaniak.com/ettercap/ettercap_ssh_filter_loaded.png" class="img-fluid mt-3" alt="Contoh konfigurasi DNS Spoofing dengan Ettercap" onerror="this.onerror=null;this.src='https://placehold.co/600x400/F0F8FF/1F2937?text=DNS+Spoofing+Ettercap'">
                                    </div>
                                    <p class="text-center text-muted"><small>Gambar 6. Contoh konfigurasi DNS Spoofing dengan Ettercap</small></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header bg-danger">
                                    <h2 class="h5 mb-0 fw-bold" style="color: #dc3545 !important;"><i class="fas fa-bolt me-2"></i>DHCP Spoofing</h2>
                                </div>
                                <div class="card-body">
                                    <p>DHCP Spoofing terjadi ketika penyerang menyiapkan server DHCP palsu yang merespon lebih cepat daripada server DHCP asli.</p>
                                    <p>Proses DHCP normal (DORA):</p>
                                    <ol>
                                        <li><strong>DHCP Discover:</strong> Klien mengirim broadcast untuk mencari server DHCP.</li>
                                        <li><strong>DHCP Offer:</strong> Server DHCP asli dan server DHCP palsu (penyerang) merespons dengan menawarkan alamat IP.</li>
                                        <li><strong>DHCP Request:</strong> Klien menerima penawaran pertama (biasanya dari penyerang karena lebih cepat) dan meminta alamat IP tersebut.</li>
                                        <li><strong>DHCP Acknowledge:</strong> Server palsu mengkonfirmasi alamat IP dan memberikan konfigurasi jaringan yang salah (misalnya, gateway dan DNS server yang mengarah ke penyerang).</li>
                                    </ol>
                                    <p>Dengan DHCP Spoofing, penyerang dapat mengendalikan lalu lintas jaringan klien, melakukan serangan Man-in-the-Middle (MITM), atau mengarahkan klien ke server berbahaya.</p>
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <strong>Risiko:</strong> Klien akan mendapatkan konfigurasi IP yang salah, mungkin tidak bisa mengakses internet atau diarahkan ke situs berbahaya.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="diagram-container">
                                <img src="https://info.pivitglobal.com/hs-fs/hubfs/1%20%2813%29.png?name=1+%2813%29.png&width=8000" alt="DHCP Spoofing Diagram" class="img-fluid" onerror="this.onerror=null;this.src='https://placehold.co/600x400/F0F8FF/1F2937?text=DHCP+Spoofing+Diagram'">
                                <p class="text-center mt-2 text-muted"><small>Gambar 7. Ilustrasi serangan DHCP Spoofing</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Media Komunikasi Nirkabel Section (Updated with more details) -->
            <section id="nirkabel-keamanan" class="py-5 position-relative">
                <div class="binary-animation-bg" id="binary-bg-4"></div>
                <div class="container-fluid"> <!-- Changed to container-fluid -->
                    <h2 class="section-title">Keamanan pada Media Komunikasi Nirkabel (WLAN)</h2>
                    <p class="lead text-center text-muted">Wi-Fi Alliance telah menyempurnakan standar keamanan WLAN. Berdasarkan standardisasi tersebut, keamanan jaringan Wireless LAN (WLAN) memiliki beberapa jenis berdasarkan perkembangannya:</p>

                    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-lock-open fa-3x mb-3" style="color: #ffc107;"></i>
                                    <h5 class="card-title" style="font-weight: bold; font-size: 1.25rem; color: var(--primary-color);">WEP (Wired Equivalent Privacy)</h5>
                                    <p class="card-text">Standardisasi awal keamanan jaringan oleh IEEE 802.11. WEP menggunakan algoritma enkripsi <strong>RC4 (Rivest’s Cipher 4)</strong>. Namun, RC4 dianggap terlalu lemah dan rentan terhadap serangan.</p>
                                    <span class="badge bg-danger">Rentan!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-lock fa-3x mb-3" style="color: #17a2b8;"></i>
                                    <h5 class="card-title" style="font-weight: bold; font-size: 1.25rem; color: var(--primary-color);">WPA (Wi-Fi Protected Access)</h5>
                                    <p class="card-text">Penyempurnaan dari WEP oleh Wi-Fi Alliance. WPA masih menggunakan <strong>RC4</strong>, tetapi menambahkan metode keamanan <strong>TKIP (Temporal Key Integrity Protocol)</strong> untuk mengatasi kelemahan WEP. WPA juga mendukung <strong>AES (Advanced Encryption Standard)</strong>.</p>
                                    <span class="badge bg-warning text-dark">Ditingkatkan</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-shield-alt fa-3x mb-3" style="color: #28a745;"></i>
                                    <h5 class="card-title" style="font-weight: bold; font-size: 1.25rem; color: var(--primary-color);">WPA2</h5>
                                    <p class="card-text">Pengembangan lanjutan dari WPA. Dengan WPA2, perangkat keras keamanan dalam WLAN menggunakan perangkat baru, bukan hanya perbaikan WEP. WPA2 secara default menggunakan metode <strong>AES</strong> untuk enkripsi yang lebih kuat.</p>
                                    <span class="badge bg-success">Standar Saat Ini</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 g-4 mt-4 mb-4">
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: var(--primary-color);"><i class="fas fa-key me-2"></i>WPA2-PSK (Pre-Shared Key)</h5>
                                    <p class="card-text">Jenis keamanan WPA2 untuk penggunaan <strong>personal</strong>. Dikenali dengan <strong>WPA2-PSK</strong> dan biasanya menggunakan mode keamanan <strong>AES</strong> (sering ditunjukkan sebagai WPA2-PSK-AES pada Access Point).</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: var(--primary-color);"><i class="fas fa-building me-2"></i>WPA2 Enterprise</h5>
                                    <p class="card-text">Jenis keamanan WPA2 untuk penggunaan <strong>perusahaan/enterprise</strong>. Menggunakan server RADIUS untuk autentikasi pengguna secara individual, memberikan keamanan tingkat tinggi untuk lingkungan besar.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="diagram-container">
                        <model-viewer 
                            src="{{asset('homepage/img/View It.glb')}}" 
                            alt="Bagan Evolusi Standar Keamanan Jaringan (WEP, WPA, WPA2)"
                            auto-rotate 
                            camera-controls 
                            style="width: 100%; height: 500px;">
                        </model-viewer>
                        <p class="text-center mt-2 text-muted"><small>Gambar 8. Bagan Evolusi Standar Keamanan Jaringan (WEP, WPA, WPA2)</small></p>        
                        <p class="mt-3">Model 3D di atas menunjukkan evolusi ancaman keamanan jaringan, mulai dari WEP yang rentan, WPA yang lebih aman, hingga WPA2 yang saat ini menjadi standar keamanan jaringan nirkabel.</p>
                        <p>Untuk melindungi jaringan dari celah keamanan ini, diperlukan pemahaman mendalam tentang cara kerja jaringan dan penerapan alat keamanan yang tepat.</p>             
                    </div>
                </div>
            </section>

            <!-- Video Pengantar Section -->
            <section id="video-pengantar-full" class="py-5 position-relative">
                <div class="binary-animation-bg" id="binary-bg-5"></div>
                <div class="container-fluid"> <!-- Changed to container-fluid -->
                    <h2 class="section-title">Video Pengantar Keamanan Jaringan</h2>
                    <div class="video-container ratio ratio-16x9 rounded-lg overflow-hidden shadow-lg"> <!-- Added ratio classes -->
                        <!-- Changed from iframe to video tag for local video control -->
                        <video id="video-player-keamanan" controls preload="metadata" style="width: 100%; height: 100%;">
                            <source src="{{ asset('homepage/img/keamanan.mp4')}}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>    
                </div>
            </section>
            
            <!-- Quiz Sederhana Section -->
            <section id="quiz-section" class="mb-5">
                <div class="quiz-card">
                    <h2 class="h3 mb-4 text-primary text-center">
                        <i class="fas fa-question-circle me-3"></i>Uji Pemahaman: Kuis Keamanan Jaringan
                    </h2>
                    <div id="quiz-container">
                        <!-- Question 1 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>1. Sistem keamanan jaringan yang memantau dan mengontrol lalu lintas jaringan masuk dan keluar berdasarkan aturan keamanan yang telah ditentukan adalah definisi dari?</strong></p>
                            <div class="quiz-option" data-question="q1" data-choice="a">
                                <label class="w-100 cursor-pointer">a. IDS</label>
                            </div>
                            <div class="quiz-option" data-question="q1" data-choice="b">
                                <label class="w-100 cursor-pointer">b. IPS</label>
                            </div>
                            <div class="quiz-option" data-question="q1" data-choice="c">
                                <label class="w-100 cursor-pointer">c. Firewall</label>
                            </div>
                            <div class="quiz-option" data-question="q1" data-choice="d">
                                <label class="w-100 cursor-pointer">d. Router</label>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>2. Serangan yang melibatkan pengiriman balasan ARP palsu untuk mengalihkan lalu lintas jaringan melalui komputer penyerang dikenal sebagai?</strong></p>
                            <div class="quiz-option" data-question="q2" data-choice="a">
                                <label class="w-100 cursor-pointer">a. DNS Spoofing</label>
                            </div>
                            <div class="quiz-option" data-question="q2" data-choice="b">
                                <label class="w-100 cursor-pointer">b. DHCP Spoofing</label>
                            </div>
                            <div class="quiz-option" data-question="q2" data-choice="c">
                                <label class="w-100 cursor-pointer">c. ARP Poisoning</label>
                            </div>
                            <div class="quiz-option" data-question="q2" data-choice="d">
                                <label class="w-100 cursor-pointer">d. MAC Flooding</label>
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>3. Standar keamanan WLAN awal yang menggunakan algoritma enkripsi RC4 dan sangat rentan terhadap serangan adalah?</strong></p>
                            <div class="quiz-option" data-question="q3" data-choice="a">
                                <label class="w-100 cursor-pointer">a. WPA2</label>
                            </div>
                            <div class="quiz-option" data-question="q3" data-choice="b">
                                <label class="w-100 cursor-pointer">b. WPA</label>
                            </div>
                            <div class="quiz-option" data-question="q3" data-choice="c">
                                <label class="w-100 cursor-pointer">c. WEP</label>
                            </div>
                            <div class="quiz-option" data-question="q3" data-choice="d">
                                <label class="w-100 cursor-pointer">d. AES</label>
                            </div>
                        </div>

                        <!-- Question 4 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>4. Proses membuat salinan data untuk tujuan pemulihan jika data asli hilang atau rusak disebut?</strong></p>
                            <div class="quiz-option" data-question="q4" data-choice="a">
                                <label class="w-100 cursor-pointer">a. Enkripsi</label>
                            </div>
                            <div class="quiz-option" data-question="q4" data-choice="b">
                                <label class="w-100 cursor-pointer">b. Backup</label>
                            </div>
                            <div class="quiz-option" data-question="q4" data-choice="c">
                                <label class="w-100 cursor-pointer">c. Autentikasi</label>
                            </div>
                            <div class="quiz-option" data-question="q4" data-choice="d">
                                <label class="w-100 cursor-pointer">d. Firewalling</label>
                            </div>
                        </div>

                        <!-- Question 5 -->
                        <div class="question-block mb-4">
                            <p class="mb-3"><strong>5. Sistem apa yang tidak hanya mendeteksi tetapi juga secara otomatis mencegah atau memblokir ancaman jaringan secara real-time?</strong></p>
                            <div class="quiz-option" data-question="q5" data-choice="a">
                                <label class="w-100 cursor-pointer">a. IDS</label>
                            </div>
                            <div class="quiz-option" data-question="q5" data-choice="b">
                                <label class="w-100 cursor-pointer">b. IPS</label>
                            </div>
                            <div class="quiz-option" data-question="q5" data-choice="c">
                                <label class="w-100 cursor-pointer">c. Router</label>
                            </div>
                            <div class="quiz-option" data-question="q5" data-choice="d">
                                <label class="w-100 cursor-pointer">d. Switch</label>
                            </div>
                        </div>
                        
                        <button onclick="checkQuiz()" class="btn btn-neon w-100 mt-3 fw-bold">Periksa Jawaban</button>
                        <p id="quiz-feedback" class="mt-4 font-weight-bold text-center"></p>
                        <!-- Next Material Button - Hidden by default. Goes back to index after last quiz -->
                        <a href="{{ route('siswa.materi.index')}}" id="nextMaterialBtn" class="btn btn-outline-neon w-100 mt-3 d-none fw-bold">Kembali ke Daftar Materi <i class="fas fa-arrow-right ms-2"></i></a>
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
<!-- Three.js (for the sphere) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<!-- Model Viewer for 3D GLB models -->
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

<script>
    // --- Three.js Sphere Initialization ---
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('cyber-sphere');
        if (container) {
            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(75, container.offsetWidth / container.offsetHeight, 0.1, 1000);
            const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
            
            renderer.setSize(container.offsetWidth, container.offsetHeight);
            container.appendChild(renderer.domElement);
            
            // Create wireframe sphere
            const geometry = new THREE.SphereGeometry(2, 24, 24); // Smaller sphere, more segments
            const material = new THREE.MeshBasicMaterial({ 
                color: 0x3B82F6, // Primary Blue from TCP/IP theme
                wireframe: true,
                transparent: true,
                opacity: 0.6
            });
            const sphere = new THREE.Mesh(geometry, material);
            scene.add(sphere);
            
            // Add glowing points (particles)
            const pointsGeometry = new THREE.BufferGeometry();
            const particlesCnt = 1000; // More particles
            
            const positions = new Float32Array(particlesCnt * 3);
            for(let i = 0; i < particlesCnt * 3; i++) {
                positions[i] = (Math.random() - 0.5) * 8; // Spread particles wider
            }
            pointsGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
            
            const pointsMaterial = new THREE.PointsMaterial({
                size: 0.03, // Smaller size
                color: 0x6366F1, // Vibrant Indigo from TCP/IP theme
                transparent: true,
                opacity: 0.7,
                blending: THREE.AdditiveBlending // For a stronger glow effect
            });
            
            const pointsMesh = new THREE.Points(pointsGeometry, pointsMaterial);
            scene.add(pointsMesh);
            
            camera.position.z = 5;
            
            // Animation loop
            function animate() {
                requestAnimationFrame(animate);
                sphere.rotation.x += 0.001;
                sphere.rotation.y += 0.002;
                pointsMesh.rotation.x += 0.0005;
                pointsMesh.rotation.y -= 0.001;
                renderer.render(scene, camera);
            }
            animate();

            // Handle window resize for Three.js
            window.addEventListener('resize', () => {
                const newWidth = container.offsetWidth;
                const newHeight = container.offsetHeight;
                camera.aspect = newWidth / newHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(newWidth, newHeight);
            });
        }
    });

    // --- Dynamic Connection Lines Animation ---
    document.addEventListener('DOMContentLoaded', function() {
        const svg = document.getElementById('connection-lines-svg');
        if (svg) {
            // Note: These coordinates are relative to the SVG container (0-100%).
            // They should align with the network-node positions defined in CSS.
            const linesData = [
                // Node 1 (20% 15%) to Node 5 (30% 50%)
                { x1: '15%', y1: '20%', x2: '50%', y2: '30%' }, 
                // Node 2 (70% 25%) to Node 5 (30% 50%)
                { x1: '25%', y1: '70%', x2: '50%', y2: '30%' },
                // Node 3 (40% 75%) to Node 5 (30% 50%)
                { x1: '75%', y1: '40%', x2: '50%', y2: '30%' },
                // Node 4 (80% 85%) to Node 5 (30% 50%)
                { x1: '85%', y1: '80%', x2: '50%', y2: '30%' }
            ];

            linesData.forEach((data, index) => {
                const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                line.setAttribute('x1', data.x1);
                line.setAttribute('y1', data.y1);
                line.setAttribute('x2', data.x2);
                line.setAttribute('y2', data.y2);
                line.setAttribute('class', 'connection-line');
                
                // Calculate length for stroke-dasharray (approximate based on viewport)
                const x1_px = (parseFloat(data.x1) / 100) * window.innerWidth;
                const y1_px = (parseFloat(data.y1) / 100) * window.innerHeight;
                const x2_px = (parseFloat(data.x2) / 100) * window.innerWidth;
                const y2_px = (parseFloat(data.y2) / 100) * window.innerHeight;
                
                const length = Math.sqrt(Math.pow(x2_px - x1_px, 2) + Math.pow(y2_px - y1_px, 2));
                
                line.style.strokeDasharray = length;
                line.style.strokeDashoffset = length;
                line.style.animation = `draw-line 2s ease-out forwards ${2.0 + index * 0.3}s`; // Staggered animation
                svg.appendChild(line);
            });
        }
    });

    // --- Binary Background Animation ---
    function createBinaryBackground(elementId) {
        const container = document.getElementById(elementId);
        if (container) {
            const binaryChars = '01';
            let resizeTimer;

            const generateBinaryContent = () => {
                // Clear previous content
                container.innerHTML = '';
                const rect = container.getBoundingClientRect();
                const columns = Math.floor(rect.width / 14); // Approx width of a char + spacing
                const rows = Math.floor(rect.height / 18); // Approx height of a char + line-height

                let binaryText = '';
                for (let i = 0; i < rows; i++) {
                    let line = '';
                    for (let j = 0; j < columns; j++) {
                        line += binaryChars[Math.floor(Math.random() * binaryChars.length)];
                    }
                    binaryText += line + '<br>';
                }
                container.innerHTML = binaryText;
            };

            // Generate initial content
            generateBinaryContent();

            // Animate random character changes
            setInterval(() => {
                const lines = container.innerHTML.split('<br>');
                if (lines.length > 1) { // Ensure there are lines to animate
                    const randomLineIndex = Math.floor(Math.random() * (lines.length - 1)); // Avoid last empty line
                    const line = lines[randomLineIndex];
                    if (line) {
                        const lineArr = line.split('');
                        const randomCharIndex = Math.floor(Math.random() * lineArr.length);
                        lineArr[randomCharIndex] = binaryChars[Math.floor(Math.random() * binaryChars.length)];
                        lines[randomLineIndex] = lineArr.join('');
                        container.innerHTML = lines.join('<br>');
                    }
                }
            }, 70); // Slightly slower update for less frenetic feel

            // Recalculate on resize
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(generateBinaryContent, 200); // Debounce resize
            });
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        createBinaryBackground('binary-bg-1');
        createBinaryBackground('binary-bg-firewall');    
        createBinaryBackground('binary-bg-backup');    
        createBinaryBackground('binary-bg-2');
        createBinaryBackground('binary-bg-3');
        createBinaryBackground('binary-bg-4');
        createBinaryBackground('binary-bg-5');
    });

    // Function to scroll to a specific section
    function scrollToSection(id) {
        const element = document.getElementById(id);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // HTML5 Video Player reference
    let keamananVideoPlayer; 
    let quizInterval;

    // Define quiz points for the Keamanan Jaringan video
    var videoQuizPoints = [
        {
            time: 15, // Example: at 15 seconds
            question: "Menurut video, apa salah satu ancaman terbesar bagi keamanan jaringan?",
            options: [
                "Cuaca buruk",
                "Serangan siber",
                "Kabel putus",
                "Listrik padam"
            ],
            correctAnswerIndex: 1, // "Serangan siber"
            answered: false
        },
        {
            time: 30, // Example: at 30 seconds
            question: "Apa tujuan utama dari firewall dalam keamanan jaringan?",
            options: [
                "Mempercepat koneksi internet",
                "Menyaring lalu lintas jaringan",
                "Mengirim email",
                "Menyimpan data"
            ],
            correctAnswerIndex: 1, // "Menyaring lalu lintas jaringan"
            answered: false
        }
        // Add more quiz points as needed
    ];
    var currentVideoQuizQuestion = null;

    document.addEventListener('DOMContentLoaded', () => {
        // Initialize HTML5 video player
        keamananVideoPlayer = document.getElementById('video-player-keamanan');

        // Add event listeners for the video for quiz functionality
        if (keamananVideoPlayer) {
            keamananVideoPlayer.addEventListener('play', onVideoPlay);
            keamananVideoPlayer.addEventListener('pause', onVideoPause);
            keamananVideoPlayer.addEventListener('ended', onVideoEnded);
            keamananVideoPlayer.addEventListener('timeupdate', checkVideoTime);
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
        if (keamananVideoPlayer && !keamananVideoPlayer.paused && !keamananVideoPlayer.ended) {
            var currentTime = keamananVideoPlayer.currentTime;
            for (let i = 0; i < videoQuizPoints.length; i++) {
                const quizPoint = videoQuizPoints[i];
                // Trigger quiz if current time is at or past the quiz point, and it hasn't been answered yet
                // Adding a small buffer (e.g., < quizPoint.time + 0.5) to ensure it triggers if time is slightly off
                if (!quizPoint.answered && currentTime >= quizPoint.time && currentTime < quizPoint.time + 0.5) {
                    keamananVideoPlayer.pause(); // Pause the HTML5 video
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

        if (keamananVideoPlayer && keamananVideoPlayer.play) {
            keamananVideoPlayer.play();
            // Restart the time checking interval after video resumes
            quizInterval = setInterval(checkVideoTime, 250); // Use 250ms interval
        }
    }


    // Quiz functionality
    const quizAnswers = {
        q1: 'c', // Firewall
        q2: 'c', // ARP Poisoning
        q3: 'c', // WEP
        q4: 'b', // Backup
        q5: 'b'  // IPS
    };

    // Minimum score to unlock next material
    const REQUIRED_SCORE = 80; // Assuming 80% is still the passing score

    // Attach event listeners to quiz options using delegation
    document.getElementById('quiz-container').addEventListener('click', function(event) {
        const option = event.target.closest('.quiz-option');
        if (option) {
            selectQuizOption(option);
        }
    });

    function selectQuizOption(selectedOption) {
        const questionBlock = selectedOption.closest('.question-block');
        
        // Remove 'selected' class from all options in this question block
        questionBlock.querySelectorAll('.quiz-option').forEach(opt => {
            opt.classList.remove('selected', 'correct-answer', 'incorrect'); // Clear previous results
        });

        // Add 'selected' class to the clicked option
        selectedOption.classList.add('selected');
    }

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

        // Clear previous results visually
        document.querySelectorAll('.quiz-option').forEach(option => {
            option.classList.remove('correct-answer', 'incorrect');
        });
        
        let allAnswered = true;

        for (const qId in quizAnswers) {
            const selectedOption = document.querySelector(`.quiz-option[data-question="${qId}"].selected`);
            const correctAnswer = quizAnswers[qId];

            if (!selectedOption) {
                allAnswered = false;
                break; // Exit loop if any question is not answered
            }

            const selectedChoice = selectedOption.dataset.choice;

            if (selectedChoice === correctAnswer) {
                score += 1;
                selectedOption.classList.add('correct-answer');
            } else {
                selectedOption.classList.add('incorrect');
                // Highlight the correct answer for clarity
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
        
        // Store the score for Material 3 in localStorage using the correct key
        localStorage.setItem('material_3_score', percentage.toFixed(0)); // Key for Material 3

        if (percentage >= REQUIRED_SCORE) { // Passing score
            showAlert(`Selamat! Anda berhasil memahami materi ini dengan baik dengan skor ${percentage.toFixed(0)}%. Semua materi telah diselesaikan!`, 'success');
            nextMaterialBtn.classList.remove('d-none'); // Show next material button
            nextMaterialBtn.disabled = false;
            // No need for a specific unlock animation flag as this is the last material
        } else {
            showAlert(`Skor Anda: ${percentage.toFixed(0)}%. Terus semangat belajar! Anda perlu mencapai setidaknya ${REQUIRED_SCORE}% untuk melanjutkan.`, 'danger');
            nextMaterialBtn.classList.add('d-none'); // Hide button
            nextMaterialBtn.disabled = true;
            
            // Reset quiz for retake after a short delay
            setTimeout(() => {
                resetQuizUI();
            }, 3000); // Reset after 3 seconds so user can see results briefly
        }
    }

    // Show a custom alert message (success, warning, danger, or info)
    function showAlert(message, type = 'success') {
        let alertDiv = document.getElementById('page-alert-notification');

        if (!alertDiv) {
            alertDiv = document.createElement('div');
            alertDiv.id = 'page-alert-notification';
            alertDiv.classList.add('alert', 'position-fixed', 'fade');
            alertDiv.style.top = '20px';
            alertDiv.style.right = '20px';
            alertDiv.style.zIndex = '1050';
            alertDiv.style.minWidth = '300px';
            alertDiv.style.display = 'flex';
            alertDiv.style.alignItems = 'center';
            alertDiv.innerHTML = `<i class="me-2"></i><span id="page-alert-message"></span><button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>`;
            document.body.appendChild(alertDiv);
            
            // Add click listener to close button
            alertDiv.querySelector('.btn-close').addEventListener('click', () => {
                alertDiv.classList.remove('show');
                setTimeout(() => {
                    alertDiv.style.display = 'none';
                }, 150);
            });
        }

        alertDiv.classList.remove('alert-success', 'alert-warning', 'alert-danger', 'alert-info', 'show');
        alertDiv.classList.add(`alert-${type}`);
        
        const messageElement = alertDiv.querySelector('#page-alert-message');
        const iconElement = alertDiv.querySelector('i');

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
        requestAnimationFrame(() => { // Use rAF for smooth transition
            alertDiv.classList.add('show');
        });

        setTimeout(() => {
            alertDiv.classList.remove('show');
            setTimeout(() => {
                alertDiv.style.display = 'none';
            }, 150);
        }, 4000);
    }


    // On page load, check if quiz was already passed and show "next material" button
    document.addEventListener('DOMContentLoaded', function() {
        const savedScore = parseInt(localStorage.getItem('material_3_score')) || 0;
        const nextMaterialBtn = document.getElementById('nextMaterialBtn');
        if (savedScore >= REQUIRED_SCORE) {
            nextMaterialBtn.classList.remove('d-none');
            nextMaterialBtn.disabled = false;
        } else {
            nextMaterialBtn.classList.add('d-none');
            nextMaterialBtn.disabled = true;
        }
    });
</script>
</body>
</html>
@endsection
