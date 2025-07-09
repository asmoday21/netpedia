@extends('siswa.siswa_master')

@section('siswa')
<div class="edit-profile-container">
  <!-- Background Elements -->
  <div class="bg-decoration">
    <div class="floating-orb orb-1"></div>
    <div class="floating-orb orb-2"></div>
    <div class="floating-orb orb-3"></div>
    <div class="floating-pattern"></div>
  </div>

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-9 col-xl-8">
        <!-- Progress Bar -->

        <!-- Main Form Card -->
        <div class="form-card glass-effect" data-aos="fade-up" data-aos-delay="200">
          <!-- Header -->
          <div class="form-header">
            <div class="header-content">
              <div class="header-icon">
                <i class="fas fa-user-cog"></i>
              </div>
              <div class="header-text">
                <h3>Perbarui Profil Anda</h3>
                <p>Pastikan informasi yang Anda masukkan akurat dan terkini</p>
              </div>
            </div>
          </div>

          <!-- Success Alert -->
          @if(session('success'))
            <div class="alert-custom alert-success" data-aos="fade-in">
              <div class="alert-icon">
                <i class="fas fa-check-circle"></i>
              </div>
              <div class="alert-content">
                <div class="alert-title">Berhasil!</div>
                <div class="alert-message">{{ session('success') }}</div>
              </div>
              <button class="alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
              </button>
            </div>
          @endif

          <!-- Form Body -->
          <div class="form-body">
            <form id="profileForm" action="{{ route('siswa.store_profile') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <!-- Profile Image Section -->
              <div class="profile-image-section" data-aos="fade-up" data-aos-delay="300">
                <div class="section-title">
                  <h6>
                    <i class="fas fa-image me-2"></i>
                    Foto Profil
                  </h6>
                  <span class="section-subtitle">Pilih foto yang merepresentasikan diri Anda</span>
                </div>

                <div class="image-upload-container">
                  <div class="image-preview-wrapper">
                    <div class="image-preview" id="imagePreview">
                      @if ($editData->profile_image)
                        <img src="{{ asset('upload/siswa_images/' . $editData->profile_image) }}" 
                             alt="Foto Profil" 
                             class="preview-img"
                             id="previewImg">
                      @else
                        <div class="placeholder-img" id="placeholderImg">
                          <i class="fas fa-user-plus"></i>
                          <span>Upload Foto</span>
                        </div>
                      @endif
                    </div>
                    
                    <div class="image-overlay">
                      <div class="overlay-content">
                        <i class="fas fa-camera"></i>
                        <span>Ubah Foto</span>
                      </div>
                    </div>
                  </div>

                  <div class="upload-controls">
                    <input type="file" 
                           name="profile_image" 
                           id="profileImage" 
                           class="file-input @error('profile_image') is-invalid @enderror" 
                           accept=".jpg,.jpeg,.png"
                           onchange="previewImage(this)">
                    
                    <label for="profileImage" class="upload-btn">
                      <i class="fas fa-cloud-upload-alt me-2"></i>
                      Pilih Gambar
                    </label>
                    
                    <button type="button" class="remove-btn" onclick="removeImage()" style="display: {{ $editData->profile_image ? 'flex' : 'none' }}">
                      <i class="fas fa-trash-alt me-2"></i>
                      Hapus
                    </button>
                  </div>

                  <div class="upload-info">
                    <div class="info-item">
                      <i class="fas fa-info-circle"></i>
                      <span>Format: JPG, JPEG, PNG</span>
                    </div>
                    <div class="info-item">
                      <i class="fas fa-weight-hanging"></i>
                      <span>Maksimal: 2MB</span>
                    </div>
                    <div class="info-item">
                      <i class="fas fa-crop-alt"></i>
                      <span>Rasio: 1:1 (Persegi)</span>
                    </div>
                  </div>

                  @error('profile_image')
                    <div class="error-message">
                      <i class="fas fa-exclamation-triangle"></i>
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <!-- Personal Information Section -->
              <div class="form-section" data-aos="fade-up" data-aos-delay="400">
                <div class="section-title">
                  <h6>
                    <i class="fas fa-user me-2"></i>
                    Informasi Pribadi
                  </h6>
                  <span class="section-subtitle">Lengkapi data pribadi Anda dengan benar</span>
                </div>

                <div class="form-grid">
                  <!-- Name Field -->
                  <div class="form-group" data-aos="fade-up" data-aos-delay="500">
                    <label for="name" class="form-label">
                      <i class="fas fa-user-tag me-2"></i>
                      Nama Lengkap
                      <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                      <input type="text" 
                             name="name" 
                             id="name" 
                             class="form-input @error('name') is-invalid @enderror" 
                             value="{{ old('name', $editData->name) }}" 
                             placeholder="Masukkan nama lengkap Anda"
                             required
                             autocomplete="name">
                      <div class="input-icon">
                        <i class="fas fa-user"></i>
                      </div>
                      <div class="input-focus-border"></div>
                    </div>
                    @error('name')
                      <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <!-- NIS Field -->
                  <div class="form-group" data-aos="fade-up" data-aos-delay="550">
                    <label for="nis" class="form-label">
                      <i class="fas fa-id-card me-2"></i>
                      NIS
                      <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                      <input type="text" 
                            name="nis" 
                            id="nis" 
                            class="form-input @error('nis') is-invalid @enderror" 
                            value="{{ old('nis', $editData->nis) }}" 
                            placeholder="Masukkan Nomor Induk Siswa"
                            required>
                      <div class="input-icon">
                        <i class="fas fa-id-badge"></i>
                      </div>
                      <div class="input-focus-border"></div>
                    </div>
                    @error('nis')
                      <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                      </div>
                    @enderror
                  </div>


                  <!-- Email Field -->
                  <div class="form-group" data-aos="fade-up" data-aos-delay="600">
                    <label for="email" class="form-label">
                      <i class="fas fa-envelope me-2"></i>
                      Alamat Email
                      <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                      <input type="email" 
                             name="email" 
                             id="email" 
                             class="form-input @error('email') is-invalid @enderror" 
                             value="{{ old('email', $editData->email) }}" 
                             placeholder="contoh@email.com"
                             required
                             autocomplete="email">
                      <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                      </div>
                      <div class="input-focus-border"></div>
                    </div>
                    @error('email')
                      <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>

              <!-- Form Actions -->
              <div class="form-actions" data-aos="fade-up" data-aos-delay="700">
                <div class="actions-wrapper">
                    <a href="{{ route('siswa.siswa_profile') }}" class="btn-secondary" style="color: black;">
                    <i class="fas fa-arrow-left me-2" style="color: black;"></i>
                    <span>Kembali</span>
                    </a>
                  
                  <div class="primary-actions">
                    <button type="button" class="btn-preview" onclick="previewChanges()">
                      <i class="fas fa-eye me-2"></i>
                      <span>Preview</span>
                    </button>
                    
                    <button type="submit" class="btn-primary" id="submitBtn">
                      <div class="btn-content">
                        <i class="fas fa-save me-2"></i>
                        <span>Simpan Perubahan</span>
                      </div>
                      <div class="btn-loading" style="display: none;">
                        <i class="fas fa-spinner fa-spin me-2"></i>
                        <span>Menyimpan...</span>
                      </div>
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Tips Card -->
        <div class="tips-card glass-effect mt-4" data-aos="fade-up" data-aos-delay="800">
          <div class="tips-header">
            <i class="fas fa-lightbulb"></i>
            <h6>Tips Profil yang Baik</h6>
          </div>
          <div class="tips-list">
            <div class="tip-item">
              <i class="fas fa-check-circle"></i>
              <span>Gunakan foto yang jelas dan profesional</span>
            </div>
            <div class="tip-item">
              <i class="fas fa-check-circle"></i>
              <span>Pastikan nama lengkap sesuai dengan dokumen resmi</span>
            </div>
            <div class="tip-item">
              <i class="fas fa-check-circle"></i>
              <span>Email yang aktif untuk notifikasi penting</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content glass-effect border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title">
          <i class="fas fa-eye me-2"></i>
          Preview Profil
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <div class="preview-profile">
          <div class="preview-avatar mb-3">
            <img id="modalPreviewImg" src="" alt="Preview" class="rounded-circle">
          </div>
          <h5 id="modalPreviewName"></h5>
          <p id="modalPreviewNis" class="text-muted"></p>
          <p id="modalPreviewEmail" class="text-muted"></p>
        </div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">
          <i class="fas fa-times me-2" style="color: black;"></i>
          Tutup
        </button>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('profileForm').submit()">
          Simpan Profil
        </button>
      </div>
    </div>
  </div>
