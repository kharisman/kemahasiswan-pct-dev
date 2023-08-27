@extends('admin/index')
@section('content')
        <div class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Category</h1>
                <a href="{{url('add-category')}}" class="btn btn-primary">Add Category</a>
            </div>

            <div class="row">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categoryData as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->status}}</td>
                                        <td class="text-center" style="width: 300px;">
                                            <div class="row">
                                                <div class="col mb-2"><a href=""
                                                        class="btn btn-sm btn-danger">Hapus</a>
                                                </div>
                                                <div class="col mb-2"><a href=""
                                                        class="btn btn-sm btn-warning">Edit</a>
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

            <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
                <h1 class="h3 mb-0 text-gray-800">Post</h1>
                <a href="{{url('add-post')}}" class="btn btn-primary">Add Post</a>
            </div>

            <div class="row">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Title Post</th>
                                        <th>Content Post</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($postData as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->content}}</td>
                                        <td>{{$item->status}}</td>
                                        <td class="text-center" style="width: 300px;">
                                            <div class="row">
                                                <div class="col mb-2"><a href=""
                                                        class="btn btn-sm btn-danger">Hapus</a>
                                                </div>
                                                <div class="col mb-2"><a href=""
                                                        class="btn btn-sm btn-warning">Edit</a>
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
