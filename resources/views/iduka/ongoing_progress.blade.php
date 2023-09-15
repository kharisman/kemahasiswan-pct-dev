@extends('iduka.layouts.app')

@section('title', 'Daftar Internship Diterima Project')

@section('contents')
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Internship Yang ada di Project {{$project->name}}</h6>
            </div>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
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
</table></div>
@endsection
