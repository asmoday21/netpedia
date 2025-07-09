@extends('siswa.siswa_master')

@section('siswa')
<div class="profile-container">
  <!-- Background Elements -->
  <div class="bg-elements">
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    <div class="floating-shape shape-3"></div>
    <div class="floating-shape shape-4"></div>
  </div>

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-11 col-xl-10">
        <!-- Main Profile Card -->
        <div class="profile-card glass-effect">
          <!-- Hero Section -->
          <div class="profile-hero">
            <div class="hero-background"></div>
            <div class="hero-content">
              <div class="row align-items-center">
                <div class="col-md-4 text-center mb-4 mb-md-0">
                  <!-- Profile Image with Status -->
                  <div class="profile-image-container">
                    <div class="status-ring"></div>
                    <img 
                      src="{{ !empty(Auth::user()->profile_image) ? url('upload/siswa_images/' . Auth::user()->profile_image) : url('upload/default_profile.jpg') }}"
                      class="profile-avatar"
                      alt="Foto Profil">
                    <div class="online-indicator">
                      <i class="fas fa-check"></i>
                    </div>
                  </div>
                  
                  <!-- User Info -->
                  <div class="user-info">
                    <h2 class="username">{{ Auth::user()->name }}</h2>
                    <div class="user-badge">
                      <i class="fas fa-graduation-cap me-2"></i>
                      <span>Siswa Aktif</span>
                    </div>
                    <div class="user-stats">
                      <div class="stat-item">
                        <div class="stat-number">{{ Auth::user()->created_at->diffInDays(now()) }}</div>
                        <div class="stat-label">Hari Bergabung</div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-8">
                  <!-- Profile Details Grid -->
                  <div class="details-grid">
                    <div class="detail-card" data-aos="fade-up" data-aos-delay="100">
                      <div class="detail-icon">
                        <i class="fas fa-user-tag"></i>
                      </div>
                      <div class="detail-info">
                        <div class="detail-label">Nama Lengkap</div>
                        <div class="detail-value">{{ Auth::user()->name }}</div>
                      </div>
                      <div class="detail-action">
                        <i class="fas fa-copy copy-btn" data-copy="{{ Auth::user()->name }}"></i>
                      </div>
                    </div>

                    <div class="detail-card" data-aos="fade-up" data-aos-delay="250">
                      <div class="detail-icon">
                        <i class="fas fa-id-card"></i>
                      </div>
                      <div class="detail-info">
                        <div class="detail-label">Nomor Induk Siswa (NIS)</div>
                        <div class="detail-value">
                          {{ Auth::user()->nis ?? '-' }}
                        </div>
                      </div>
                      <div class="detail-action">
                        <i class="fas fa-copy copy-btn" data-copy="{{ Auth::user()->nis }}"></i>
                      </div>
                    </div>

                    <div class="detail-card" data-aos="fade-up" data-aos-delay="200">
                      <div class="detail-icon">
                        <i class="fas fa-envelope"></i>
                      </div>
                      <div class="detail-info">
                        <div class="detail-label">Email Address</div>
                        <div class="detail-value">{{ Auth::user()->email }}</div>
                      </div>
                      <div class="detail-action">
                        <i class="fas fa-copy copy-btn" data-copy="{{ Auth::user()->email }}"></i>
                      </div>
                    </div>

                    <div class="detail-card" data-aos="fade-up" data-aos-delay="300">
                      <div class="detail-icon">
                        <i class="fas fa-calendar-alt"></i>
                      </div>
                      <div class="detail-info">
                        <div class="detail-label">Bergabung Sejak</div>
                        <div class="detail-value">{{ Auth::user()->created_at->format('d F Y') }}</div>
                      </div>
                      <div class="detail-action">
                        <i class="fas fa-info-circle"></i>
                      </div>
                    </div>

                    <div class="detail-card" data-aos="fade-up" data-aos-delay="400">
                      <div class="detail-icon">
                        <i class="fas fa-clock"></i>
                      </div>
                      <div class="detail-info">
                        <div class="detail-label">Terakhir Update</div>
                        <div class="detail-value">{{ Auth::user()->updated_at->format('d M Y, H:i') }}</div>
                      </div>
                      <div class="detail-action">
                        <i class="fas fa-sync-alt"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Action Section -->
          <div class="profile-actions">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
              <div class="profile-tip">
                <i class="fas fa-lightbulb me-2"></i>
                <span>Pastikan data profil Anda selalu terkini untuk pengalaman terbaik</span>
              </div>
              
              <div class="action-buttons">
                <button class="btn-action btn-secondary" onclick="refreshProfile()">
                    <i class="fas fa-sync-alt me-2 text-dark"></i>
                    <span class="text-dark">Refresh</span>
                </button>
                <a href="{{ route('siswa.siswa_edit_profile') }}" class="btn-action btn-primary">
                  <i class="fas fa-edit me-2"></i>
                  <span>Edit Profil</span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Stats Cards -->
        <div class="row mt-4 g-3">
          <div class="col-md-4">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="500">
              <div class="stat-icon">
                <i class="fas fa-user-check"></i>
              </div>
              <div class="stat-content">
                <div class="stat-title">Status Akun</div>
                <div class="stat-desc">Aktif & Terverifikasi</div>
              </div>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="600">
              <div class="stat-icon">
                <i class="fas fa-shield-alt"></i>
              </div>
              <div class="stat-content">
                <div class="stat-title">Keamanan</div>
                <div class="stat-desc">Data Aman Terlindungi</div>
              </div>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="700">
              <div class="stat-icon">
                <i class="fas fa-star"></i>
              </div>
              <div class="stat-content">
                <div class="stat-title">Level</div>
                <div class="stat-desc">Siswa Premium</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Toast Notification -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="copyToast" class="toast" role="alert">
    <div class="toast-body">
      <i class="fas fa-check-circle text-success me-2"></i>
      Berhasil disalin ke clipboard!
    </div>
  </div>
