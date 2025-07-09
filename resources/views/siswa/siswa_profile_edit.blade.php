@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="container mt-5">
  <div class="card shadow-lg">
    <!--begin::Header-->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h3 class="card-title text-white"><strong>Edit Profile</strong></h3>
      <a href="{{ route('admin.profile') }}" class="btn btn-light">Back to Profile</a>
    </div>
    <!--end::Header-->
    <!--begin::Form-->
    <form class="form-horizontal" method="post" action="{{ route('store.profile') }}" enctype="multipart/form-data">
      @csrf
      <!--begin::Body-->
      <div class="card-body">
        <div class="form-group row mb-3">
          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" value="{{ $editData->name }}">
          </div>
        </div>
        <div class="form-group row mb-3">
          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail" name="email" value="{{ $editData->email }}">
          </div>
        </div>
        <div class="form-group row mb-3">
          <label for="inputProfileImage" class="col-sm-2 col-form-label">Profile Image</label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="image" name="profile_image">
          </div>
        </div>
        <div class="text-center mb-3">
          <div class="nav-profile-image">
            <img id="showImage" src="{{ isset($adminData->profile_image) ? url('upload/admin_images/'. $adminData->profile_image) : url('upload/admin_images.jpg') }}" class="rounded-circle shadow" style="width: 150px; height: 150px;" alt="User Image">
          </div>
        </div>
      </div>
      <div class="card-footer text-center">
        <button type="submit" class="btn btn-success">Save</button>
      </div>
    </form>
  </div>
</div>
<style>
  .card-title {
    font-size: 1.5rem;
  }
  .form-control {
    border: 1px solid #ced4da;
    transition: border-color 0.3s ease-in-out;
  }
  .form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }
  .nav-profile-image img {
    transition: transform 0.3s ease-in-out;
  }
  .nav-profile-image img:hover {
    transform: scale(1.1);
  }
  .btn-success {
    background-color: #28a745;
    border-color: #28a745;
    transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;
  }
  .btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
  }
  .btn-light {
    background-color: #f8f9fa;
    border-color: #f8f9fa;
    transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;
  }
  .btn-light:hover {
    background-color: #e2e6ea;
    border-color: #dae0e5;
  }
</style>
<script type="text/javascript">
  $(document).ready(function(){
    $('#image').change(function(e){
      let reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src', e.target.result);
      }
      reader.readAsDataURL(e.target.files[0]);
    });
  });
</script>
@endsection
