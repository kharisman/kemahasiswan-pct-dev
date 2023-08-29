@extends('iduka/layouts.app')

@section('title', 'Dashboard')

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
                                <p>{!! $project->notes !!}</p>
                                <a href="{{ route('edit_status', ['id' => $project->id]) }}" class="btn btn-primary">Actions</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Kamu belum membuat proyek.</p>
                    <a class="nav-link" href="{{ route('create_project') }}">Buat proyek baru</a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
