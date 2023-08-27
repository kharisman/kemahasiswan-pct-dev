@extends('admin/index')
@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Project Category</h1>
        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{url('add-category-project')}}" method="post">@csrf
                        <label for="name" class="form-label">Input Category Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <button type="submit" class="btn btn-success w-100 mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
