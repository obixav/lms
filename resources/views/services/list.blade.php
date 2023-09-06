@extends('layouts.master')
@section('content')

    <!-- Page Banner Start -->
    <section class="page-banner bgs-cover text-white pt-65 pb-75"
             style="background-image: url(assets/images/banner.jpg);">
        <div class="container">
            <div class="banner-inner">
                <h2 class="page-title wow fadeInUp delay-0-2s">Services</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Services</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->



    <!-- What We Profide start -->
    <section class="what-we-provide  pt-75 pb-80"
             style="background-image: url(assets/images/background/what-we-provide.png);">
        <div class="container">
            <div class="section-title text-center mb-20 wow fadeInUp delay-0-2s">
                <span class="sub-title mb-10">What We Provide</span>
                <h2>Best Printing for the following</h2>
            </div>
            <div class="what-we-provide-active">
                <div class="what-we-provide-item hover-two wow fadeInUp delay-0-2s">
                    <i class="flaticon-t-shirt"></i>
                    <h6><a href="#">T-Shart Print</a></h6>
                </div>
                <div class="what-we-provide-item hover-two wow fadeInUp delay-0-3s">
                    <i class="flaticon-logo"></i>
                    <h6><a href="#">Logo Design</a></h6>
                </div>
                <div class="what-we-provide-item hover-two wow fadeInUp delay-0-4s">
                    <i class="flaticon-banner"></i>
                    <h6><a href="#">Banner Print</a></h6>
                </div>
                <div class="what-we-provide-item hover-two wow fadeInUp delay-0-5s">
                    <i class="flaticon-reading-book"></i>
                    <h6><a href="#">Books Print</a></h6>
                </div>
                <div class="what-we-provide-item hover-two wow fadeInUp delay-0-6s">
                    <i class="flaticon-debit-card"></i>
                    <h6><a href="#">Card Print</a></h6>
                </div>
                <div class="what-we-provide-item hover-two wow fadeInUp delay-0-7s">
                    <i class="flaticon-award"></i>
                    <h6><a href="#">Trophy Print</a></h6>
                </div>

            </div>
        </div>
    </section>
    <!-- What We Profide end -->



    <!-- Services Four Area start -->
    <section class="services-area-four bgc-lighter pt-120 pb-130">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-title text-center mb-55 wow fadeInUp delay-0-2s">
                        <span class="sub-title mb-10">Our Services</span>
                        <h2>We Provide Amazing Services For Printing and Design</h2>
                    </div>
                </div>
            </div>
            <div class="services-four-slider">
                @foreach($services as $service)
                    @php
                        $text = $service->details;
                        $truncated_text = substr($text, 0, 50);
                        $last_space = strrpos($truncated_text, " ");
                        $truncated_text = substr($truncated_text, 0, $last_space);
                        $truncated_text .= "...";
                    @endphp
                    <div class="service-item-four wow fadeInUp delay-0-2s">
                        <div class="image">
                            <img src="{{$service->getFirstMedia("*")->original_url}}" alt="Service">
                        </div>
                        <div class="content">
                            <h4><a href="{{url('services/'.$service->id)}}">{{$service->name}}</a></h4>
                            <p>{{$truncated_text}}</p>
                            <a href="{{url('services/'.$service->id)}}" class="theme-btn style-three">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- Services Four Area end -->

@endsection
