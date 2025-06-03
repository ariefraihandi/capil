<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />    
  
    <title>{{$title}} | {{$subtitle}}</title>
  
    <meta name="description" content="{{$description ?? 'Portal MS Lhokseumawe'}}" />
    <meta name="keywords" content="{{$keywords ?? 'Portal MS Lhokseumawe'}}" />
    <meta name="author" content="{{$author ?? 'ariefraihandi'}}" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{$title}}" />
    <meta property="og:description" content="{{$description ?? 'Portal MS Lhokseumawe'}}" />
    <meta property="og:image" content="{{ asset('assets') }}/img/og-image.jpg" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets') }}/img/favicon/favicon.ico" />
  
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/pages/front-page.css" />
    
    <!-- Stack Scripts -->
    @stack('head-script')
    
    <!-- Helpers and Template Customizer -->
    <script src="{{ asset('assets') }}/vendor/js/helpers.js"></script>
    <script src="{{ asset('assets') }}/vendor/js/template-customizer.js"></script>
    <script src="{{ asset('assets') }}/js/front-config.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  @stack('style-head')