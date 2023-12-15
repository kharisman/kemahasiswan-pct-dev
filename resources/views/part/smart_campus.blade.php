<style>
    .equal-height {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        height: 100%;
        /* Atur tinggi elemen menjadi 100% dari parent */
        justify-content: space-between;
        /* Pusatkan elemen dan biarkan tombol di bawah */
    }

    .icon-wrapper {
        /* Stil ikon seperti sebelumnya */
    }

    .feature-1-content {
        margin-top: 20px;
    }

    .learn-more-btn {
        margin-top: auto;
        /* Biarkan tombol berada di bagian bawah elemen */
    }

    /* Sembunyikan teks tambahan awalnya */
    .more-text {
        display: none;
    }
</style>
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<div class="site-section">
    <div class="container">
        <div class="row mb-5 justify-content-center text-center">
            <div class="col-lg-4 mb-2">
                <h2 class="section-title-underline mb-2">
                    <span>Kenapa harus bergabung besama Palcomtech</span>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="container-xxl border-primary hero-header">
                <div class="container">
                    <div class="row g-5 align-items-center">
                        <h3 class="text-dark text-center mb-4 animated zoomIn">
                            Kaloborasi Palcomtech merupakan sebuah wadah bagi Civitas akademika Palcomtech dengan Dunia Industri dan Dunia Kerja 
                            (IDUKA)  
                            </h3>
                        <div class="col-lg-6 text-justify text-lg-start">
                            <p class="text-dark pb-3 animated zoomIn">
                                untuk membuka peluang bagi pengembangan dari Civitas Akademika Palcomtech dalam menyelesaikan permasalahan yang ada di 
                                IDUKA dalam bentuk Aplikasi, Website, maupun Desain dari Brand IDUKA.</p><br>
                            <div class="feature-1 border">
                                <div class="icon-wrapper bg-primary">
                                    <span class="flaticon-mortarboard text-white"></span>
                                </div>
                                <div class="feature-1-content">
                                    <span class="more-text">"Merajut harapan melalui teknologi Palcomtech dan keunggulan akademis, kolaborasi ini membentuk jembatan menuju masa depan 
                                        pendidikan yang inovatif dan memberdayakan mahasiswa untuk mencapai potensi tertinggi mereka."</span></p>
                                    <p><a href="#" class="btn btn-lg btn-primary px-2 rounded-0 learn-more-btn learn-more-btn">Selengkapnya</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center text-lg-start">
                            <img class="img-fluid animated zoomIn" src="css/hero.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-lg-6 col-md-6 mb-4 mb-lg-0">
                <div class="feature-1 border">
                    <div class="icon-wrapper bg-primary">
                        <span class="flaticon-mortarboard text-white"></span>
                    </div>
                    <div class="feature-1-content">
                        <p>Kaloborasi Palcomtech merupakan sebuah wadah bagi Civitas akademika Palcomtech dengan Dunia Industri dan Dunia 
                            Kerja (IDUKA)  </p>
                        <span class="more-text">untuk membuka peluang bagi pengembangan dari Civitas Akademika Palcomtech dalam menyelesaikan 
                            permasalahan yang ada di IDUKA dalam bentuk Aplikasi, Website, maupun Desain dari Brand IDUKA..</span></p>
                        <p><a href="#" class="btn btn-primary px-2 rounded-0 learn-more-btn">Selengkapnya</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-4 mb-lg-0">
                <div class="feature-1 border">
                    <div class="icon-wrapper bg-primary">
                        <span class="flaticon-library text-white"></span>
                    </div>
                    <div class="feature-1-content">
                        <p>"Merajut harapan melalui teknologi Palcomtech dan keunggulan akademis, kolaborasi ini membentuk jembatan menuju 
                            masa depan pendidikan yang inovatif dan memberdayakan mahasiswa untuk mencapai potensi tertinggi mereka."</p>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".learn-more-btn").click(function(e) {
            e.preventDefault(); // Mencegah tautan mengarahkan ke halaman lain
            var $parent = $(this).closest('.feature-1');
            $parent.find('.more-text').slideToggle(); // Menampilkan atau menyembunyikan teks tambahan
        });
    });
</script>
