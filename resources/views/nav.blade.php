<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="frontend/images/favicon.png" type="image/x-icon">

  <title>
    Giftos
  </title>


  <!-- slider stylesheet -->
  <link rel="stylesheet" type="frontend/text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.css') }}" />

  <!-- Custom styles for this template -->
  <link href=" {{ asset('frontend/css/style.css') }}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet" />
</head>
<style>
    .cart-icon {
    position: relative;
    display: inline-block;
}

.cart-icon .cart-count {
    position: absolute;
    bottom: -5px;
    right: -10px;
    background: red;
    color: #fff;
    padding: 3px 6px;
    border-radius: 50%;
    font-size: 8px;
    font-weight: bold;
}

</style>


<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="index.html">
          <span>
            آرائش
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  ">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('AllProducts') }}">
                Shop
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="why.html">
                Why Us
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="testimonial.html">
                Testimonial
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Contact Us</a>
            </li>
          </ul>
          <div class="user_option">

            @if (Auth::check() )
                 @php
                 if(Auth()->user()->Cart){
                $count = optional(Auth()->user()->Cart)->CartItem->count();
                 }
            @endphp

              <a href="{{ route('dashboard') }}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>
                Dashboard
              </span>
            </a>

            <a href="{{ route('get_cart') }}" class="cart-icon">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
               @if(Auth()->user()->Cart)
               <span class="cart-count">{{ $count }}</span>
                @endif
            </a>
            @else
            <a href="{{ route('login') }}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>
                Login
              </span>
            </a>
               <a href="{{ route('register') }}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>
               Sign Up
              </span>
            </a>
 @endif
            {{-- <form class="form-inline ">
              <button class="btn nav_search-btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </form> --}}
          </div>
        </div>
      </nav>
    </header>

   <section class="shop_section layout_padding">
@if(session('message_sent'))
    <div class="alert alert-success">
       {{ session('message_sent') }}
    </div>
@endif
@yield('cart')
@yield('product_detail')
@yield('product_detail_by_category')
@yield('category')
@yield('address')
@yield('ordermethod')



   </section>





  <!-- contact section -->

  <section class="contact_section ">
    <div class="container px-0">
      <div class="heading_container ">
        <h2 class="">
          Contact Us
        </h2>
      </div>
    </div>
    <div class="container container-bg">
      <div class="row">
        <div class="col-lg-7 col-md-6 px-0">
          <div class="map_container">
            <div class="map-responsive">
              <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Eiffel+Tower+Paris+France" width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%" allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-5 px-0" id="contact">
          <form action="{{ route('contactus') }}" method="POST">
            @csrf
            <div>
              <input type="text" placeholder="Name" name="name" />
            </div>
            <div>
              <input type="email" placeholder="Email" name="email" />
            </div>
            <div>
              <input type="text" placeholder="Phone" name="phone" />
            </div>
            <div>
              <input type="text" class="message-box" placeholder="Message" name="message" />
            </div>
            <div class="d-flex ">
              <button>
                SEND
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <br><br><br>

  <!-- end contact section -->



  <!-- info section -->

  <section class="info_section  layout_padding2-top">
    <div class="social_container">
      <div class="social_box">
        <a href="">
          <i class="fa fa-facebook" aria-hidden="true"></i>
        </a>
        <a href="">
          <i class="fa fa-twitter" aria-hidden="true"></i>
        </a>
        <a href="">
          <i class="fa fa-instagram" aria-hidden="true"></i>
        </a>
        <a href="">
          <i class="fa fa-youtube" aria-hidden="true"></i>
        </a>
      </div>
    </div>
    <div class="info_container ">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <h6>
              ABOUT US
            </h6>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit amet,
            </p>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="info_form ">
              <h5>
                Newsletter
              </h5>
              <form action="#">
                <input type="email" placeholder="Enter your email">
                <button>
                  Subscribe
                </button>
              </form>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <h6>
              NEED HELP
            </h6>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit amet,
            </p>
          </div>
          <div class="col-md-6 col-lg-3">
            <h6>
              CONTACT US
            </h6>
            <div class="info_link-box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span> Gb road 123 london Uk </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>+01 12345678901</span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span> demo@gmail.com</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- footer section -->
    <footer class=" footer_section">
      <div class="container">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Web Tech Knowledge</a>
        </p>
      </div>
    </footer>
    <!-- footer section -->

  </section>

  <!-- end info section -->


  <script src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="{{ asset('frontend/js/custom.js') }}"></script>

</body>

</html>
