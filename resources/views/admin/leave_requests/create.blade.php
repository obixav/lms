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
                                <h3 class="nk-block-title page-title">New Leave Request</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form id="NewLeaveForm">
                                    @csrf
                                <div class="row gy-4">
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="leave_type">Leave Type</label>
                                            <select id="leave_type" class="form-select js-select2" name="leave_type_id">
                                                <option value="default_option">Select</option>
                                                @if($user->status==1 || ($user->status==0 && $leave_setting->uses_casual_leave==0))
                                                @foreach($leave_types as $leave_type)
                                                    <option value="{{$leave_type->id}}">{{ucfirst($leave_type->name)}}</option>
                                                @endforeach
                                                @elseif($user->status==0 || $lp->uses_casual_leave==1)
                                                    <option value="{{$leave_setting->annual_leave_id}}">Casual Leave</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div><!--col-->

                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Selection Type</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="date_selection_type" name="date_selection_type" required >
                                                    <option value="range">Range</option>
                                                    <option value="dates">Dates</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4" id="range">
                                        <div class="form-group">
                                            <label class="form-label">Period</label>
                                            <div class="input-daterange input-group" id="datepicker">
                                                <input type="text" class="input-sm form-control" name="start_date" placeholder="From date" id="fromdate" value="" required readonly />
                                                <span class="input-group-addon">to</span>
                                                <input type="text" class="input-sm form-control" name="end_date" placeholder="To date" id="todate" value="" required readonly />
                                            </div>
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4" id="dates">
                                        <div class="form-group">
                                            <label class="form-label" for="last-name">Period</label>
                                            <input type="text" class="form-control " name="selection" placeholder="" id="selection" required readonly>
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="leave_type">Replacement</label>
                                            <select id="leave_type" class="form-select js-select2" data-search="on" required name="replacement_id">
                                                <option value="default_option">Select</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{$employee->id}}">{{$employee->fullname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Reason</label>
                                            <input type="text" class="form-control" id="reason" placeholder="Reason" required name="reason">
                                        </div>
                                    </div><!--col-->
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="photo">Absence Document</label>
                                            <div class="form-control-wrap">
                                                <div class="custom-file">
                                                    <input type="file"  class="form-control" id="customFile">
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--col-->

                                @if($leave_setting->can_request_allowance==1)
                                    <div class="col-xxl-3 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Request Allowance</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select js-select2" name="requested_allowance">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div><!--col-->
                                    @endif
                                        <div class="col-xxl-3 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Leave Days Requested</label>
                                                <input type="text" readonly class="form-control" id="leave_days_requested" name="leave_days_requested">
                                            </div>
                                        </div><!--col-->

                                        <div class="col-xxl-3 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Leave Balance Before</label>
                                                <input type="text" readonly class="form-control" id="leaveBalanceBefore" name="leave_balance">
                                            </div>
                                        </div><!--col-->
                                        <div class="col-xxl-3 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Leave Balance After</label>
                                                <input type="text" readonly class="form-control" id="leaveBalanceAfter" name="leave_balance_after">
                                            </div>
                                        </div><!--col-->
                                        <input type="hidden" name="user_id" value="{{$user_id}}">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Save Leave Request</button>
                                        </div>
                                    </div><!--col-->
                                </div><!--row-->
                                </form>
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
@endsection
@section('scripts')
    <script>
        function datePicker() {
            $('.period_daterange').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
        }
        $(document).ready(function () {
            $('#dates').hide();
            datePicker();
            $('#date_selection_type').on('change', function () {
                console.log($(this).val());
                if ($(this).val() == 'range') {
                    $('#range').show();
                    $('#dates').hide();
                    $('#leave_days_requested').val('');
                    $('#leaveBalanceAfter').val('');
                    $('#leaveBalanceBefore').val('');

                }
                if ($(this).val() == 'dates') {
                    $('#dates').show();
                    $('#range').hide();
                    $('#leave_days_requested').val('');
                    $('#leaveBalanceAfter').val('');
                    $('#leaveBalanceBefore').val('');

                }

            });
            $('.input-daterange').datepicker({
                format: 'yyyy-mm-dd',
                startDate: new Date,
                autoclose: true,
                closeOnDateSelect: true,
                daysOfWeekDisabled: [@if($leave_setting->includes_weekend==0)0, 6 @endif],
                datesDisabled: [@if($leave_setting->includes_holiday==0) @foreach($holidays as $holiday)"{{date('Y-m-d',strtotime($holiday->date))}}",@endforeach @endif]
            }).datepicker("setDate", 'now');

            $('#selection ').datepicker({
                format: 'yyyy-mm-dd',
                multidate: true,
                todayHighlight: true,
                daysOfWeekDisabled: [@if($leave_setting->includes_weekend==0)0, 6 @endif],
                clearBtn: true,
                datesDisabled: [@if($leave_setting->includes_holiday==0) @foreach($holidays as $holiday)"{{date('Y-m-d',strtotime($holiday->date))}}",@endforeach @endif]
            })

        });
        $('#NewLeaveForm').submit(function(e) {
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
                    submitForm('NewLeaveForm', '{{url('leave_requests')}}', '{{url('my_leave_requests')}}');
                    // .then(() => {
                    //     location.reload();
                    // })
                }
            })
        });
        $('#fromdate').on('change', function () {
          let  fromdate = $('#fromdate').val();
          let  todate = $('#todate').val();

            $.get('{{ url('/leave_requests/get_leave_requested_days') }}/', {
                fromdate: fromdate,
                todate: todate,
            }, function (data) {
                $('#leave_days_requested').val(data);
            });
            checkLeaveLength();
        });


        $('#todate').on('change', function () {
            let fromdate = $('#fromdate').val();
           let  todate = $('#todate').val();

            $.get('{{ url('/leave_requests/get_leave_requested_days') }}/', {
                fromdate: fromdate,
                todate: todate,
                type: 'range'
            }, function (data) {
                $('#leave_days_requested').val(data);
            });
            checkLeaveLength()
        });

        $('#selection').on('change', function () {
          let selection = $(this).val();

            $.get('{{ url('/leave_requests/get_leave_requested_days') }}/', {
                selection: selection,
                type: 'dates'
            }, function (data) {
                $('#leave_days_requested').val(data);
            });
            checkLeaveLength();
        });
        function deleteLeaveRequest(leave_request_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this product?!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get('{{url('leave_requests/delete')}}/'+leave_request_id, function (data) {
                        if (data.success == true) {
                            location.reload();
                        }
                    })
                }
            })


        }
        function checkLeaveLength() {
            let leave_type_id = $('#leave_type').val();


            $.get('{{ url('/leave_requests/get_leave_balance') }}', {leave_type_id: leave_type_id,user_id:{{$user_id}}}, function (data) {
                $('#leaveBalanceBefore').val(Math.round(data));

                if (doValidate(data).check) {
                    $('#leaveBalanceAfter').val(Math.round(doValidate(data).value));
                }

            });
        }

        function doValidate(v) {
            let  vl;
            vl = v || vl;
            check = vl - $('#leave_days_requested').val();
            if (check < 0) {
                Swal.fire(
                    `Error!`,
                    'Your selected leave days cannot exceed your entitled days (' + $('#leave_days_requested').val() + ')','error'

                )
                $('#fromdate').val('');
                $('#todate').val('');
                // toastr.error('Your selected leave days cannot exceed your entitled days (' + $('#leave_days_requested').val() + ')','Error');

                //alert('Your leave days cannot exceed your entitled days (' + $('#leave_days_requested').val() + ')');
            }
            return {
                check: check > 0,
                value: check
            };
        }
    </script>
@endsection
