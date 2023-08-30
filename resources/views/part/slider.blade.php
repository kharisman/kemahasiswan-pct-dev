<div class="hero-slide owl-carousel site-blocks-cover">

    @foreach ($Sliders as $Slider )

        <div class="intro-section" style="background-image: url('{{$Slider->images}}');">
            {{-- <div class="container">
                <div class="row align-items-center">

                </div>
            </div> --}}
        </div>
        
    @endforeach
    

    <div class="intro-section" style="background-image: url('{{asset('landingpage/images/smart_campus.jpg')}}');">
        
    </div>

</div>