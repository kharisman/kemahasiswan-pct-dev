@extends('layout')
@section('content')

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
                <div class="form-group col-md-3 mb-2">
                    <select class="form-control w-100" name="filter">
                        <option value="">Semua</option>
                        <option value="terbaru" {{ request('filter') === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="populer" {{ request('filter') === 'populer' ? 'selected' : '' }}>Populer</option>
                    </select>
                </div>
                <div class="form-group col-md-3 mb-2">
                    <select class="form-control w-100" name="kategori">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('kategori') == $category->id ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </form>

            <div class="row">

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
                                        <a class="badge badge-danger text-white" href="">Dibuka</a>
                                        @else
                                        <a class="badge badge-primary text-white" href="">Tutup</a>
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
