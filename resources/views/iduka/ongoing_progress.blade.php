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
        @foreach ($groupedUpdates as $projectId => $projectData)
        
        <tr>
            <td>{{ $projectId }}</td>
            <td>{{ $projectData['project']->name }}</td>
            <td>
                @foreach ($projectData['internships'] as $internshipName)
                    {{ $internshipName }}<br>
                @endforeach
            </td>
            <td>
                <span id="status_{{ $projectData['project']->id }}">{{ $projectData['project']->status }}</span>
            </td>
            <td>{{ $projectData['project']->created_at }}</td>
            <td>
                <a href="{{ route('iduka.detail_apply', ['projectApplyId' => $projectData['project']->id]) }}" class="btn btn-success btn-circle btn-lg">
                    <i class="fas fa-info-circle"></i>
                </a>
            </td>
        </tr>
    
        @endforeach
    </tbody>
</table>
@endsection
