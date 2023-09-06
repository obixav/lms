@php
    $company=company_info();
@endphp
    <!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$company->store_name}}</title>
    <link rel=icon href="assets/images/favicon.png" sizes="20x20" type="image/png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.min.css">
    <link rel="stylesheet" href="assets/css/slick.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    @livewireStyles
</head>

<body>
<div class="page-wrapper">

    {{--        <!-- preloader area start -->--}}
    {{--        <div class="preloader" id="preloader"></div>--}}
    {{--        <!-- preloader area end -->--}}

    <!-- search popup start-->
    <div class="td-search-popup" id="td-search-popup">
        <form action="index.html" class="search-form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search....." required>
            </div>
            <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!-- search popup end-->
    <div class="body-overlay" id="body-overlay"></div>


    <!--Form Back Drop-->
    <div class="form-back-drop"></div>

    <!-- Hidden Sidebar -->
    <section class="hidden-bar">
        <div class="inner-box text-center">
            <div class="cross-icon"><span class="fa fa-times"></span></div>
            <div class="title">
                <h4>Design Request</h4>
            </div>

            <!--Appointment Form-->
            <div class="appointment-form">
                <form method="post" action="contact.html">
                    <div class="form-group">
                        <input type="text" name="text" value="" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" value="" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" value="" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group" style="text-align: left;">
                        <label>Project Type</label><br>
                        @foreach($project_categories as $pc)
                            <input type="radio" name="category_id" value="{{$pc->id}}" required>{{$pc->name}}<br>
                        @endforeach


                    </div>
                    <div class="form-group">
                        <input type="number" name="phone" class="" value="" placeholder="Item Quantity" required>
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Message" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="theme-btn">Submit now</button>
                    </div>
                </form>
            </div>

            <!--Social Icons-->
            <div class="social-style-one">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-pinterest-p"></i></a>
            </div>
        </div>
    </section>
    <!--End Hidden Sidebar -->


    <!-- navbar start -->
    <header class="header-wrapper">
        <div class="navbar-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="topbar-left rmb-10 text-lg-start text-center">
                            <span class="off">{{$company->discount_announcement}}</span>
                            <span>{{$company->small_announcement}}</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="index.html"><img src="assets/images/logos/logo.png" alt="img"></a>
                        </div>
                    </div>
                    {{--                        <div class="col-lg-5">--}}
                    {{--                            <div class="topbar-right justify-content-center justify-content-lg-end">--}}
                    {{--                                <select name="currentcy" id="currentcy">--}}
                    {{--                                    <option value="USD">USD</option>--}}
                    {{--                                    <option value="BDT">BDT</option>--}}
                    {{--                                    <option value="EURO">EURO</option>--}}
                    {{--                                </select>--}}

                    {{--                                <select name="language" id="language">--}}
                    {{--                                    <option value="English">English</option>--}}
                    {{--                                    <option value="Bengali">Bengali</option>--}}
                    {{--                                    <option value="Arabic">Arabic</option>--}}
                    {{--                                </select>--}}

                    {{--                                <div class="follower">--}}
                    {{--                                    <i class="fab fa-facebook"></i>--}}
                    {{--                                    <a href="#">250k+ Followers</a>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                </div>
            </div>
        </div>
        <nav class="navbar navbar-area navbar-expand-lg">
            <div class="container rpy-10">
                <div class="responsive-mobile-menu">
                    <button class="menu toggle-btn d-block d-lg-none" data-target="#Iitechie_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-left"></span>
                        <span class="icon-right"></span>
                    </button>
                </div>
                <div class="mobile-logo">
                    <a href="{{url('/')}}"><img src="{{asset('assets/images/logos/logo5.png')}}" alt="img"></a>
                </div>
                <div class="nav-right-part nav-right-part-mobile">
                    <a class="search-bar-btn" href="#">
                        <i class="far fa-search"></i>
                    </a>
                </div>
                @include('layouts.nav')
                <div class="nav-right-part nav-right-part-desktop">
                    <button class="search-bar-btn">
                        <i class="far fa-search"></i>
                    </button>
                    <livewire:cart />
                    <button>
                        <i class="far fa-heart"></i>
                    </button>
                    <div class="menu-sidebar">
                        <button title="Design request">
                            <i class="far fa-ellipsis-h"></i>
                            <i class="far fa-ellipsis-h"></i>
                            <i class="far fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- navbar end -->


    <!-- hero Area start -->
    <div class="hero-three-area bgc-lighter text-center pt-145 rel z-1">
        <div class="container-fluid">
            <div class="row justify-content-around">
                <div class="col-xl-4 align-self-center">
                    <div class="hero-left-image my-80 rel wow fadeInUp delay-0-2s">
                        <!--<img src="assets/images/hero/hero-three-left.png" alt="Hero">-->
                    </div>
                </div>
                <div class="col-xl-3 col-lg-7 col-md-9 col-sm-11 align-self-center">
                    <div class="hero-three-content mb-20 rel z-2 wow fadeInDown delay-0-4s">
                        <span class="sub-title pt-10 mb-15">{{$company->store_name}}</span>
                        <h1>Creative Print & Design Agency</h1>
                        <p>{{$company->big_announcement}}</p>
                        <div class="hero-btns justify-content-center">
                            <a href="{{url('design-request')}}" class="theme-btn mt-20">Talk With Us <i class="far fa-long-arrow-right"></i></a>
                            <a target="_blank" href="{{url('projects')}}" class="theme-btn style-three mt-20">Latest Projects <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 align-self-end">
                    <div class="hero-right-image rel wow fadeInUp delay-0-6s">
                        <img src="assets/images/hero/hero-three-right.png" alt="Hero">
                        <div class="circle-shapes">
                            <div class="shape-inner">
                                <span class="dot-one"></span>
                                <span class="dot-two"></span>
                                <span class="dot-three"></span>
                                <span class="dot-four"></span>
                                <span class="dot-five"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img class="hero-bg-circle" src="assets/images/hero/hero-bg-circle.png" alt="Shape">
    </div>
    <!-- hero Area end -->


    <!-- Category Area start -->
    <section class="category-area bgc-black text-white pt-80 pb-50">
        <div class="container container-1570">
            <div class="row">
                <div class="col-xl-2 col-lg-6 offset-xl-1 text-center">
                    <div class="category-circle-shape wow fadeInLeft delay-0-2s">
                        <div class="icon">
                            <i class="fal fa-arrow-alt-right"></i>
                        </div>
                        <img src="assets/images/category/circle-shape.png" alt="Shape">
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="cetagory-item wow fadeInLeft delay-0-4s">
                        <img src="assets/images/category/category1.jpg" alt="Category">
                        <h3>T-shirts</h3>
                        <a class="details-btn" href="{{url('products')}}?q=shirt"><i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="cetagory-item wow fadeInLeft delay-0-6s">
                        <img src="assets/images/category/category2.jpg" alt="Category">
                        <h3>Business Cards</h3>
                        <a class="details-btn" href="{{url('products')}}?q=business"><i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 offset-xl-1">
                    <div class="cetagory-item wow fadeInRight delay-0-2s">
                        <img src="assets/images/category/category3.jpg" alt="Category">
                        <h3>Frames</h3>
                        <a class="details-btn" href="{{url('products')}}?q=frame"><i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="cetagory-item wow fadeInRight delay-0-4s">
                        <img src="assets/images/category/category4.jpg" alt="Category">
                        <h3>Mugs</h3>
                        <a class="details-btn" href="{{url('products')}}?q=mug"><i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-6 align-self-center">
                    <a class="category-more-btn wow fadeInRight delay-0-6s" href="#">
                        <i class="far fa-long-arrow-right"></i>
                        <span>View More Categories</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Category Area end -->


    <!-- Offer Banners Start -->
    <section class="offer-banners pt-30">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-6">
                    <div class="offer-banner-item wow fadeInUp delay-0-2s" style="background-image: url(assets/images/offers/offer-banner1.png);">
                        <div class="content">
                            <span class="off">23% OFF</span>
                            <h3>Award Designs<br>Glass and Acrylic</h3>
                            <a href="{{url('products')}}?q=award" class="theme-btn style-three">Shop Now <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="offer-banner-item wow fadeInUp delay-0-4s" style="background-image: url(assets/images/offers/offer-banner2.png);">
                        <div class="content">
                            <span class="off">50% OFF</span>
                            <h3>Mug Design<br>Hot or Cold</h3>
                            <a href="{{url('products')}}?q=mug" class="theme-btn style-three">Shop Now <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="offer-banner-item wow fadeInUp delay-0-6s" style="background-image: url(assets/images/offers/offer-banner3.png);">
                        <div class="content">
                            <span class="off">49% OFF</span>
                            <h3>Gift Bag Design <br>For Souvenirs</h3>
                            <a href="{{url('products')}}?q=bag" class="theme-btn style-three">Shop Now <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Offer Banners End -->


    <!-- Shop Area start -->
    <section class="shop-area pt-60">
        <div class="container">
            <div class="row justify-content-between align-items-end pb-20">
                <div class="col-lg-9">
                    <div class="section-title mb-25 wow fadeInUp delay-0-2s">
                        <span class="sub-title mb-10">Visit Our Shop</span>
                        <h2>Explore Featured Products</h2>
                    </div>
                </div>
                <div class="col-lg-3 text-lg-end">
                    <a href="{{url('products')}}" class="theme-btn mb-25 wow fadeInUp delay-0-4s">View More <i class="far fa-long-arrow-right"></i></a>
                </div>
            </div>
            <div class="product-two-slider">
                @foreach($featured_products as $fp)
                    <div class="product-item-two wow fadeInUp delay-0-2s">
                        <div class="image">
                            <img style="width: 250px;height: 250px;" src="{{$fp->getFirstMedia("*")?$fp->getFirstMedia("*")->original_url:asset('assets/images/shop/product-two4.jpg')}}" alt="Product">
                        </div>
                        <div class="content">
                            <div class="title-price">
                                <span class="category">{{$fp->product_category?$fp->product_category->name:''}}</span>
                                <h5><a href="{{url('products/'.$fp->id)}}">{{$fp->name}}</a></h5>
                                <span style="color: red;">&#8358;{{$fp->price}}</span>
                            </div>
                            <a href="{{url('products/'.$fp->id)}}" class="theme-btn style-three">Shop Now <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- Shop Area end -->


    <!-- Work Process Area start -->
    <section class="work-process-area mt-90 mb-100">
        <div class="container container-1350 pb-55">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7">
                    <div class="section-title text-center mb-75 wow fadeInUp delay-0-2s">
                        <span class="sub-title mb-10">Working Process</span>
                        <h2>How Do We Works</h2>
                    </div>
                </div>
            </div>
            <div class="row rel z-1 justify-content-around">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="work-process-item wow fadeInUp delay-0-2s">
                        <div class="image">
                            <img src="assets/images/work-step/work-step1.png" alt="Work Step">
                        </div>
                        <span class="step-number">step 01</span>
                        <h5>Upload your design</h5>
                        <!--<p>Sed ut perspiciatis unde omnis natus error voluptatem</p>-->
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="work-process-item active wow fadeInUp delay-0-4s">
                        <div class="image">
                            <img src="assets/images/work-step/work-step2.png" alt="Work Step">
                        </div>
                        <span class="step-number">step 02</span>
                        <h5>We review it </h5>
                        <!--<p>Sed ut perspiciatis unde omnis natus error voluptatem</p>-->
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="work-process-item wow fadeInUp delay-0-6s">
                        <div class="image">
                            <img src="assets/images/work-step/work-step3.png" alt="Work Step">
                        </div>
                        <span class="step-number">step 03</span>
                        <h5>We print it</h5>
                        <!--<p>Sed ut perspiciatis unde omnis natus error voluptatem</p>-->
                    </div>
                </div>
                <div class="col-lg-12">
                    <img class="work-step-arrow-one" src="assets/images/work-step/arrow.png" alt="Arrow">
                    <img class="work-step-arrow-two" src="assets/images/work-step/arrow.png" alt="Arrow">
                </div>
            </div>
        </div>
    </section>
    <!-- Work Process Area end -->



    <!-- Services Three Area start -->
    <section class="services-three-area pt-80 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="service-item-three wow fadeInUp delay-0-2s">
                        <div class="icon">
                            <img src="assets/images/services/icon1.png" alt="Icon">
                        </div>
                        <h5><a href="service-details.html">T-Shirt Design</a></h5>
                        <!--<p>Sed ut perspiciatis unde omnste natus error</p>-->
                        <a href="#" class="read-more">Read More <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="service-item-three wow fadeInUp delay-0-4s">
                        <div class="icon">
                            <img src="assets/images/services/icon2.png" alt="Icon">
                        </div>
                        <h5><a href="service-details.html">T-Shirt Printing</a></h5>
                        <!--<p>Sed ut perspiciatis unde omnste natus error</p>-->
                        <a href="#" class="read-more">Read More <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="service-item-three wow fadeInUp delay-0-6s">
                        <div class="icon">
                            <img src="assets/images/services/icon3.png" alt="Icon">
                        </div>
                        <h5><a href="service-details.html">Logo Design</a></h5>
                        <!--<p>Sed ut perspiciatis unde omnste natus error</p>-->
                        <a href=#" class="read-more">Read More <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="service-item-three wow fadeInUp delay-0-8s">
                        <div class="icon">
                            <img src="assets/images/services/icon4.png" alt="Icon">
                        </div>
                        <h5><a href="service-details.html">3D Printing</a></h5>
                        <!--<p>Sed ut perspiciatis unde omnste natus error</p>-->
                        <a href="#" class="read-more">Read More <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Three Area end -->


    <!-- About Three Area start -->
    <section class="about-three py-100">
        <div class="container">
            <div class="row large-gap align-items-center justify-content-center">
                <div class="col-lg-6">
                    <div class="about-three-image rmb-55 wow fadeInLeft delay-0-2s">
                        <img src="assets/images/about/about-three.png" alt="About">
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="about-three-content wow fadeInRight delay-0-2s">
                        <div class="section-title mb-30">
                            <span class="sub-title mb-5">Why Choose Us</span>
                            <h2>Experience Allows Us To Print Things</h2>
                        </div>
                        <p>Join our happy customers who made Rich Concept Unlimited their most preferred printing destination in Nigeria</p>
                        <ul class="list-style-two pt-10">
                            <li>Logo Design & Printing</li>
                            <li>Banner Design & Printing</li>
                            <li>Book Cover Printing</li>
                        </ul>
                        <a href="{{url('about')}}" class="theme-btn mt-35">Learn More <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Three Area end -->


    <!-- Feature Area start -->
    <section class="feature-area pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-6">
                    <div class="feature-item wow fadeInUp delay-0-2s">
                        <div class="icon">
                            <i class="fal fa-building"></i>
                        </div>
                        <div class="content">
                            <h5><a href="#">One Stop Shop</a></h5>
                            <p> From the design and print of Business Cards, Frames, Throwpillows,
                                Mugs, Corporate Stationary, Display Banners, Signs and Displays, Stamps and Seals, Marketing Materials to the
                                Branding of Vehicles, Clothing, Gifts and Souvenirs</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="feature-item wow fadeInUp delay-0-4s">
                        <div class="icon">
                            <i class="fal fa-shipping-fast"></i>
                        </div>
                        <div class="content">
                            <h5><a href="#">Quick Delivery</a></h5>
                            <p>Our project timeline is important to us </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="feature-item wow fadeInUp delay-0-6s">
                        <div class="icon">
                            <i class="flaticon-update"></i>
                        </div>
                        <div class="content">
                            <h5><a href="#">Premium Quality</a></h5>
                            <p>Delivering excellence is in our DNA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Feature Area end -->


    <!-- Testimonials Area start -->
    <section class="testimonials-three-area bgc-lighter pt-90 pb-100">
        <div class="container rel z-1">
            <div class="section-title text-center mb-55 wow fadeInUp delay-0-2s">
                <span class="sub-title mb-10">Clients Feedback</span>
                <h2>What Our Clients Say Us</h2>
            </div>
            <div class="testimonial-three-slider">
                @foreach($clients as $client)
                    <div class="testimonial-two-item style-two wow fadeInUp delay-0-2s">
                        <div class="image"><img src="{{$client->getFirstMedia("*")?$client->getFirstMedia("*")->original_url:''}}" alt="Author"></div>
                        <p>{{$client->comment}}</p>
                        <div class="quote"><i class="flaticon-quotation-mark"></i></div>
                        <h5 class="name">{{$client->name}}</h5>
                        <span class="designation">{{$client->designation}}</span>
                    </div>
                @endforeach

            </div>
            <div class="circle-shapes">
                <div class="shape-inner">
                    <span class="dot-one"></span>
                    <span class="dot-two"></span>
                    <span class="dot-three"></span>
                    <span class="dot-four"></span>
                    <span class="dot-five"></span>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials Area end -->



    @include('layouts.footer')
</div>
<!--End pagewrapper-->

<!-- all plugins here -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/isotope.min.js"></script>
<script src="assets/js/appear.min.js"></script>
<script src="assets/js/imageload.min.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/circle-progress.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<script src="assets/js/skill.bars.jquery.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/wow.min.js"></script>

<!-- main js  -->
@livewireScripts
<script src="assets/js/main.js"></script>
<script>
    $('.shopping-cart').each(function() {
        var delay = $(this).index() * 50 + 'ms';
        $(this).css({
            '-webkit-transition-delay': delay,
            '-moz-transition-delay': delay,
            '-o-transition-delay': delay,
            'transition-delay': delay
        });
    });
    $('#cart, .shopping-cart').hover(function(e) {
        $(".shopping-cart").stop(true, true).addClass("active");
    }, function() {
        $(".shopping-cart").stop(true, true).removeClass("active");
    });
</script>
</body>

</html>
