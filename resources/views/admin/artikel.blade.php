@extends('admin/index')
@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Artikel</h1>
            <a href="{{url('add-slider')}}" class="btn btn-primary">Add Slider</a>
        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Sort</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><img src="{{$item->image}}" class="card-img-top" alt=""></td>
                                    <td>{{$item->sort}}</td>
                                    <td>{{$item->status}}</td>
                                    <td class="text-center" style="width: 300px;">
                                        <div class="row">
                                            <div class="col mb-2"><a href="" class="btn btn-sm btn-danger">Hapus</a>
                                            </div>
                                            <div class="col mb-2"><a href="" class="btn btn-sm btn-warning">Edit</a>
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
