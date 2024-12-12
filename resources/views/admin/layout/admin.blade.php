<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>phateme-Web - @yield('title')</title>

  <!-- Custom styles for this template-->
  <link href="{{ asset('/build/assets/css/admin.css')}}" rel="stylesheet">
  {{-- <link href="/dist/mds.bs.datetimepicker.style.css" rel="stylesheet"/> --}}
  <link href="/build/assets/css/mds.bs.datetimepicker.css" rel="stylesheet"/>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('admin.sections.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('admin.sections.topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

         @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('admin.sections.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  @include('admin.sections.scroll_top')

  <!-- JavaScript - Load jQuery and other dependencies first -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>


  <!-- Your custom script - Ensure this is loaded after dependencies -->
  <script type="module" src="{{ asset('/build/assets/js/admin2.js') }}"></script>
  <script src="{{ asset('/build/assets/js/jquery.czMore-latest.js') }}"></script>
  {{-- <script src="node_modules/md.bootstrappersiandatetimepicker/dist/mds.bs.datetimepicker.js"></script> --}}
  <script src="/build/assets/js/mds.bs.datetimepicker.js"></script>

  @include('sweetalert::alert')

  @yield('script')

</body>

</html>
