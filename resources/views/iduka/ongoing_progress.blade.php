@extends('iduka.layouts.app')

@section('title', 'Daftar Internship Diterima Project')

@section('contents')
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Project Name</th>
            <th>Internship Name</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Status Pengerjaan</th>
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
            <td>{{ $projectData['project']->work_start_at}} Hingga {{ $projectData['project']->work_end_at}}</td>
            <td>
          {{ $projectData['project']->status_work}}
            </td>
        </tr>
    
        @endforeach
    </tbody>
</table>
@endsection
