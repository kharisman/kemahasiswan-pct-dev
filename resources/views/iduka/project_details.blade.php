@extends('iduka/layouts.app')

@section('title', 'Detail Project')

@section('contents')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Project: {{ $project->name }}</h6>
    </div>
    <div class="card-body">
        <p><strong>ID Proyek:</strong> {{ $project->id }}</p>
        @foreach ($categories as $category)
        <!-- Menampilkan Kategori Proyek -->
        <p><strong>Kategori:</strong> {{ $project->category->category }}</p>
        @endforeach
        <p><strong>ID Pengguna:</strong> {{ $project->iduka_id }}</p>
        <p><strong>Catatan:</strong> {!! $project->notes !!}</p>
        <p><strong>Status:</strong> {{ $project->status }}</p>
        <p><strong>Level:</strong> {{ $project->level }}</p>
        <p><strong>Mulai Pendaftaran:</strong> {{ $project->registration_start_at }}</p>
        <p><strong>Selesai Pendaftaran:</strong> {{ $project->registration_end_at }}</p>
        <p><strong>Mulai Pekerjaan:</strong> {{ $project->work_start_at }}</p>
        <p><strong>Selesai Pekerjaan:</strong> {{ $project->work_end_at }}</p>
        <p><strong>Jumlah Views:</strong> {{ $project->views }}</p>
        <p><strong>Status Pekerjaan:</strong> {{ $project->status_work }}</p>

        <!-- Menampilkan Catatan Progres -->
        <h5>Catatan Progres</h5>
        @foreach ($project->progress as $progress)
            <p><strong>{{ date('d, M Y', strtotime($progress->created_at ))}}:</strong> {{ $progress->notes }}</p>
        @endforeach

     
    </div>
</div>
@endsection
