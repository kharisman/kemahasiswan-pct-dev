@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
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
                        <h4 class="card-title">Project Sedang Berlangsung</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered border-primary table-hover table-striped">
                                <thead>
                                    <tr class="table-dark text-center">
                                        <th>No</th>
                                        <th>Nama Project</th>
                                        <th>Tanggal Mulai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($onGoingProject <> 0)
                                        @foreach ($onGoingProjectData as $item)
                                            <tr class="table-bordered border-primary">
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->date_start}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="text-center">
                                            <td colspan="4">Tidak ada project yang berlangsung, <a href="{{url('internship-project')}}"> Daftar Sekarang</a></td>
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
