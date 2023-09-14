@extends('iduka.layouts.app')

@section('title', 'Daftar Tugas')
@section('toolbar')
    <a  href="{{ route('tasks.create', ['project' => $project->id]) }}" class=" btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Tugas</a>
@endsection
@section('contents')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Tugas untuk Proyek: {{ $project->name }}</h6>
    </div>

     <div class="card-body">
    <table class="table" id="dataTable">
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
                    ,
                    <!-- Jika bukan internship terakhir, tambahkan koma -->
                    @endif
                    @endforeach
                </td>
                <td>
                    {{ $task->status_task }}</td>
                <td>
                    <a class="btn btn-primary"  href="{{ route('task.edit', ['task' => $task->id]) }}">
                        Edit 
                    </a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
