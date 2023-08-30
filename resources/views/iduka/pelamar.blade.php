@extends('iduka/layouts.app')

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
        <tr>
            <td>{{ $projectApply->id }}</td>
            <td>{{ $projectApply->project->name }}</td>
            <td>{{ $projectApply->internship->name }}</td>
            <td>{{ $projectApply->status }}</td>
            <td>{{ $projectApply->created_at }}</td>
            <td><a href="#" class="btn btn-success btn-circle btn-lg">
                   <i class="fas fa-info-circle"></i>
               </a>
               <a href="#" class="btn btn-info btn-circle btn-lg">
                   <i class="fas fa-check"></i>
               </a>
               <a href="#" class="btn btn-danger btn-circle btn-lg">
                   <i class="fa-solid fa-x">"></i>
               </a></td>
        </tr>
        @endforeach
    </tbody>
</table>

           
    @endsection
    