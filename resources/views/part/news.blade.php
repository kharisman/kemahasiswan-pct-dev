<div class="news-updates">
    <div class="container">

        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2 class="text-black">Berita Terbaru</h2>
                    <a href="#">Baca lebih lanjut</a>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        @foreach ($new_posts as $post )

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
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2 class="text-black">Berita Terpopuler</h2>
                    <a href="#">Baca lebih lanjut</a>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                          @foreach ($pop_posts as $post )

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
