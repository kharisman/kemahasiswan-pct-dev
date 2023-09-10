@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
        <div class="row">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Program Project</h1>
                    <div class="col text-end me-3">
                            Urutkan : 
                            <div class="btn-group dropend">
                              <button type="button" class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Filter Program Project
                              </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item">Rekomendasi Project</a></li>
                                <li><a class="dropdown-item" href="{{ url('internship-project-filter', ['data' => 'new']) }}">Project Terbaru</a></li>
                                <li><a class="dropdown-item" href="{{ url('internship-project-filter', ['data' => 'best']) }}">View Terbaik</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item">Program</a></li>
                              </ul>
                            </div>
                    </div>
                    <form action="{{url('internship-project')}}" method="post">
                        <div class="input-group">
                            @csrf
                            <input type="text" class="form-control" placeholder="Program Project..."
                                aria-label="Recipient's username" aria-describedby="button-addon2" name="search">
                            <button class="btn btn-outline-light btn-primary" type="submit" id="button-addon2">Button</button>
                        </div>
                    </form>
                </div>


                @if ($internship->phone <> '')
                <div class="row">
                    @foreach ($projectData as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <a href="{{ url('internship-detail-project', ['id' => $item->id]) }}" class="text-decoration-none text-dark">
                            <div class="card shadow-lg">
                                <div class="card-header card-loop d-flex flex-column justify-content-center align-items-center">
                                    <img src="{{$item->photo}}" class="img-loop img-fluid" alt="">
                                </div>
                                <div class="card-body">
                                    {{$item->category}}
                                    <h5 class="card-title text-truncate line-clamp-3">{{$item->name}}</h5>
                                    <p>
                                        <i class="mdi mdi-calendar-check"></i> Pendaftaran 
                                        <br>
                                        {{$item->registration_start_at}} / {{$item->registration_end_at}}
                                        <br>
                                    </p>
                                    {{-- <p>{!! \Illuminate\Support\Str::limit($item->notes, 250) !!}</p> --}}
                                    {{-- <a href="{{url('internship-project-apply',['id' => $item->id])}}" class="btn btn-primary col-12 mt-3">Daftar</a> --}}
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                @else
                    <div class="text-center">Data Pengguna Belum Lengkap, Mohon Lengkapi Data Sebelum Mendaftar di project, <a href="{{url('internship-data')}}">Disini</a></div>
                @endif
            </div>
        </div>
    </div>
@endsection
