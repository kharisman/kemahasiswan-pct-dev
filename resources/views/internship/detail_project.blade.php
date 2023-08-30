@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
        <div class="row">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Program Project</h1>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <div class="card">
                            <img src="{{$projectData->photo}}" class="card-img-top p-3" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{$projectData->name}}</h5>
                                <p>{!! $projectData->notes !!}</p>
                                <a href="{{url('internship-project-apply',['id' => $projectData->id])}}" class="btn btn-primary col-12 mt-3">Apply</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
