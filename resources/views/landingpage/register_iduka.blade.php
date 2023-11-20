@extends('layout')
@section('content')
<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
    <div class="container">
        <div class="row align-items-end justify-content-center text-center">
            <div class="col-lg-7">
                <h2 class="mb-0">Daftar</h2>
                <p>Gabung Dengan Palcomtech</p>
            </div>
        </div>
    </div>
</div>

<div class="custom-breadcrumns border-bottom">
    <div class="container">
        <a href="{{route('index')}}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Register </span>
    </div>
</div>
<p></p>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form register') }}</div>
                
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {!! session('error') !!}
                        </div>
                        <script>
                            // Setelah 3 detik, alihkan pengguna ke form iduka 
                            setTimeout(function () {
                                window.location.href = 'https://palcomtech.ac.id';
                            }, 3000);
                        </script>
                    @endif

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('registerIduka') }}">{{ __('Iduka') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('register') }}">{{ __('Internship') }}</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="register_internship">
                        <div class="row align-items-end justify-content-center text-center">
                            <div class="col-lg-7">
                                <h2 class="mb-0">Register</h2>
                                <p>Sebagai Iduka</p>
                            </div>
                            @if(session('success'))
                            <div class="alert alert-success w-100">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger w-100">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        
                            <form action="{{ route('registerIduka.simpan') }}" method="POST" class="user">
                                @csrf
                                <div class="col-md-12 form-group">
                                    <label for="username">Nama</label>
                                    <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder="Nama">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="email@palcomtech.ac.id">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="password"
                                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"
                                        title="Password harus memiliki minimal 8 karakter dan mengandung kombinasi huruf dan angka."
                                        required>
                                    <span id="password-error" class="text-danger"></span>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="password_confirmation">Ulangi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" placeholder="Ulangi password">
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <input type="submit" class="col-12 btn btn-primary btn-lg px-5">
                                    </div>
                                </div>    
                                    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section"></div>
<script>
    // Fungsi untuk memeriksa validasi password saat input berubah
    function validatePassword() {
        var password = document.getElementById('password').value;
        var passwordError = document.getElementById('password-error');
        
        // Reset pesan kesalahan sebelumnya
        passwordError.innerHTML = '';

        // Cek apakah password memenuhi kriteria
        if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(password)) {
            passwordError.innerHTML = 'Password harus memiliki minimal 8 karakter dan mengandung kombinasi huruf kapital, huruf kecil, dan angka.';
        }
    }

    // Tambahkan event listener ke input password
    document.getElementById('password').addEventListener('input', validatePassword);
</script>


@endsection