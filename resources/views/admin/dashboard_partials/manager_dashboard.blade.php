<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title page-title">Manager Dashboard</h4>
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
                                <a href="html/user-details-regular.html" class="btn btn-round btn-outline-light w-150px"><span>View Profile</span></a>
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
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead"><a href="#">Annual Leave</a></span>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-purple-dim">
                                        <span>AB</span>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">Abu Bin Ishtiyak</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">Aug, 8 2023</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">Aug, 11 2023 </span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-dot-xs bg-success">Approved</span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead"><a href="#">Exam Leave</a></span>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-azure-dim">
                                        <span>DE</span>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">Desiree Edwards</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">Sep 1, 2023</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">Sep 5, 2023</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-dot-xs bg-danger">Rejected</span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead"><a href="#">Annual Leave</a></span>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-azure-dim">
                                        <span>BS</span>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">Blanca Schultz</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">Sep 7, 2023</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">Sep 8, 2023</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-dot-xs bg-success">Approved</span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead"><a href="#">Maternity Leave</a></span>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-success-dim">
                                        <span>CH</span>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">Cassandra Hogan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">Oct 2, 2023</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">Oct 7, 2023</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-dot-xs bg-warning">Pending</span>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div>
        </div>
    </div><!-- .nk-block -->

</div>
