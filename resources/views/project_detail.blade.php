@extends('layout')

@section('content')
<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ url('landingpage/images/bg_1.jpg')}}')">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-7">
                <h2 class="mb-0">{{$project->name}}</h2>
                <a href="#">Tanggal Pembuatan: {{$project->created_at->translatedFormat('d F Y')}}</a> - <span class="text-white bg-black p-2 rounded">{{$project->views}} kali dilihat - 
                @if (now()->between($project->registration_start_at, $project->registration_end_at))
                    Dibuka
                @else
                    Tutup
                @endif
                </span>
        
            </div>
        </div>
    </div>
</div>

<div class="custom-breadcrumns border-bottom">
    <div class="container">
        <a href="index.html">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <a href="courses.html">Berita</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <a href="courses.html">{{$project->title}}</a>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                @php
                $now = now();
                $registrationStart = \Carbon\Carbon::parse($project->registration_start_at);
                $registrationEnd = \Carbon\Carbon::parse($project->registration_end_at);
                $workStart = \Carbon\Carbon::parse($project->work_start_at);
                $workEnd = \Carbon\Carbon::parse($project->work_end_at);
                $status = 'Dibuka';
                $statusClass = 'status-open'; // Kode status default

                if ($now < $registrationStart) {
                    $status = 'Pendaftaran Belum Dibuka';
                    $statusClass = 'status-not-open';
                } elseif ($now > $registrationEnd) {
                    $status = 'Pendaftaran Ditutup';
                    $statusClass = 'status-closed';
                } elseif ($now > $workEnd) {
                    $status = 'Proyek Selesai';
                    $statusClass = 'status-finished';
                } elseif ($now >= $workStart && $now <= $workEnd) {
                    $status = 'Proyek Sedang Berlangsung';
                    $statusClass = 'status-ongoing';
                }
                @endphp
                <div class="alert {{$statusClass}}">{{$status}}</div>
                <div class="category">
                    <h3>{{$project->iduka->name}}</h3>

                    <p>Periode Daftar : {{$project->registration_start_at}} sd {{$project->registration_end_at}} </p>
                    <p>Periode Kerja : {{$project->work_start_at}} sd {{$project->work_end_at}} </p>
                </div>
            </div>
            <div class="col-lg-12 ml-auto align-self-center">
                <!-- Konten atau isi proyek ditampilkan di sini -->
                {!! $project->notes !!}

                @if (now()->between($project->registration_start_at, $project->registration_end_at))
                    
                    @if (Auth::check())
                        <a href="{{ url('internship-project-apply/' . $project->id) }}" class="btn btn-success">Daftar Sekarang</a>
                    @else
                        <a href="{{ url('login') }}?id={{$project->id}}" class="btn btn-success">Daftar Sekarang</a>
                    @endif
                @else
                
                <a href="" class="btn btn-warning"> Pendaftaran Sudah Ditutup</a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="section-bg style-1" style="background-image: url('images/hero_1.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon flaticon-mortarboard"></span>
                <h3>Filosofi Kami</h3>
                <p>Deskripsi filosofi atau prinsip dasar proyek Anda.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon flaticon-school-material"></span>
                <h3>Prinsip Akademik</h3>
                <p>Deskripsi prinsip akademik atau pendidikan yang diterapkan dalam proyek.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon flaticon-library"></span>
                <h3>Kunci Kesuksesan</h3>
                <p>Deskripsi faktor kunci kesuksesan yang relevan dengan proyek Anda.</p>
            </div>
        </div>
    </div>
</div>
@endsection
