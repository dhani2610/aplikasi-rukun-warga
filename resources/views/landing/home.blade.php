@extends('layouts-fe.app')

@section('style-fe')
<style>
#hero .carousel-item::before {
    background: none!important;
    }
</style>
@endsection

@section('content')

<section id="hero">

    <div class="hero-container">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <ol id="hero-carousel-indicators" class="carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

            @foreach ($slider as $item)
                
                <div class="carousel-item active" style="background-image: url({{asset('img/slider/'.($item->foto ?? 'user.png'))}})">
                <div class="carousel-container">
                    
                </div>
                </div>
            @endforeach

            {{-- <div class="carousel-item" style="background-image: url({{asset('BizPage/assets/img/hero-carousel/2.jpg')}})">
            <div class="carousel-container">
            
            </div>
            </div>

            <div class="carousel-item" style="background-image: url({{asset('BizPage/assets/img/hero-carousel/3.jpg')}})">
            <div class="carousel-container">
            
            </div>
            </div>

            <div class="carousel-item" style="background-image: url({{asset('BizPage/assets/img/hero-carousel/4.jpg')}})">
            <div class="carousel-container">
            
            </div>
            </div>

            <div class="carousel-item" style="background-image: url({{asset('BizPage/assets/img/hero-carousel/5.jpg')}})">
            <div class="carousel-container">
            
            </div>
            </div> --}}

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        </div>
    </div>

</section><!-- End Hero Section -->

<main id="main">
    <!-- ======= About Us Section ======= -->
    <section id="about">
        <div class="container" data-aos="fade-up">
  
          <header class="section-header">
            <h3>Berita</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </header>
  
          <div class="row about-cols">
  
            @foreach ($berita as $item)
                <div class="col-md-4" onclick="location.href='{{ route('berita',$item->id) }}'" data-aos="fade-up" data-aos-delay="100">
                    <div class="about-col">
                        <div class="img">
                        <img src="{{ asset('img/berita/'.($item->foto ?? 'user.png')) }}" alt="" class="img-fluid" style="max-width:273px">
                        {{-- <div class="icon"><i class="bi bi-bar-chart"></i></div> --}}
                        </div>
                        <h2 class="title mb-2" style="padding-bottom: 20px;"><a href="#">{{ $item->judul }}</a></h2>
                        {{-- <p>
                        Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p> --}}
                    </div>
                </div>
            @endforeach
  
          </div>
  
        </div>
    </section><!-- End About Us Section -->
</main><!-- End #main -->

  


@endsection

@section('script-fe')

@endsection