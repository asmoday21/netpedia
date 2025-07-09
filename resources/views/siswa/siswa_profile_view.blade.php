@extends('admin.admin_master')
@section('admin')
<div class="card shadow-sm mb-4">
  <!--begin::Header-->
  <div class="card-header bg-gradient-primary text-white">
    <h3 class="card-title">Edit Profile</h3>
  </div>
  <!--end::Header-->
  
  <!--begin::Form-->
  <form>
    <!--begin::Body-->
    <div class="card-body">
      <div class="form-group">
        <label for="name" class="form-label">Nama:</label>
        <input type="text" class="form-control" id="name" value="{{$adminData->name}}" readonly>
      </div>
      <div class="form-group">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" value="{{$adminData->email}}" readonly>
      </div>
      <div class="text-center my-4">
        <div class="profile-image">
          <img src="{{ isset($adminData->profile_image) ? url('upload/admin_images/'. $adminData->profile_image) : url('upload/admin_images.jpg') }}" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px;" alt="profile">
        </div>
      </div>
    </div>
    <div class="card-footer text-center">
      <a href="{{ route('edit.profile') }}" class="btn btn-primary">Edit Profile</a>
    </div>
  </form>
  <!--end::Form-->
</div>

<style>
  .card-header {
    background: linear-gradient(45deg, #007bff, #00c6ff);
    color: white;
    padding: 1rem;
    border-radius: 0.25rem 0.25rem 0 0;
  }
  .card-body {
    background-color: #ffffff;
    padding: 1.5rem;
  }
  .profile-image img {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  .profile-image img:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }
  .btn-primary {
    transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    border-radius: 0.25rem;
  }
  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
  }
  .form-group {
    margin-bottom: 1.5rem;
  }
  .form-label {
    font-weight: bold;
    margin-bottom: 0.5rem;
    display: block;
  }
  .form-control {
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    padding: 0.5rem;
    font-size: 1rem;
  }
  .card-footer {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0 0 0.25rem 0.25rem;
  }
</style>
@endsection
