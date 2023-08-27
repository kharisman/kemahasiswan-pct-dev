@extends('admin/index')
@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Post</h1>
        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{url('add-post')}}" method="post">@csrf
                        <label for="title" class="form-label">Input Title Post</label>
                        <input type="text" class="form-control" name="title" id="title">
                        <label for="content" class="form-label">Input Content Post</label>
                        <input type="text" class="form-control" name="content" id="content">
                        <button type="submit" class="btn btn-success w-100 mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
