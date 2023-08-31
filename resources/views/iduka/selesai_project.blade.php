@extends('iduka/layouts.app')

@section('title', 'Project Selesai')

@section('contents')

<div class="row">
    <!-- Content Column -->
    <div class="col-lg-12">
        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
            </div>
            <div class="card-body">
                @if(count($projects) > 0)
                    @foreach ($projects as $project)
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <h5 class="card-title">{{ $project->name }} Project </h5>
                            </div>
                            <div class="card-body">
                                <p>Status: {{ $project->status }}</p>
                                <p>Level: {{ $project->level }} </p>
                                <p>Tanggal Registrasi: {{ $project->registration_start_at }} sampai dengan{{ $project->registration_end_at}}  </p>
                                <p>Akan mulai tanggal: {{ $project->work_start_at }} sampai dengan{{ $project->work_end_at}}  </p>
                                Keterangan
                                <p>{!! $project->notes !!}</p>
                                <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                            </button>
                            <div class="dropdown-menu">
                             
                            </div>
                        </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Kamu belum ada projek yang telah selesai.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
