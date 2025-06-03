@extends('IndexPortal.app')

@push('head-script')
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/pages/page-profile.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/sweetalert2/sweetalert2.css" /> 
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Menu / {{$title}}</h4>    
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="{{ asset('assets') }}/img/pages/profile-banner.png" alt="Banner image" class="rounded-top" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    <img
                        src="{{ asset('assets') }}/img/logo/{{$instansi->logo}}"
                        alt="user image"
                        class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                            <h4>{{$instansi->igusername}}</h4>
                            <ul
                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                <li class="list-inline-item fw-medium"><i class="bx bx-phone"></i> {{$instansi->telp}}</li>
                                <li class="list-inline-item fw-medium"><i class="bx bx-envelope"></i> {{$instansi->email}}</li>                    
                            </ul>
                            </div>               
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahInstansiModal">
                                Tambah Instansi
                            </button>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->

    <!-- User Profile Content -->
    <div class="row">
    
        <div class="col-xl-12 col-lg-12 col-md-7">
            <div class="card card-action mb-4">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0"><i class="bx bx-list-ul me-2"></i>Detail Instansi</h5>
                </div>        
                <div class="card-body">                                      
                    <div class="row g-3">                      
                        <div class="col-sm-6">
                            <label class="form-label" for="name">Nama</label>
                            <input type="text" required name="name" id="name" class="form-control" value="{{$instansi->name}}" />
                        </div>                     
                        <div class="col-sm-6">
                            <label class="form-label" for="igusername">Nama Lengkap</label>
                            <input type="text" required name="igusername" id="igusername" class="form-control" value="{{$instansi->igusername}}" />
                        </div>                     
                        <div class="col-sm-6">
                            <label class="form-label" for="surname">Singkatan</label>
                            <input type="text" required name="surname" id="surname" class="form-control" value="{{$instansi->surname}}" />
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="alamat">Alamat</label>
                            <input type="text" required name="alamat" id="alamat" class="form-control" value="{{$instansi->alamat}}" />
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="text" required name="email" id="email" class="form-control" value="{{$instansi->email}}" />
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="telp">Telpon</label>
                            <input type="text" required name="telp" id="telp" class="form-control" value="{{$instansi->telp}}" />
                        </div>             
                    </div>
                </div>
            </div>            
        </div>
    </div>
    <!--/ User Profile Content -->
</div>

<!-- Modal -->
<div class="modal fade" id="tambahInstansiModal" tabindex="-1" aria-labelledby="tambahInstansiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahInstansiModalLabel">Tambah Instansi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('instansi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="mb-3">
              <label for="namaInstansi" class="form-label">Nama Instansi</label>
              <input type="text" class="form-control" id="namaInstansi" name="name" required>
            </div>
            <div class="mb-3">
              <label for="surnameInstansi" class="form-label">Surname Instansi</label>
              <input type="text" class="form-control" id="surnameInstansi" name="surname" required>
            </div>
            <div class="mb-3">
              <label for="logoInstansi" class="form-label">Logo Instansi</label>
              <input type="file" class="form-control" id="logoInstansi" name="logo" required>
            </div>
            <div class="mb-3">
              <label for="alamatInstansi" class="form-label">Alamat Instansi</label>
              <input type="text" class="form-control" id="alamatInstansi" name="alamat" required>
            </div>
            <div class="mb-3">
              <label for="profilInstansi" class="form-label">Profil Instansi</label>
              <textarea class="form-control" id="profilInstansi" name="profil" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="emailInstansi" class="form-label">Email Instansi</label>
              <input type="email" class="form-control" id="emailInstansi" name="email" required>
            </div>
            <div class="mb-3">
              <label for="teleponInstansi" class="form-label">Telepon Instansi</label>
              <input type="text" class="form-control" id="teleponInstansi" name="telp" required>
            </div>
            <div class="mb-3">
              <label for="igUsername" class="form-label">Instagram Username</label>
              <input type="text" class="form-control" id="igUsername" name="igusername" required>
            </div>
            <div class="mb-3">
              <label for="tiktokUsername" class="form-label">Tiktok Username</label>
              <input type="text" class="form-control" id="tiktokUsername" name="tiktokusername">
            </div>
            <div class="mb-3">
              <label for="fbUsername" class="form-label">Facebook Username</label>
              <input type="text" class="form-control" id="fbUsername" name="fbusername">
            </div>
            <!-- Tambahkan input lainnya sesuai kebutuhan -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
@endsection

@push('footer-script')            
<script src="{{ asset('assets') }}/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="{{ asset('assets') }}/vendor/libs/sweetalert2/sweetalert2.js"></script>
@endpush

@push('footer-Sec-script')
  <script>
    function showDeleteConfirmation(url, message) {
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    function showSweetAlert(response) {
        Swal.fire({
            icon: response.success ? 'success' : 'error',
            title: response.title,
            text: response.message,
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if(session('response'))
            var response = @json(session('response'));
            showSweetAlert(response);
        @endif
    });
  </script>
@endpush