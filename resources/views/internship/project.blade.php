@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
        <div class="row">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Program Project</h1>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Order by Iduka Partner"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-light btn-primary" type="button" id="button-addon2">Button</button>
                    </div>
                </div>
                <div class="row mb-3">
                    @foreach ($projectData as $item)
                    <div class="col mb-3">
                        <div class="card">
                            <img src="{{$item->photo}}" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{$item->name}}</h5>
                                <p class="card-text">{{$item->notes}}</p>
                                <a href="" class="btn btn-primary">Apply</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
