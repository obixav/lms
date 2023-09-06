@extends('admin.layouts.master')
@section('content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Orders</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <form action="">
                                            <li>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-search"></em>
                                                    </div>
                                                    <input type="text" name="q" value="{{request()->q}}" class="form-control" id="default-04" placeholder="Search by tracking id">
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-control-wrap">

                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-users"></em>
                                                    </div>
                                                    <select name="customer" class="form-control select2" id="">
                                                        <option value="0">Select Customers</option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{$customer->id}}" {{request()->customer==$customer->id?'selected':''}}>{{$customer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </li>
                                                <li>
                                                    <div class="form-control-wrap">

                                                        <div class="form-icon form-icon-right">
                                                            <em class="icon ni ni-star-fill
                                                    check-round-cut"></em>
                                                        </div>
                                                        <select name="order_status" class="form-control" id="">
                                                            <option value="">Order Status</option>
                                                            <option value="0" {{request()->order_status===0?'selected':''}}>Pending</option>
                                                            <option value="3" {{request()->order_status==3?'selected':''}}>Shipped</option>
                                                            <option value="1" {{request()->order_status==1?'selected':''}}>Delivered</option>
                                                            <option value="2" {{request()->order_status==2?'selected':''}}>Rejected</option>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-control-wrap">

                                                        <div class="form-icon form-icon-right">
                                                            <em class="icon ni ni-star-fill
                                                    check-round-cut"></em>
                                                        </div>
                                                        <select name="payment_status" class="form-control" id="">
                                                            <option value="">Payment Status</option>
                                                            <option value="0" {{request()->payment_status===0?'selected':''}}>Pending</option>
                                                            <option value="1" {{request()->payment_status==1?'selected':''}}>Paid</option>
                                                            <option value="2" {{request()->payment_status==2?'selected':''}}>Cancelled</option>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-control-wrap">

                                                        <button type="submit" class="btn btn-info d-none d-md-inline-flex">Filter</button>
                                                    </div>
                                                </li>
                                            </form>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="nk-tb-list is-separate is-medium mb-3">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="oid">
                                        <label class="custom-control-label" for="oid"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-md"><span>ID</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-block">Status</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-block">Payment Status</span></div>
                                <div class="nk-tb-col tb-col-sm"><span>Customer</span></div>
                                <div class="nk-tb-col"><span>Number of Items</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Purchased</span></div>

                                <div class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1 my-n1">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger me-n1" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><em class="icon ni ni-edit"></em><span>Update Status</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-truck"></em><span>Mark as Delivered</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-money"></em><span>Mark as Paid</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-report-profit"></em><span>Send Invoice</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Orders</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @foreach($orders as $order)
                            <!-- .nk-tb-item -->
                            <div class="nk-tb-item">
                                <div class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="oid01">
                                        <label class="custom-control-label" for="oid01"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-lead"><a href="{{url('admin/order_details/'.$order->id)}}">{{$order->tracking_id}}</a></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub">{{date('F j, Y',strtotime($order->created_at))}}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="dot bg-warning d-sm-none"></span>
                                    <span class="badge badge-sm badge-dot has-bg bg-{{resolveOrderStatusColor($order->status)}} d-none d-sm-inline-flex">{{resolveOrderStatus($order->status)}}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="dot bg-warning d-sm-none"></span>
                                    <span class="badge badge-sm badge-dot has-bg bg-{{resolvePaymentStatusColor($order->payment_status)}} d-none d-sm-inline-flex">{{resolvePaymentStatus($order->payment_status)}}</span>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <span class="tb-sub">{{$order->customer?$order->customer->name:''}}</span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub text-primary">{{$order->order_lines_count}} Item{{$order->order_lines_count>1?'s':''}}</span>
                                </div>
{{--                                <div class="nk-tb-col">--}}
{{--                                    <span class="tb-lead"> {{number_format($order->amount,2)}}</span>--}}
{{--                                </div>--}}
{{--                                <div class="nk-tb-col">--}}
{{--                                    <span class="tb-lead"> {{number_format($order->amount-$order->total_after_discount,2)}}</span>--}}
{{--                                </div>--}}
                                <div class="nk-tb-col">
                                    <span class="tb-lead"> &#8358;{{number_format($order->total_payable,2)}}</span>
                                </div>
                                <div class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        <li class="nk-tb-action-hidden"><a href="#" class="btn btn-icon btn-trigger btn-tooltip" title="Mark as Delivered">
                                                <em class="icon ni ni-truck"></em></a></li>
                                        <li class="nk-tb-action-hidden"><a href="#" class="btn btn-icon btn-trigger btn-tooltip" title="View Order">
                                                <em class="icon ni ni-eye"></em></a></li>
                                        <li>
                                            <div class="drodown me-n1">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><em class="icon ni ni-eye"></em><span>Order Details</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-truck"></em><span>Mark as Delivered</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-money"></em><span>Mark as Paid</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-report-profit"></em><span>Send Invoice</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Order</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                                <!-- .nk-tb-item -->

                        </div><!-- .nk-tb-list -->
                        <div class="card">
                            <div class="card-inner">
                                <div class="nk-block-between-md g-3">
                                    <div class="g">
                                       {{$orders->links('vendor.pagination.custom-backend')}}
                                    </div>
                                    <div class="g">

                                    </div><!-- .pagination-goto -->
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
@endsection
