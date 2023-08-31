@extends('iduka.layouts.app')

@section('title', 'Daftar Pelamar Project')

@section('contents')
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Project Name</th>
            <th>Internship Name</th>
            <th>Status</th>
            <th>Tanggal Diterima</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projectApplies as $projectApply)
        @if ($projectApply->status === 'accepted') {{-- Check if the status is "diterima" --}}
        <tr>
            <td>{{ $projectApply->id }}</td>
            <td>{{ $projectApply->project->name }}</td>
            <td>{{ $projectApply->internship->name }}</td>
            <td>
                <span id="status_{{ $projectApply->id }}">{{ $projectApply->status }}</span>
            </td>
            <td>{{ $projectApply->created_at }}</td>
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
@endsection
