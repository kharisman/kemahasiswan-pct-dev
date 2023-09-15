@extends('iduka.layouts.app')

@section('contents')
<div class="container">
    <h2>Tambah Catatan Proyek</h2>
    <form method="post" action="{{ route('save_project_progress', ['id' => $project->id]) }}">
        @csrf
        <div class="form-group">
            <label for="notes">Catatan:</label>
            <textarea class="form-control" name="notes" id="notes" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
