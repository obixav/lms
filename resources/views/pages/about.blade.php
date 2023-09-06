@extends('layouts.master')
@section('content')
    <!-- Page Banner Start -->
    <section class="page-banner bgs-cover text-white pt-65 pb-75" style="background-image: url(assets/images/banner.jpg);">
        <div class="container">
            <div class="banner-inner">
                <h2 class="page-title wow fadeInUp delay-0-2s">About Us</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">About Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->


    <!-- About Area start -->
    <div class="about-page-area py-130 rpt-120 rel z-1">
        <div class="container">
            <div class="row large-gap justify-content-between">
                <div class="col-lg-6">
                    <div class="about-page-content rmb-65 wow fadeInUp delay-0-2s">
                        <div class="section-title mb-20">
                            <span class="sub-title mb-15">About Company</span>
                            <h2>We are Printing & Services Company Based in Lagos Nigeria</h2>
                        </div>
                        <p>
                            Rich Concept Unlimited is Nigeria's most innovative Printing and Branding Company based in Lagos, Nigeria; Our designs are
                            brilliant and our prints, very exclusive.<br>
                            We offer full range of printing and branding services to a wide range of clients operating across different industry sectors all across Nigeria and beyond.
                            <br>
                            Rich Concept Unlimited is a One stop shop for all your printing needs; our custom made
                            solutions are tailored specifically to meet your peculiar needs ensuring the best output throughout the process.
                            <br>
                            Join our happy customers who made Rich Concept Unlimited their most preferred printing destination in Nigeria.
                            <br>
                            Let us earn your loyalty, give us a trial Today.
                            <br>
                            Our project timeline is as important to us as our delivering excellence in print. From the design and print of Business Cards, Frames, Throw-pillows,
                            Mugs, Corporate Stationary, Display Banners, Signs and Displays, Stamps and Seals, Marketing Materials to the
                            Branding of Vehicles, Clothing, Gifts and Souvenirs, we provide quality finishing using our cutting-edge printing technology."
                        </p>
                        <div class="about-btns pt-5">
                            <a href="#" class="theme-btn mt-20">Learn More <i class="far fa-long-arrow-right"></i></a>
{{--                            <a href="https://www.youtube.com/watch?v=9Y7ma241N8k" class="mfp-iframe about-video-play mt-20"><i class="fas fa-play"></i> <span>How IT Works</span></a>--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mission-vision-part">
                        <div class="mission-vision-item wow fadeInUp delay-0-4s">
                            <div class="progress-content one">
                                <i class="flaticon-target"></i>
                            </div>
                            <div class="content">
                                <h4>Our Mission</h4>
                                <p>Our company is here to ease the stress of printing, with our innovative, idea and team work. Solve all printing problems, providing quality finishing using our cutting – edge printing technology.
                                </p>
                            </div>
                        </div>
                        <div class="mission-vision-item wow fadeInUp delay-0-6s">
                            <div class="progress-content two">
                                <i class="flaticon-mission"></i>
                            </div>
                            <div class="content">
                                <h4>Our Vision</h4>
                                <p>We aim to solve all printing challenges both now, the future and also make everyone see the beauty of colours and digital designs.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Area end -->


    <!-- Fact Counter start -->
    <div class="video-fact-counter bgc-lighter" style="background-image: url(assets/images/about/about-counter-bg.png);">
        <div class="container">
{{--            <div class="about-video about-page-video">--}}
{{--                <img src="assets/images/about/about-page-video.jpg" alt="About">--}}
{{--                <a href="https://www.youtube.com/watch?v=9Y7ma241N8k" class="mfp-iframe video-play"><i class="fas fa-play"></i></a>--}}
{{--            </div>--}}
            <div class="row pt-80 pb-50">
                <div class="col-xl-3 col-md-6">
                    <div class="counter-item wow fadeInUp delay-0-2s">
                        <div class="icon">
                            <i class="far fa-plus"></i>
                        </div>
                        <p>Brands we have worked with</p>
                        <span class="count-text plus" data-speed="3000" data-stop="100">0</span>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="counter-item wow fadeInUp delay-0-4s">
                        <div class="icon">
                            <i class="far fa-plus"></i>
                        </div>
                        <p>We Have Done lot’s of Printing Projects</p>
                        <span class="count-text plus" data-speed="3000" data-stop="1000">0</span>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="counter-item wow fadeInUp delay-0-6s">
                        <div class="icon">
                            <i class="far fa-plus"></i>
                        </div>
                        <p>Project We Completed Along the Way</p>
                        <span class="count-text plus" data-speed="3000" data-stop="30">0</span>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="counter-item wow fadeInUp delay-0-8s">
                        <div class="icon">
                            <i class="far fa-plus"></i>
                        </div>
                        <p>We Have Many Years Of Experience</p>
                        <span class="count-text plus" data-speed="3000" data-stop="8">0</span>
                    </div>
                </div>
            </div>
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
    <!-- Fact Counter end -->


    <!-- Team Area start -->
    <section class="team-area rel z-1 pt-120 pb-130">
        <div class="container">
            <div class="row justify-content-between align-items-end pb-25">
                <div class="col-xl-6 col-lg-8">
                    <div class="section-title mb-25 wow fadeInUp delay-0-2s">
                        <span class="sub-title mb-10">Our Team Member</span>
                        <h2>We Have Experienced Team Members. Meet Our Team</h2>
                    </div>
                </div>
                <div class="col-lg-3 text-lg-end">
                    <a href="#" class="theme-btn mb-35 wow fadeInUp delay-0-4s">View More <i class="far fa-long-arrow-right"></i></a>
                </div>
            </div>
            <div class="team-slider">
                @foreach($team_members as $team_member)
                <div class="team-member wow fadeInUp delay-0-2s">
                    <div class="image">
                        <img src="{{$team_member->getFirstMedia("*")?$team_member->getFirstMedia("*")->preview_url:''}}" alt="Member">
                    </div>
                    <div class="content">
                        <h5>{{$team_member->name}}</h5>
                        <span class="designation">{{$team_member->role}}</span>
                        <div class="social-style-two">
                            <a href="https://facebook.com/{{$team_member->facebook}}"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/{{$team_member->twitter}}"><i class="fab fa-twitter"></i></a>
{{--                            <a href="#"><i class="fab fa-dribbble"></i></a>--}}
{{--                            <a href="#"><i class="fab fa-instagram"></i></a>--}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
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
    </section>
    <!-- Team Area end -->


    <!-- Why Choose Area start -->
    <div class="why-choose-three pt-120 pb-100 rel z-1 bgc-black text-white">
        <div class="container">
            <div class="services-inner ">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-title text-center mb-60">
                            <span class="sub-title mb-15">Why Choose us</span>
                            <h2>Amazing Features For Printing Design and Services</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="service-item style-three wow fadeInUp delay-0-2s">
                            <div class="icon">
                                <i class="flaticon-network"></i>
                            </div>
                            <h5><a href="{{url('services')}}">Experience Team</a></h5>
                            <p>Our team is made up of world class professionals</p>
                            <div class="bg-image" style="background-image: url(assets/images/services/service-bg-three.jpg);"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="service-item style-three wow fadeInUp delay-0-4s">
                            <div class="icon">
                                <i class="flaticon-air-plane"></i>
                            </div>
                            <h5><a href="{{url('services')}}">Quick Delivery</a></h5>
                            <p>Our project timeline is as important to us as our delivering excellence in print</p>
                            <div class="bg-image" style="background-image: url(assets/images/services/service-bg-three.jpg);"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="service-item style-three wow fadeInUp delay-0-6s">
                            <div class="icon">
                                <i class="flaticon-award"></i>
                            </div>
                            <h5><a href="{{url('services')}}">Quality Services</a></h5>
                            <p>Delivering excellence in our DNA</p>
                            <div class="bg-image" style="background-image: url(assets/images/services/service-bg-three.jpg);"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="service-item style-three wow fadeInUp delay-0-8s">
                            <div class="icon">
                                <i class="flaticon-technical-support"></i>
                            </div>
                            <h5><a href="{{url('services')}}">100% Support</a></h5>
                            <p>Join our happy customers who made Rich Concept Unlimited their most preferred printing destination in Nigeria</p>
                            <div class="bg-image" style="background-image: url(assets/images/services/service-bg-three.jpg);"></div>
                        </div>
                    </div>
                </div>
            </div>
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
    <!-- Why Choose Area end -->


    <!-- Testimonials start -->
    <section class="testimonials-area py-130">
        <div class="container rel">
            <div class="row justify-content-between pb-35">
                <div class="col-lg-5">
                    <div class="section-title mb-20 wow fadeInRight delay-0-2s">
                        <span class="sub-title mb-10">Our Testimonials</span>
                        <h2>What Our Clients Say About Services</h2>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="global-clients mb-20 wow fadeInLeft delay-0-2s">
                        <h5>Global Clients</h5>
                        <div class="images">
                            @foreach($clients as $client)
                            <img src="{{$client->getFirstMedia("*")?$client->getFirstMedia("*")->preview_url:''}}" alt="Global client">
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-active">
                @foreach($clients as $client)
                <div class="testimonial-item">
                    <div class="image">
                        <img src="{{$client->getFirstMedia("*")?$client->getFirstMedia("*")->original_url:''}}" alt="Testimonial">
                    </div>
                    <div class="content">
                        <div class="text">
                           {{$client->comment}}
                        </div>
                        <div class="author">
                            <img src="{{$client->getFirstMedia("*")?$client->getFirstMedia("*")->preview_url:''}}" alt="Author">
                            <div class="title">
                                <h5>{{$client->name}}</h5>
                                <span>{{$client->designation}}</span>
                            </div>
                        </div>
                    </div>
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
    <!-- Testimonials end -->


@endsection
@section('scripts')

@endsection
