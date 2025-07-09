@extends('siswa.siswa_master')

@section('siswa')
<div class="quiz-container">
  <!-- Hero Section -->
  <div class="hero-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <div class="hero-content">
            <div class="hero-icon mb-4">
              <i class="mdi mdi-brain"></i>
            </div>
            <h1 class="hero-title mb-3">
              <span class="text-gradient">Koleksi Quiz Interaktif</span>
            </h1>
            <p class="hero-subtitle mb-4">
              Asah kemampuanmu dengan berbagai quiz menarik yang telah disiapkan khusus untukmu. 
              Mari mulai petualangan belajar yang seru!
            </p>
            <div class="stats-row">
              <div class="stat-item">
                <div class="stat-number">{{ count($quizzes) }}</div>
                <div class="stat-label">Quiz Tersedia</div>
              </div>
              <div class="stat-divider"></div>
              <div class="stat-item">
                <div class="stat-number">∞</div>
                <div class="stat-label">Kesempatan Belajar</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="hero-decoration">
      <div class="floating-shape shape-1"></div>
      <div class="floating-shape shape-2"></div>
      <div class="floating-shape shape-3"></div>
    </div>
  </div>

  <div class="container py-5">
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show custom-alert mb-4" role="alert">
        <div class="alert-content">
          <i class="mdi mdi-check-circle alert-icon"></i>
          <div class="alert-text">{{ session('success') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <!-- Quiz Cards Grid -->
    <div class="quiz-grid">
      @forelse ($quizzes as $index => $quiz)
        <div class="quiz-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
          <div class="quiz-card-header">
            <div class="quiz-number">{{ $index + 1 }}</div>
            <div class="quiz-platform">
              <span class="platform-badge">{{ $quiz->platform }}</span>
            </div>
          </div>
          
          <div class="quiz-card-body">
            <h5 class="quiz-title">
              <a href="{{ route('siswa.quiz.show', $quiz->id) }}" class="quiz-title-link">
                {{ $quiz->judul }}
              </a>
            </h5>
            
            <div class="quiz-meta">
              <div class="quiz-author">
                <i class="mdi mdi-account-circle"></i>
                <span>{{ $quiz->user->name ?? 'N/A' }}</span>
              </div>
            </div>

            <div class="quiz-link-preview">
              <i class="mdi mdi-link-variant"></i>
              <span class="link-text">{{ Str::limit($quiz->link, 35) }}</span>
            </div>
          </div>

          <div class="quiz-card-footer">
            <a href="{{ $quiz->link }}" target="_blank" class="quiz-btn">
              <span class="btn-text">Mulai Quiz</span>
              <i class="mdi mdi-arrow-right btn-icon"></i>
            </a>
          </div>

          <div class="card-decoration">
            <div class="decoration-dot dot-1"></div>
            <div class="decoration-dot dot-2"></div>
            <div class="decoration-dot dot-3"></div>
          </div>
        </div>
      @empty
        <div class="empty-state">
          <div class="empty-illustration">
            <i class="mdi mdi-quiz-outline"></i>
          </div>
          <h4 class="empty-title">Belum Ada Quiz</h4>
          <p class="empty-description">
            Quiz sedang dalam persiapan. Pantau terus halaman ini untuk update terbaru!
          </p>
          <div class="empty-decoration">
            <div class="empty-dot"></div>
            <div class="empty-dot"></div>
            <div class="empty-dot"></div>
          </div>
        </div>
      @endforelse
    </div>
  </div>
</div>

<style>
  :root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    --light-bg: #f8f9ff;
    --card-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    --card-shadow-hover: 0 20px 60px rgba(0, 0, 0, 0.15);
  }

  .quiz-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    position: relative;
    overflow-x: hidden;
  }

  /* Hero Section */
  .hero-section {
    background: var(--primary-gradient);
    padding: 80px 0 100px;
    position: relative;
    margin-bottom: -50px;
    border-radius: 0 0 50px 50px;
  }

  .hero-content {
    position: relative;
    z-index: 2;
  }

  .hero-icon {
    font-size: 4rem;
    color: white;
    opacity: 0.9;
    animation: float 3s ease-in-out infinite;
  }

  .hero-title {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
  }

  .text-gradient {
    background: linear-gradient(45deg, #fff, #e3f2fd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .hero-subtitle {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
  }

  .stats-row {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2rem;
    margin-top: 2rem;
  }

  .stat-item {
    text-align: center;
    color: white;
  }

  .stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1;
  }

  .stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    margin-top: 0.5rem;
  }

  .stat-divider {
    width: 1px;
    height: 40px;
    background: rgba(255, 255, 255, 0.3);
  }

  .hero-decoration {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    pointer-events: none;
  }

  .floating-shape {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float 6s ease-in-out infinite;
  }

  .shape-1 {
    width: 100px;
    height: 100px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
  }

  .shape-2 {
    width: 150px;
    height: 150px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
  }

  .shape-3 {
    width: 80px;
    height: 80px;
    top: 80%;
    left: 80%;
    animation-delay: 4s;
  }

  /* Custom Alert */
  .custom-alert {
    border: none;
    border-radius: 15px;
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
    box-shadow: var(--card-shadow);
    border-left: 5px solid #28a745;
  }

  .alert-content {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .alert-icon {
    font-size: 1.5rem;
    color: #28a745;
  }

  /* Quiz Grid */
  .quiz-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    padding: 2rem 0;
  }

  .quiz-card {
    background: white;
    border-radius: 20px;
    box-shadow: var(--card-shadow);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.8);
  }

  .quiz-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: var(--card-shadow-hover);
  }

  .quiz-card-header {
    padding: 1.5rem 1.5rem 0;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
  }

  .quiz-number {
    width: 40px;
    height: 40px;
    background: var(--accent-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.1rem;
  }

  .platform-badge {
    background: var(--secondary-gradient);
    color: white;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .quiz-card-body {
    padding: 1rem 1.5rem;
  }

  .quiz-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.3;
  }

  .quiz-title-link {
    color: #2d3748;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .quiz-title-link:hover {
    color: #667eea;
  }

  .quiz-meta {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    color: #718096;
    font-size: 0.9rem;
  }

  .quiz-author {
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .quiz-author i {
    font-size: 1.1rem;
  }

  .quiz-link-preview {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.8rem;
    background: rgba(102, 126, 234, 0.05);
    border-radius: 10px;
    color: #667eea;
    font-size: 0.85rem;
    border-left: 3px solid #667eea;
  }

  .link-text {
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .quiz-card-footer {
    padding: 0 1.5rem 1.5rem;
  }

  .quiz-btn {
    width: 100%;
    background: var(--primary-gradient);
    color: white;
    border: none;
    padding: 1rem 1.5rem;
    border-radius: 15px;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }

  .quiz-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
  }

  .quiz-btn:hover::before {
    left: 100%;
  }

  .quiz-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
  }

  .btn-icon {
    transition: transform 0.3s ease;
  }

  .quiz-btn:hover .btn-icon {
    transform: translateX(5px);
  }

  .card-decoration {
    position: absolute;
    top: 1rem;
    right: 1rem;
    display: flex;
    gap: 0.3rem;
  }

  .decoration-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    opacity: 0.3;
  }

  .dot-1 { background: #ff6b6b; }
  .dot-2 { background: #4ecdc4; }
  .dot-3 { background: #45b7d1; }

  /* Empty State */
  .empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 20px;
    box-shadow: var(--card-shadow);
    position: relative;
  }

  .empty-illustration {
    font-size: 5rem;
    color: #e2e8f0;
    margin-bottom: 2rem;
    animation: pulse 2s infinite;
  }

  .empty-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #4a5568;
    margin-bottom: 1rem;
  }

  .empty-description {
    color: #718096;
    font-size: 1.1rem;
    max-width: 400px;
    margin: 0 auto 2rem;
    line-height: 1.6;
  }

  .empty-decoration {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
  }

  .empty-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #cbd5e0;
    animation: bounce 1.4s infinite ease-in-out both;
  }

  .empty-dot:nth-child(1) { animation-delay: -0.32s; }
  .empty-dot:nth-child(2) { animation-delay: -0.16s; }

  /* Animations */
  @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
  }

  @keyframes pulse {
    0%, 100% { opacity: 0.4; }
    50% { opacity: 0.8; }
  }

  @keyframes bounce {
    0%, 80%, 100% { transform: scale(0); }
    40% { transform: scale(1); }
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .hero-title {
      font-size: 2.5rem;
    }

    .hero-subtitle {
      font-size: 1rem;
    }

    .stats-row {
      gap: 1rem;
    }

    .stat-number {
      font-size: 2rem;
    }

    .quiz-grid {
      grid-template-columns: 1fr;
      gap: 1.5rem;
      padding: 1rem 0;
    }

    .hero-section {
      padding: 60px 0 80px;
      margin-bottom: -30px;
      border-radius: 0 0 30px 30px;
    }
  }

  @media (max-width: 480px) {
    .hero-title {
      font-size: 2rem;
    }

    .hero-icon {
      font-size: 3rem;
    }

    .quiz-card {
      margin: 0 0.5rem;
    }
  }
</style>
@endsection