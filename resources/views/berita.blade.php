@extends('layout')
@section('content')

<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{url('')}}/landingpage/images/bg_1.jpg')">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-7">
                <h2 class="mb-0">Berita</h2>
                <p>Kumpulan berita terbaru dan terpopuler</p>
            </div>
        </div>
    </div>
</div>

<div class="custom-breadcrumns border-bottom">
    <div class="container">
        <a href="index.html">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <a href="#">
            @if ($filter === 'terbaru')
                Berita Terbaru
            @elseif ($filter === 'populer')
                Berita Terpopuler
            @else
                Semua Berita
            @endif
        </a>
</div>
<div class="news-updates">
    <div class="container">
        <form class="form-inline mb-5" action="{{ route('berita') }}" method="GET">
            <div class="form-group col-md-3 mb-2">
                <input type="text" class="form-control w-100" name="search" placeholder="Cari berita..." value="{{ request('search') }}">
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
                            {{ $category->name }}
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

                            <div class="post-entry-big horizontal d-flex mb-4">
                                <a href="news-single.html" class="img-link mr-4"><img src="{{$post->cover}}" alt="Image" class="img-fluid"></a>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <a href="#">{{$post->created_at->translatedFormat('d F Y')}}</a>
                                        <span class="mx-1">/</span>
                                         @foreach ($post->categories as $category)
                                            
                                            <a href="#">{{ $category->category->name }}</a>
                                            @unless ($loop->last)
                                                ,
                                            @endunless
                                        @endforeach
                                    </div>

                                     @php
                                        $slug = Str::slug(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z0-9\s]/', '', strtolower($post->title))), '-')
                                    @endphp
                                    <h3 class="post-heading"><a href="{{url('')}}/berita/{{$post->id}}/{{$slug}}">{{$post->title}}</a></h3>
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
