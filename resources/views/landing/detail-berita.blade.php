@extends('layouts-fe.app')

@section('style-fe')

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
       <!-- ======= Blog Single Section ======= -->
       <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
  
          <div class="row">
  
            <div class="col-lg-12 entries">
  
              <article class="entry entry-single">
  
                <div class="entry-img">
                  <img src="{{ asset('img/berita/'.($berita->foto ?? 'user.png')) }}" alt="" class="img-fluid">
                </div>
  
                <h2 class="entry-title">
                  <a href="blog-single.html">{{ $berita->judul }}</a>
                </h2>
  
                <div class="entry-meta">
                  <ul>
                    {{-- <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">John Doe</a></li> --}}
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time datetime="{{ $berita->created_at }}">{{ $berita->created_at }}</time></a></li>
                    {{-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">12 Comments</a></li> --}}
                  </ul>
                </div>
  
                <div class="entry-content">
                    <?php
                        echo $berita->isi_berita;
                    ?>
                </div>
  
        
              </article><!-- End blog entry -->
  
     
  
            </div><!-- End blog entries list -->
  
        
          </div>
  
        </div>
      </section><!-- End Blog Single Section -->
</main><!-- End #main -->

  


@endsection

@section('script-fe')

@endsection