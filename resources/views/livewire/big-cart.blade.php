<div class="row">
    <!-- cart -->
    <div class="col-lg-9">
        <div class="card border shadow-0">
            <div class="m-4">
                <h4 class="card-title mb-4">Your shopping cart</h4>
                @if ($content->count() > 0)
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
                                <td> <img src="{{isset($item->get('options')['image'])?$item->get('options')['image']:''}}" class="border rounded me-3" style="width: 96px; height: 96px;" alt="item1" /></td>
                                <td>{{ $item->get('name') }}</td>
                                <td>&#8358;{{$item->get('price')}}</td>
                                <td> <button class="text-sm p-2 border-2 rounded border-gray-200 " wire:click="updateCartItem({{ $id }}, 'minus')"> - </button>
                                    {{$item->get('quantity')}}
                                    <button class="text-sm p-2 border-2 rounded border-gray-200 " wire:click="updateCartItem({{ $id }}, 'plus')"> + </button></td>
                                <td>&#8358;{{$item->get('price')* $item->get('quantity')}}</td>
                                <td><button wire:click="removeFromCart({{$id}})" class="btn btn-danger btn-sm">Remove</button></td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>

            <div class="border-top pt-4 mx-4 mb-4">
                <p><i class="fas fa-truck text-muted fa-lg"></i> Free Delivery within 1-2 weeks</p>
                <p class="text-muted">
{{--                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut--}}
{{--                    aliquip--}}
                </p>
            </div>
        </div>
    </div>
    <!-- cart -->
    <!-- summary -->
    <div class="col-lg-3">
        <div class="card mb-3 border shadow-0">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label class="form-label">Have coupon?</label>
                        <div class="input-group">
                            <input type="text" class="form-control border" name="" placeholder="Coupon code" />
                            <button class="btn btn-light border">Apply</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card shadow-0 border">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="mb-2">Total(No Discount):</p>
                    <p class="mb-2">&#8358;{{ number_format($total+$total_discount,2) }}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="mb-2">Discount:</p>
                    <p class="mb-2 text-success">-&#8358;{{ number_format($total_discount,2) }}</p>
                </div>
                @php
                $tax=$company->tax_rate>0?$total*(floatval($company->tax_rate)/100):0;

                @endphp
                <div class="d-flex justify-content-between">
                    <p class="mb-2">TAX ({{$company->tax_rate}}%):</p>
                    <p class="mb-2">&#8358;-{{number_format($tax,2)}}</p>
                </div>
                <hr />
                <div class="d-flex justify-content-between">
                    <p class="mb-2">Total :</p>
                    <p class="mb-2 fw-bold">&#8358;{{number_format($total+$tax,2)}}</p>
                </div>

                <div class="mt-3">
                    <a href="{{url('checkout')}}" class="btn btn-success w-100 shadow-0 mb-2"> Proceed to Checkout </a>
                    <a href="{{url('products')}}" class="btn btn-light w-100 border mt-2"> Back to shop </a>
                </div>
            </div>
        </div>
    </div>
    <!-- summary -->
</div>
