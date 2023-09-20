@extends('iduka/layouts.app')

@section('title', 'Detail Project')

@section('contents')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Project: {{ $project->name }}</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                
                @foreach ($categories as $category)
                <div class="form-group">
                    <label class="label-fixed-width"><strong>Kategori:</strong></label>
                    {{ $project->category->category }}
                </div>
                @endforeach
                <div class="form-group">
                    <label class="label-fixed-width"><strong>Status:</strong></label>
                    {{ $project->status }}
                </div>
                <div class="form-group">
                    <label class="label-fixed-width"><strong>Level:</strong></label>
                    {{ $project->level }}
                </div>
                <div class="form-group">
                    <label class="label-fixed-width"><strong>Catatan:</strong></label>
                    {!! $project->notes !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-fixed-width"><strong>Mulai Pendaftaran:</strong></label>
                    {{ $project->registration_start_at }}
                </div>
                <div class="form-group">
                    <label class="label-fixed-width"><strong>Selesai Pendaftaran:</strong></label>
                    {{ $project->registration_end_at }}
                </div>
                <div class="form-group">
                    <label class="label-fixed-width"><strong>Mulai Pekerjaan:</strong></label>
                    {{ $project->work_start_at }}
                </div>
                <div class="form-group">
                    <label class="label-fixed-width"><strong>Selesai Pekerjaan:</strong></label>
                    {{ $project->work_end_at }}
                </div>
                <div class="form-group">
                    <label class="label-fixed-width"><strong>Jumlah Views:</strong></label>
                    {{ $project->views }}
                </div>
                <div class="form-group">
                    <label class="label-fixed-width"><strong>Status Pekerjaan:</strong></label>
                    {{ $project->status_work }}
                </div>
            </div>
        </div>

        <!-- Menampilkan Catatan Progres -->
        <h5 class="mt-4">Catatan Progres Project</h5>
        @foreach ($project->progress as $progress)
        <div class="media mb-3">
            <div class="media-body">
                <h6 class="mt-0">{{ date('d, M Y', strtotime($progress->created_at ))}}</h6>
                <p>{{ $progress->notes }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .label-fixed-width {
        min-width: 100px; /* Sesuaikan lebar minimum yang Anda inginkan */
        display: inline-block;
    }
</style>

@endsection
