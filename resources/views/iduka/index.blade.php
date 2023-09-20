@extends('iduka/layouts.app')

@section('title', 'Dashboard')

@section('contents')


<!-- Begin Page Content -->

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Project</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $projectsCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pelamar
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $applicantsCount }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Diterima</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $applicantsAcceptedCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Ditolak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $applicantsRejectedCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Content Row -->

<!-- Project Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Projects Terbaru</h6>
    </div>
    <div class="card-body">
        @if ($latestProject->count() > 0)
        <div class="table-responsive table-responsive-lg">
            <table class="table table-bordered" id="latestProjectsTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Proyek</th>
                        <th>Status</th>
                        <th>Tanggal Registrasi</th>
                        <th>Dikunjungi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($latestProject as $latestProject)
                    <tr>
                        <td>{{ $latestProject->id }}</td>
                        <td>{{ $latestProject->name }}</td>
                        <td>{{ $latestProject->status }}</td>
                        <td>
                            {{ date('d M Y', strtotime($latestProject->registration_start_at)) }}
                            sampai
                            {{ date('d M Y', strtotime($latestProject->registration_end_at)) }}
                        </td>
                        <td>{{ $latestProject->views }}</td>
                        <td><a href="{{ route('project.details', ['projectId' => $latestProject->id]) }}" class="btn btn-primary">Lihat Detail</a></td>
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div>
        @else
        <p>Kamu belum membuat project.</p>
        <a class="nav-link" href="{{ route('create_project') }}">Buat proyek baru</a>
        @endif
    </div>
</div>

<!-- persentase task -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6  class="m-0 font-weight-bold text-primary">Persentase Tasks selesai</h6>
    </div>
    <div class="card-body">
        @foreach ($projects as $project)
            <a class="big font-weight-bold" href="{{ route('tasks.byProject', ['project_id' => $project->id]) }}">Project 
                {{ $project->name }}
                <span class="float-right">{{ number_format($project->completionPercentage, 2) }}%</span>
            </a>
            <div class="progress mb-4">
                @if ($project->completionPercentage < 100)
                    <div class="progress-bar bg-danger" role="progressbar"
                         style="width: {{ $project->completionPercentage }}%"
                         aria-valuenow="{{ $project->completionPercentage }}"
                         aria-valuemin="0" aria-valuemax="100">
                    </div>
                @else
                    <div class="progress-bar bg-success" role="progressbar"
                         style="width: {{ $project->completionPercentage }}%"
                         aria-valuenow="{{ $project->completionPercentage }}"
                         aria-valuemin="0" aria-valuemax="100">
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Documentasi</h6>
        </div>
        <div class="card-body">
            <div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/team.svg" alt="...">
            </div>
            <p> Alur kerja sama </p>
            <a target="_blank" rel="nofollow" href="https://palcomtech.ac.id">search &rarr;</a>
        </div>
    </div>



@endsection

</html>