        <!-- navbar start -->
        <div class="navbar-top style-one text-white bgs-cover" style="background-image: url(assets/images/background/header-top-bg.jpg);">
            <div class="container container-1570">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="topbar-left text-lg-start text-center">
                            <span class="off">{{$company->discount_announcement}}</span>
                            <span>{{$company->small_announcement}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="topbar-right justify-content-center justify-content-lg-end">
                            <li><i class="fal fa-phone"></i> <b>Call :<a href="calto:{{company_info()->phone}}"> {{company_info()->phone}}</a></b></li>
                            <li class="social-style-one">
                                <a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                <a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fab fa-dribbble" aria-hidden="true"></i></a>
                                <a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar style-one rel navbar-area navbar-expand-lg py-20">
            <div class="container container-1570">
                <div class="responsive-mobile-menu">
                    <button class="menu toggle-btn d-block d-lg-none" data-target="#Iitechie_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-left"></span>
                        <span class="icon-right"></span>
                    </button>
                </div>
                <div class="logo">
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
                    <a href="{{url('design-request')}}" class="theme-btn style-two">Get Started <i class="far fa-long-arrow-right"></i></a>
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
        <!-- navbar end -->
