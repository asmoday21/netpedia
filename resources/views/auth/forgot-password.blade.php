<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Lupa Kata Sandi - NetPedia</title>

    <!-- Favicons -->
    <link href="{{ asset('admin2/assets/img/NetPedia.png') }}" rel="icon" />
    <link href="{{ asset('admin2/assets/img/NetPedia.png') }}" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Vendor CSS Files - Kept for compatibility, but most styling is inline -->
    <link href="{{ asset('admin2/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin2/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin2/assets/css/style.css') }}" rel="stylesheet" />

    <style>
        /* CSS Variables - Consistent with Login/Registration Page */
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --accent: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #0f172a;
            --light: #f8fafc;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }

        /* Base Body Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif; /* Consistent font */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        /* Animated Background */
        .bg-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 20%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 30%;
            left: 15%;
            animation-delay: 4s;
        }

        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            bottom: 10%;
            right: 20%;
            animation-delay: 1s;
        }

        .shape:nth-child(5) {
            width: 40px;
            height: 40px;
            top: 50%;
            left: 5%;
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) translateX(0px) rotate(0deg);
                opacity: 0.7;
            }
            33% {
                transform: translateY(-30px) translateX(10px) rotate(120deg);
                opacity: 0.4;
            }
            66% {
                transform: translateY(-10px) translateX(-10px) rotate(240deg);
                opacity: 0.8;
            }
        }

        /* Main Container */
        .main-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        /* Login/Register/Forgot Password Card Wrapper */
        .login-wrapper {
            width: 100%;
            max-width: 1000px;
            display: grid;
            grid-template-columns: 1fr 1fr; /* Two columns for illustration and form */
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Left Side - Illustration */
        .login-illustration {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-illustration::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .illustration-content {
            position: relative;
            z-index: 2;
        }

        .illustration-icon {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .illustration-icon svg {
            width: 60px;
            height: 60px;
            color: var(--white);
        }

        .illustration-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .illustration-text {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            max-width: 300px;
        }

        /* Right Side - Form */
        .login-form-section {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
        }

        .brand-name {
            font-size: 1.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-header {
            margin-bottom: 2rem;
        }

        .form-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: var(--gray-600);
            font-size: 1rem;
            font-weight: 400;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid var(--gray-200);
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 500;
            background: var(--gray-50);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
        }

        .form-input:focus {
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            transform: translateY(-1px);
        }

        .form-input::placeholder {
            color: var(--gray-400);
            font-weight: 400;
        }

        /* Submit Button Styling */
        .submit-button {
            width: 100%;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            border: none;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .submit-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .submit-button:hover::before {
            left: 100%;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.4);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .back-to-login-text {
            text-align: center;
            color: var(--gray-600);
            font-size: 0.875rem;
        }

        .back-to-login-link {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .back-to-login-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .error-message {
            color: var(--danger);
            font-size: 0.8125rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-weight: 500;
        }

        /* Success Message Styling */
        .session-status-message {
            background-color: var(--success);
            color: var(--white);
            padding: 1rem 1.25rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9375rem;
            font-weight: 500;
            text-align: center;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }


        .credits {
            position: absolute;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            font-size: 0.8125rem;
            color: rgba(255, 255, 255, 0.8);
            z-index: 10;
        }

        .credits a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .credits a:hover {
            color: var(--white);
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 968px) {
            .login-wrapper {
                grid-template-columns: 1fr; /* Stack columns on smaller screens */
                max-width: 500px; /* Adjust max-width for single column layout */
            }

            .login-illustration {
                display: none; /* Hide illustration on smaller screens */
            }
        }

        @media (max-width: 640px) {
            .main-container {
                padding: 1rem;
            }

            .login-wrapper {
                border-radius: 20px;
                margin: 0;
            }

            .login-form-section {
                padding: 2rem 1.5rem;
            }

            .form-title {
                font-size: 1.5rem;
            }

            .illustration-title {
                font-size: 1.75rem;
            }

            .form-input {
                padding: 0.875rem 1rem;
                font-size: 16px; /* Prevent zoom on iOS */
            }
        }

        @media (max-width: 480px) {
            .login-form-section {
                padding: 1.5rem 1rem;
            }

            .brand-name {
                font-size: 1.5rem;
            }

            .brand-logo {
                width: 40px;
                height: 40px;
            }
        }

        /* Animation for wrapper and form elements */
        .login-wrapper {
            animation: scaleIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            opacity: 0;
            transform: scale(0.9);
        }

        @keyframes scaleIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .form-group {
            animation: slideInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        /* Adjust animation delays based on number of fields */
        .form-group:nth-child(1) { animation-delay: 0.1s; } /* Email */
        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Animated background shapes -->
    <div class="bg-animation">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <main>
        <div class="main-container">
            <div class="login-wrapper">
                <!-- Left Side - Illustration -->
                <div class="login-illustration d-flex align-items-center justify-content-center">
                    <div class="illustration-content text-center" style="width: 100%; max-width: 400px;">
                        <div class="illustration-icon mx-auto mb-3" style="width: 64px; height: 64px;">
                            <!-- Icon for Forgot Password: a key or padlock -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-key-round">
                                <path d="M2 18v3c0 .6.4 1 1 1h4v-3h-4v-3H2z"/><path d="M7 21v-3h4v3h7c.6 0 1-.4 1-1v-3h-7V7h7c.6 0 1-.4 1-1V2H7z"/>
                            </svg>
                        </div>
                        <h2 class="illustration-title mb-2">Lupa Kata Sandi?</h2>
                        <p class="illustration-text mx-auto" style="max-width: 300px;">Jangan khawatir! Kami akan membantu Anda mengatur ulang kata sandi dengan cepat dan aman.</p>
                    </div>
                </div>

                <!-- Right Side - Form -->
                <div class="login-form-section">
                    <div class="brand-section">
                        <img src="{{ asset('admin2/assets/img/NetPedia.png') }}" alt="NetPedia" class="brand-logo">
                        <h1 class="brand-name">NetPedia</h1>
                    </div>

                    <div class="form-header">
                        <h2 class="form-title">Atur Ulang Kata Sandi Anda</h2>
                        <p class="form-subtitle">Masukkan email Anda untuk menerima tautan reset</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="session-status-message" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-group">
                            <label for="email" class="form-label">Alamat Email</label>
                            <div class="input-wrapper">
                                <input
                                    type="email"
                                    name="email"
                                    class="form-input"
                                    id="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    placeholder="Masukkan alamat email Anda"
                                />
                            </div>
                            @error('email')
                                <div class="error-message">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="submit-button">
                            Kirim Link Reset Password
                        </button>

                        <div class="back-to-login-text">
                            <a href="{{ route('login') }}" class="back-to-login-link">Kembali ke halaman masuk</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>

    <div class="credits">
        Designed with by <a href="https://www.instagram.com/ferjuprihamdani/">Ferju Prihamdani</a>
    </div>

    <script>
        // Form validation enhancement for visual feedback on blur/focus
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input[required]');

            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() === '') {
                        this.style.borderColor = 'var(--danger)';
                        this.style.boxShadow = '0 0 0 4px rgba(239, 68, 68, 0.1)';
                    } else {
                        this.style.borderColor = 'var(--success)';
                        this.style.boxShadow = '0 0 0 4px rgba(16, 185, 129, 0.1)';
                    }
                });

                input.addEventListener('focus', function() {
                    this.style.borderColor = 'var(--primary)';
                    this.style.boxShadow = '0 0 0 4px rgba(99, 102, 241, 0.1)';
                });
            });
        });
    </script>
</body>
</html>
