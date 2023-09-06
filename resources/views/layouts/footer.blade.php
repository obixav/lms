<!-- CTA Area start -->
<section class="cta-area bgc-gradient">
    <div class="row">
        <div class="col-xl-4">
            <div class="cta-left-image rel z-1 wow fadeInLeft delay-0-4s">
                <img src="{{asset('assets/images/cta/cta-left.png')}}" alt="CTA Left">
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
                    <h2>Need Any Printing For your Business?</h2>
                </div>
                <a href="projects.html" class="theme-btn">Start Your Projects <i class="far fa-long-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="cta-right-image rel z-1 wow fadeInRight delay-0-2s">
                <img src="{{asset('assets/images/cta/cta-right.png')}}" alt="CTA Right">
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



<!-- footer top start -->
@php
    $projects=projects();
@endphp
<div class="footer-top pt-100">
    <div class="container">
        <div class="footer-top-projects">

            @foreach($projects as $project)
                <div class="footer-project-item wow fadeInUp delay-0-2s">
                    <img src="{{$project->getFirstMedia("project_main_image")?$project->getFirstMedia("project_main_image")->original_url:asset('assets/images/footer/gallery1.jpg')}}" alt="Gallery">
                    <div class="content">
                        <h6><a href="{{url('projects/'.$project->id)}}">{{$project->name}}</a></h6>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
<!-- footer top end -->


<!-- footer area start -->
<footer class="footer-area pt-80">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="widget widget_about wow fadeInUp delay-0-2s">
                    <div class="footer-logo mb-25">
                        <a href="{{url('/')}}"><img src="{{asset('assets/images/logos/logo.png')}}" alt="Logo"></a>
                    </div>
                    <p>Rich Concept Unlimited is a One stop shop for all your printing needs; our custom made
                        solutions are tailored specifically to meet your peculiar needs ensuring the best output throughout the process.</p>
                    <div class="social-style-two mt-15">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-dribbble"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="widget widget_nav_menu wow fadeInUp delay-0-4s">
                    <h4 class="widget-title">Useful Links</h4>
                    <ul>
                        <li><a href="#">Digital Printing</a></li>
                        <li><a href="#">Latest News</a></li>
                        <li><a href="#">3D Printing</a></li>
                        <li><a href="#">Printing & Design</a></li>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Ofset Printing</a></li>
                        <li><a href="#">Shopping Cart</a></li>
                        <li><a href="#">Logo Design</a></li>
                        <li><a href="#">Payment Method</a></li>
                        <li><a href="#">T-Shirt Pringting</a></li>
                        <li><a href="#">Faqs</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="widget widget_contact_info wow fadeInUp delay-0-6s">
                    <h4 class="widget-title">Support</h4>
                    <p>Need Any Support From Us? Let's Work Together!</p>
                    <ul>
                        <li><i class="far fa-map-marker-alt"></i> {{$company->address}}</li>
                        <li><i class="far fa-envelope"></i> <a
                                href="mailto:{{$company->email}}">{{$company->email}}</a></li>
                        <li><i class="far fa-phone"></i> <a href="calto:{{$company->phone}}">{{$company->phone}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom mt-15 pt-25 pb-10">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="copyright-text text-center text-lg-start">
                        <p><a href="{{url('/')}}">{{$company->store_name}}</a> © {{date('Y')}} All Rights Reserved</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="payment-method-image mb-15 text-center text-lg-end">
                        <a href="#"><img src="{{asset('assets/images/footer/payment-method.png')}}"
                                         alt="Payment Method"></a>
                    </div>
                </div>
            </div>

            <!-- back to top area start -->
            <div class="back-to-top">
                <span class="back-top"><i class="fa fa-angle-up"></i></span>
            </div>
            <!-- back to top area end -->
        </div>
    </div>
</footer>
<!-- footer area end -->
