<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets') }}/"
  data-template="vertical-menu-template">
 
@include('IndexPortal.head')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            {{-- @include('IndexPortal.sidebar') --}}
            <div class="layout-page">
                {{-- @include('IndexPortal.navbar') --}}
                <div class="content-wrapper">
                    @yield('content')
                    @include('IndexPortal.footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
     
        <div class="layout-overlay layout-menu-toggle"></div>

        <div class="drag-target"></div>
    </div>
    @include('IndexPortal.script')
</body>

</html>
