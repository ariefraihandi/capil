@extends('IndexPortal.app')

@push('head-script')
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/@form-validation/umd/styles/index.min.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/sweetalert2/sweetalert2.css" /> 
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Menu / {{$title}}</h4>       
    <!-- Role cards -->
    <div class="row g-4">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                <button
                    data-bs-target="#modalAddMenus"
                    data-bs-toggle="modal"
                    class="btn btn-primary mt-1 text-nowrap add-new-role">
                    Add Menu
                </button>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                    <h4 class="mb-1">Menu: {{ $menus->count() }}</h4>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                <button
                    data-bs-target="#modalAddSubmenus"
                    data-bs-toggle="modal"
                    class="btn btn-primary mt-1 text-nowrap add-new-role">
                    Add Sub Menu
                </button>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                    <h4 class="mb-1">Sub Menu: {{ $menuSubs->count() }}</h4>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">                
                <button
                    data-bs-target="#modalAddChildSubmenus"
                    data-bs-toggle="modal"
                    class="btn btn-primary mb-1 text-nowrap add-new-role">
                    Add Child Menu
                </button>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                    <h4 class="mb-1">Child Menu: {{ $menuSubChildren->count() }}</h4>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">                
                <button
                    data-bs-target="#modalAddRoles"
                    data-bs-toggle="modal"
                    class="btn btn-primary mt-1 text-nowrap add-new-role">
                    Add Role
                </button>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                    <h4 class="mb-1">Role: {{ $roleList->count() }}</h4>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 order-0 order-md-1">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item col-3">
                    <a class="nav-link" href="/admin/menu/menulist"><i class="bx bx-menu-alt-left me-1"></i>Menu</a>
                </li>
                <li class="nav-item col-3">
                    <a class="nav-link active" href="/admin/menu/submenulist"><i class="bx bx-menu me-1"></i>Submenu</a>
                </li>
                <li class="nav-item col-3">
                    <a class="nav-link" href="/admin/menu/childmenulist"><i class="bx bx-menu-alt-right me-1"></i>Child Menu</a>
                </li>
                <li class="nav-item col-3">
                    <a class="nav-link" href="/admin/menu/role"><i class="bx bx-lock-open-alt me-1"></i>Role</a>
                </li>
            </ul>
            <!-- Role Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="menus-table" class="datatables-users table border-top">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Submenu</th>
                                <th>Menu</th>
                                <th>order</th>
                                <th>url</th>
                                <th>dropdown</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            
            <!--/ Role Table -->
        </div>
    </div>
  </div>
     
<div class="modal fade" id="modalAddMenus" tabindex="-1" aria-labelledby="modalAddMenusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddMenusLabel">Add Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMenuForm" action="{{ route('menu.add') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="menuName" class="form-label">Menu Name</label>
                        <input type="text" class="form-control" id="menuName" name="menu_name" required>
                    </div>
                    <div class="mb-3" style="display:none;">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="1" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked>
                        <label class="form-check-label" for="status">Activate Menu</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Menu</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAddSubmenus" tabindex="-1" aria-labelledby="modalAddSubmenusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddSubmenusLabel">Add Submenu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addSubmenuForm" action="{{ route('add.submenu') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="submenuName" class="form-label">Submenu Name</label>
                        <input type="text" class="form-control" id="submenuName" name="submenu_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="menuId" class="form-label">Select Menu</label>
                        <select class="select2 form-select" id="menuId" name="menu_id" data-allow-clear="true" required>
                            <option value="">Select a menu</option>
                            @foreach($menus as $menuItem)
                                <option value="{{ $menuItem->id }}">{{ ucfirst($menuItem->menu_name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3" style="display:none;">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="text" class="form-control" id="url" name="url" required>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="itemSub" name="itemsub" value="1">
                        <label class="form-check-label" for="itemSub">Enable Dropdown</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="submenuStatus" name="status" value="1" checked>
                        <label class="form-check-label" for="submenuStatus">Activate Submenu</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Submenu</button>
                </form>
            </div>            
        </div>
    </div>
</div>

<div class="modal fade" id="modalAddChildSubmenus" tabindex="-1" aria-labelledby="modalAddChildSubmenusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddChildSubmenusLabel">Add Child Submenu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addChildSubmenuForm" action="{{ route('add.ChildSubmenu') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="childsubmenuName" class="form-label">Child Submenu Name</label>
                        <input type="text" class="form-control" id="childsubmenuName" name="childsubmenu_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="submenuId" class="form-label">Select Submenu</label>
                        <select class="select2 form-select" id="submenu_id" name="submenu_id" data-allow-clear="true" required>
                            <option value="">Select a submenu</option>
                            @foreach($menuSubs as $sub)
                                <option value="{{ $sub->id }}">{{ ucfirst($sub->title) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3" style="display:none;">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="text" class="form-control" id="url" name="url" required>
                    </div>                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="childSubmenuStatus" name="childSubmenuStatus" value="1" checked>
                        <label class="form-check-label" for="childSubmenuStatus">Activate Child Submenu</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Child Submenu</button>
                </form>
            </div>            
        </div>
    </div>
</div>
@endsection

@push('footer-script')            
<script src="{{ asset('assets') }}/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="{{ asset('assets') }}/vendor/libs/sweetalert2/sweetalert2.js"></script>
@endpush

@push('footer-Sec-script')
{{-- <script src="{{ asset('assets') }}/js/app-access-roles.js"></script> --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#menus-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('getDatasubMenu') !!}',
            columns: [
              { data: 'no', name: 'no' },
              { data: 'Submenu', name: 'Submenu' },
              { data: 'Menu', name: 'Menu' },
              { data: 'order', name: 'order' },
              { data: 'url', name: 'url' },
              { data: 'dropdown', name: 'dropdown' },
              { data: 'status', name: 'status' },
              { data: 'action', name: 'action' },
          ]
      });
  });
</script>

<script>
    function moveItem(itemId, direction, event) {
        event.preventDefault();
        // Logic to move the item up or down
        // You might want to send an AJAX request to your server to update the order in the database
        $.ajax({
            url: '/move-submenu',
            method: 'POST',
            data: {
                id: itemId,
                direction: direction,
                _token: '{{ csrf_token() }}' // Include CSRF token if using Laravel
            },
            success: function(response) {
                // Jika berhasil, perbarui datatabel
                $('#menus-table').DataTable().ajax.reload();
            },
            error: function(xhr) {
                // Handle error
                alert('An error occurred while moving the item.');
            }
        });
    }
</script>

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