@extends('layouts.master')
@section('content')
    <div class="row d-flex justify-content-center">

        <div class="col-md-8">

            <div class="card">


                <div class="text-left logo p-2 px-5">

                    <img src="https://i.imgur.com/2zDU056.png" width="50">


                </div>

                <div class="invoice p-5">

                    <h5>Your order Confirmed!</h5>

                    <span class="font-weight-bold d-block mt-4">Hello, {{$order->customer->name}}</span>
                    <span>You order has been confirmed and will be shipped in next two days!</span>

                    <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">

                        <table class="table table-borderless">

                            <tbody>
                            <tr>
                                <td>
                                    <div class="py-2">

                                        <span class="d-block text-muted">Order Date</span>
                                        <span>{{date('F j, Y',strtotime($order->created_at))}}</span>

                                    </div>
                                </td>

                                <td>
                                    <div class="py-2">

                                        <span class="d-block text-muted">Order No</span>
                                        <span>{{$order->tracking_id}}</span>

                                    </div>
                                </td>

                                <td>
                                    <div class="py-2">

                                        <span class="d-block text-muted">Payment</span>
                                        <span><img src="https://img.icons8.com/color/48/000000/mastercard.png" width="20" /></span>

                                    </div>
                                </td>

                                <td>
                                    <div class="py-2">

                                        <span class="d-block text-muted">Shiping Address</span>
                                        <span></span>

                                    </div>
                                </td>
                            </tr>
                            </tbody>

                        </table>





                    </div>




                    <div class="product border-bottom table-responsive">

                        <table class="table table-borderless">

                            <tbody>
                            @foreach($order->order_lines as $ol)
                            <tr>
                                <td width="20%">

                                    <img src="{{$ol->product?$ol->product->getFirstMedia("*")->original_url:''}}" width="90">

                                </td>

                                <td width="60%">
                                    <span class="font-weight-bold">{{$ol->product?$ol->product->name:''}}</span>
                                    <div class="product-qty">
                                        <span class="d-block">Quantity:{{$ol->quantity}}</span>
                                        <span></span>

                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="text-right">
                                        <span class="font-weight-bold">&#8358;{{$ol->total}}</span>
                                    </div>
                                </td>
                            </tr>


                            @endforeach
                            </tbody>

                        </table>



                    </div>



                    <div class="row d-flex justify-content-end">

                        <div class="col-md-5">

                            <table class="table table-borderless">

                                <tbody class="totals">

                                <tr>
                                    <td>
                                        <div class="text-left">

                                            <span class="text-muted">Subtotal</span>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-right">
                                            <span>&#8358;{{$order->amount}}</span>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <div class="text-left">

                                            <span class="text-muted">Shipping Fee</span>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-right">
                                            <span>&#8358;0</span>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <div class="text-left">

                                            <span class="text-muted">Tax Fee</span>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-right">
                                            <span>&#8358;{{$order->tax}}</span>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <div class="text-left">

                                            <span class="text-muted">Discount</span>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-right">
                                            <span class="text-success">&#8358;{{$order->amount-$order->total_after_discount}}</span>
                                        </div>
                                    </td>
                                </tr>


                                <tr class="border-top border-bottom">
                                    <td>
                                        <div class="text-left">

                                            <span class="font-weight-bold">Subtotal</span>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-right">
                                            <span class="font-weight-bold">&#8358;{{$order->total_payable}}</span>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>

                            </table>

                        </div>



                    </div>


                    <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                    <p class="font-weight-bold mb-0">Thanks for shopping with us!</p>
                    <span>{{company_info()->store_name}}</span>





                </div>


                <div class="d-flex justify-content-between footer p-3">

                    <span>Need Help? visit our <a href="#"> help center</a></span>
                    <span>{{date('F j, Y',strtotime($order->created_at))}}</span>

                </div>




            </div>

        </div>

    </div>
@endsection
