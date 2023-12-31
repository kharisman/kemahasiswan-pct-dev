<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Palcomtech</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('iduka/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('iduka/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <script src="{{asset('iduka/vendor/jquery/jquery.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    
    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('iduka/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript -->
    <script src="{{asset('iduka/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('iduka/layouts.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('iduka/layouts.navbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
            @yield('toolbar')
          </div>

          @if(Session::has('success'))
              <script>
              $(document).ready( function () {
                  Swal.fire({
                      title: 'Berhasil !',
                      text: '{{ Session::get('success') }}',
                      icon: 'success',
                      confirmButtonText: 'Tutup'
                  })
              } );
              </script>
              @php
              Session::forget('success');
              @endphp
          @endif

          @if(Session::has('error'))
              <script>
              $(document).ready( function () {
                  Swal.fire({
                      title: 'Gagal !',
                      text: '{{ Session::get('error') }}',
                      icon: 'error',
                      confirmButtonText: 'Tutup'
                  })
              } );
              </script>
              @php
              Session::forget('error');
              @endphp
          @endif

          @yield('contents')

          <!-- Content Row -->


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('iduka/layouts.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 

<!-- Custom scripts for all pages -->
<script src="{{asset('iduka/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('iduka/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('iduka/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('iduka/js/demo/chart-pie-demo.js')}}"></script>
    
</body>

</html>
