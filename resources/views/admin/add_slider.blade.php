@extends('admin/index')
@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Slider</h1>
        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{url('add-slider')}}" method="post" enctype="multipart/form-data">@csrf
                        <label for="image" class="form-label">Input Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        <button type="submit" class="btn btn-success w-100 mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
