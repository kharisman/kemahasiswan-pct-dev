@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
        <div class="row">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Program Project</h1>
                    <form action="{{url('internship-project')}}" method="post">
                        <div class="input-group">
                            @csrf
                            <input type="text" class="form-control" placeholder="Order by Iduka Partner"
                                aria-label="Recipient's username" aria-describedby="button-addon2" name="search">
                            <button class="btn btn-outline-light btn-primary" type="submit" id="button-addon2">Button</button>
                        </div>
                    </form>
                </div>
                @if ($internship->phone <> '')
                <div class="row">
                    @foreach ($projectData as $item)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{$item->photo}}" class="card-img-top p-3" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{$item->name}}</h5>
                                <p>{!! \Illuminate\Support\Str::limit($item->notes, 250) !!}</p>
                                <a href="{{ url('internship-detail-project', ['id' => $item->id]) }}">Selengkapnya</a>
                                <a href="{{url('internship-project-apply',['id' => $item->id])}}" class="btn btn-primary col-12 mt-3">Apply</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                    <div class="h3 text-center">Your Profile Not Complleted Please, Complleted you profile <a href="{{url('internship-data')}}">here</a></div>
                @endif
            </div>
        </div>
    </div>
@endsection
