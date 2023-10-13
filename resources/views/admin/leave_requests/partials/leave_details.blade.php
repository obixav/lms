<div class="card">
    <div class="card-inner mb-n2">
        <div class="card-title-group">
            <div class="card-title card-title-sm">
                <h6 class="title">Employee Details</h6>
            </div>

        </div>
    </div>
    <div class="nk-tb-list is-compact">

        <div class="nk-tb-item">
            <div class="nk-tb-col">
                <span class="tb-sub"><span>Name</span></span>
            </div>
            <div class="nk-tb-col text-end">
                <span class="tb-sub tb-amount"><span>{{$leave_request->user->name}}</span></span>
            </div>
        </div><!-- .nk-tb-item -->
        <div class="nk-tb-item">
            <div class="nk-tb-col">
                <span class="tb-sub"><span>Staff Id</span></span>
            </div>
            <div class="nk-tb-col text-end">
                <span class="tb-sub tb-amount"><span>{{$leave_request->user->staff_id}}</span></span>
            </div>
        </div><!-- .nk-tb-item -->
        <div class="nk-tb-item">
            <div class="nk-tb-col">
                <span class="tb-sub"><span>Leave Balance</span></span>
            </div>
            <div class="nk-tb-col text-end">
                <span class="tb-sub tb-amount"><span>{{getLeaveBalance($leave_request->user_id,$leave_request->leave_type_id)}}</span></span>
            </div>
        </div><!-- .nk-tb-item -->
        <div class="nk-tb-item">
            <div class="nk-tb-col">
                <span class="tb-sub"><span>Hire date</span></span>
            </div>
            <div class="nk-tb-col text-end">
                <span class="tb-sub tb-amount"><span>{{date('F j, Y',strtotime($leave_request->user->hiredate))}}</span></span>
            </div>
        </div><!-- .nk-tb-item -->
    </div><!-- .nk-tb-list -->
</div><!-- .card -->
<center>
    <div id="dateviewer" ></div>
</center>
<div class="table-responsive">
    <h4>Other Leave applications this year</h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Leave Type</th>
            <th>Approval Status</th>
            <th>Length</th>
            <th>Applied On</th>
            <th>Start Date</th>
            <th>End Date</th>


        </tr>
        </thead>
        <tbody>
        @foreach($previous_annual_leave_requests as $lrequest)
            <tr>
                <td>{{$lrequest->leave_type->name}}</td>
                <td><span class=" tag   {{$lrequest->status==0?'tag-warning':($lrequest->status==1?'tag-success':'tag-danger')}}">{{$lrequest->status==0?'pending':($lrequest->status==1?'approved':'rejected')}}</span></td>
                <td>{{$lrequest->length}}</td>
                <td>{{date('F j,Y',strtotime($lrequest->created_at))}}</td>
                <td>{{date('F j,Y',strtotime($lrequest->start_date))}}</td>
                <td>{{date('F j,Y',strtotime($lrequest->end_date))}}</td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>
<div class="table-responsive">
    <h4>Approval Details ({{$leave_request->workflow->name}})</h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Stage</th>
            <th>Approver</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Time in Stage</th>

        </tr>
        </thead>
        <tbody>
        @foreach($leave_request->approvals as $approval)
            <tr>
                <td>{{$approval->stage->name}}</td>
                <td>{{$approval->approver_id>0?$approval->approver->name:""}}</td>
                <td>{{$approval->comments}}</td>
                <td><span class=" tag   {{$approval->status==0?'tag-warning':($approval->status==1?'tag-success':'tag-danger')}}">{{$approval->status==0?'pending':($approval->status==1?'approved':'rejected')}}</span></td>
                <td>{{ $approval->created_at==$approval->updated_at?\Carbon\Carbon::parse($approval->created_at)->diffForHumans():\Carbon\Carbon::parse($approval->created_at)->diffForHumans($approval->updated_at) }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>


<div class="table-responsive">
    <h4>Adjustment Details</h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Adjuster</th>
            <th>Reason</th>
            <th>Date Removed</th>

        </tr>
        </thead>
        <tbody>
        @foreach($leave_request->adjustments as $adjustment)
            <tr>
                <td>{{$adjustment->$adjuster?$adjustment->adjuster->name:""}}</td>
                <td>{{$adjustment->adjustment_reason}}</td>
                <td>{{date('F j,Y',strtotime($adjustment->date))}}</td>

            </tr>
        @endforeach
        </tbody>

    </table>
</div>




<script>
    $('#dateviewer ').datepicker({
        format: 'yyyy-mm-dd',

        enableOnReadonly:true,
        todayBtn:true,
        daysOfWeekDisabled:[0,1,2,3,4,5,6],
        title:'Leave Days Selected'

    }).datepicker('update', @foreach($leave_request->dates as $lrd)"{{date('Y-m-d',strtotime($lrd->date))}}",@endforeach);
</script>
