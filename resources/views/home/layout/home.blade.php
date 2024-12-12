<!DOCTYPE html>
<html class="no-js" lang="fa">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>phateme-Web - @yield('title')</title>

  <!-- Custom styles for this template-->
  <link href="{{ asset('/build/assets/css/home.css')}}" rel="stylesheet">
  <link href="/build/assets/css/mds.bs.datetimepicker.css" rel="stylesheet"/>

</head>

<body>




    <div class="wrapper">


        @include('home.sections.header')
        @include('home.sections.mobile_off_canvas')

        @yield('content')

        @include('home.sections.footer')



  <!-- Your custom script - Ensure this is loaded after dependencies -->
    <script src="{{ asset('/home/jquery-1.12.4.min.js') }}"></script>
    <script type="module" src="{{ asset('/build/assets/js/home2.js') }}"></script>
    <script src="{{ asset('/home/plugins.js') }}"></script>

  @include('sweetalert::alert')

  @yield('script')

</body>

</html>
