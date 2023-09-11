@extends('iduka.layouts.app')
@section('title', 'Daftar Pelamar Project')
@section('contents')


<div class="card shadow mb-4">
    <div class="card-body table-responsive">

        <div class="row mb-3">
    <div class="col-md-12">
        <form method="GET" class="form-inline">
            <div class="form-group mr-2">
                <label for="project_name">Project:</label>
                <input type="text" name="project_name" id="project_name" class="form-control" placeholder="Ketikkan Nama Proyek" value="{{ request('project_name') }}">
            </div>

            <div class="form-group mr-2">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Menunggu</option>
                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Diterima</option>
                    <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>
</div>


        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Project Name</th>
                    <th>Internship Name</th>
                    <th>Status</th>
                    <th>Tanggal Apply</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projectApplies as $projectApply)
                <tr>
                    <td>{{ $projectApply->id }}</td>
                    <td>{{ $projectApply->project->name }}</td>
                    <td>{{ $projectApply->internship->name }}</td>
                    <td>
                        @if($projectApply->status )
                        {{ $projectApply->status }}
                        @else
                        Menunggu
                        @endif
                    </td>
                    <td>{{ $projectApply->created_at }}</td>
                    <td>
                        <a href="{{ route('iduka.detail_apply', ['projectApplyId' => $projectApply->id]) }}" class="btn btn-success ">
                            <i class="fas fa-info-circle"></i> Info profile Intern
                        </a>
                        <button class="btn btn-primary open-modal" data-toggle="modal" data-target="#statusModal" data-projectapplyid="{{ $projectApply->id }}">
                            Ubah Status
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal di luar foreach -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="status-form" action="{{ route('edit.status') }}" method="POST">
                @csrf
                <input type="hidden" name="projectApplyId" id="projectApplyId">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Ubah Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="new_status">Beri Status:</label>
                        <select name="new_status" class="form-control status-dropdown">
                            <option value="">Beri status</option>
                            <option value="accepted">Diterima</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
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

<script>
    // JavaScript untuk mengisi formulir modal dengan data yang sesuai saat tombol "Ubah Status" diklik
    $('.open-modal').click(function() {
        var projectApplyId = $(this).data('projectapplyid');
        $('#projectApplyId').val(projectApplyId);
    });

</script>

@endsection
