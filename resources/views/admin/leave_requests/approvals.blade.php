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
                                <h3 class="nk-block-title page-title">Leave Request Approvals</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total of {{$user_approvals->count()+$dr_approvals->count()+$role_approvals->count()}} Pending Approvals</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                             </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">

                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                    <label class="custom-control-label" for="uid"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col"><span class="sub-text">Employee</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Staff ID</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Gender</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Applied On</span></div>

                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Leave Type</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Starts</span></div>
                                            <div class="nk-tb-col tb-col-xxl"><span class="sub-text">Ends</span></div>
                                            <div class="nk-tb-col tb-col-xxl"><span class="sub-text">Length</span></div>
                                            <div class="nk-tb-col tb-col-xxl"><span class="sub-text">Requested Allowance</span></div>
                                            <div class="nk-tb-col tb-col-xxl"><span class="sub-text">Approval Type</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                            <div class="nk-tb-col nk-tb-col-tools">

                                            </div>
                                        </div><!-- .nk-tb-item -->
{{--                                        Role Approvals--}}
                                        @foreach($user_approvals as $approval)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                                    <label class="custom-control-label" for="uid1"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col">
                                                <a href="{{url('employees/'.$approval->approvable->user->id)}}">
                                                    <div class="user-card">
                                                        <div class="user-avatar sm bg-primary">
                                                            <span>{{generateInitials($approval->approvable->user->name)}}</span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{$approval->approvable->user->name}} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                            <span>{{$approval->approvable->user->email}}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span>{{$approval->approvable->user->staff_id}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-mb">
                                                <span class="fw-bold">{{ucfirst($employee->gender)}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-xxl">
                                                <span>{{date('F j, Y',strtotime($approval->approvable->created_at))}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-lg">
                                                <span>{{$approval->approvable->leave_type->name}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-xxl">
                                                <span>{{date('F j, Y',strtotime($approval->approvable->start_date))}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-xxl">
                                                <span>{{date('F j, Y',strtotime($approval->approvable->end_date))}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-lg">
                                                <span>{{$approval->approvable->length}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-lg">
                                                <span>User Approval</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="tb-status text-{{getLeaveStatusColor($approval->approvable->status)}}">{{getLeaveStatus($approval->approvable->status)}}</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li class="nk-tb-action-hidden">
                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                            <em class="icon ni ni-mail-fill"></em>
                                                        </a>
                                                    </li>
                                                    <li class="nk-tb-action-hidden">
                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Suspend">
                                                            <em class="icon ni ni-user-cross-fill"></em>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a onclick="LeaveDetails({{$approval->approvable->id}})"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    <li><a onclick="DisplayApproveModal({{$approval->id}})"><em class="icon ni ni-edit"></em><span>Approve/Reject</span></a></li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                        @endforeach
                                        @foreach($dr_approvals as $approval)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input" id="uid1">
                                                        <label class="custom-control-label" for="uid1"></label>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <a href="{{url('employees/'.$approval->approvable->user->id)}}">
                                                        <div class="user-card">
                                                            <div class="user-avatar sm bg-primary">
                                                                <span>{{generateInitials($approval->approvable->user->name)}}</span>
                                                            </div>
                                                            <div class="user-info">
                                                                <span class="tb-lead">{{$approval->approvable->user->name}} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                                <span>{{$approval->approvable->user->email}}</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <span>{{$approval->approvable->user->staff_id}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-mb">
                                                    <span class="fw-bold">{{ucfirst($approval->approvable->user->gender)}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span>{{date('F j, Y',strtotime($approval->approvable->created_at))}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span>{{$approval->approvable->leave_type->name}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span>{{date('F j, Y',strtotime($approval->approvable->start_date))}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span>{{date('F j, Y',strtotime($approval->approvable->end_date))}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span>{{$approval->approvable->length}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span>Manager Approval</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <span class="tb-status text-{{getLeaveStatusColor($approval->approvable->status)}}">{{getLeaveStatus($approval->approvable->status)}}</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                                <em class="icon ni ni-mail-fill"></em>
                                                            </a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Suspend">
                                                                <em class="icon ni ni-user-cross-fill"></em>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a onclick="LeaveDetails({{$approval->approvable->id}})"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                        <li><a onclick="DisplayApproveModal({{$approval->id}})"><em class="icon ni ni-edit"></em><span>Approve/Reject</span></a></li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                        @endforeach
                                        @foreach($role_approvals as $approval)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input" id="uid1">
                                                        <label class="custom-control-label" for="uid1"></label>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <a href="{{url('employees/'.$approval->approvable->user->id)}}">
                                                        <div class="user-card">
                                                            <div class="user-avatar sm bg-primary">
                                                                <span>{{generateInitials($approval->approvable->user->name)}}</span>
                                                            </div>
                                                            <div class="user-info">
                                                                <span class="tb-lead">{{$approval->approvable->user->name}} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                                <span>{{$approval->approvable->user->email}}</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <span>{{$approval->approvable->user->staff_id}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-mb">
                                                    <span class="fw-bold">{{ucfirst($approval->approvable->user->gender)}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span>{{date('F j, Y',strtotime($approval->approvable->created_at))}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span>{{$approval->approvable->leave_type->name}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span>{{date('F j, Y',strtotime($approval->approvable->start_date))}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span>{{date('F j, Y',strtotime($approval->approvable->end_date))}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span>{{$approval->approvable->length}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span>Role Approval</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <span class="tb-status text-{{getLeaveStatusColor($approval->approvable->status)}}">{{getLeaveStatus($approval->approvable->status)}}</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                                <em class="icon ni ni-mail-fill"></em>
                                                            </a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Suspend">
                                                                <em class="icon ni ni-user-cross-fill"></em>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a onclick="LeaveDetails({{$approval->approvable->id}})"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                        <li><a onclick="DisplayApproveModal({{$approval->id}})"><em class="icon ni ni-edit"></em><span>Approve/Reject</span></a></li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                        @endforeach
                                    </div><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->

                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
 @include('admin.leave_requests.modals.details')
    @include('admin.leave_requests.modals.approve_request')
@endsection
@section('scripts')
    <script>
        $('#approval').on('change', function () {
            type = $(this).val();

            if (type == 1) {

                $('#comment').attr('required', false);

            }
            if (type == 2) {
                $('#comment').attr('required', true);
            }


        });
        $('#approveLeaveRequestForm').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Save changes?!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm('approveLeaveRequestForm', '{{url('leave_approvals')}}','{{url('leave_approvals')}}')
                    // .then(() => {
                    //     location.reload();
                    // })
                }
            })
        });

        function DisplayApproveModal(leave_approval_id)
        {
            $(document).ready(function () {
                $('#approval_id').val(leave_approval_id);
                $('#approveLeaveRequestModal').modal('show');
            });

        }
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
