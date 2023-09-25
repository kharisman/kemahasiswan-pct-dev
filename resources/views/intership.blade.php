@extends('layout')
@section('content')

<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{url('')}}/landingpage/images/bg_1.jpg')">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-7">
                <h2 class="mb-0">Bagaimana cara mencari tempat magang yang baik</h2>
                <p>Ikuti langkah langkah di bawah ini</p>
            </div>
        </div>
    </div>
</div>

<div class="custom-breadcrumns border-bottom">
    <div class="container">
        <a href="{{ route('index') }}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Pengajuan Intership</span>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <p>
                    <img src="{{url('')}}/landingpage/images/course_5.jpg" alt="Image" class="img-fluid">
                </p>
            </div>
            <div class="col-lg-5 ml-auto align-self-center">
                {{-- <h2 class="section-title-underline mb-5">
                    <span>Course Details</span>
                </h2> --}}

                {{-- <p><strong class="text-black d-block">Teacher:</strong> Craig Daniel</p>
                <p class="mb-5"><strong class="text-black d-block">Hours:</strong> 8:00 am — 9:30am</p> --}}
                <p>Tertarik untuk menjadi bagian dari perjalanan pendidikan yang inovatif? 
                Bergabunglah sebagai mitra IDUKA di Institut PalComTech dan 
                berkontribusi dalam membentuk masa depan pendidikan yang lebih baik.</p>
               

                <ul class="ul-check primary list-unstyled mb-5">
                      <li>Pilih Bidang yang Sesuai: Tentukan bidang yang sesuai dengan minat dan tujuan karir Anda.</li>
                    <li>Riset Perusahaan: Cari tahu tentang perusahaan atau organisasi yang beroperasi dalam bidang yang Anda minati.</li>
                    <li>Manfaatkan Sumber Online: Gunakan situs web perusahaan, platform pencari kerja, dan situs magang untuk mencari peluang magang.</li>
                    <li>Jaringan dan Berkonsultasi: Ajukan pertanyaan kepada dosen, mentor, teman, atau keluarga yang mungkin memiliki informasi tentang peluang magang.</li>
                    <li>Kirim Lamaran yang Tepat: Buat lamaran yang sesuai dan menarik, serta sertakan CV yang relevan dengan pengalaman Anda.</li>
                    <li>Siapkan Wawancara: Jika dipanggil untuk wawancara, persiapkan diri dengan baik dan tunjukkan motivasi serta antusiasme Anda.</li>
                </ul>

                <p>
                    <a href="{{route('register')}}" class="btn btn-primary rounded-0 btn-lg px-5 text-white">Register</a>
                </p>

            </div>
        </div>
    </div>
</div>
<div class="section-bg style-1" style="background-image: route('images/hero_1.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon flaticon-mortarboard"></span>
                <h3>Tekhnik Informatika </h3>
                <p>Menjadi program studi yang menghasilkan sarjana dengan kompetensi unggulan di bidang rekayasa perangkat lunak, pengembangan sistem cerdas dan jaringan komputer yang berprestasi dan berwawasan global.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon flaticon-school-material"></span>
                <h3>Sistem Informasi</h3>
                <p>Menjadi program studi yang menghasilkan sarjana dengan kompetensi unggulan di bidang desain, manajemen dan analisis sistem informasi yang berprestasi dan berwawasan global.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon flaticon-library"></span>
                <h3>Bisnis Digital</h3>
                <p>Menjadi program studi yang menghasilkan sarjana dengan kompetensi di bidang bisnis dan keuangan dengan berbasis teknologi digital yang berprestasi dan berwawasan global.</p>
            </div>
        </div>
    </div>
</div>
<p></p>

@endsection
