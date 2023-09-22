<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Internship | Palcomtech</title>
  <link rel="stylesheet" href="{{asset('internship/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('internship/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('internship/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('internship/css/sweetalert2.min.css')}}">
  <link rel="stylesheet" href="{{asset('internship/dropzone/min/dropzone.min.css')}}">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>
<body>
  <div class="container-scroller d-flex">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="sidebar-category">
          <p>INTERNSHIP</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('internship-index')}}">
            <i class="mdi mdi-chart-bar menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('internship-project') }}">
            <i class="mdi mdi-view-headline menu-icon"></i>
            <span class="menu-title">Project</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('internship-history')}}">
            <i class="mdi mdi-box menu-icon"></i>
            <span class="menu-title">Riwayat</span>
          </a>
        </li>
      </ul>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="navbar-brand-wrapper">
            <a class="navbar-brand brand-logo" href=""><img src="{{asset('landingpage/images/logo-1.jpg')}}" width="50" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href=""><img src="{{asset('landingpage/images/logo-1.jpg')}}" height="55" width="30" alt="logo"/></a>
          </div>
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1">Selamat datang, 
            @if (Auth::check())
            <?php
                $internship = App\Models\Internship::where('user_id', Auth::user()->id)->first();
                $name = $internship ? $internship->name : '';
                $dateSign = ($internship->created_at)->format('j'). " days ago";
                if ($internship->photo <> '') {
                  $photo = $internship->photo;
                }else {
                  $photo = 'undraw_profile.svg';
                }
                $condition = 0;

                if ($internship->phone == "") {
                    $condition++;
                }

                if (session('successProject')) {
                    $condition++;
                }

                if ($dateSign < 1) {
                    $condition++;
                }
            ?>
            {{ $name }}
            @endif
        
          </h4>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item">
              <h4 class="mb-0 font-weight-bold d-none d-xl-block">
                {{ now()->format('F d, Y') }}
              </h4>
            </li>
            <li class="nav-item dropdown me-2">
              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-email-open mx-0"></i>
                @if ($condition >= 1)
                  <span class="count bg-danger">{{$condition}}</span>
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Pesan</p>
                @if ($internship->phone == "")
                  <a class="dropdown-item preview-item" href="{{url('internship-data')}}">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-danger">
                        <i class="mdi mdi-information mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal">Lengkapi Data Pribadi</h6>
                      <p class="font-weight-light small-text mb-0 text-muted">
                        Sekarang, untuk bisa mendaftar project
                      </p>
                    </div>
                </a>  
                @endif
                @if (session('successProject'))
                <a class="dropdown-item preview-item" href="{{url('internship-index')}}">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-settings mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Pendaftaran Project Sedang ditinjau</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      Proses Berhasil
                    </p>
                  </div>
                </a>
                @endif
                @if ($dateSign < 1)
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-account-box mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Pengguna Baru</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      {{$dateSign}}
                    </p>
                  </div>
                </a>
                @endif
              </div>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                <img src="{{ asset('images/internship/' . $photo) }}" width="55" alt="profile"/>
                <span class="nav-profile-name">{{$name}}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{url('internship-data')}}">
                  <i class="mdi mdi-settings text-primary"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="{{url('/')}}">
                  <i class="mdi mdi-menu text-primary"></i>
                  Landing page
                </a>
                <a class="dropdown-item" href="{{url('logout')}}">
                  <i class="mdi mdi-logout text-primary"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <div class="main-panel">
        @yield('contentInternship')
        <footer class="footer">
          <div class="card">
            <div class="card-body">
              <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">©Institut Teknologi dan Bisnis PalComTech – 2023 &copy;All rights reserved.</span>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>


  <script src="{{asset('internship/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('internship/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('internship/js/off-canvas.js')}}"></script>
  <script src="{{asset('internship/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('internship/js/template.js')}}"></script>
  <script src="{{asset('internship/js/dashboard.js')}}"></script>
  <script src="{{asset('internship/css/jquery.js')}}"></script>
  <script src="{{asset('internship/css/sweetalert2.all.min.js')}}"></script>
  <script src="{{asset('internship/vendors/scriptdatatables.js')}}"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  
  <script>
      $(document).ready(function() {
          var table = $('#dataTable').DataTable({
  
          });
      });
  
  </script>
  <script src="{{asset('internship/dropzone/min/dropzone.min.js')}}"></script>
</body>
</html>