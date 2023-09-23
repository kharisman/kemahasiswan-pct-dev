@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
        <div class="row">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Program Project</h1>
                </div>
                <form method="POST" class="form-inline">
                @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="search">Nama Project :</label>
                                    <input type="text" id="search" name="search" class="form-control border-secondary" placeholder="Nama project...">
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="filter">Filter :</label>
                                <select name="filter" id="filter" class="form-control border-secondary">
                                    <option value="">Filter Program</option>
                                    <option value="new">Terbaru</option>
                                    <option value="best">Banyak Diminati</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">Kategori :</label>
                                <select name="category" id="category" class="form-control border-secondary">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categoryProjectData as $item)
                                        <option value="{{$item->category}}">{{$item->category}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary col-md-12">Filter</button>
                    </div>
                </form>


                @if ($internship->phone <> '')
                    @if ($projectData->isEmpty())
                        <div class="alert alert-info w-100 text-center">Tidak ada data yang memenuhi</div>
                    @else
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
                                            <div class="text-end">
                                                <i class="mdi mdi-eye"></i> {{$item->views}}
                                            </div>
                                            {{-- <p>{!! \Illuminate\Support\Str::limit($item->notes, 250) !!}</p> --}}
                                            {{-- <a href="{{url('internship-project-apply',['id' => $item->id])}}" class="btn btn-primary col-12 mt-3">Daftar</a> --}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="text-center">Data Pengguna Belum Lengkap, Mohon Lengkapi Data Sebelum Mendaftar di project, <a href="{{url('internship-data')}}">Disini</a></div>
                @endif
            </div>
        </div>
    </div>
@endsection
