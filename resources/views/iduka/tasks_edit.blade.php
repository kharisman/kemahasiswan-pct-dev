@extends('iduka.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Status Task</h1>

    <form action="{{ route('tasks.update', ['task_id' => $task->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="status_task">Status Task:</label>
            <input type="text" class="form-control" id="status_task" name="status_task" value="{{ $task->status_task }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>

    <a href="{{ route('tasks.byProject', ['project_id' => $task->project_id]) }}" class="btn btn-secondary">Kembali ke Daftar Tugas</a>
</div>
@endsection
