@extends('iduka/layouts.app')

@section('title', 'Semua Project')

@section('contents')
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('iduka.all_project') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Cari project berdasarkan nama project...">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>

        @if ($projects->isEmpty())
            <p>Tidak ditemukan nama project yang sesuai.</p>
        @endif
    </div>
</div>

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
                        <p>Status: {{ $project->status }} </p>
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
                                <a class="dropdown-item" href="{{ route('edit_project', ['id' => $project->id]) }}">Edit</a>
                                <a class="dropdown-item" href="{{ route('edit_status', ['id' => $project->id]) }}">Change status</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal-{{ $project->id }}">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal-{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-{{ $project->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <!-- ... Bagian modal ... -->
                        <div class="modal fade" id="deleteModal-{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-{{ $project->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel-{{ $project->id }}">Delete Project</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this project?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <form action="{{ route('delete_project', ['id' => $project->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>Kamu belum membuat project.</p>
            <a class="nav-link" href="{{ route('create_project') }}">Buat proyek baru</a>
        @endif
    </div>
</div>
@endsection
