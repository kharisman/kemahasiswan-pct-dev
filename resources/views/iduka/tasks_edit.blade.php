@extends('iduka.layouts.app')

@section('title', 'Edit Tugas')

@section('contents')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Tugas: {{ $task->name }}</h6>
    </div>
    <div class="card-body">
        <form method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Tugas</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $task->name) }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $task->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status_task">Status Pengerjaan Task : {{$task->status_task}}</label>

                <div class="form-group">
                    <select name="status_task" class="form-control status-dropdown @error('status_task') is-invalid @enderror">
                        <option value="">Beri status</option>
                        <option value="Belum Dimulai" {{ old('status_task', $task->status_task) == 'Belum Dimulai' ? 'selected' : '' }}>Belum Dimulai</option>
                        <option value="Sedang Dikerjakan" {{ old('status_task', $task->status_task) == 'Sedang Dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                        <option value="Selesai" {{ old('status_task', $task->status_task) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Batal" {{ old('status_task', $task->status_task) == 'Batal' ? 'selected' : '' }}>Batal</option>
                    </select>
                    @error('status_task')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Tambahkan field lain sesuai kebutuhan -->

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            
            <a href="{{ route('tasks.byProject', ['project_id' => $task->project_id]) }}"  class="btn btn-success"> Kembali </a>
        </form>    
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> History Perubahan</h6>
    </div>
     <div class="card-body">
    <table class="table" id="dataTable">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($task->taskHistories as $task)
            <tr>
                <td>{{ $task->created_at }}</td>
                <td>{{ $task->description }}</td>
                          
            </tr>
            @endforeach
        </tbody>
    </table>
    </div> 
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({

        });
    });

</script>
@endsection
