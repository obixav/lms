<div>
    {{-- The best athlete wants his opponent at his best. --}}

        <div class="product-item wow fadeInUp delay-0-2s">
            <div class="image">
                @if(\Illuminate\Support\Carbon::parse($product->createed_at)->diffInDays()<=7)
                    <span class="badge">New</span>
                @endif
                @if($product->discount>0)
                    <span class="badge red ">-{{$product->discount}}</span>
                @endif
                <img style="width: 250px;height: auto;" src="{{$product->getFirstMedia("*")?$product->getFirstMedia("*")->original_url:asset('assets/images/shop/product1.jpg')}}" alt="Product">
            </div>
            <div class="content">
                <div class="title"><h5><a href="{{url('products/'.$product->id)}}">{{$product->name}}</a></h5></div>
                <div class="title-price">
                    @if($product->discount>0) <span  style="text-decoration: red line-through;color: red;">&#8358;{{$product->price}}</span>&nbsp;&#8358;{{number_format($product->discount_price,2)}}&nbsp;
                    @else<div >&#8358;{{$product->price}}</div>
                    @endif

                </div>
                <div class="social-style-two">
                    <button  wire:click="addToCart"><i class="far fa-shopping-cart"></i></button>
                    <a href="#"><i class="far fa-heart"></i></a>
                    <a href="{{url('products/'.$product->id)}}"><i class="far fa-eye"></i></a>
                    <a href="#"><i class="far fa-star"></i></a>
                </div>
            </div>
        </div>

</div>
