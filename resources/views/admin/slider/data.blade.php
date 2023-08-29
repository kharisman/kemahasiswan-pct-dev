@extends('admin/index')
@section('content')
        <div class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Slider</h1>
                <a href="{{url('admin/settings/slider/add')}}" class=" btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Slider</a>
            </div>

            <div class="row">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover dataTable" id="dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Slider</th>
                                        <th>Tanggal Update</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ( $data as $d )
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td><img width="500" src="{{$d->images}}" alt=""></td>
                                        <td>{{$d->created_at}}</td>
                                        <td class="text-center" style="width: 300px;">
                                            <div class="row">
                                                <div class="col-6 mb-2">
                                                    <a href="{{ url('admin/settings/slider/edit') }}?id={{ $d->id }}" class="btn btn-sm btn-primary">Edit</a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{ url('admin/settings/slider/delete') }}?id={{ $d->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus slider ini?')">Delete</a>
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
