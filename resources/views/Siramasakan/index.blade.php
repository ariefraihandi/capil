@extends('IndexPortal.app')

@push('head-script')
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/@form-validation/umd/styles/index.min.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/sweetalert2/sweetalert2.css" /> 
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/pages/page-faq.css" />
  <style>
    .badge {
        cursor: pointer;
    }
</style>

@endpush

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="faq-header d-flex flex-column justify-content-center align-items-center">
            <h1  class="text-center" style="color: white;">Sistem Integrasi <br>PA Muara Enim & Sistem Kependudukan</h1>
        
            {{-- <p class="text-center mb-0 px-3" style="color: white;">Sistem Integrasi Mahkamah Syar'iyah Dengan Data Kependudukan</p> --}}
            
        </div>

        <div class="row mt-4">
        <!-- Navigation -->
        <div class="col-lg-3 col-md-4 col-12 mb-md-0 mb-3">
            <div class="d-flex justify-content-between flex-column mb-2 mb-md-0">
            <ul class="nav nav-align-left nav-pills flex-column">
                <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pengajuan">
                    <i class="bx bx-receipt faq-nav-icon me-1"></i>
                    <span class="align-middle">Pengajuan</span>
                </button>
                </li>
            </ul>
            <div class="d-none d-md-block">
                <div class="mt-5">
                <img
                    src="{{ asset('assets') }}//img/illustrations/sitting-girl-with-laptop-light.png"
                    class="img-fluid w-px-200"
                    alt="FAQ Image"
                    data-app-light-img="illustrations/sitting-girl-with-laptop-light.png"
                    data-app-dark-img="illustrations/sitting-girl-with-laptop-dark.png" />
                </div>
            </div>
            </div>
        </div>
        <!-- /Navigation -->

        <!-- FAQ's -->
        <div class="col-lg-9 col-md-8 col-12">
            <div class="tab-content py-0">
                <div class="tab-pane fade show active" id="pengajuan" role="tabpanel">
                    <div class="d-flex mb-3 gap-3">
                        <div>
                            <span class="badge bg-label-primary rounded-2">
                                <i class="bx bx-credit-card bx-md"></i>
                            </span>
                        </div>
                        <div>
                            <h4 class="mb-0">
                                <span class="align-middle">Pengajuan</span>
                            </h4>
                            <span>Daftar Pengajuan Perubahan Data Kependudukan</span>
                        </div>
                    </div>
                    <div id="accordionPayment" class="accordion">
                        <div class="card accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#accordionPayment-1" aria-controls="accordionPayment-1">
                                    Permohonan Yang Belum Diproses
                                </button>
                            </h2>
                            <div id="accordionPayment-1" class="accordion-collapse collapse show">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 text-center col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-center justify-content-center">
                                                        <div class="avatar flex-shrink-0">
                                                            <i class='bx bx-task' style="font-size: 40px; color: #0d6efd;"></i>
                                                        </div>
                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">Pengajuan Bulan Ini</span>
                                                    <h3 class="card-title mb-2">{{ $pemohonUbahStatuses->count() }}</h3>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="col-lg-4 text-center col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-center justify-content-center">
                                                        <div class="avatar flex-shrink-0">
                                                            <i class='bx bx-task' style="font-size: 40px; color: #0dfd5d;"></i>
                                                        </div>
                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">Selesai Diproses</span>
                                                    <h3 class="card-title mb-2">{{$successCount}}</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 text-center col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                  
                                                    <div class="col-lg-12 text-center col-md-12 col-6 ">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPemohonModal">
                                                            Tambah Pemohon
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card">
                                            <h5 class="card-header">Daftar Tabel Pengajuan Perubahan Status</h5>
                                            <div class="table-responsive text-nowrap">
                                                <table class="table" id="myTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Pemohon</th>
                                                            <th>Perubahan</th>
                                                            <th>Receipt</th>
                                                            <th>Document</th>                                                        
                                                            <th>Action</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pemohonUbahStatuses as $status)
                                                        <tr>
                                                            <!-- Pemohon -->
                                                            <td>{{ $status->pemohon->nama ?? 'Tidak ditemukan' }}<br>{{ $status->pemohon->NIK ?? 'Tidak ditemukan' }}</td>
                                            
                                                            <!-- NIK -->
                                                            <td>
                                                                @if ($status->cheklist_ubah_status && $status->cheklist_ubah_alamat)
                                                                    Ubah Status dan Alamat
                                                                @elseif ($status->cheklist_ubah_status)
                                                                    Ubah Status
                                                                @elseif ($status->cheklist_ubah_alamat)
                                                                    Ubah Alamat
                                                                @else
                                                                    Tidak ada perubahan
                                                                @endif
                                                            </td>
                                                            
                                                            <td>
                                                                <a href="{{ url('cetak/receipt/ubahstatus', ['data' => $status->id]) }}" class="btn btn-sm btn-primary" target="_blank">Download</a>
                                                            </td>                                                            
                                                            <td>
                                                                <a href="{{ url($status->url_document) }}" class="btn btn-sm btn-info" target="_blank">Download</a>
                                                            </td> 
                                                            <td>
                                                                @if ($status->cheklist_ubah_status && $status->cheklist_ubah_alamat)
                                                                    <a href="https://wa.me/6282276624504?text=Perubahan%20Status%20dan%20Alamat%20atas%20nama%20{{ urlencode($status->pemohon->nama) }}" class="btn btn-sm btn-success" target="_blank">
                                                                        <i class="bx bxl-whatsapp"></i> Notify
                                                                    </a>
                                                                @elseif ($status->cheklist_ubah_status)
                                                                    <a href="https://wa.me/6282276624504?text=Perubahan%20Status%20atas%20nama%20{{ urlencode($status->pemohon->nama) }}" class="btn btn-sm btn-success" target="_blank">
                                                                        <i class="bx bxl-whatsapp"></i> Notify
                                                                    </a>
                                                                @elseif ($status->cheklist_ubah_alamat)
                                                                    <a href="https://wa.me/6282276624504?text=Perubahan%20Alamat%20atas%20nama%20{{ urlencode($status->pemohon->nama) }}" class="btn btn-sm btn-success" target="_blank">
                                                                        Notify <i class="bx bxl-whatsapp"></i> 
                                                                    </a>
                                                                @else
                                                                    Tidak ada perubahan
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($status->cheklist_ubah_status && $status->cheklist_ubah_alamat)
                                                                    Perubahan Status dan Alamat atas nama {{ $status->pemohon->nama }}
                                                                @elseif ($status->cheklist_ubah_status)
                                                                    Perubahan Status atas nama {{ $status->pemohon->nama }}
                                                                @elseif ($status->cheklist_ubah_alamat)
                                                                    Perubahan Alamat atas nama {{ $status->pemohon->nama }}
                                                                @else
                                                                    Tidak ada perubahan
                                                                @endif
                                                            </td>
                                                            
                                                            <td>
                                                                @if ($status->cheklist_ubah_status && $status->cheklist_ubah_alamat)
                                                                    Perubahan Status dan Alamat atas nama {{ $status->pemohon->nama }}
                                                                @elseif ($status->cheklist_ubah_status)
                                                                    Perubahan Status atas nama {{ $status->pemohon->nama }}
                                                                @elseif ($status->cheklist_ubah_alamat)
                                                                    Perubahan Alamat atas nama {{ $status->pemohon->nama }}
                                                                @else
                                                                    Tidak ada perubahan
                                                                @endif
                                                            </td>
                                                                                                                                                                                                                                                                                                                                                    
                                                            <td>
                                                                @if ($status->status == 1)
                                                                    <span class="badge bg-primary" data-bs-toggle="modal" data-bs-target="#modalStatus{{ $status->id }}">Sedang Diproses</span>
                                                                @elseif ($status->status == 2)
                                                                    <span class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#modalStatus{{ $status->id }}">Gagal Proses</span><br>Catatan: {{ $status->catatan ?? '' }}
                                                                @elseif ($status->status == 3)
                                                                    <span class="badge bg-warning" data-bs-toggle="modal" data-bs-target="#modalStatus{{ $status->id }}">Selesai Proses</span><br>Belum Ambil
                                                                @elseif ($status->status == 4)
                                                                    <span class="badge bg-success" data-bs-toggle="modal" data-bs-target="#modalStatus{{ $status->id }}">SUCCESS</span>
                                                                @elseif ($status->status == 5)
                                                                    <span class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#{{ $status->id }}">Dibatalkan</span>
                                                                @else
                                                                    <span class="badge bg-secondary" data-bs-toggle="modal" data-bs-target="#modalStatus{{ $status->id }}">Status Tidak Diketahui</span>
                                                                @endif
                                                            </td>                                                            
                                                        </tr>
                                                        <!-- Modal for changing status -->
                                                            <div class="modal fade" id="modalStatus{{ $status->id }}" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="statusModalLabel">Ubah Status</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Traditional form submission -->
                                                                            <form action="{{ route('update.status.capil') }}" method="POST" id="formStatus{{ $status->id }}">                
                                                                                @csrf
                                                                                <!-- Hidden field to pass the pemohon ID -->
                                                                                <input type="hidden" name="id" value="{{ $status->id }}">

                                                                                <div class="mb-3">
                                                                                    <label for="selectStatus{{ $status->id }}" class="form-label">Pilih Status:</label>
                                                                                    <select name="status" id="selectStatus{{ $status->id }}" class="form-select">
                                                                                        <option value="1" {{ $status->status == 1 ? 'selected' : '' }}>Sedang Diproses</option>
                                                                                        <option value="2" {{ $status->status == 2 ? 'selected' : '' }}>Gagal Proses</option>
                                                                                        <option value="3" {{ $status->status == 3 ? 'selected' : '' }}>Selesai Proses</option>                            
                                                                                    </select>
                                                                                </div>

                                                                                <!-- Notes field (only appears if "Gagal Proses" is selected) -->
                                                                                <div class="mb-3" id="catatanField{{ $status->id }}" style="display: none;">
                                                                                    <label for="catatan{{ $status->id }}" class="form-label">Catatan:</label>
                                                                                    <textarea name="catatan" id="catatan{{ $status->id }}" class="form-control" placeholder="Masukkan catatan"></textarea>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                            <!-- Submit form via traditional form submission -->
                                                                            <button type="submit" form="formStatus{{ $status->id }}" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <!-- Modal for changing status -->
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        </div>

    
    </div>    

    {{-- <div class="modal fade" id="addPemohonModal" tabindex="-1" aria-labelledby="addPemohonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPemohonModalLabel">Tambah Pemohon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="uploadDocumentForm" action="{{ route('pemohon.upload.document') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadDocumentModalLabel">Upload Document or External URL</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="pemohon_id" id="pemohon_id">
        
                            <!-- Select option for document upload method -->
                            <div class="form-group mb-3">
                                <label for="uploadOption">Choose Upload Method</label>
                                <select class="form-control" id="uploadOption" name="upload_option" required onchange="toggleUploadOption()">
                                    <option value="manual">Upload Document</option>
                                    <option value="url">External URL</option>
                                </select>
                            </div>
        
                            <!-- Manual Document Upload Field -->
                            <div class="form-group mb-3" id="manualUploadDiv">
                                <label for="document">Upload Document</label>
                                <input type="file" class="form-control" name="document" id="document">
                            </div>
        
                            <!-- External URL Field (Hidden by default) -->
                            <div class="form-group mb-3" id="urlUploadDiv" style="display: none;">
                                <label for="externalUrl">External URL</label>
                                <input type="url" class="form-control" name="external_url" id="externalUrl" placeholder="https://drive.google.com/">
                            </div>
        
                            <!-- Checkbox for Ubah Status -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ubahStatus" name="ubah_status" onchange="toggleStatusFields()">
                                <label class="form-check-label" for="ubahStatus">Ubah Status</label>
                            </div>
        
                            <!-- Input fields for Status Awal and Status Baru (hidden by default) -->
                            <div class="row mt-3" id="statusFields" style="display: none;">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="statusAwal">Status Awal (Status Di KTP)</label>
                                        <input type="text" class="form-control" id="statusAwal" name="status_awal" placeholder="Masukkan Status Awal">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="statusBaru">Status Baru (Setelah Putusan)</label>
                                        <input type="text" class="form-control" id="statusBaru" name="status_baru" placeholder="Masukkan Status Baru">
                                    </div>
                                </div>
                            </div>
        
                            <!-- Checkbox for Ubah Alamat -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ubahAlamat" name="ubah_alamat" onchange="toggleAlamatFields()">
                                <label class="form-check-label" for="ubahAlamat">Ubah Alamat</label>
                            </div>
        
                            <!-- Input fields for Alamat Awal dan Alamat Baru (hidden by default) -->
                            <div class="row mt-3" id="alamatFields" style="display: none;">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="jalanAwal">Jalan Awal</label>
                                        <input type="text" class="form-control" id="jalanAwal" name="jalan_awal" placeholder="Masukkan Jalan Awal">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="jalanBaru">Jalan Baru</label>
                                        <input type="text" class="form-control" id="jalanBaru" name="jalan_baru" placeholder="Masukkan Jalan Baru">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="rtRwAwal">RT/RW Awal</label>
                                        <input type="text" class="form-control" id="rtRwAwal" name="rt_rw_awal" placeholder="Masukkan RT/RW Awal">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="rtRwBaru">RT/RW Baru</label>
                                        <input type="text" class="form-control" id="rtRwBaru" name="rt_rw_baru" placeholder="Masukkan RT/RW Baru">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="kelDesAwal">Kel/Des Awal</label>
                                        <input type="text" class="form-control" id="kelDesAwal" name="kel_des_awal" placeholder="Masukkan Kel/Des Awal">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="kelDesBaru">Kel/Des Baru</label>
                                        <input type="text" class="form-control" id="kelDesBaru" name="kel_des_baru" placeholder="Masukkan Kel/Des Baru">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="kecAwal">Kecamatan Awal</label>
                                        <input type="text" class="form-control" id="kecAwal" name="kec_awal" placeholder="Masukkan Kecamatan Awal">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="kecBaru">Kecamatan Baru</label>
                                        <input type="text" class="form-control" id="kecBaru" name="kec_baru" placeholder="Masukkan Kecamatan Baru">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="kabKotaAwal">Kab/Kota Awal</label>
                                        <input type="text" class="form-control" id="kabKotaAwal" name="kab_kota_awal" placeholder="Masukkan Kab/Kota Awal">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="kabKotaBaru">Kab/Kota Baru</label>
                                        <input type="text" class="form-control" id="kabKotaBaru" name="kab_kota_baru" placeholder="Masukkan Kab/Kota Baru">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="provinsiAwal">Provinsi Awal</label>
                                        <input type="text" class="form-control" id="provinsiAwal" name="provinsi_awal" placeholder="Masukkan Provinsi Awal">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="provinsiBaru">Provinsi Baru</label>
                                        <input type="text" class="form-control" id="provinsiBaru" name="provinsi_baru" placeholder="Masukkan Provinsi Baru">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="modal fade" id="addPemohonModal" tabindex="-1" aria-labelledby="uploadDocumentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadDocumentModalLabel">Upload Document or External URL</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="uploadDocumentForm" action="{{ route('pemohon.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="NIK" class="form-label">NIK</label>
                                <input type="text" id="NIK" name="NIK" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="jenisperkara" class="form-label">Jenis Perkara</label>
                                <input type="text" id="jenisperkara" name="jenisperkara" class="form-control" required>
                            </div>
                        </div>
                        
                       
                    
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="whatsapp" class="form-label">Nomor Telepon / whatsapp</label>
                                <input type="text" name="whatsapp" id="whatsapp" class="form-control" required>
                            </div>
                        </div>
                                                                 
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" placeholder="Isi (-) Jika Tidak Memiliki Email" class="form-control">
                            </div>
                        </div>
                        <!-- Select option for document upload method -->
                        <div class="form-group mb-3">
                            <label for="uploadOption">Choose Upload Method</label>
                            <select class="form-control" id="uploadOption" name="upload_option" required onchange="toggleUploadOption()">
                                <option value="manual">Upload Document</option>
                                <option value="url">External URL</option>
                            </select>
                        </div>
    
                        <!-- Manual Document Upload Field -->
                        <div class="form-group mb-3" id="manualUploadDiv">
                            <label for="document">Upload Document</label>
                            <input type="file" class="form-control" name="document" id="document">
                        </div>
    
                        <!-- External URL Field (Hidden by default) -->
                        <div class="form-group mb-3" id="urlUploadDiv" style="display: none;">
                            <label for="externalUrl">External URL</label>
                            <input type="url" class="form-control" name="external_url" id="externalUrl" placeholder="https://drive.google.com/">
                        </div>
    
                        <!-- Checkbox for Ubah Status -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ubahStatus" name="ubah_status" onchange="toggleStatusFields()">
                            <label class="form-check-label" for="ubahStatus">Ubah Status</label>
                        </div>
    
                        <!-- Input fields for Status Awal and Status Baru (hidden by default) -->
                        <div class="row mt-3" id="statusFields" style="display: none;">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="statusAwal">Status Awal (Status Di KTP)</label>
                                    <input type="text" class="form-control" id="statusAwal" name="status_awal" placeholder="Masukkan Status Awal">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="statusBaru">Status Baru (Setelah Putusan)</label>
                                    <input type="text" class="form-control" id="statusBaru" name="status_baru" placeholder="Masukkan Status Baru">
                                </div>
                            </div>
                        </div>
    
                        <!-- Checkbox for Ubah Alamat -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ubahAlamat" name="ubah_alamat" onchange="toggleAlamatFields()">
                            <label class="form-check-label" for="ubahAlamat">Ubah Alamat</label>
                        </div>
    
                        <!-- Input fields for Alamat Awal dan Alamat Baru (hidden by default) -->
                        <div class="row mt-3" id="alamatFields" style="display: none;">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="jalanAwal">Jalan Awal</label>
                                    <input type="text" class="form-control" id="jalanAwal" name="jalan_awal" placeholder="Masukkan Jalan Awal">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="jalanBaru">Jalan Baru</label>
                                    <input type="text" class="form-control" id="jalanBaru" name="jalan_baru" placeholder="Masukkan Jalan Baru">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="rtRwAwal">RT/RW Awal</label>
                                    <input type="text" class="form-control" id="rtRwAwal" name="rt_rw_awal" placeholder="Masukkan RT/RW Awal">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="rtRwBaru">RT/RW Baru</label>
                                    <input type="text" class="form-control" id="rtRwBaru" name="rt_rw_baru" placeholder="Masukkan RT/RW Baru">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="kelDesAwal">Kel/Des Awal</label>
                                    <input type="text" class="form-control" id="kelDesAwal" name="kel_des_awal" placeholder="Masukkan Kel/Des Awal">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="kelDesBaru">Kel/Des Baru</label>
                                    <input type="text" class="form-control" id="kelDesBaru" name="kel_des_baru" placeholder="Masukkan Kel/Des Baru">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="kecAwal">Kecamatan Awal</label>
                                    <input type="text" class="form-control" id="kecAwal" name="kec_awal" placeholder="Masukkan Kecamatan Awal">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="kecBaru">Kecamatan Baru</label>
                                    <input type="text" class="form-control" id="kecBaru" name="kec_baru" placeholder="Masukkan Kecamatan Baru">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="kabKotaAwal">Kab/Kota Awal</label>
                                    <input type="text" class="form-control" id="kabKotaAwal" name="kab_kota_awal" placeholder="Masukkan Kab/Kota Awal">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="kabKotaBaru">Kab/Kota Baru</label>
                                    <input type="text" class="form-control" id="kabKotaBaru" name="kab_kota_baru" placeholder="Masukkan Kab/Kota Baru">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="provinsiAwal">Provinsi Awal</label>
                                    <input type="text" class="form-control" id="provinsiAwal" name="provinsi_awal" placeholder="Masukkan Provinsi Awal">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="provinsiBaru">Provinsi Baru</label>
                                    <input type="text" class="form-control" id="provinsiBaru" name="provinsi_baru" placeholder="Masukkan Provinsi Baru">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    function openUploadModal(pemohonId) {
        $('#pemohon_id').val(pemohonId); // Set the pemohon ID in the hidden field
        $('#uploadDocumentModal').modal('show'); // Show the modal
    }

    $(document).ready(function() {
        $('#pemohonInformasi').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('pemohon.ubahStatus.data') }}',
            columns: [
                { data: 'pemohon', name: 'pemohon' },                  
                { data: 'perkara', name: 'perkara' },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },                                   
            ]
        });
    });

    function cancelSubmission(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pengajuan dengan ini akan dibatalkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, batalkan!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, tampilkan input textarea
                Swal.fire({
                    title: 'Alasan Pembatalan',
                    input: 'textarea',
                    inputPlaceholder: 'Masukkan alasan pembatalan di sini...',
                    inputAttributes: {
                        'aria-label': 'Masukkan alasan pembatalan'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Kirim',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    preConfirm: (reason) => {
                        if (!reason) {
                            Swal.showValidationMessage('Alasan pembatalan wajib diisi!');
                            return false;
                        }
                        return reason;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const reason = result.value; // Alasan pembatalan dari textarea
                        // Lakukan permintaan POST
                        fetch("{{ route('batal.siramasakan') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}" // Token CSRF
                            },
                            body: JSON.stringify({ id: id, reason: reason }) // Kirim ID dan alasan
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Dibatalkan!',
                                    'Pengajuan berhasil dibatalkan.',
                                    'success'
                                ).then(() => {
                                    // Reload DataTable setelah sukses
                                    $('#pemohonInformasi').DataTable().ajax.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Gagal',
                                    'Pengajuan gagal dibatalkan.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            Swal.fire(
                                'Error',
                                'Terjadi kesalahan pada server.',
                                'error'
                            );
                        });
                    }
                });
            }
        });
    }



    function toggleUploadOption() {
        const uploadOption = document.getElementById('uploadOption').value;
        document.getElementById('manualUploadDiv').style.display = uploadOption === 'manual' ? 'block' : 'none';
        document.getElementById('urlUploadDiv').style.display = uploadOption === 'url' ? 'block' : 'none';
    }

    function toggleStatusFields() {
        const isChecked = document.getElementById('ubahStatus').checked;
        document.getElementById('statusFields').style.display = isChecked ? 'flex' : 'none';
    }

    function toggleAlamatFields() {
        const isChecked = document.getElementById('ubahAlamat').checked;
        document.getElementById('alamatFields').style.display = isChecked ? 'block' : 'none';
    }

    document.getElementById('ubahStatus').addEventListener('change', toggleStatusFields);
    document.getElementById('ubahAlamat').addEventListener('change', toggleAlamatFields);

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
{{-- <script>
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
  <script>
    // Function to show/hide additional input fields based on the checkbox state
    function toggleAdditionalFields(checkboxId, fieldsId) {
        const checkbox = document.getElementById(checkboxId);
        const fields = document.getElementById(fieldsId);
        fields.style.display = checkbox.checked ? 'block' : 'none';
    }

    // Add event listeners to the checkboxes
    const checkboxes = document.querySelectorAll('.form-check-input');
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            if (checkbox.id === 'gantiNama') {
                toggleAdditionalFields('gantiNama', 'gantiNamaFields');
            } else if (checkbox.id === 'gantiAgama') {
                toggleAdditionalFields('gantiAgama', 'gantiAgamaFields');
            } else if (checkbox.id === 'gantiKelamin') {
                toggleAdditionalFields('gantiKelamin', 'gantiKelaminFields');
            } else if (checkbox.id === 'gantiKewarganegaraan') {
                toggleAdditionalFields('gantiKewarganegaraan', 'gantiKewarganegaraanFields');
            } else if (checkbox.id === 'gantiStatus') {
                toggleAdditionalFields('gantiStatus', 'gantiStatusFields');
            }  else if (checkbox.id === 'gantiStatus') {
                toggleAdditionalFields('gantiStatus', 'gantiStatusFields');
            }  else if (checkbox.id === 'gantiPindahTempatTinggal') {
                toggleAdditionalFields('gantiPindahTempatTinggal', 'gantiPindahTempatTinggalFields');
            }
            // Add similar conditions for other checkboxes and their respective fields
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Function to handle when the modal is opened
        $('[id^=modalStatus]').on('show.bs.modal', function (event) {
            var modalId = $(this).attr('id');
            var selectElement = $('#' + modalId + ' select');
            var catatanField = $('#' + modalId + ' #catatanField' + modalId.replace('modalStatus', ''));

            // When select changes, show or hide the notes field
            selectElement.change(function() {
                if ($(this).val() == '2') {
                    catatanField.show();
                } else {
                    catatanField.hide();
                }
            });

            // Trigger the change event on modal open to reset visibility of catatan field
            selectElement.trigger('change');
        });
    });
</script> --}}

@endpush