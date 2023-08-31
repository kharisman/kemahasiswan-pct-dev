<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('iduka.index')}}">
    <div class="sidebar-brand-icon ">
    <img src="{{asset('landingpage/images/Logo-1.jpg')}}" alt="Image" class="img-fluid" height="50" width="55">
    </div>
    <div class="sidebar-brand-text mx-3">X Iduka </div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{route('iduka.index')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Management</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Berkas</h6>
            <a class="collapse-item" href="{{route('iduka.data_apply')}}">Pelamar </a>
            <a class="collapse-item" href="{{route('iduka.data_apply_diterima')}}">Diterima </a>
            <a class="collapse-item" href="{{route('iduka.data_apply_ditolak')}}">Ditolak </a>
            <a class="collapse-item" href="{{route('iduka.all_project')}}">Semua Project</a>
            <a class="collapse-item" href="{{route('iduka.aktif_project')}}">Project Aktif</a>
            <a class="collapse-item" href="{{route('iduka.selesai_project')}}">Projects selesai</a>
        </div>
    </div>
</li>

<!-- Heading -->
<div class="sidebar-heading">
    input
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
   

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{route('create_project')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>Buat Project</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('iduka.ongoing_progress')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>Project ongoing</span></a>
</li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

  <!-- Sidebar Message -->
  
</ul>

<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingin keluar dari sesi?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">pilih tombol logout jika ingin keluar </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
    </div>
</div>
</div>
</div>