</div>

{{-- Font Awesome & AOS --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
  /* Root Variables */
  :root {
    --primary-color: #667eea;
    --secondary-color: #764ba2;
    --accent-color: #f093fb;
    --success-color: #4ecdc4;
    --text-primary: #2d3748;
    --text-secondary: #718096;
    --bg-light: #f7fafc;
    --white: #ffffff;
    --shadow-soft: 0 10px 40px rgba(0, 0, 0, 0.1);
    --shadow-hover: 0 20px 60px rgba(0, 0, 0, 0.15);
    --border-radius: 20px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  /* Base Styles */
  .profile-container {
    min-height: 100vh;
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    overflow-x: hidden;
  }

  /* Floating Background Elements */
  .bg-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    overflow: hidden;
  }

  .floating-shape {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 15s infinite ease-in-out;
  }

  .shape-1 {
    width: 80px;
    height: 80px;
    top: 10%;
    left: 10%;
    animation-delay: 0s;
  }

  .shape-2 {
    width: 120px;
    height: 120px;
    top: 20%;
    right: 15%;
    animation-delay: 2s;
  }

  .shape-3 {
    width: 60px;
    height: 60px;
    bottom: 30%;
    left: 20%;
    animation-delay: 4s;
  }

  .shape-4 {
    width: 100px;
    height: 100px;
    bottom: 20%;
    right: 10%;
    animation-delay: 6s;
  }

  @keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    25% { transform: translateY(-20px) rotate(90deg); }
    50% { transform: translateY(0px) rotate(180deg); }
    75% { transform: translateY(-15px) rotate(270deg); }
  }

  /* Glass Effect */
  .glass-effect {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: var(--shadow-soft);
  }

  /* Profile Card */
  .profile-card {
    border-radius: var(--border-radius);
    overflow: hidden;
    transition: var(--transition);
    animation: slideUp 0.8s ease-out;
  }

  @keyframes slideUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Hero Section */
  .profile-hero {
    position: relative;
    padding: 3rem 2rem;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
  }

  .hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
  }

  .hero-content {
    position: relative;
    z-index: 2;
  }

  /* Profile Image */
  .profile-image-container {
    position: relative;
    display: inline-block;
    margin-bottom: 1.5rem;
  }

  .status-ring {
    position: absolute;
    top: -10px;
    left: -10px;
    right: -10px;
    bottom: -10px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    animation: pulse 2s infinite;
  }

  @keyframes pulse {
    0% {
      transform: scale(1);
      opacity: 1;
    }
    50% {
      transform: scale(1.05);
      opacity: 0.7;
    }
    100% {
      transform: scale(1);
      opacity: 1;
    }
  }

  .profile-avatar {
    width: 160px;
    height: 160px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid rgba(255, 255, 255, 0.9);
    transition: var(--transition);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
  }

  .profile-avatar:hover {
    transform: scale(1.05);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
  }

  .online-indicator {
    position: absolute;
    bottom: 10px;
    right: 10px;
    width: 40px;
    height: 40px;
    background: var(--success-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    border: 3px solid white;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    animation: bounce 2s infinite;
  }

  @keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
      transform: translateY(0);
    }
    40% {
      transform: translateY(-10px);
    }
    60% {
      transform: translateY(-5px);
    }
  }

  /* User Info */
  .user-info {
    text-align: center;
  }

  .username {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .user-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-weight: 500;
    margin-bottom: 1rem;
    backdrop-filter: blur(10px);
  }

  .user-stats {
    display: flex;
    justify-content: center;
    gap: 2rem;
  }

  .stat-item {
    text-align: center;
  }

  .stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
  }

  .stat-label {
    font-size: 0.8rem;
    opacity: 0.8;
    margin-top: 0.25rem;
  }

  /* Details Grid */
  .details-grid {
    display: grid;
    gap: 1rem;
    grid-template-columns: 1fr;
  }

  .detail-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    padding: 1.25rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: var(--transition);
    border: 1px solid rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px);
  }

  .detail-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    background: rgba(255, 255, 255, 1);
  }

  .detail-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    flex-shrink: 0;
  }

  .detail-info {
    flex-grow: 1;
  }

  .detail-label {
    font-size: 0.85rem;
    color: var(--text-secondary);
    margin-bottom: 0.25rem;
    font-weight: 500;
  }

  .detail-value {
    font-size: 1rem;
    color: var(--text-primary);
    font-weight: 600;
  }

  .detail-action {
    flex-shrink: 0;
  }

  .copy-btn {
    width: 35px;
    height: 35px;
    border-radius: 8px;
    background: var(--bg-light);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-secondary);
    cursor: pointer;
    transition: var(--transition);
  }

  .copy-btn:hover {
    background: var(--primary-color);
    color: white;
    transform: scale(1.1);
  }

  /* Profile Actions */
  .profile-actions {
    background: var(--bg-light);
    padding: 1.5rem 2rem;
  }

  .profile-tip {
    display: flex;
    align-items: center;
    color: var(--text-secondary);
    font-size: 0.9rem;
  }

  .action-buttons {
    display: flex;
    gap: 0.75rem;
  }

  .btn-action {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.25rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
  }

  .btn-primary {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    color: white;
  }

  .btn-secondary {
    background: white;
    color: var(--text-primary);
    border: 1px solid #e2e8f0;
  }

  .btn-secondary:hover {
    background: var(--bg-light);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  /* Stat Cards */
  .stat-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: var(--transition);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.8);
  }

  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
  }

  .stat-card .stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
  }

  .stat-content .stat-title {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
  }

  .stat-content .stat-desc {
    font-size: 0.85rem;
    color: var(--text-secondary);
  }

  /* Toast */
  .toast {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border: none;
    color: white;
  }

  .toast-body {
    display: flex;
    align-items: center;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .profile-hero {
      padding: 2rem 1rem;
    }
    
    .profile-avatar {
      width: 120px;
      height: 120px;
    }
    
    .username {
      font-size: 1.5rem;
    }
    
    .user-stats {
      gap: 1rem;
    }
    
    .action-buttons {
      flex-direction: column;
      width: 100%;
    }
    
    .profile-tip {
      font-size: 0.8rem;
      margin-bottom: 1rem;
    }
    
    .profile-actions {
      flex-direction: column;
      align-items: stretch;
    }
  }

  @media (max-width: 576px) {
    .profile-hero {
      padding: 1.5rem 1rem;
    }
    
    .detail-card {
      padding: 1rem;
    }
    
    .detail-icon {
      width: 40px;
      height: 40px;
      font-size: 1rem;
    }
    
    .stat-card {
      padding: 1rem;
    }
    
    .stat-card .stat-icon {
      width: 50px;
      height: 50px;
      font-size: 1.2rem;
    }
  }
