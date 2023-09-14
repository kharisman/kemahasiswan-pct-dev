@extends('iduka/layouts.app')

@section('title', 'Semua Project')

@section('contents')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
    </div>
    <div class="card-body">
        
        <form action="{{ route('iduka.all_project') }}" method="GET">
        <div class="row mb-3">
            <div class="col-md-4">
                    <div class="form-group">
                        
                        <label for="level">Proyek:</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari berdasarkan nama project...">
                       
                    </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="level">Level:</label>
                    <select name="level" id="level" class="form-control">
                        <option value="">Semua Level</option>
                        <option value="Mudah" {{ request('level') == 'Mudah' ? 'selected' : '' }}>Mudah</option>
                        <option value="Sedang" {{ request('level') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="Susah" {{ request('level') == 'Susah' ? 'selected' : '' }}>Susah</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="status_work">Status work:</label>
                    <select name="status_work" id="status_work" class="form-control">
                        <option value="">Semua Status work</option>
                        <option value="Belum Dimulai" {{ request('status_work') == 'Belum Dimulai' ? 'selected' : '' }}>Belum Dimulai</option>
                        <option value="Sedang Dikerjakan" {{ request('status_work') == 'Sedang Dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                        <option value="Selesai" {{ request('status_work') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Batal" {{ request('status_work') == 'Batal' ? 'selected' : '' }}>Batal</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Cari & Filter</button>
            </div>
        </div>
        
        </form>
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama Proyek</th>
                    <th>Status</th>
                    <th>Level</th>
                    <th>Tanggal Registrasi</th>
                    <th>Akan Mulai</th>
                    <th>Status Work</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(count($projects) > 0)
                @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->status }}</td>
                    <td>{{ $project->level }}</td>
                    <td>{{ date('d, M Y', strtotime($project->registration_start_at)) }} Hingga {{ date('d, M Y', strtotime($project->registration_end_at)) }}</td>
                    <td>{{ date('d, M Y', strtotime($project->work_start_at)) }} Hingga {{ date('d, M Y', strtotime($project->work_end_at)) }}</td>
                    <td>{{ $project->status_work }}</td>
                    <td> <a href="{{ route('iduka.data_apply', ['id' => $project->id]) }}" class="btn btn-success">Pelamar Project</a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('edit_project', ['id' => $project->id]) }}">Edit</a>
                                <a class="dropdown-item" href="{{ route('edit_status', ['id' => $project->id]) }}">Change status</a>
                                <a class="dropdown-item" href="{{ route('iduka.ongoing_progress.project', ['id' => $project->id]) }}" >Intern Terkait</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal-{{ $project->id }}">Delete</a>
                                <a class="dropdown-item" href="{{ route('tasks.create', ['project' => $project->id]) }}">Tambah Tugas</a>
                                <a class="dropdown-item" href="{{ route('tasks.byProject', ['project_id' => $project->id]) }}">Lihat Tugas Proyek</a>

            
                            </div>
                        </div>
                    </td>
                </tr>
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
                <tr>
                    <td colspan="7">Kamu belum membuat project.
                        @if ($projects->isEmpty())
                        atau Tidak ditemukan nama project yang sesuai.
                        @endif

                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
</div>
<!-- DataTables (pastikan Anda sudah mengunduh dan memasangnya) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({

        });
    });

</script>
@endsection
