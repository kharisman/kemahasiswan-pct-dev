@extends('iduka.layouts.app')

@section('title', 'Daftar Pelamar Project')

@section('contents')
<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Sorting
    </button>
    <div class="dropdown-menu">
    <a class="dropdown-item" href="{{route('iduka.data_apply')}}" >Menunggu Status</a>
    <a class="dropdown-item" href="{{route('iduka.data_apply_diterima')}}" >Diterima</a>
    <a class="dropdown-item" href="{{route('iduka.data_apply_ditolak')}}">Ditolak</a>
    </div>
</div>
<div class="card shadow mb-4">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Project Name</th>
            <th>Internship Name</th>
            <th>Status</th>
            <th>Tanggal Ditolak</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projectApplies as $projectApply)
        @if ($projectApply->status === 'rejected') {{-- Check if the status is "ditolak" --}}
        <tr>
            <td>{{ $projectApply->id }}</td>
            <td>{{ $projectApply->project->name }}</td>
            <td>{{ $projectApply->internship->name }}</td>
            <td>
                <span id="status_{{ $projectApply->id }}">{{ $projectApply->status }}</span>
            </td>
            <td>{{ $projectApply->updated_at }}</td>
            <td>
                <a href="{{ route('iduka.detail_apply', ['projectApplyId' => $projectApply->id]) }}" class="btn btn-success btn-circle btn-lg">
                    <i class="fas fa-info-circle"></i>
                </a>Info profile Intern
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
</div>
@endsection
