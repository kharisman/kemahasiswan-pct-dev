@extends('admin/index')
@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Project Category</h1>
        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <label for="category" class="form-label">Input Category Name</label>
                        <input type="text" class="form-control" name="category" id="category">
                        <button type="submit" class="btn btn-success w-100 mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="card w-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category Project Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categoryProjectData as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->category}}</td>
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
