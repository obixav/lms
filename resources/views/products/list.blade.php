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

    <!-- Product Area start -->
    <section class="shop-page-area py-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-sidebar rmb-75">
                        <div class="widget widget-search wow fadeInUp delay-0-2s">
                            <form id="FilterForm" class="default-search-form">
                                <input type="text" name="q" placeholder="Search" value="{{request()->q}}" required>
                                <input type="hidden" id="sort" name="sortby" value="{{request()->sortby}}">
                                <input type="hidden"  name="category" value="{{request()->category}}">
                                <input type="hidden" id="min_price" name="min_price" value="{{request()->min_price}}">
                                <input type="hidden" id="max_price" name="max_price" value="{{request()->max_price}}">
                                <button type="submit" class="searchbutton far fa-search"></button>
                            </form>
                        </div>
                        <div class="widget widget-category wow fadeInUp delay-0-4s">
                            <h5 class="widget-title">Category</h5>
                            <ul>
                                @foreach($categories as $category)
                                <li><a href="{{url('products')}}?category={{$category->id}}">{{$category->name}}</a> <span>({{$category->products_count}})</span></li>
                                    @endforeach

                            </ul>
                        </div>
                        <div class="widget widget-products wow fadeInUp delay-0-2s">
                            <h5 class="widget-title">Products</h5>
                            <ul>
                                @foreach($featured_products as $fp)
                                <li>
                                    <div class="image">
                                        <img style="width: 75px;height: 75px;"
                                             src="{{$fp->getFirstMedia("*")?$fp->getFirstMedia("*")->original_url:asset('assets/images/widgets/product1.jpg')}}" alt="Product">
                                    </div>
                                    <div class="content">
                                        <h5><a href="{{url('products/'.$fp->id)}}">{{$fp->name}}</a></h5>
                                        <span class="price">&#8358;{{$fp->price}}</span>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="widget widget-price-filter wow fadeInUp delay-0-2s">
                            <h5 class="widget-title">Filter By Price</h5>
                            <div class="price">
{{--                                <span id="">5</span> - <input type="text" id="price" readonly>--}}
                                <label for="amount">Price:</label>
                                <input type="text" id="amount" readonly
                                       style="border:0; color:#f6931f; font-weight:bold;padding: 15px 5px;"
                                       value="&#8358;{{request()->min_price!=''?request()->min_price:'200'}}-&#8358;{{request()->max_price!=''?request()->max_price:'10000'}}">

                            </div>
                            <div class="price-slider-range "></div>
                            <div class="pt-10"> <button id="applyPrice" class=" btn btn-sm btn-danger mt-5" >apply</button></div>

                        </div>
                        <div class="widget widget-tag-cloud wow fadeInUp delay-0-2s">
                            <h5 class="widget-title">Popular Tags</h5>
                            <div class="tags">
                                @foreach($tags as $tag)
                                <a href="{{url('products/')}}?q={{$tag->name}}">{{$tag->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop-shorter rel z-3 mb-30 wow fadeInUp delay-0-2s">
                        <div class="sort-text">

                            {{$products->links('vendor.pagination.custom',['display'=>'info'])}}
                        </div>
                        <button class="btn btn-dark filters-clear" >Clear Filters</button>
                        <div class="products-dropdown">

                            <select id="sort-filter">
                                <option value="date-desc" {{request()->sortby=='date-desc'?'selected':''}}>Sort by Newness</option>
                                <option value="date-asc" {{request()->sortby=='date-asc'?'selected':''}}>Sort by Oldest</option>
                                <option value="price-desc" {{request()->sortby=='price-desc'?'selected':''}} >High To Low</option>
                                <option value="price-asc" {{request()->sortby=='price-asc'?'selected':''}}>Low To High</option>
                            </select>
                        </div>
                        <ul class="grid-list">
                            <li><a href="#"><i class="far fa-list"></i></a></li>
                            <li><a href="#"><i class="fal fa-border-all"></i></a></li>
                        </ul>
                    </div>
                    <div class="row justify-content-center">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-sm-6">
                            <livewire:product :product='$product' />
                            </div>
                        @endforeach

                    </div>
                    {{$products->links()}}

                </div>
            </div>
        </div>
    </section>
    <!-- Product Area end -->

@endsection
@section('scripts')
    <script>
        if ($('.price-slider-range').length) {
            $( ".price-slider-range" ).slider({
                range: true,
                values: [ 200, 10000],
                min: 200,
                max: 100000,
                slide: function( event, ui ) {
                    // $( "#price" ).val( $("<div/>").html("&#8358;").text() + ui.value );
                    $( "#amount" ).val(  $("<div/>").html("&#8358;").text() + ui.values[ 0 ] + " - "+ $("<div/>").html("&#8358;").text() + ui.values[ 1 ] );
                    $( "#min_price" ).val(ui.values[ 0 ]);
                    $( "#max_price" ).val(ui.values[ 1 ]);
                }
            });
            // $( "#amount" ).val(  $("<div/>").html("&#8358;").text() + $( ".price-slider-range" ).slider( "values", 0 ) +
            //     " - " +$("<div/>").html("&#8358;").text() + $( ".price-slider-range" ).slider( "values", 1 ) );
            // $( "#price" ).val( $("<div/>").html("&#8358;").text() + $( ".price-slider-range" ).slider( "value" ) );
        }
        $(document).on('change','#sort-filter',function(event){
            event.preventDefault();
            console.log('hello')
            $('#sort').val($(this).val());
            $('#FilterForm').submit();
        });
        $(document).on('click','#applyPrice',function(event){
            $('#FilterForm').submit();

        });
        $(document).on('click','.filters-clear',function(event){
           location.replace('{{url('products')}}');

        });
    </script>
@endsection
