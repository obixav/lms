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
                <h4 class="nk-block-title page-title">Leave Report</h4>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <form action="">
                                <li>
                                    <div class="form-control-wrap" style="width: 200px;">
                                        <select name="employee" class="form-control employee"  >
                                            @if(request()->filled('employee'))
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @else
                                            <option value="">Select Employee</option>
                                            @endif
                                        </select>
                                       </div>
                                </li>
                                <li>
                                    <div class="form-control-wrap">

                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-link-group"></em>
                                        </div>
                                        <select name="$leave_type" class="form-control" id="">
                                            <option value="">Select Leave Type</option>
                                            @foreach ($leave_types as $leave_type)
                                                <option value="{{$leave_type->id}}" {{request()->leave_type==$leave_type->id?'selected':''}}>{{$leave_type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-control-wrap">

                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-
                                                    check-round-cut"></em>
                                        </div>
                                        <select name="status" class="form-control" id="">
                                            <option value="">Status</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Approved</option>
                                            <option value="2">Rejected</option>
                                            <option value="4">Cancelled</option>
                                        </select>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-control-wrap">
                                        <a href="{{request()->url()}}" class="btn btn-warning d-none d-md-inline-flex">Clear Filters</a>
                                        <button type="submit" class="btn btn-primary d-none d-md-inline-flex">Filter</button>
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
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner position-relative card-tools-toggle">

                </div><!-- .card-inner -->
            </div>
        </div>
        <div class="row g-gs">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xxl-12">
                <div class="card card-full">
                    <div class="card-inner-group">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h5 class="title">Leave Requests</h5>
                                </div>


                            </div>
                        </div>
                    <div class="card-inner">

                        <table class="datatable-init-export nowrap table" data-export-title="Export">
                            <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Leave Type</th>
                                <th>Applied On</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Length</th>
                                <th>Requested Allowance</th>
                                <th> Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leaveRequests as $leave_request)
                            <tr class="{{$leave_request->status==4?'cancelled':''}}">
                                <td>{{$leave_request->user->name}}</td>
                                <td >{{$leave_request->leave_type?$leave_request->leave_type->name:''}}</td>
                                <td>{{date('F j,Y',strtotime($leave_request->created_at))}}</td>
                                <td>{{date('F j,Y',strtotime($leave_request->start_date))}}</td>
                                <td>{{date('F j,Y',strtotime($leave_request->end_date))}}</td>
                                <td>{{$leave_request->length}}</td>
                                <td>{{$leave_request->requested_allowance==1?'Yes':'No'}}</td>
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

                    </div>

                </div><!-- .card -->
            </div>

        </div>
    </div><!-- .nk-block -->

</div>
            </div>
        </div>
    </div>
    @include('admin.leave_requests.modals.details')

@endsection
@section('scripts')
    <script src="{{asset('admin_assets/js/libs/datatable-btns.js?ver=3.2.0')}}"></script>
    <script>
        $('.employee').select2({
            ajax: {
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                url: function (params) {
                    return '{{url('employees_search')}}';
                }
            },

        });
        function LeaveDetails(leave_request_id)
        {
            $(document).ready(function() {
                $("#detailLoader").load('{{ url('/leave_details') }}?leave_request_id='+leave_request_id);
                $('#leaveDetailsModal').modal('show');
            });

        }


        window.LeaveDetails = LeaveDetails;
    </script>
@endsection
