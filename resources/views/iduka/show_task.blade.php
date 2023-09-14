@extends('iduka.layouts.app')

@section('contents')
<div class="container">
    <h1>Daftar Tugas untuk Proyek: {{ $project->name }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nama Tugas</th>
                <th>Deskripsi</th>
                <th>Nama Internship</th>
                <th>Status Pengerjaan Task</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                <td>
                    @foreach ($task->internships as $internship)
                    {{ $internship->name }}
                    @if (!$loop->last)
                    , <!-- Jika bukan internship terakhir, tambahkan koma -->
                    @endif
                    @endforeach
                </td>
                <td>
                    {{ $task->status_task }}</td> <td>
                    <button class="btn btn-primary open-modal" data-toggle="modal" data-target="#editStatusTaskModal" data-taskid="{{ $task->id }}">
                        Edit Status
                    </button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Edit Status Task -->
    <div class="modal fade" id="editStatusTaskModal" tabindex="-1" role="dialog" aria-labelledby="editStatusTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form action="{{ route('tasks.update', ['task_id' => $task->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- Tambahkan input tersembunyi untuk mengirim task_id -->
    <input type="hidden" name="task_id" value="{{ $task->id }}">

    <div class="modal-header">
        <!-- ... -->
    </div>

    <div class="modal-body">
        <div class="form-group">
            <label for="status_task">Beri Status:</label>
            <select name="status_task" class="form-control status-dropdown">
            <option value="">Beri status</option>
                <option value="Belum Dimulai">Belum Dimulai</option>
                <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                <option value="Selesai">Selesai</option>
                <option value="Batal">Batal</option>
            </select>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form>


                  
            
            </div>
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
