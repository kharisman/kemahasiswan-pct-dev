@extends('admin/index')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Event</h1>
        <a href="{{ url('/admin/event/add') }}" class="btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Event</a>
    </div>
    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTable" id="dataTable">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Event</th>
                                <th>Kuota Peserta</th>
                                <th>Periode Pendaftaran</th>
                                <th>Periode Acara</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($data as $d)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $d->title }}</td>
                                <td><a href="{{url('')}}/admin/event/peserta?id={{ $d->id }}">{{$d->registrations()->count()}}</a>/{{ $d->participants }}</td>
                                <td>{{ $d->reg_start . ' - ' . $d->reg_end }}</td>
                                <td>{{ $d->start_date . ' - ' . $d->end_date }}</td>
                                <td>{{ $d->status}}</td>
                                <td class="text-center" style="width: 300px;">
                                     <div class="row">
                                        <div class="col-12 mb-2">
                                            <a href="{{ url('admin/event/edit') }}?id={{ $d->id }}" class="btn btn-sm btn-primary">Edit</a>
                                        
                                            <a href="{{ url('admin/event/delete') }}?id={{ $d->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori project ini?')">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
