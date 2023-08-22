<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Internship | Dashboard</title>

    <link rel="stylesheet" href="internship/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="internship/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="internship/assets/vendors/css/vendor.bundle.base.css">

    <link rel="stylesheet" href="internship/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="internship/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="internship/assets/css/style.css">
  </head>
  <body>
    <div class="container-scroller">

      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="">INTERNSHIP</a>
          <a class="navbar-brand brand-logo-mini" href=""><img src="assets/images/logo.jpg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>

      <div class="container-fluid page-body-wrapper">

        <nav class="sidebar sidebar-offcanvas" style="background-color: #1F4492;" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-category text-light">Menu</li>
            <li class="nav-item">
              <a class="nav-link" href="beranda.html">
                <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon text-light"></i></span>
                <span class="menu-title text-light">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="history.html">
                <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon text-light"></i></span>
                <span class="menu-title text-light">History Apply</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">
                <span class="icon-bg"><i class="mdi mdi-table-large menu-icon text-light"></i></span>
                <span class="menu-title text-light">Badges</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon text-light"></i></span>
                <span class="menu-title text-light">User Pages</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item text-light"> <a class="nav-link" href="profile.html"> User Profile </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <div class="sidebar-user-menu">
                <a href="index.html" class="nav-link"><i class="mdi mdi-logout menu-icon text-light"></i>
                  <span class="menu-title text-light">Log Out</span></a>
              </div>
            </li>
          </ul>
        </nav>
        <div class="main-panel">
          <div class="content-wrapper text-dark">
            <div class="row g-5 pt-5">
                <div class="col-6 col-md-4">
                    <div class="card h-100">
                        <div class="card-header">
                            User Profile
                        </div>
                        <div class="card-body text-center mb-3">
                          <div class="mb-3">
                            <img src="images/person_1.jpg" class="rounded-circle w-50" alt="">
                          </div>
                          <div class="mb-3">
                            Zeinniko
                          </div>
                          <div class="mb-3">
                            0896 - 8167 - 6100
                          </div>
                          <div class="mb-3">
                            Deskripsi
                          </div>
                            <a href="" class="btn btn-sm btn-primary">Update</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Data Pribadi
                        </div>
                        <div class="card-body">
                                <div class="row mb-3 text-end">
                                    <label for="nama" class="col-sm-4 col-form-label text-end">Nama</label>
                                    <div class="col-sm-8">
                                        <input id="nama" class="form-control" type="text" name="nama" placeholder="nama..." required>
                                    </div>
                                </div>
                                <div class="row mb-3 text-end">
                                    <label for="jenis_kelamin" class="col-sm-4 col-form-label text-end">Jenis Kelamin</label>
                                    <div class="col-sm-8">
                                      <select class="form-control"  name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="">Input jenis kelamin</option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                      </select>
                                    </div>
                                </div>
                                <div class="row mb-3 text-end">
                                    <label for="alamat" class="col-sm-4 col-form-label text-end">Alamat</label>
                                    <div class="col-sm-8">
                                      <textarea class="form-control" name="alamat" id="alamat" cols="32" rows="2" placeholder="alamat..."></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3 text-end">
                                    <label for="foto" class="col-sm-4 col-form-label text-end">Foto</label>
                                    <div class="col-sm-8">
                                      <input id="foto" class="form-control" type="file" name="foto" required>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            
                    <p class="d-inline-flex gap-1 text-end">
                      <div class="text-dark" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Kontak >>
                      </div>
                    </p>
                </div>
                    <div class="collapse" id="collapseExample1">
                      <div class="card card-body">
                        <div class="row mb-3 text-end">
                            <label for="foto" class="col-sm-4 col-form-label text-end">Nomor Telepon</label>
                            <div class="col-sm-8">
                              <input id="foto" class="form-control" type="text" placeholder="nomor telepon ..." name="foto" required>
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="foto" class="col-sm-4 col-form-label text-end">Media Sosial 1</label>
                            <div class="col-sm-8">
                              <input id="foto" class="form-control" type="text" placeholder="url ..." name="foto" required>
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="foto" class="col-sm-4 col-form-label text-end">Media Sosial 2</label>
                            <div class="col-sm-8">
                              <input id="foto" class="form-control" type="text" placeholder="url ..." name="foto" required>
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="foto" class="col-sm-4 col-form-label text-end">Media Sosial 3</label>
                            <div class="col-sm-8">
                              <input id="foto" class="form-control" type="text" placeholder="url ..." name="foto" required>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        
                    <p class="d-inline-flex gap-1 text-end">
                      <div class="text-dark" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Dokumen >>
                      </div>
                    </p>
                </div>
                    <div class="collapse" id="collapseExample2">
                      <div class="card card-body">
                        <div class="row mb-3 text-end">
                            <label for="foto" class="col-sm-4 col-form-label text-end">Dokumen 1</label>
                            <div class="col-sm-8">
                              <input id="foto" class="form-control" type="file" name="foto" required>
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="foto" class="col-sm-4 col-form-label text-end">Dokumen 2</label>
                            <div class="col-sm-8">
                              <input id="foto" class="form-control" type="file" name="foto" required>
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="foto" class="col-sm-4 col-form-label text-end">Dokumen 3</label>
                            <div class="col-sm-8">
                              <input id="foto" class="form-control" type="file" name="foto" required>
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
    <script src="internship/vendors/js/vendor.bundle.base.js"></script>
    <script src="internship/vendors/chart.js/Chart.min.js"></script>
    <script src="internship/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="internship/js/off-canvas.js"></script>
    <script src="internship/js/hoverable-collapse.js"></script>
    <script src="internship/js/template.js"></script>
    <script src="internship/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="internship/js/dashboard.js"></script>
  </body>
  </html>