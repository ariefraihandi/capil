<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets') }}/"
  data-template="vertical-menu-template">
  
@include('IndexLandingPage.head')

<body>
  <script src="{{ asset('assets') }}/vendor/js/dropdown-hover.js"></script>
  <script src="{{ asset('assets') }}/vendor/js/mega-dropdown.js"></script>
    @include('IndexLandingPage.navbar')
    
    @yield('content')
    
    {{-- @include('IndexLandingPage.footer') --}}
    
    @include('IndexLandingPage.script')
</body>

</html>
