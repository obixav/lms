@extends('layouts.master')
@section('content')
    <!-- Page Banner Start -->
    <section class="page-banner bgs-cover text-white pt-65 pb-75" style="background-image: url(assets/images/banner.jpg);">
        <div class="container">
            <div class="banner-inner">
                <h2 class="page-title wow fadeInUp delay-0-2s">{{$service->name}}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Service Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->
    <!-- Services Area start -->
    <section class="service-details-area pt-130 rpt-120 pb-110">
        <div class="container">
            <div class="row large-gap">
                <div class="col-lg-4">
                    <div class="service-sidebar rmb-75">
                        <div class="widget widget-category wow fadeInUp delay-0-2s">
                            <h4 class="widget-title before-circle">Services</h4>
                            <ul>
                                @foreach($services as $se)
                                <li><a href="{{url('services/'.$se->id)}}">{{$se->name}}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="widget widget-download wow fadeInUp delay-0-2s">
                            <h4 class="widget-title before-circle">Download</h4>
                            <div class="download-btns">
                                <a href="#" class="theme-btn style-three mb-20">Download Doc <i class="far fa-file-word"></i></a>
                                <a href="#" class="theme-btn style-three mb-35">Download pdf <i class="far fa-file-pdf"></i></a>
                            </div>
                            <h4 class="widget-title before-circle">Share Now</h4>
                            <div class="social-style-two">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="widget widget-cta wow fadeInUp delay-0-2s">
                            <span class="h5">Need Any printing</span>
                            <h3>Design or Service?</h3>
                            <h6>Right Place for Printing Service</h6>
                            <a href="contact.html" class="theme-btn mb-40">Talk With Us <i class="far fa-long-arrow-right"></i></a><br>
                            <img src="assets/images/widgets/cta.png" alt="CTA">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="service-details-content">
                        <div class="image mb-35 wow fadeInUp delay-0-2s">
                            <img src="{{$service->getFirstMedia("*")?$service->getFirstMedia("*")->original_url:''}}" alt="Service Details">
                        </div>
                        <h3 class="before-circle">3D Printing Design & Service</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque lau dantium totam rem aperiam eaque quae abillo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed quia consequuntur magni dolores eos qui ratione voluptatem sequi neciunt. Neque porro quisquam est qui dolorem ipsum quia dolor sit amet consectetur adipisci velit sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam nisi ut aliquid ex ea commodi consequatur</p>
                        <h4 class="before-circle mt-35">Printing Process</h4>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed sequuntur magni dolores eos qui ratione voluptatem sequi neciunt. Neque porro quisquam est qui dolo rem ipsum quia dolor sit amet consectetur adipisci velite</p>
                        <div class="row large-gap work-process-two-wrap justify-content-center mt-35 mb-20 rel z-1">
                            <div class="col-md-4 col-sm-6">
                                <div class="work-process-two-item wow fadeInUp delay-0-2s">
                                    <div class="icon">
                                        <i class="flaticon-curve"></i>
                                    </div>
                                    <span class="step-number">step 01</span>
                                    <h5>Design Plan</h5>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="work-process-two-item active wow fadeInUp delay-0-4s">
                                    <div class="icon">
                                        <i class="flaticon-print"></i>
                                    </div>
                                    <span class="step-number">step 02</span>
                                    <h5>Printing Now</h5>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="work-process-two-item wow fadeInUp delay-0-6s">
                                    <div class="icon">
                                        <i class="flaticon-clean-clothes"></i>
                                    </div>
                                    <span class="step-number">step 03</span>
                                    <h5>Get Result</h5>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <img class="work-step-arrow-one" src="assets/images/work-step/arrow.png" alt="Arrow">
                                <img class="work-step-arrow-two" src="assets/images/work-step/arrow.png" alt="Arrow">
                            </div>
                        </div>
                        <div class="image mb-40 wow fadeInUp delay-0-2s">
                            <img src="assets/images/services/service-middle.jpg" alt="Service Middle">
                        </div>
                        <h4 class="before-circle">Amazing Core Features</h4>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed sequuntur magni dolores eos qui ratione voluptatem sequi neciunt. Neque porro quisquam est qui dolo rem ipsum quia dolor sit amet consectetur adipisci velite</p>
                        <div class="accordion pt-10" id="faq-accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                        Why Come to Our Printco?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam aperiam eaquey quae abillo inventore</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                        What Services Are You Get It?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        <p>On the other hand we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire that they cannot foresee the pain and trouble that are bound</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                        How Much Price Our Services?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam aperiam eaquey quae abillo inventore</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                        Learn About Our Team Member?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam aperiam eaquey quae abillo inventore</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Area end -->


    <!-- Next Prev Post Area start -->
    <section class="next-prev-post-area pb-80">
        <div class="container">
            <hr>
            <div class="next-prev-post pt-65">
                <div class="prev-post wow fadeInLeft delay-0-2s">
                    <div class="image">
                        <img src="assets/images/blog/prev-post.jpg" alt="News">
                    </div>
                    <div class="content">
                        <h5><a href="blog-details.html">Digital Printing</a></h5>
                        <a href="blog-details.html" class="read-more">Read More <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <a class="show-all" href="blog.html">
                    <i class="far fa-ellipsis-h"></i>
                    <i class="far fa-ellipsis-h"></i>
                    <i class="far fa-ellipsis-h"></i>
                </a>
                <div class="next-post wow fadeInRight delay-0-2s">
                    <div class="content">
                        <h5><a href="blog-details.html">Ofset Printing</a></h5>
                        <a href="blog-details.html" class="read-more">Read More <i class="far fa-long-arrow-right"></i></a>
                    </div>
                    <div class="image">
                        <img src="assets/images/blog/next-post.jpg" alt="News">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Next Prev Post Area end -->


@endsection
