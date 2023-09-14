@extends('layout')

@section('content')
<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ url('landingpage/images/bg_1.jpg')}}')">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-7">
                <h2 class="mb-0">{{$project->title}}</h2>
                <a href="#">Tanggal Pembuatan: {{$project->created_at->translatedFormat('d F Y')}}</a> - <span class="text-white bg-black p-2 rounded">{{$project->views}} kali dilihat - 
                @if (now()->between($project->reg_start, $project->reg_end))
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
        <a href="{{url('')}}/event">Event</a>
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
                $registrationStart = \Carbon\Carbon::parse($project->reg_start);
                $registrationEnd = \Carbon\Carbon::parse($project->reg_end);
                $workStart = \Carbon\Carbon::parse($project->start_date);
                $workEnd = \Carbon\Carbon::parse($project->end_date);
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
                    <h3>{{$project->title}}</h3>

                    <p>Periode Daftar : {{$project->reg_start}} sd {{$project->reg_end}} </p>
                    <p>Periode Pelaksanaan : {{$project->start_date}} sd {{$project->end_date}} </p>
                </div>
            </div>
            <div class="col-lg-12 ml-auto align-self-center">
                <!-- Konten atau isi proyek ditampilkan di sini -->
                {!! $project->description !!}

                @if (now()->between($project->reg_start, $project->reg_end))
                    
                    
                    <a id="btn-regis" class="btn btn-success">Daftar Sekarang</a>
                    
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

<!-- Modal -->
<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Pendaftaran Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulir pendaftaran di sini -->
                <form method="POST" >
                    @csrf
                    <!-- Tambahkan input yang diperlukan sesuai dengan tabel Anda, seperti name, email, phone, activity -->
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" required value="{{ old('phone') }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="activity">Aktivitas</label>
                        <input type="text" class="form-control" id="activity" name="activity" required value="{{ old('activity') }}">
                        @error('activity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        $('#registrationModal').on('show.bs.modal', function (e) {
            // Reset formulir pendaftaran ketika modal ditampilkan
            $(this).find('form')[0].reset();
        });

        // Tampilkan modal saat tombol "Daftar Sekarang" diklik
        $('#btn-regis').click(function () {
            $('#registrationModal').modal('show');
        });

        @if($errors->any())
            $('#registrationModal').modal('show'); // Tampilkan modal jika ada kesalahan validasi
        @endif
    });
</script>

@endsection
