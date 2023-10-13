<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title page-title">Admin Dashboard</h4>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-sm-6 col-md-4 col-lg-4 col-xxl-4">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Managers </h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">{{$managers_count}}</div>
                                    <div class="nk-ecwg6-ck">

                                    </div>

                                </div>
                                <div class="info"><a href="#">View More</a></div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-sm-6 col-md-4 col-lg-4 col-xxl-4">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Pending Leave Approval Count</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">{{ $pending_leave_approval_count}}</div>
                                    <div class="nk-ecwg6-ck">

                                    </div>
                                </div>
                                <div class="info"><a href="#">View More</a></div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-sm-6 col-md-4 col-lg-4 col-xxl-4">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Employees</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">{{$employees_count}}</div>
                                    <div class="nk-ecwg6-ck">

                                    </div>
                                </div>
                                <div class="info"><a href="#">View More</a></div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-sm-6 col-md-4 col-lg-4 col-xxl-4">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">My Pending Leave Approval Count</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">{{$my_pending_leave_approval_count}}</div>
                                    <div class="nk-ecwg6-ck">

                                    </div>
                                </div>
                                <div class="info"><a href="#">View More</a></div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-sm-6 col-md-4 col-lg-4 col-xxl-4">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">My Direct Reports</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">{{$my_direct_report_count}}</div>
                                    <div class="nk-ecwg6-ck">

                                    </div>
                                </div>
                                <div class="info"><a href="#">View More</a></div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-sm-6 col-md-4 col-lg-4 col-xxl-4">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Pending Cancelled Leave Count</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">{{$cancelled_leave_count}}</div>
                                    <div class="nk-ecwg6-ck">

                                    </div>
                                </div>
                                <div class="info"><a href="">View More</a></div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
        <br>
        <div class="row g-gs">
            <div class="col-sm-3 col-md-3 col-lg-4 col-xxl-4">
                <div class="card">
                    <div class="card-inner">
                        <div class="team">
                            <div class="team-status bg-danger text-white"><em class="icon ni ni-na"></em></div>
                            <div class="team-options">
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                           </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="user-card user-card-s2">
                                <div class="user-avatar md bg-primary">
                                    <span>{{generateInitials(auth()->user()->name)}}</span>
                                    <div class="status dot dot-lg dot-success"></div>
                                </div>
                                <div class="user-info">
                                    <h6>{{auth()->user()->name}}</h6>
                                    <span class="sub-text">{{auth()->user()->staff_id}}</span>
                                </div>
                            </div>
                            <div class="team-details">
                                <p>{{ucfirst(auth()->user()->role)}}</p>
                            </div>
                            <ul class="team-statistics">
                                <li><span>{{$my_cancelled_leave_approval_count}}</span><span>Cancelled Leave Requests</span></li>
                                <li><span>{{$my_pending_leave_approval_count}}</span><span>Pending Requests</span></li>
                                <li><span>{{getLeaveBalance(auth()->id(),$leave_settings->annual_leave_id)}}</span><span>Balance(Days)</span></li>
                            </ul>
                            <div class="team-view">
                                <a href="{{url('employees/details/'.auth()->id())}}" class="btn btn-round btn-outline-light w-150px"><span>View Profile</span></a>
                            </div>
                        </div><!-- .team -->
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-sm-9 col-md-9 col-lg-8 col-xxl-8">
                <div class="card card-full">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Recent Leave Requests</h6>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list mt-n2">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Leave Type</span></div>
                            <div class="nk-tb-col tb-col-sm"><span>Employee Name</span></div>
                            <div class="nk-tb-col tb-col-md"><span>Starts</span></div>
                            <div class="nk-tb-col"><span>Ends</span></div>
                            <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
                        </div>
                        @foreach($recent_leave_requests as $rlr)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead"><a href="#">{{$rlr->leave_type->name}}</a></span>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-purple-dim">
                                        <span>{{generateInitials($rlr->user->name)}}</span>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">{{$rlr->user->name}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">{{date('F j, Y',strtotime($rlr->start_date))}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">{{date('F j, Y',strtotime($rlr->end_date))}} </span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-dot-xs bg-{{getLeaveStatusColor($rlr->status)}}">{{getLeaveStatus($rlr->status)}}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div><!-- .card -->
            </div>
        </div>
    </div><!-- .nk-block -->

</div>