</div>

{{-- External Libraries --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
  /* Root Variables */
  :root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --success-gradient: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
    --text-primary: #2d3748;
    --text-secondary: #718096;
    --text-muted: #a0aec0;
    --bg-light: #f7fafc;
    --white: #ffffff;
    --shadow-soft: 0 10px 40px rgba(0, 0, 0, 0.1);
    --shadow-medium: 0 20px 60px rgba(0, 0, 0, 0.15);
    --border-radius: 20px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  /* Base Styles */
  .edit-profile-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow-x: hidden;
  }

  /* Background Decoration */
  .bg-decoration {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    overflow: hidden;
  }

  .floating-orb {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float 20s infinite ease-in-out;
  }

  .orb-1 {
    width: 100px;
    height: 100px;
    top: 10%;
    left: 10%;
    animation-delay: 0s;
  }

  .orb-2 {
    width: 150px;
    height: 150px;
    top: 60%;
    right: 10%;
    animation-delay: 7s;
  }

  .orb-3 {
    width: 80px;
    height: 80px;
    bottom: 20%;
    left: 20%;
    animation-delay: 14s;
  }

  .floating-pattern {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
    opacity: 0.5;
  }

  @keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    33% { transform: translateY(-30px) rotate(120deg); }
    66% { transform: translateY(15px) rotate(240deg); }
  }

  /* Glass Effect */
  .glass-effect {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: var(--shadow-soft);
  }

  /* Progress Bar */
  .progress-wrapper {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .progress-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    color: white;
  }

  .progress-indicator {
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .step {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.85rem;
  }

  .step.active {
    background: white;
    color: var(--text-primary);
  }

  .step-label {
    font-size: 0.9rem;
    opacity: 0.9;
  }

  .progress-custom {
    height: 6px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 3px;
    overflow: hidden;
  }

  .progress-bar {
    background: linear-gradient(90deg, #ffffff, rgba(255, 255, 255, 0.8));
    transition: width 0.6s ease;
  }

  /* Form Card */
  .form-card {
    border-radius: var(--border-radius);
    overflow: hidden;
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

  /* Form Header */
  .form-header {
    background: var(--primary-gradient);
    color: white;
    padding: 2rem;
    position: relative;
    overflow: hidden;
  }

  .form-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="60" cy="60" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="30" r="1.5" fill="rgba(255,255,255,0.05)"/></svg>');
    opacity: 0.3;
  }

  .header-content {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    position: relative;
    z-index: 2;
  }

  .header-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    backdrop-filter: blur(10px);
  }

  .header-text h3 {
    margin: 0 0 0.5rem 0;
    font-weight: 700;
    font-size: 1.5rem;
  }

  .header-text p {
    margin: 0;
    opacity: 0.9;
    font-size: 0.95rem;
  }

  /* Alert Custom */
  .alert-custom {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    margin: 1.5rem;
    border-radius: 12px;
    position: relative;
    animation: slideDown 0.5s ease-out;
  }

  .alert-success {
    background: linear-gradient(135deg, rgba(78, 205, 196, 0.1), rgba(68, 160, 141, 0.1));
    border: 1px solid rgba(78, 205, 196, 0.3);
    color: #2d7d76;
  }

  .alert-icon {
    font-size: 1.2rem;
  }

  .alert-content {
    flex-grow: 1;
  }

  .alert-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
  }

  .alert-message {
    font-size: 0.9rem;
    opacity: 0.9;
  }

  .alert-close {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 8px;
    transition: var(--transition);
  }

  .alert-close:hover {
    background: rgba(0, 0, 0, 0.1);
  }

  @keyframes slideDown {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Form Body */
  .form-body {
    padding: 2rem;
  }

  /* Section Styles */
  .profile-image-section,
  .form-section {
    margin-bottom: 3rem;
  }

  .section-title {
    margin-bottom: 1.5rem;
  }

  .section-title h6 {
    color: var(--text-primary);
    font-weight: 600;
    margin-bottom: 0.25rem;
    display: flex;
    align-items: center;
  }

  .section-subtitle {
    color: var(--text-secondary);
    font-size: 0.9rem;
  }

  /* Image Upload */
  .image-upload-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
  }

  .image-preview-wrapper {
    position: relative;
    cursor: pointer;
    transition: var(--transition);
  }

  .image-preview-wrapper:hover {
    transform: scale(1.02);
  }

  .image-preview {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid rgba(102, 126, 234, 0.2);
    position: relative;
    transition: var(--transition);
  }

  .preview-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .placeholder-img {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    font-size: 0.9rem;
    gap: 0.5rem;
  }

  .placeholder-img i {
    font-size: 2rem;
  }

  .image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
    border-radius: 50%;
  }

  .image-preview-wrapper:hover .image-overlay {
    opacity: 1;
  }

  .overlay-content {
    color: white;
    text-align: center;
    font-size: 0.9rem;
  }

  .overlay-content i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    display: block;
  }

  .upload-controls {
    display: flex;
    gap: 1rem;
    align-items: center;
  }

  .file-input {
    display: none;
  }

  .upload-btn,
  .remove-btn {
    display: flex;
    align-items: center;
    padding: 0.75rem 1.25rem;
    border-radius: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    border: none;
    font-size: 0.9rem;
  }

  .upload-btn {
    background: var(--primary-gradient);
    color: white;
  }

  .upload-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
  }

  .remove-btn {
    background: rgba(245, 87, 108, 0.1);
    color: #f5576c;
    border: 1px solid rgba(245, 87, 108, 0.3);
  }

  .remove-btn:hover {
    background: rgba(245, 87, 108, 0.2);
  }

  .upload-info {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    flex-wrap: wrap;
  }

  .info-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.85rem;
  }

  .info-item i {
    color: var(--primary-color);
  }

  /* Form Grid */
  .form-grid {
    display: grid;
    gap: 1.5rem;
    grid-template-columns: 1fr;
  }

  /* Form Group */
  .form-group {
    position: relative;
  }

  .form-label {
    display: block;
    margin-bottom: 0.75rem;
    color: var(--text-primary);
    font-weight: 600;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
  }

  .required {
    color: #f5576c;
    margin-left: 0.25rem;
  }

  /* Input Wrapper */
  .input-wrapper {
    position: relative;
  }

  .form-input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    transition: var(--transition);
    background: white;
  }

  .form-input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
  }

  .form-input.is-invalid {
    border-color: #f5576c;
  }

  .input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    transition: var(--transition);
  }

  .form-input:focus + .input-icon {
    color: #667eea;
  }

  .input-focus-border {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--primary-gradient);
    transition: width 0.3s ease;
  }

  .form-input:focus ~ .input-focus-border {
    width: 100%;
  }

  /* Error Message */
  .error-message {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #f5576c;
    font-size: 0.85rem;
    margin-top: 0.5rem;
    animation: shake 0.3s ease-in-out;
  }

  @keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
  }

  /* Form Actions */
  .form-actions {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e2e8f0;
  }

  .actions-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
  }

  .primary-actions {
    display: flex;
    gap: 1rem;
  }

  /* Buttons */
  .btn-secondary,
  .btn-preview,
  .btn-primary {
    display: flex;
    align-items: center;
    padding: 0.875rem 1.5rem;
    border-radius: 12px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition);
    border: none;
    font-size: 0.95rem;
  }

  .btn-secondary {
    background: white;
    color: var(--text-primary);
    border: 2px solid #e2e8f0;
  }

  .btn-secondary:hover {
    background: #f8fafc;
    border-color: #cbd5e0;
    transform: translateY(-1px);
    color: var(--text-primary);
  }

  .btn-preview {
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
    border: 2px solid rgba(102, 126, 234, 0.2);
      }

  .btn-preview:hover {
    background: rgba(102, 126, 234, 0.2);
    transform: translateY(-1px);
  }

  .btn-primary {
    background: var(--primary-gradient);
    color: white;
    position: relative;
    overflow: hidden;
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
  }

  .btn-primary::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0));
    opacity: 0;
    transition: var(--transition);
  }

  .btn-primary:hover::after {
    opacity: 1;
  }

  .btn-content, .btn-loading {
    display: flex;
    align-items: center;
  }

  /* Tips Card */
  .tips-card {
    border-radius: var(--border-radius);
    padding: 1.5rem;
  }

  .tips-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    color: var(--text-primary);
  }

  .tips-header i {
    font-size: 1.5rem;
    color: #667eea;
  }

  .tips-header h6 {
    margin: 0;
    font-weight: 600;
  }

  .tips-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .tip-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
  }

  .tip-item i {
    color: #4ecdc4;
    font-size: 0.9rem;
    margin-top: 0.15rem;
  }

  .tip-item span {
    font-size: 0.9rem;
    color: var(--text-secondary);
    line-height: 1.5;
  }

  /* Preview Modal */
  .modal-content {
    border-radius: var(--border-radius);
    overflow: hidden;
  }

  .modal-header {
    background: var(--primary-gradient);
    color: white;
  }

  .btn-close {
    filter: brightness(0) invert(1);
  }

  .preview-profile {
    padding: 1rem;
  }

  .preview-avatar {
    width: 120px;
    height: 120px;
    margin: 0 auto;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid rgba(102, 126, 234, 0.2);
  }

  .preview-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .form-grid {
      grid-template-columns: 1fr;
    }

    .actions-wrapper {
      flex-direction: column-reverse;
    }

    .primary-actions {
      width: 100%;
      justify-content: space-between;
    }

    .btn-secondary {
      width: 100%;
      justify-content: center;
      margin-top: 1rem;
    }
  }

  @media (max-width: 576px) {
    .form-header {
      padding: 1.5rem;
    }

    .header-content {
      flex-direction: column;
      text-align: center;
    }

    .header-icon {
      margin-bottom: 1rem;
    }

    .form-body {
      padding: 1.5rem;
    }

    .upload-controls {
      flex-direction: column;
      width: 100%;
    }

    .upload-btn, .remove-btn {
      width: 100%;
      justify-content: center;
    }
  }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
  // Initialize AOS animation library
  AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true
  });

  // Image Preview Functionality
  function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('placeholderImg');
    const removeBtn = document.querySelector('.remove-btn');
    const file = input.files[0];
    
    if (file) {
      const reader = new FileReader();
      
      reader.onload = function(e) {
        if (placeholder) placeholder.style.display = 'none';
        
        let img = document.getElementById('previewImg');
        if (!img) {
          img = document.createElement('img');
          img.id = 'previewImg';
          img.className = 'preview-img';
          preview.appendChild(img);
        }
        
        img.src = e.target.result;
        removeBtn.style.display = 'flex';
      }
      
      reader.readAsDataURL(file);
    }
  }

  // Remove Image Functionality
  function removeImage() {
    const preview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('placeholderImg');
    const fileInput = document.getElementById('profileImage');
    const removeBtn = document.querySelector('.remove-btn');
    
    // Reset file input
    fileInput.value = '';
    
    // Hide remove button
    removeBtn.style.display = 'none';
    
    // Remove preview image if exists
    const img = document.getElementById('previewImg');
    if (img) img.remove();
    
    // Show placeholder
    if (placeholder) placeholder.style.display = 'flex';
  }

  // Preview Changes Modal
  function previewChanges() {
    // Get form values
    const name = document.getElementById('name').value;
    const nis = document.getElementById('nis').value;
    const email = document.getElementById('email').value;
    
    // Get image preview
    let imageSrc = '';
    const previewImg = document.getElementById('previewImg');
    if (previewImg) {
      imageSrc = previewImg.src;
    } else {
      const existingImg = "{{ $editData->profile_image ? asset('upload/siswa_images/' . $editData->profile_image) : '' }}";
      if (existingImg) {
        imageSrc = existingImg;
      } else {
        imageSrc = "{{ asset('backend/assets/img/avatars/avatar.png') }}";
      }
    }
    
    // Set modal content
    document.getElementById('modalPreviewImg').src = imageSrc;
    document.getElementById('modalPreviewName').textContent = name || "Nama belum diisi";
    document.getElementById('modalPreviewNis').textContent = nis || "NIS belum diisi";
    document.getElementById('modalPreviewEmail').textContent = email || "Email belum diisi";
    
    // Show modal
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
    previewModal.show();
  }

  // Form Submission Handling
  document.getElementById('profileForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    const btnContent = submitBtn.querySelector('.btn-content');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    
    // Show loading state
    btnContent.style.display = 'none';
    btnLoading.style.display = 'flex';
    
    // Disable button to prevent multiple submissions
    submitBtn.disabled = true;
  });

  // Input validation
  document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('input', function() {
      if (this.value.trim() !== '') {
        this.classList.remove('is-invalid');
      }
    });
  });
</script>

@endsection