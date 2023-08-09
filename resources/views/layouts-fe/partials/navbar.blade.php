<header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container-fluid">

      <div class="row justify-content-center align-items-center">
        <div class="col-xl-11 d-flex align-items-center justify-content-between">
          <h1 class="logo"><a href="{{ url('/') }}">Rukun Warga</a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto active" href="#hero"></a></li>
              <li><a class="nav-link scrollto" href="#about"></a></li>
              <li><a class="nav-link scrollto" href="#services"></a></li>
              <li><a class="nav-link scrollto " href="#portfolio"></a></li>
              <li><a class="nav-link scrollto" href="#team"></a></li>
              <li><a class="nav-link  " href="blog.html"></a></li>
              @if (Auth::check() != null)
              <li><a class="nav-link scrollto" href="{{ url('/dashboard') }}">{{ Auth::user()->name }}</a></li>
              @else
              <li><a class="nav-link scrollto" href="{{ url('/login') }}">Login</a></li>
              @endif
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
        </div>
      </div>

    </div>
  </header>