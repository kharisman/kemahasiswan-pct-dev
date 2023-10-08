@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
        @if(session('successProject'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            Swal.fire(
                'Data Berhasil Dikirimkan!',
                'Status project dalam tinjau Mohon Cek Pesan secara berskala',
                'success'
            );
            });
        </script>
        @endif
        @if($data->phone == "")
        <script>
            document.addEventListener('DOMContentLoaded', function(){
                Swal.fire({
                title : 'Data Belum Lengkap!',
                text : 'Mohon lengkapi data pengguna',
                icon : 'warning',
                confirmButtonText : 'OK'
                }).then((result) =>{
                  if(result.isConfirmed){
                      window.location.href = '{{url('internship-data')}}';
                  }  
                });
            });
        </script>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger w-100">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-facebook d-flex align-items-center">
                    <div class="card-body py-5">
                        <div
                            class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                            <i class="mdi mdi-checkbox-multiple-marked text-white icon-lg"></i>
                            <div class="ms-3 ml-md-0 ml-xl-3">
                                <h5 class="text-white font-weight-bold">Project Selesai</h5>
                                <p class="mt-2 text-white card-text">{{$completedProject}} Project</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-twitter d-flex align-items-center">
                    <div class="card-body py-5">
                        <div
                            class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                            <i class="mdi mdi-calendar-remove text-white icon-lg"></i>
                            <div class="ms-3 ml-md-0 ml-xl-3">
                                <h5 class="text-white font-weight-bold">Project Ditolak</h5>
                                <p class="mt-2 text-white card-text">{{$rejectProject}} Project</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-facebook d-flex align-items-center">
                    <div class="card-body py-5">
                        <div
                            class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                            <i class="mdi mdi-clipboard-text text-white icon-lg"></i>
                            <div class="ms-3 ml-md-0 ml-xl-3">
                                <h5 class="text-white font-weight-bold">Project Berjalan</h5>
                                <p class="mt-2 text-white card-text">{{$onGoingProject}} Project</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Project Berlangsung</h4>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="text-center table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Project</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Status Project</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($onGoingProject <> 0 || $completedProject <> 0)
                                        @foreach ($onGoingProjectData as $item)
                                            <tr>
                                                <td class="text-center" style="width:10px; height:15px;">{{$loop->iteration}}</td>
                                                <td>{{$item->name}}</td>
                                                <td class="text-center">{{$item->work_start_at}}</td>
                                                <td class="text-center">
                                                    @if ($item->status_work == "Selesai" )
                                                        <b class="text-uppercase text-success">{{$item->status_work}}</b>
                                                    @elseif($item->status_work == "Sedang Dikerjakan" )
                                                        <b class="text-uppercase text-warning">{{$item->status_work}}</b>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="text-center">
                                            <td colspan="4"><b> Tidak ada project yang berlangsung, <a href="{{url('internship-project')}}"> <i> Daftar Sekarang</i></b></a></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
