@extends('admin.layouts.master')
@section('content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h5 class="title fw-medium">Leave Settings</h5>
                                                <span>These settings helps you modify Leave settings.</span>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="nk-block-head-content align-self-start d-lg-none">

                                            </div>
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <form id="leaveSettingForm" class="form-settings">
                                            @csrf
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="site-name">Workflow</label>
                                                        <span class="form-note">Select Leave Approval</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <select name="workflow_id" class="form-control">
                                                                <option value="">Select Leave Approval Workflow</option>
                                                                @foreach($workflows as $workflow)
                                                                    <option value="{{$workflow->id}}" {{$workflow->id==$leave_setting->workflow_id?'selected':''}}>{{$workflow->name}}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="site-name">Annual Leave Type</label>
                                                        <span class="form-note">Select Leave type that is annual leave.</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <select name="annual_leave_id" class="form-control">
                                                                <option value="">Select Annual Leave Type</option>
                                                                @foreach($leave_types as $lt)
                                                                    <option value="{{$lt->id}}" {{$lt->id==$leave_setting->annual_leave_id?'selected':''}}>{{$lt->name}}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="site-off">Uses Casual Leave</label>
                                                        <span class="form-note">Enable if unconfirmed staff use casual leave instead of their leave days till confirmed.</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" {{$leave_setting->uses_casual_leave==1?'checked':''}} name="uses_casual_leave" id="site-off">
                                                            <label class="custom-control-label" for="site-off">Enabled</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="site-email">Casual Leave Length</label>
                                                        <span class="form-note">Specify the key of your hospital address</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" name="casual_leave_length" value="{{$leave_setting->casual_leave_length}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="site-off">Require Replacement Approval</label>
                                                        <span class="form-note">Enable to make Project make offline.</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" {{$leave_setting->require_replacement_approval==1?'checked':''}} name="require_replacement_approval" id="require_replacement_approval">
                                                            <label class="custom-control-label" for="require_replacement_approval">Enabled</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="site-off">Includes Holiday</label>
                                                        <span class="form-note">Enable is leave days includes holidays</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" {{$leave_setting->include_holiday==1?'checked':''}} name="include_holiday" id="include_holiday">
                                                            <label class="custom-control-label" for="include_holiday">Enabled</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="site-off">Includes Weekend</label>
                                                        <span class="form-note">Enable if leave days include weekends.</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" {{$leave_setting->include_weekend==1?'checked':''}} name="include_weekend" id="include_weekend">
                                                            <label class="custom-control-label" for="include_weekend">Enabled</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="site-off">Can Request Leave Allowance</label>
                                                        <span class="form-note">Enable if employees can request leave allowance</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" {{$leave_setting->can_request_allowance==1?'checked':''}} name="can_request_allowance" id="can_request_allowance">
                                                            <label class="custom-control-label" for="can_request_allowance">Enabled</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3 align-center">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="site-off">Probationer can apply for leave</label>
                                                        <span class="form-note">Enable if an unconfirmed staff can apply for any leave.</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" {{$leave_setting->probationer_applies==1?'checked':''}} name="probationer_applies" id="probationer_applies">
                                                            <label class="custom-control-label" for="probationer_applies">Enabled</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-lg-7">
                                                    <div class="form-group mt-2">
                                                        <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!-- .nk-block-head -->
                                </div><!-- .card-inner -->
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <h3 class="nk-block-title page-title">Settings</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>Here you can change and edit your needs</p>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0">
                                           @include('admin.settings.partials.nav')
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- card-aside -->
                            </div><!-- card-aside-wrap -->
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
$('#leaveSettingForm').submit(function(e) {
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
            submitForm('leaveSettingForm', '{{url('leave_settings')}}',false)
            // .then(() => {
            //     location.reload();
            // })
        }
    })
});
</script>
@endsection