</style>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  // Initialize AOS
  AOS.init({
    duration: 600,
    easing: 'ease-out-cubic',
    once: true,
    offset: 100
  });

  // Copy to clipboard functionality
  document.querySelectorAll('.copy-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const textToCopy = this.getAttribute('data-copy');
      navigator.clipboard.writeText(textToCopy).then(() => {
        showToast();
        
        // Visual feedback
        this.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(() => {
          this.innerHTML = '<i class="fas fa-copy"></i>';
        }, 2000);
      });
    });
  });

  // Show toast notification
  function showToast() {
    const toastEl = document.getElementById('copyToast');
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
  }

  // Refresh profile function
  function refreshProfile() {
    // Add loading state
    const refreshBtn = event.target.closest('.btn-action');
    const originalContent = refreshBtn.innerHTML;
    refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i><span>Refreshing...</span>';
    
    // Simulate refresh (replace with actual refresh logic)
    setTimeout(() => {
      refreshBtn.innerHTML = originalContent;
      location.reload();
    }, 1500);
  }

  // Add smooth scroll and page transitions
  document.addEventListener('DOMContentLoaded', function() {
    // Add entrance animations
    const profileCard = document.querySelector('.profile-card');
    const statCards = document.querySelectorAll('.stat-card');
    
    // Stagger stat card animations
    statCards.forEach((card, index) => {
      card.style.animationDelay = `${0.8 + (index * 0.1)}s`;
      card.classList.add('animate-in');
    });
  });

  // Add scroll effects
  window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const shapes = document.querySelectorAll('.floating-shape');
    
    shapes.forEach((shape, index) => {
      const speed = 0.5 + (index * 0.1);
      shape.style.transform = `translateY(${scrolled * speed}px)`;
    });
  });
</script>
@endsection