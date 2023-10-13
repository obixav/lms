@extends('admin.layouts.master')
@section('stylesheets')
    <style>
        .cancelled td {
          background: #fbd9dc;
        }
    </style>
@endsection
@section('content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title page-title">My Leave Requests</h4>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <a href="{{url('leave_requests/create')}}" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                <a href="{{url('leave_requests/create')}}" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>New Leave Request</span></a>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">

            <div class="col-sm-6 col-md-3 col-lg-3 col-xxl-3">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">My Pending Leave Approvals </h6>
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
            <div class="col-sm-6 col-md-3 col-lg-3 col-xxl-3">
                <div class="card" id="leave_bank">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">My Leave Days Entitled (Annual)</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">{{$annual_leave_details['entitled']}}</div>
                                    <div class="nk-ecwg6-ck">

                                    </div>
                                </div>
                                <div class="info"><a href="#">View More</a></div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->

            </div><!-- .col -->
            <div class="col-sm-6 col-md-3 col-lg-3 col-xxl-3">
                <div class="card" id="leave_bank">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">My Used Leave Days (Annual)</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">{{$annual_leave_details['usage']}}</div>
                                    <div class="nk-ecwg6-ck">

                                    </div>
                                </div>
                                <div class="info"><a href="#">View More</a></div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->

            </div><!-- .col -->
            <div class="col-sm-6 col-md-3 col-lg-3 col-xxl-3">
                <div class="card" id="leave_bank">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">My Leave Balance (Annual)</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">{{$annual_leave_details['balance']}}</div>
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

            <div class="col-sm-12 col-md-12 col-lg-12 col-xxl-12">
                <div class="card card-full">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title"> Leave Requests</h6>
                            </div>
                        </div>
                        <table class="datatable-init-export nowrap table" data-export-title="Export">
                            <thead>
                            <tr>
                                <th>Leave Type</th>
                                <th>Applied On</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Length</th>
                                <th>Approval Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leaveRequests as $leave_request)
                            <tr class="{{$leave_request->status==4?'cancelled':''}}">
                                <td >{{$leave_request->leave_type?$leave_request->leave_type->name:''}}</td>
                                <td>{{date('F j,Y',strtotime($leave_request->created_at))}}</td>
                                <td>{{date('F j,Y',strtotime($leave_request->start_date))}}</td>
                                <td>{{date('F j,Y',strtotime($leave_request->end_date))}}</td>
                                <td>{{$leave_request->length}}</td>
                                <td><span class="badge badge-dot badge-dot-xs bg-{{getLeaveStatusColor($leave_request->status)}}">{{getLeaveStatus($leave_request->status)}}</span></td>
                                <td class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">

                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a onclick="LeaveDetails({{$leave_request->id}})"><em class="icon ni ni-focus"></em><span>View More Details</span></a></li>
                                                        @if($leave_request->status==1)
                                                        <li><a href="{{url('leave_advice?leave_request_id='.$leave_request->id)}}" target="_blank"><em class="icon ni ni-file-docs"></em><span>Leave Advice</span></a></li>
                                                        @endif
                                                            <li><a onclick="cancelLeaveRequest({{$leave_request->id}})"><em class="icon ni ni-na"></em><span>Cancel leave</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>



                </div><!-- .card -->
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xxl-12">
                <div class="card card-full">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">My leave Balances</h6>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list mt-n2">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span> Type</span></div>
                            <div class="nk-tb-col tb-col-sm"><span>Entitled</span></div>
                            <div class="nk-tb-col tb-col-md"><span>Usage</span></div>
                            <div class="nk-tb-col"><span>Balance</span></div>

                        </div>
                        @foreach($leave_info as $li)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <span class="tb-lead"><a href="#">{{$li['name']}}</a></span>
                                </div>
                                <div class="nk-tb-col ">

                                    <span class="tb-lead">{{$li['entitled']}}</span>


                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub">{{$li['usage']}}</span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub">{{$li['balance']}} </span>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div><!-- .card -->

            </div><!-- .col -->
        </div>
    </div><!-- .nk-block -->

</div>
            </div>
        </div>
    </div>
    @include('admin.leave_requests.modals.details')
    @include('admin.leave_requests.modals.start_cancellation_request')
@endsection
@section('scripts')
    <script src="{{asset('admin_assets/js/libs/datatable-btns.js?ver=3.2.0')}}"></script>
    <script>
        $('#startCancellationForm').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Cancel This Leave Request?!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm('startCancellationForm', '{{url('cancel_leave_request')}}','{{url('my_leave_requests')}}')
                    // .then(() => {
                    //     location.reload();
                    // })
                }
            })
        });
        function LeaveDetails(leave_request_id)
        {
            $(document).ready(function() {
                $("#detailLoader").load('{{ url('/leave_details') }}?leave_request_id='+leave_request_id);
                $('#leaveDetailsModal').modal('show');
            });

        }
        function cancelLeaveRequest(leave_request_id)
        {
            $('#cancel_id').val(leave_request_id);
            $('#startCancellationModal').modal('show');


        }

        window.LeaveDetails = LeaveDetails;
    </script>
@endsection
