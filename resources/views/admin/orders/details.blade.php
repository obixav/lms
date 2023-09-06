@extends('admin.layouts.master')
@section('content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Orders / <strong class="text-primary small">Order Details</strong></h3>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>Order ID: <span class="text-base">{{$order->tracking_id}}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{url()->previous()}}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="{{url()->previous()}}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-aside-wrap">
                                <div class="card-content">
                                    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#"><em class="icon ni ni-list"></em><span>Details</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><em class="icon ni ni-truck"></em><span>Shipping Details</span></a>
                                        </li>
                                        <li class="nav-item nav-item-trigger d-xxl-none">
                                            <a href="#" class="toggle btn btn-icon btn-trigger" data-target="userAside"><em class="icon ni ni-user-list-fill"></em></a>
                                        </li>
                                    </ul><!-- .nav-tabs -->
                                    <div class="card-inner">
                                        <div class="nk-block">
                                            <div class="nk-block-head">
                                                <h5 class="title">Order Information</h5>
                                                <p>Details about the order</p>
                                            </div><!-- .nk-block-head -->
                                            <div class="profile-ud-list">
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Tracking ID</span>
                                                        <span class="profile-ud-value">{{$order->tracking_id}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Payment Channel</span>
                                                        <span class="profile-ud-value ">{{$order->payment_channel}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Order Status</span>
                                                        <span class="profile-ud-value badge badge-sm badge-dot has-bg bg-{{resolveOrderStatusColor($order->status)}}">{{resolveOrderStatus($order->status)}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Payment Status</span>
                                                        <span class="profile-ud-value badge badge-sm badge-dot has-bg bg-{{resolvePaymentStatusColor($order->payment_status)}}">{{resolvePaymentStatus($order->payment_status)}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Total</span>
                                                        <span class="profile-ud-value">&#8358;{{number_format($order->amount,2)}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Discount</span>
                                                        <span class="profile-ud-value">&#8358;{{number_format($order->amount-$order->total_after_discount,2)}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Tax</span>
                                                        <span class="profile-ud-value">&#8358;{{number_format($order->tax,2)}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Total Payable</span>
                                                        <span class="profile-ud-value">&#8358;{{number_format($order->total_payable,2)}}</span>
                                                    </div>
                                                </div>
                                            </div><!-- .profile-ud-list -->
                                        </div><!-- .nk-block -->
                                        <div class="nk-block">
                                            <div class="nk-block-head nk-block-head-line">
                                                <h6 class="title overline-title text-base">Order Products</h6>
                                                <div class="nk-tb-list nk-tb-ulist is-compact card">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col tb-col-sm">
                                                            <span class="sub-text">Product Name</span>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="sub-text">Unit Price</span>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="sub-text">Quantity</span>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="sub-text">Total Price</span>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="sub-text">Discount</span>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="sub-text">Payable</span>
                                                        </div>
                                                    </div>
                                                    @foreach($order->order_lines as $item)
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col tb-col-sm">
                                                                    <span class="tb-product">
                                                                        <img src="{{$item->product?$item->product->getFirstMedia("*")->original_url:''}}" alt="" class="thumb">
                                                                        <span class="title">{{$item->product?$item->product->name:''}}</span>
                                                                    </span>
                                                        </div>
                                                        <div class="nk-tb-col ">
                                                            <span class="amount">&#8358; {{number_format($item->unit_price,2)}}</span>
                                                        </div>
                                                        <div class="nk-tb-col ">
                                                            <span class="amount"> {{$item->quantity}}</span>
                                                        </div>
                                                        <div class="nk-tb-col ">
                                                            <span class="amount">&#8358; {{number_format($item->unit_price*$item->quantity,2)}}</span>
                                                        </div>
                                                        <div class="nk-tb-col ">
                                                            <span class="amount">&#8358; {{number_format($item->discount,2)}}</span>
                                                        </div>
                                                        <div class="nk-tb-col ">
                                                            <span class="amount">&#8358; {{number_format($item->total,2)}}</span>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                </div><!-- .nk-tb-list -->
                                            </div><!-- .nk-block-head -->

                                        </div><!-- .nk-block -->
                                        <div class="nk-divider divider md"></div>

                                    </div><!-- .card-inner -->
                                </div><!-- .card-content -->
                                <div class="card-aside card-aside-right user-aside toggle-slide toggle-slide-right toggle-break-xxl" data-content="userAside" data-toggle-screen="xxl" data-toggle-overlay="true" data-toggle-body="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <div class="user-card user-card-s2">
                                                <div class="user-avatar lg bg-primary">
                                                    <span>{{generateInitials($order->customer?$order->customer->name:'')}}</span>
                                                </div>
                                                <div class="user-info">
                                                    <div class="badge bg-outline-light rounded-pill ucap">Customer</div>
                                                    <h5>{{$order->customer?$order->customer->name:''}}</h5>
                                                    <span class="sub-text">{{$order->customer?$order->customer->email:''}}</span>
                                                    <span class="sub-text">{{$order->customer?$order->customer->phone:''}}</span>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner">
                                            <div class="overline-title-alt mb-2">In Account</div>
                                            <div class="profile-balance">
                                                <div class="profile-balance-group gx-4">
                                                    <div class="profile-balance-sub">
                                                        <div class="profile-balance-amount">
                                                            <div class="number">&#8358;{{$customer_purchases}} </div>
                                                        </div>
                                                        <div class="profile-balance-subtitle">Total Amount Purchases</div>
                                                    </div>
                                                    <div class="profile-balance-sub">

                                                        <div class="profile-balance-amount">
                                                            <div class="number">{{date('F j, Y',strtotime($last_purchase_date))}}</div>
                                                        </div>
                                                        <div class="profile-balance-subtitle">Last Order Date</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner">
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span class="amount">{{$customer_order_count}}</span>
                                                        <span class="sub-text">Total Orders</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span class="amount">{{$customer_completed_order_count}}</span>
                                                        <span class="sub-text">Completed</span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="profile-stats">
                                                        <span class="amount">{{$customer_order_count-$customer_completed_order_count}}</span>
                                                        <span class="sub-text">Pending</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner -->
                                </div><!-- .card-aside -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
@endsection
