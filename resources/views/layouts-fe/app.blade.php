<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts-fe.partials.head')

 
</head>

<body>

  <!-- ======= Header ======= -->
  @include('layouts-fe.partials.navbar')
 
  <!-- End Header -->
  <!-- ======= hero Section ======= -->
  @yield('content')

  @include('layouts-fe.partials.footer')



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  @include('layouts-fe.partials.foot')

  {{-- script foot  --}}
</body>

</html>