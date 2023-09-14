@extends('iduka.layouts.app')
@section('title', 'Tambah Tugas')
@section('contents')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Tugas</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('tasks.store', ['project_id' => $project->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="project_id">Nama Project:</label>
                <input type="text" class="form-control" id="project_id" name="project_id" value="{{ $project->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="name">Nama Tugas:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="internship_id">Pilih Internship:</label>
                <select class="form-control" id="internship_id" name="internship_id[]" multiple>
                    <option value="">Pilih Internship</option>
                    @foreach ($projectApplies as $projectApply)
                    @if ($projectApply->status == 'accepted' && $projectApply->project_id == $project->id)
                    <option value="{{ $projectApply->internship_id }}">{{ $projectApply->internship->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Tugas</button>
            <a href="{{ route('tasks.byProject', ['project_id' => $project->id]) }}"  class="btn btn-success">Lihat Tugas</a>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#internship_id').select2();
});
</script>
@endsection
