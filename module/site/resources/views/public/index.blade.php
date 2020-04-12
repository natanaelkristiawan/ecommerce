@extends('theme.public.layouts.index')

@section('content')


<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
  <div class="container d-flex align-items-center">

    <div class="logo mr-auto">
      <h1 class="text-light"><a href="index.html"><span>
      {{ $section1_title }}</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html"><img src="{{ asset('template/ecommerce') }}/assets/img/logo.png" alt="" class="img-fluid"></a>-->
    </div>

    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li class="active"><a href="#header">Home</a></li>
        <li><a href="#features">Features</a></li>
        <li><a href="#pricing">Pricing</a></li>
        <li><a href="" target="_blank">Contact Us</a></li>
        <li><a href="login/login.html">Sign In</a></li>

      </ul>
    </nav><!-- .nav-menu -->

  </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" style="background: url('{{ url('image/original/'.$background['path']) }}')">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
        <div data-aos="zoom-out">
          <h1>{{ $section1_caption_1 }}<span>
          {{ $section1_title }}</span></h1>
          <h2>{{ $section1_caption_2 }}</h2>
          <div class="text-center text-lg-left">
            <a href="#pricing" class="btn-get-started scrollto">View Product</a>
          </div>
        </div>
      </div>
      <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
        <img align="middle" src="{{ url('image/original/'.$logo['path']) }}" class="img-fluid animated" alt="logo-market">
      </div>
    </div>
  </div>

  <div class="hero-waves">
    <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave">
      <defs></defs>
      <path id="wave1" d="" />
    </svg>
    <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave">
      <defs></defs>
      <path id="wave2" d="" />
    </svg>
  </div>
</section><!-- End Hero -->

<main id="main">
  <!-- ======= Features Section ======= -->
  <section id="features" class="features">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>{{ $section2_title }}</h2>
        <p>{{ $section2_sub_title }}</p>
      </div>

      <div class="row" data-aos="fade-left">

        @foreach($section2_data as $key => $data)

        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
            <i class="{{ $dataIcon[ $key % 8 ]  }}" style="color: {{ $dataColor[ $key % 8 ]  }};"></i>
            <h3><a href="" target="_blank">{{ $data }}</a></h3>
          </div>
        </div>
        @endforeach
      </div>


    </div>
  </section><!-- End Features Section -->

  <!-- ======= Pricing Section ======= -->
  <section id="pricing" class="pricing">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Pricing</h2>
        <p>Check our Pricing</p>
      </div>

      <div class="row" data-aos="fade-left">

        @foreach($products as $key => $product)
         
            @foreach($product as $list)
            <div class="col-lg-3 col-md-6 {{ (bool)$key ? 'mt-5' : 'mt-4' }}">
              <div class="box" data-aos="zoom-in" data-aos-delay="100">
                <h3>{{ $list->name }}</h3>
                <h4><sup>$</sup>{{ $list->price_dollar }}<span> ({{ $list->price_idr }} IDR)</span></h4>
                {!! $list->detail !!}
                <div class="btn-wrap">
                  <a href="#" class="btn-buy">Buy Now</a>
                </div>
              </div>
            </div>
            @endforeach
      
        @endforeach





      </div>

    </div>
  </section><!-- End Pricing Section -->

  <!-- ======= Testimonials Section ======= -->
  <section id="testimonials" class="testimonials">
    <div class="container">

      <div class="owl-carousel testimonials-carousel" data-aos="zoom-in">
        
        @foreach($section3_quote as $list)

        <div class="testimonial-item">
          <p>
            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
            {!! $list !!}
            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
          </p>
        </div>

        @endforeach



      </div>

    </div>
  </section><!-- End Testimonials Section -->
</main>


<!-- ======= Footer ======= -->
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">


  <div class="container">
    <div class="copyright">
      Copyright &copy; {{ date('Y') }} <strong><span>Bootslander</span></strong>. All Rights Reserved
    </div>
   <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
  </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
<div id="preloader"></div>

@stop