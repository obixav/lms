@extends('layouts.master')
@section('content')
    <!-- Page Banner Start -->
    <section class="page-banner style-two text-center bgc-lighter pt-70 pb-75">
        <div class="container">
            <div class="banner-inner pt-20">
                <h1 class="page-title wow fadeInUp delay-0-2s">404</h1>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->


    <!-- Error Page Start -->
    <section class="error-page-area py-130">
        <div class="container">
            <div class="error-page-content text-center">
                <div class="image mb-65 wow fadeInUp delay-0-2s">
                    <img src="{{asset('assets/images/404.png')}}" alt="404 Erro">
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="section-title wow fadeInUp delay-0-2s">
                            <h2><span>Opps!</span> This Page Can’t Be Found</h2>
                        </div>
                    </div>
                </div>
                <a href="{{url('/')}}" class="theme-btn mt-15 wow fadeInUp delay-0-2s">Go To Home <i class="far fa-long-arrow-right"></i></a>
            </div>
        </div>
    </section>
    <!-- Error Page End -->


    <!-- CTA Area start -->
    <section class="cta-area bgc-gradient">
        <div class="row">
            <div class="col-xl-4">
                <div class="cta-left-image rel z-1 wow fadeInLeft delay-0-4s">
                    <img src="assets/images/cta/cta-left.png" alt="CTA Left">
                    <div class="circle-shapes white-shape no-animation">
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
            <div class="col-xl-4 align-self-center">
                <div class="cta-content text-white py-55 wow fadeInUp delay-0-2s">
                    <div class="section-title mb-35">
                        <span class="sub-title mb-10">Contact With Us</span>
                        <h2>Need Any Printig For your Business?</h2>
                    </div>
                    <a href="projects.html" class="theme-btn">Start Your Projects <i class="far fa-long-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="cta-right-image rel z-1 wow fadeInRight delay-0-2s">
                    <img src="assets/images/cta/cta-right.png" alt="CTA Right">
                    <div class="circle-shapes white-shape no-animation">
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
    </section>
    <!-- CTA Area end -->


@endsection
