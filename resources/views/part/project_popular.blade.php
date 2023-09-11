<div class="site-section">
    <div class="container">
        <div class="row mb-5 justify-content-center text-center">
            <div class="col-lg-6 mb-5">
                <h2 class="section-title-underline mb-3">
                    <span>Project IDUKA</span>
                </h2>
                <p>Mari bergabung Bersama Project IDUKA</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="owl-slide-3 owl-carousel">
                    @foreach ($projects as $item)
                    @php
                    $now = now();
                    $registrationStart = \Carbon\Carbon::parse($item->registration_start_at);
                    $registrationEnd = \Carbon\Carbon::parse($item->registration_end_at);
                    $workStart = \Carbon\Carbon::parse($item->work_start_at);
                    $workEnd = \Carbon\Carbon::parse($item->work_end_at);
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
                    <div class="course-1-item">
                        <figure class="thumnail">
                            {{-- <a href="course-single.html"><img src="{{$item->notes}}" alt="Image" class="img-fluid"></a> --}}
                            <div class="price {{$statusClass}}">{{$status}}</div>
                            <div class="category">
                                <h3>{{$item->iduka->name}}</h3>
                            </div>
                        </figure>
                        <div class="course-1-content pb-4">
                            <h2>{{$item->name}}</h2>
                            <div class="rating text-center mb-3">
                                <span class="icon-star2 text-warning"></span>
                                <span class="icon-star2 text-warning"></span>
                                <span class="icon-star2 text-warning"></span>
                                <span class="icon-star2 text-warning"></span>
                                <span class="icon-star2 text-warning"></span>
                            </div>
                            <p class="desc desc-3 mb-4">
                                {{ strip_tags(html_entity_decode($item->notes)) }}
                            </p>
                             @php
                                $slug = Str::slug(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z0-9\s]/', '', strtolower($item->name))), '-')
                            @endphp
                            <p><a href="{{url('')}}/project/{{$item->id}}/{{$slug}}" class="btn btn-primary rounded-0 px-4">Daftar</a></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <center><a class="btn btn-primary" href="{{url("project")}}" target="_blank" rel="noopener noreferrer"> Lihat Semua</a></center>
    </div>
</div>
