@extends('layout')
@section('content')

<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
    <div class="container">
        <div class="row align-items-end justify-content-center text-center">
            <div class="col-lg-7">
                <h2 class="mb-0">Login</h2>
                <p>Masukan Email dan Password yang telah terdaftar.</p>
            </div>
        </div>
    </div>
</div>


<div class="custom-breadcrumns border-bottom">
    <div class="container">
        <a href="{{route('index')}}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Login</span>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="row">
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

                <form action="{{ route('login.aksi') }}" method="POST" class="user">
                    @csrf
                    <div class="col-md-12 form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="email@palcomtech.ac.id">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="password">
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

@endsection


