<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets') }}/"
  data-template="vertical-menu-template">
  
@include('IndexMisc.head')

<body>
    
    @yield('content')
    
    @include('IndexMisc.script')
</body>

</html>
