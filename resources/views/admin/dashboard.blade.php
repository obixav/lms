@extends('admin.layouts.master')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title page-title">Dashboard</h4>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-xxl-4 col-md-6">
                            <div class="card is-dark h-100">
                                <div class="nk-ecwg nk-ecwg1">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Total Sales</h6>
                                            </div>
                                            <div class="card-tools">
                                                <a href="#" class="link">View Report</a>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="amount">&#8358;{{number_format($sales,2)}}</div>
                                            <div class="info"><strong>&#8358;{{number_format($last_30_days_sales,2)}}</strong> in last month</div>
                                        </div>
                                        <div class="data">
                                            <h6 class="sub-title">This week so far</h6>
                                            <div class="data-group">
                                                <div class="amount">&#8358;{{number_format($current_week_sales,2)}}</div>
                                                <div class="info text-end"><span class="change {{$week_percentage_difference>0?'up':''}} text-danger"><em class="icon ni {{$week_percentage_difference>0?'ni-arrow-long-up':'ni-arrow-long-down'}}"></em>{{number_format($week_percentage_difference,2)}}%</span><br><span>vs. last week</span></div>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                    <div class="nk-ecwg1-ck">
                                        <canvas class="ecommerce-line-chart-s1" id="totalSales"></canvas>
                                    </div>
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card h-100">
                                <div class="nk-ecwg nk-ecwg2">
                                    <div class="card-inner">
                                        <div class="card-title-group mt-n1">
                                            <div class="card-title">
                                                <h6 class="title">Averarge order</h6>
                                            </div>
                                            <div class="card-tools me-n1">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#" class="active"><span>15 Days</span></a></li>
                                                            <li><a href="#"><span>30 Days</span></a></li>
                                                            <li><a href="#"><span>3 Months</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount">&#8358;{{$current_week_average_sales}}</div>
                                                <div class="info text-end"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last week</span></div>
                                            </div>
                                        </div>
                                        <h6 class="sub-title">Orders over time</h6>
                                    </div><!-- .card-inner -->
                                    <div class="nk-ecwg2-ck">
                                        <canvas class="ecommerce-bar-chart-s1" id="averargeOrder"></canvas>
                                    </div>
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-xxl-4">
                            <div class="row g-gs">
                                <div class="col-xxl-12 col-md-6">
                                    <div class="card">
                                        <div class="nk-ecwg nk-ecwg3">
                                            <div class="card-inner pb-0">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Orders</h6>
                                                    </div>
                                                </div>
                                                <div class="data">
                                                    <div class="data-group">
                                                        <div class="amount">{{$orders_count}}</div>
                                                        <div class="info text-end"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last week</span></div>
                                                    </div>
                                                </div>
                                            </div><!-- .card-inner -->
                                            <div class="nk-ecwg3-ck">
                                                <canvas class="ecommerce-line-chart-s1" id="totalOrders"></canvas>
                                            </div>
                                        </div><!-- .nk-ecwg -->
                                    </div><!-- .card -->
                                </div><!-- .col -->
                                <div class="col-xxl-12 col-md-6">
                                    <div class="card">
                                        <div class="nk-ecwg nk-ecwg3">
                                            <div class="card-inner pb-0">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Customers</h6>
                                                    </div>
                                                </div>
                                                <div class="data">
                                                    <div class="data-group">
                                                        <div class="amount">{{$customers_count}}</div>
                                                        <div class="info text-end"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last week</span></div>
                                                    </div>
                                                </div>
                                            </div><!-- .card-inner -->
                                            <div class="nk-ecwg3-ck">
                                                <canvas class="ecommerce-line-chart-s1" id="totalCustomers"></canvas>
                                            </div>
                                        </div><!-- .nk-ecwg -->
                                    </div><!-- .card -->
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .col -->
                        <div class="col-xxl-8">
                            <div class="card card-full">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Recent Orders</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-list mt-n2">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span>Order No.</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Customer</span></div>
                                        <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                                        <div class="nk-tb-col"><span>Amount</span></div>
                                        <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
                                    </div>
                                    @foreach($last_five_orders as $lfo)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-lead"><a href="#">#{{$lfo->tracking_id}}</a></span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <div class="user-card">
                                                <div class="user-avatar sm bg-purple-dim">
                                                    <span>{{generateInitials($lfo->customer?$lfo->customer->name:'')}}</span>
                                                </div>
                                                <div class="user-name">
                                                    <span class="tb-lead">{{$lfo->customer?$lfo->customer->name:''}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span class="tb-sub">{{date('F j, Y',strtotime($lfo->created_at))}}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub tb-amount">{{number_format($lfo->total_payable,2)}} <span>NGN</span></span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="badge badge-dot badge-dot-xs bg-success">{{$lfo->payment_status=1?'Paid':'Pending Payment'}}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div><!-- .card -->
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card h-100">
                                <div class="card-inner">
                                    <div class="card-title-group mb-2">
                                        <div class="card-title">
                                            <h6 class="title">Top products</h6>
                                        </div>
                                        <div class="card-tools">
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle link link-light link-sm dropdown-indicator" data-bs-toggle="dropdown">Weekly</a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><span>Daily</span></a></li>
                                                        <li><a href="#" class="active"><span>Weekly</span></a></li>
                                                        <li><a href="#"><span>Monthly</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nk-top-products">
                                        @foreach($top_products as $tp)
                                        <li class="item">

                                            <div class="info">
                                                <div class="title">{{$tp->name}}</div>
                                                <div class="price">&#8358;{{$tp->price}}</div>
                                            </div>
                                            <div class="total">
                                                <div class="amount">{{$tp->sum_total}}</div>
                                                <div class="count">{{$tp->number_of_orders}} Sold</div>
                                            </div>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div><!-- .card-inner -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card h-100">
                                <div class="card-inner">
                                    <div class="card-title-group mb-2">
                                        <div class="card-title">
                                            <h6 class="title">Store Statistics</h6>
                                        </div>
                                    </div>
                                    <ul class="nk-store-statistics">
                                        <li class="item">
                                            <div class="info">
                                                <div class="title">Orders</div>
                                                <div class="count">{{$orders_count}}</div>
                                            </div>
                                            <em class="icon bg-primary-dim ni ni-bag"></em>
                                        </li>
                                        <li class="item">
                                            <div class="info">
                                                <div class="title">Customers</div>
                                                <div class="count">{{$customers_count}}</div>
                                            </div>
                                            <em class="icon bg-info-dim ni ni-users"></em>
                                        </li>
                                        <li class="item">
                                            <div class="info">
                                                <div class="title">Products</div>
                                                <div class="count">{{$products_count}}</div>
                                            </div>
                                            <em class="icon bg-pink-dim ni ni-box"></em>
                                        </li>
                                        <li class="item">
                                            <div class="info">
                                                <div class="title">Categories</div>
                                                <div class="count">{{$product_categories_count}}</div>
                                            </div>
                                            <em class="icon bg-purple-dim ni ni-server"></em>
                                        </li>
                                    </ul>
                                </div><!-- .card-inner -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-xxl-5 col-lg-6">
                            <div class="card card-full overflow-hidden">
                                <div class="nk-ecwg nk-ecwg4 h-100">
                                    <div class="card-inner flex-grow-1">
                                        <div class="card-title-group mb-4">
                                            <div class="card-title">
                                                <h6 class="title">Traffic Sources</h6>
                                            </div>
                                            <div class="card-tools">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle link link-light link-sm dropdown-indicator" data-bs-toggle="dropdown">30 Days</a>
                                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><span>15 Days</span></a></li>
                                                            <li><a href="#" class="active"><span>30 Days</span></a></li>
                                                            <li><a href="#"><span>3 Months</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="data-group">
                                            <div class="nk-ecwg4-ck">
                                                <canvas class="ecommerce-doughnut-s1" id="trafficSources"></canvas>
                                            </div>
                                            <ul class="nk-ecwg4-legends">
                                                <li>
                                                    <div class="title">
                                                        <span class="dot dot-lg sq" data-bg="#9cabff"></span>
                                                        <span>Organic Search</span>
                                                    </div>
                                                    <div class="amount amount-xs">4,305</div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        <span class="dot dot-lg sq" data-bg="#ffa9ce"></span>
                                                        <span>Referrals</span>
                                                    </div>
                                                    <div class="amount amount-xs">482</div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        <span class="dot dot-lg sq" data-bg="#b8acff"></span>
                                                        <span>Social Media</span>
                                                    </div>
                                                    <div class="amount amount-xs">859</div>
                                                </li>
                                                <li>
                                                    <div class="title">
                                                        <span class="dot dot-lg sq" data-bg="#f9db7b"></span>
                                                        <span>Others</span>
                                                    </div>
                                                    <div class="amount amount-xs">138</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .card-inner -->
                                    <div class="card-inner card-inner-md bg-light">
                                        <div class="card-note">
                                            <em class="icon ni ni-info-fill"></em>
                                            <span>Traffic channels have beed generating the most traffics over past days.</span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-xxl-4 col-lg-6">
                            <div class="card h-100">
                                <div class="nk-ecwg nk-ecwg5">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start pb-3 g-2">
                                            <div class="card-title">
                                                <h6 class="title">Store Visitors</h6>
                                            </div>
                                            <div class="card-tools">
                                                <em class="card-hint icon ni ni-help" data-bs-toggle="tooltip" data-bs-placement="left" title="Users of this month"></em>
                                            </div>
                                        </div>
                                        <div class="data-group">
                                            <div class="data">
                                                <div class="title">Monthly</div>
                                                <div class="amount amount-sm">9.28K</div>
                                                <div class="change up"><em class="icon ni ni-arrow-long-up"></em>4.63%</div>
                                            </div>
                                            <div class="data">
                                                <div class="title">Weekly</div>
                                                <div class="amount amount-sm">2.69K</div>
                                                <div class="change down"><em class="icon ni ni-arrow-long-down"></em>1.92%</div>
                                            </div>
                                            <div class="data">
                                                <div class="title">Daily (Avg)</div>
                                                <div class="amount amount-sm">0.94K</div>
                                                <div class="change up"><em class="icon ni ni-arrow-long-up"></em>3.45%</div>
                                            </div>
                                        </div>
                                        <div class="nk-ecwg5-ck">
                                            <canvas class="ecommerce-line-chart-s4" id="storeVisitors"></canvas>
                                        </div>
                                        <div class="chart-label-group">
                                            <div class="chart-label">01 Jul, 2020</div>
                                            <div class="chart-label">30 Jul, 2020</div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div>
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
@endsection
