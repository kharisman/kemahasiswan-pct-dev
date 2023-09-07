@extends('iduka.layouts.app')

@section('title', 'Daftar Pelamar Project')

@section('contents')
<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Sorting
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('iduka.data_apply') }}">Menunggu Status</a>
        <a class="dropdown-item" href="{{ route('iduka.data_apply_diterima') }}">Diterima</a>
        <a class="dropdown-item" href="{{ route('iduka.data_apply_ditolak') }}">Ditolak</a>
    </div>
</div>

<div class="card shadow mb-4">
    @if ($projectApplies)
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    @if (!$projectApply->status) {{-- Check if the status is empty or null --}}
                    <tr>
                        <td>{{ $projectApply->id }}</td>
                        <td>{{ $projectApply->project->name }}</td>
                        <td>{{ $projectApply->internship->name }}</td>
                        <td>
                            <span id="status_{{ $projectApply->id }}">{{ $projectApply->status }}Menunggu</span>
                        </td>
                        <td>{{ $projectApply->created_at }}</td>
                        <td>
                            <a href="{{ route('iduka.detail_apply', ['projectApplyId' => $projectApply->id]) }}" class="btn btn-success btn-circle btn-lg">
                                <i class="fas fa-info-circle"></i>
                            </a>Info profile Intern
                            <div class="container">
                                <form id="form_{{ $projectApply->id }}" class="status-form" action="{{ route('edit.status', ['applyId' => $projectApply->id]) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="new_status">Beri Status:</label>
                                        <select name="new_status" class="form-control status-dropdown">
                                            <option value="">Beri status</option>
                                            <option value="accepted">Diterima</option>
                                            <option value="rejected">Ditolak</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada data yang sesuai.</p>
    @endif
</div>
@endsection
