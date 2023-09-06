@extends('layouts.master')
@section('content')
    <!-- Page Banner Start -->
    <section class="page-banner bgs-cover text-white pt-65 pb-75" style="background-image: url(assets/images/banner.jpg);">
        <div class="container">
            <div class="banner-inner">
                <h2 class="page-title wow fadeInUp delay-0-2s">Shop</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">shop</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->

    <!-- Product Details Start -->
    <section class="product-details-two pt-130 rpt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 wow fadeInLeft delay-0-2s">
                    <div class="tab-content preview-images mb-30">
                        @php
                        $mediaFiles=$product->getMedia("*");
                        @endphp
                        @foreach($mediaFiles as $media)
                        <div class="tab-pane fade preview-item  @if ($loop->first)active @endif show" id="preview{{$loop->iteration}}">
                            <img src="{{$media->original_url}}" alt="Perview">
                        </div>
                        @endforeach
                    </div>
                    <div class="nav style-two thumb-images rmb-20">
                        @foreach($mediaFiles as $media)
                        <a href="#preview{{$loop->iteration}}" data-bs-toggle="tab" class="thumb-item @if ($loop->first)active @endif show">
                            <img src="{{$media->original_url}}" alt="Thumb">
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-details-content wow fadeInRight delay-0-2s">
                        <div class="section-title">
                            <h2>{{$product->name}}</h2>
                        </div>
                        <div class="ratting-price mb-30">
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span style="font-size: 24px;font-weight: 600;color: #000000;">&#8358;{{$product->price}}</span>
                        </div>
                        <hr class="mb-25">
                        <p>{{$product->description}}</p>
                        <hr class="mt-30">
                        <ul class="category-tags pt-10 pb-15">
                            <li>
                                <b>Category</b>
                                <span>:</span>
                                <a href="{{url('products')}}?category={{$product->product_category->id}}">{{$product->product_category?$product->product_category->name:''}}</a>
                            </li>
                            <li>
                                <b>Tags</b>
                                <span>:</span>
                                @foreach($product->tags as $tag)
                                <a href="{{url('products/')}}?q={{$tag->name}}">{{$tag->name}}</a>
                                @endforeach

                            </li>
                        </ul>
                        <hr>
                        <livewire:single-product :product='$product' />

                        <div class="product-info-accordion pt-70 wow fadeInUp delay-0-2s" id="product-info-accordion">
                            <div class="product-accordion-item">
                                <h4 class="accordion-header">
                                    <button data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                        Descriptions
                                    </button>
                                </h4>
                                <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#product-info-accordion">
                                    <div class="accordion-content">
                                        <p>{{$product->description}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-accordion-item">
                                <h4 class="accordion-header">
                                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                        Information
                                    </button>
                                </h4>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#product-info-accordion">
                                    <div class="accordion-content">
                                        <p>{{$product->information}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-accordion-item">
                                <h4 class="accordion-header">
                                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                        Vendor Info
                                    </button>
                                </h4>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#product-info-accordion">
                                    <div class="accordion-content">
                                        <p>inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam</p>
                                        <ul class="list-style-two mt-25 mb-25">
                                            <li>Strong lens for long distance surveillance.</li>
                                            <li>WIFI technology can view and view the Internet</li>
                                            <li>Auto Night Vision, Clear video can be seen in the dark at night</li>
                                            <li>Video recording system on a memory card</li>
                                            <li>You can watch back videos from the phone</li>
                                            <li>CCTV videos can be viewed live on your Laptop, Desktop, Smartphone or Tablet PC</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="product-accordion-item">
                                <h4 class="accordion-header">
                                    <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                        Review (0)
                                    </button>
                                </h4>
                                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#product-info-accordion">
                                    <div class="accordion-content">
                                        <h4>0 Review</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details End -->


    <!-- Related Product Area start -->
    <section class="related-product-area mt-120 mb-70">
        <div class="container pb-55">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7">
                    <div class="section-title text-center mb-35 wow fadeInUp delay-0-2s">
                        <h2>Related Product</h2>

                    </div>
                </div>
            </div>
            <div class="realated-product-slider">
                @foreach($related_products as $rproduct)
                    <livewire:related-product :product='$rproduct' />
                @endforeach


            </div>
        </div>
    </section>
    <!-- Related Product Area end -->
@endsection
