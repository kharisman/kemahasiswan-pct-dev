<style>.equal-height {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    height: 100%; /* Atur tinggi elemen menjadi 100% dari parent */
    justify-content: space-between; /* Pusatkan elemen dan biarkan tombol di bawah */
}

.icon-wrapper {
    /* Stil ikon seperti sebelumnya */
}

.feature-1-content {
    margin-top: 20px;
}

.learn-more-btn {
    margin-top: auto; /* Biarkan tombol berada di bagian bawah elemen */
}

/* Sembunyikan teks tambahan awalnya */
.more-text {
    display: none;
}
</style>
<div class="site-section">
    <div class="container">
        <div class="row mb-5 justify-content-center text-center">
            <div class="col-lg-4 mb-5">
                <h2 class="section-title-underline mb-5">
                    <span>Kenapa harus bergabung besama Palcomtech</span>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">

                <div class="feature-1 border">
                    <div class="icon-wrapper bg-primary">
                        <span class="flaticon-mortarboard text-white"></span>
                    </div>
                    <div class="feature-1-content">
                        <h2>Smart Campus</h2>
                        <p>kampus cerdas, mengacu pada fasilitas-fasilitas kampus pendukung semua kegiatan sivitas akademika dalam melaksanakan kewajiban Tri Dharma Perguruan Tinggi yang </p>
                        <span class="more-text">menggunakan teknologi informasi sebagai tulang punggung pendukung.</span></p>
    <p><a href="#" class="btn btn-primary px-4 rounded-0 learn-more-btn">Read More</a></p>
</div>
                       
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="feature-1 border">
                    <div class="icon-wrapper bg-primary">
                        <span class="flaticon-school-material text-white"></span>
                    </div>
                    <div class="feature-1-content">
                        <h2>Active learning</h2>
                        <p>merupakan usaha pendekatan pembelajaran dimana
                            siswa diberikan berbagai kesempatan untuk bisa mengeksplorasi serta mendalami materi
                            pembelajaran 
                            </p><span class="more-text">yang sudah diajarkan bersamaan dengan  mengembangkan skill atau kemampuan dengan upaya pemecahan masalah (Problem solving) serta investigasi.</span></p>
    <p><a href="#" class="btn btn-primary px-4 rounded-0 learn-more-btn">Read More</a></p>
</div>
                        
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="feature-1 border">
                    <div class="icon-wrapper bg-primary">
                        <span class="flaticon-library text-white"></span>
                    </div>
                    <div class="feature-1-content">
                        <h2>Sesuai kebutuhan IDUKA</h2>
                        <p>Penyelarasan kurikulum adalah upaya menyesuaikan kurikulum kampus dengan tuntutan IDUKA yang meliputi kompetensi dan budaya kerja yang berlaku di IDUKA.</p>
                        <span class="more-text"> Tujuan Penyelarasan Kurikulum yaitu agar kurikulum kampus sesuai tuntutan dan budaya kerja yang berlaku di IDUKA, sehingga lulusan kampus Palcomtech memiliki kompetensi dan etos kerja yang sesuai dengan kebutuhan IDUKA. Untuk memenuhi kebutuhan tersebut.</span></p>
                        <p><a href="#" class="btn btn-primary px-4 rounded-0 learn-more-btn">Read More</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><script>
    $(document).ready(function() {
        $(".learn-more-btn").click(function(e) {
            e.preventDefault(); // Mencegah tautan mengarahkan ke halaman lain
            var $parent = $(this).closest('.feature-1');
            $parent.find('.more-text').slideToggle(); // Menampilkan atau menyembunyikan teks tambahan
        });
    });
</script>
