<div>
<button id="cart">
    <i class="far fa-shopping-basket"></i><span class="badge">{{$content->count()}}</span>
</button>
<div class="shopping-cart">
    <div class="shopping-cart-header">
        <button class="btn btn-dark btn-sm" wire:click="clearCart()">Empty Cart</button>
        <div class="shopping-cart-total">
            <span class="lighter-text">Total:</span>
            <span class="main-color-text total">&#8358;{{ $total }}</span>
        </div>
    </div> <!--end shopping-cart-header -->

{{--    <ul class="shopping-cart-items">--}}
        @if ($content->count() > 0)

{{--        <li class="clearfix">--}}
            <table class="shopping-cart-items" style="width: 100%" >
                <tr style="text-align: center">
                    <td ></td>
                    <td >Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                    <td>Action</td>
                </tr>
                @foreach ($content as $id => $item)
                <tr class="clearfix" style="text-align: center">
                    <td> <img src="{{isset($item->get('options')['image'])?$item->get('options')['image']:''}}" alt="item1" /></td>
                    <td>{{ $item->get('name') }}</td>
                    <td>&#8358;{{$item->get('price')}}</td>
                    <td>{{$item->get('quantity')}}</td>
                    <td>&#8358;{{$item->get('price')* $item->get('quantity')}}</td>
                    <td><button wire:click="removeFromCart({{$id}})" class="btn btn-danger btn-sm">Remove</button></td>
                </tr>
                @endforeach
            </table>
{{--            <img src="{{isset($item->get('options')['image'])?$item->get('options')['image']:''}}" alt="item1" />--}}
{{--            --}}
{{--            <span class="item-name">{{ $item->get('name') }}</span>--}}
{{--            <span class="item-price">&#8358;{{$item->get('price')}}</span>--}}
{{--            <span class="item-quantity">X {{$item->get('quantity')}}</span>--}}
{{--            <span class="item-quantity"> {{$item->get('price')* $item->get('quantity')}}</span>--}}
{{--            <button wire:click="removeFromCart({{$id}})" class="btn btn-danger btn-sm">Remove</button>--}}
{{--        </li>--}}

            @endif

{{--    </ul>--}}

    <a href="{{url('cart')}}" class="button">Checkout <i class="fa fa-chevron-right"></i></a>
</div> <!--end shopping-cart -->
</div>
