<style>
    .intro-section {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        padding: 20px; /* Padding untuk layar yang lebih besar */
        margin: 20px; /* Margin untuk layar yang lebih besar */
        background-color: #f2f2f2; /* Background color for the entire section */
    }

    /* Mengurangi margin dan padding pada layar yang lebih kecil */
    @media (max-width: 767px) {
        .intro-section {
            padding: 10px; /* Reduced padding for smaller screens */
            margin: 10px; /* Reduced margin for smaller screens */
            background-size: 100% auto; /* Adjusted background size */
        }
    }
</style>

<div class="hero-slide owl-carousel site-blocks-cover">
    @foreach ($Sliders as $Slider )
        <div class="intro-section" style="background-image: url('images/{{$Slider->images}}');">
            {{-- <div class="container">
                <div class="row align-items-center">
                    Isi konten di sini
                </div>
            </div> --}}
        </div>
    @endforeach

    <div class="intro-section" style="background-image: url('{{asset('landingpage/images/smart_campus.jpg')}}');">
        {{-- <div class="container">
            <div class="row align-items-center">
                Isi konten di sini
            </div>
        </div> --}}
    </div>
</div>
