@extends('iduka.layouts.app')

@section('contents')
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Catatan progress</h6>
            </div>
<div class="container">
    <h2>Tambah Catatan Proyek</h2>
    <form method="post" action="{{ route('save_project_progress', ['id' => $project->id]) }}">
        @csrf
        <div class="form-group">
            <label for="notes">Catatan:</label>
            <textarea class="form-control" name="notes" id="notes" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button><p></p>
    </form>
</div></div>
@endsection
