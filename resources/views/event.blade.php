@extends('layout')
@section('content')

<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{url('')}}/landingpage/images/bg_1.jpg')">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-7">
                <h2 class="mb-0">Event</h2>
                <p>Kumpulan event terbaru dan terpopuler</p>
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
            Event Terbaru
            @elseif ($filter === 'populer')
            Event Terpopuler
            @else
            Semua Event
            @endif
        </a>
    </div>
    </div>
    <div class="news-updates">
        <div class="container">

            <form class="form-inline mb-5" action="{{ route('event') }}" method="GET">
                <div class="form-group col-md-3 mb-2">
                    <input type="text" class="form-control w-100" name="search" placeholder="Cari event..." value="{{ request('search') }}">
                </div>
                <div class="form-group col-md-3 mb-2">
                    <select class="form-control w-100" name="filter">
                        <option value="">Semua</option>
                        <option value="terbaru" {{ request('filter') === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="populer" {{ request('filter') === 'populer' ? 'selected' : '' }}>Populer</option>
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
                            $slug = Str::slug(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z0-9\s]/', '', strtolower($post->title))), '-')
                            @endphp

                            <div class="post-entry-big horizontal d-flex mb-4">
                                <a href="{{url('')}}/event/{{$post->id}}/{{$slug}}" class="img-link mr-4"><img src="{{$post->cover}}" alt="Image" class="img-fluid"></a>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <a href="{{url('')}}/event/{{$post->id}}/{{$slug}}">{{$post->created_at->translatedFormat('d F Y')}}</a>
                                        <span class="mx-1">/</span>
                                        

                                        @if (now()->between($post->reg_start, $post->reg_end))
                                        <a class="badge badge-danger text-white" href="">Dibuka</a>
                                        @else
                                        <a class="badge badge-primary text-white" href="">Tutup</a>
                                        @endif
                                    </div>

                                    <h3 class="post-heading"><a href="{{url('')}}/event/{{$post->id}}/{{$slug}}">{{$post->title}}</a></h3>
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
