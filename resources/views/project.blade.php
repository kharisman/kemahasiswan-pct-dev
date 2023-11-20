@extends('layout')
@section('content')
<style>
    .category-box {
        border: 1px solid #ccc; /* Garis bingkai */
        padding: 15px; /* Jarak antara teks dan bingkai */
        margin: 10px; /* Jarak antara kotak kategori */
        text-align: center;
    }

    .category-logo {
        max-width: 100px; /* Lebar maksimum logo */
        height: auto; /* Biarkan tinggi menyesuaikan */
    }

    .category-name {
        margin-top: 10px; /* Jarak atas teks nama kategori */
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{url('')}}/landingpage/images/bg_1.jpg')">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-7">
                <h2 class="mb-0">Project</h2>
                <p>Kumpulan project terbaru dan terpopuler</p>
            </div>
        </div>
    </div>
</div>

<div class="custom-breadcrumns border-bottom">
    <div class="container">
        <a href="{{ route('index') }}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">
            @if ($filter === 'terbaru')
            Project Terbaru
            @elseif ($filter === 'populer')
            Project Terpopuler
            @else
            Semua Project
            @endif
        </a>
    </div>
</div>
    <div class="news-updates">
        <div class="container">

            <form class="form-inline mb-5" action="{{ route('project') }}" method="GET">
                <div class="form-group col-md-3 mb-2">
                    <input type="text" class="form-control w-100" name="search" placeholder="Cari project..." value="{{ request('search') }}">
                </div>
                
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </form>

            <div class="row">
                <div class="container">
                    <form class="form-inline mb-5" action="{{ route('project') }}" method="GET">
                        <!-- Form fields for search, filter, and category selection -->
                    </form>
                
                    <!-- Categories Grid (4 columns) -->
                    <div class="row">
                        @php
                        $icons = [
                            'fa-solid fa-code fa-bounce',
                            'fa-brands fa-codepen',
                            'fa-solid fa-code-merge',
                            'fa-solid fa-terminal',
                            'fa-solid fa-microchip',
                            'fa-solid fa-keyboard',
                            'fa-solid fa-globe',
                            'fa-solid fa-server',
                        ];
                        @endphp
                
                        @foreach ($categories as $key => $category)
                        @if ($key % 4 == 0)
                        </div>
                        <div class="row">
                        @endif
                        <div class="col-md-3 mb-2">
                            <div class="category-box">
                                <a href="{{ route('project', ['kategori' => $category->id]) }}" class="category-link">
                                    <i class="{{ $icons[$key] }} category-icon fa-3x"></i><br><p></p> <!-- Menambahkan class fa-3x untuk memperbesar ikon -->
                                    <span class="category-name">{{ $category->category }}</span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                <p></p>
                    <!-- List of Posts -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div a class="row">
                                <div class="col-lg-12">
                                    @if (request('kategori'))
                                    @foreach ($posts as $post)
                                    <!-- Your post entry code here -->
                                    @endforeach
                                    @else
                                    <p>Semua Project</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach ($posts as $post )
                            @php
                            $slug = Str::slug(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z0-9\s]/', '', strtolower($post->name))), '-')
                            @endphp

                            <div class="post-entry-big horizontal d-flex mb-4">
                                <a href="{{url('')}}/project/{{$post->id}}/{{$slug}}" class="img-link mr-4"><img src="{{$post->iduka->photo}}" alt="Image" class="img-fluid"></a>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <a href="{{url('')}}/project/{{$post->id}}/{{$slug}}">{{$post->created_at->translatedFormat('d F Y')}}</a>
                                        <span class="mx-1">/</span>
                                        <a href="">{{$post->category->category}}</a>
                                        <span class="mx-1">/</span>

                                        @if (now()->between($post->registration_start_at, $post->registration_end_at))
                                        <a class="badge badge-primary text-white" href="">Dibuka</a>
                                        @else
                                        <a class="badge badge-danger text-white" href="">Tutup</a>
                                        @endif
                                    </div>

                                    <h3 class="post-heading"><a href="{{url('')}}/project/{{$post->id}}/{{$slug}}">{{$post->name}}</a></h3>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
