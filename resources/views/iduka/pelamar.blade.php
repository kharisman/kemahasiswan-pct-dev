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
                <span id="status_{{ $projectApply->id }}">{{ $projectApply->status }}</span>
            </td>
            <td>{{ $projectApply->created_at }}</td>
            <td>
                <a href="{{ route('iduka.detail_apply', ['projectApplyId' => $projectApply->id]) }}" class="btn btn-success btn-circle btn-lg">
                    <i class="fas fa-info-circle"></i>
                </a>Info profile Intern
                <form id="form_{{ $projectApply->id }}" class="status-form" action="{{ route('edit.status', ['applyId' => $projectApply->id]) }}" method="POST">
                    @csrf
                    <select name="new_status" class="status-dropdown">
                        <option value="accepted">Diterima</option>
                        <option value="rejected">Ditolak</option>
                        <option value="pending">Menunggu</option>
                    </select>
                    <button type="submit">Simpan</button>
                </form></div>
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
@endsection
