@extends('admin/index')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pererta Event : {{$event->title}} </h1>
    </div>
    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTable" id="dataTable">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th> Nama </th>
                                <th> Email </th>
                                <th> Momor Telepon</th>
                                <th> Aktifitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($event->registrations()->get() as $d)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->email }}</td>
                                <td>{{ $d->phone }}</td>
                                <td>{{ $d->activity }}</td>
                                
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
