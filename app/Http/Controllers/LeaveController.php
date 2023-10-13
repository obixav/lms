<?php

namespace App\Http\Controllers;

use App\Mail\SendLeaveAdvice;
use App\Mail\ShareLeaveAdvice;
use App\Models\Approval;
use App\Models\GradeLeaveType;
use App\Models\Holiday;
use App\Models\LeaveRequest;
use App\Models\LeaveRequestAdjustment;
use App\Models\LeaveRequestCancellation;
use App\Models\LeaveRequestDate;
use App\Models\LeaveSetting;
use App\Models\LeaveType;
use App\Models\Setting;
use App\Models\User;
use App\Models\Workflow;
use App\Models\WorkflowStage;
use App\Notifications\ApproveLeaveCancellationRequest;
use App\Notifications\ApproveLeaveRequest;
use App\Notifications\LeaveRequestApproved;
use App\Notifications\LeaveRequestApprovedOthers;
use App\Notifications\LeaveRequestCancellationApproved;
use App\Notifications\LeaveRequestCancellationRejected;
use App\Notifications\LeaveRequestPassedStage;
use App\Notifications\LeaveRequestRejected;
use App\Notifications\RelieveColleagueOnLeave;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LeaveController extends Controller
{
    public $allowed = ['JPG', 'PNG', 'jpeg', 'png', 'gif', 'jpg', 'pdf', 'docx', 'doc'];
    //

    public function Report(Request $request)
    {
        $year=$request->year!=''?$request->year:date('Y');
        $ls=LeaveSetting::first();
        $leave_types=LeaveType::all();
        $leave_adjustments=LeaveRequestAdjustment::whereYear('created_at',$year)->get();
        $leave_cancellations=LeaveRequestCancellation::whereYear('created_at',$year)->get();
        $leaveRequests=LeaveRequest::whereYear('created_at',$year)->withTrashed();
        $user=User::find(0);
        if($request->filled('employee'))
        {
            $user_id=$request->employee;
            $leaveRequests=$leaveRequests->whereHas('user',function ($query) use($user_id){
                $query->where('users.id',$user_id);
            });
            $user=User::find($user_id);
        }
        if($request->filled('leave_type'))
        {
            $leaveRequests=$leaveRequests->where('leave_type_id',$request->leave_type);
        }
        if($request->filled('status'))
        {
            $leaveRequests=$leaveRequests->where('status',$request->status);
        }
        $leaveRequests=$leaveRequests->get();
        return view('admin.leave_requests.report',compact('leave_adjustments','ls','leaveRequests','leave_types',
            'leave_cancellations','user'));
    }
    public function myRequests(Request $request)
    {

        $user = Auth::user();
        $year = $request->year;
        if ($request->year == '') {
            $year = date('Y');
        }
        $ls=LeaveSetting::first();
        //fetch all leaves
        $leaves = LeaveType::all();
        //create leave in formation array
        $leave_info = [];
        //check if user is confirmed
        if ($user->status == 1 || ($user->status == 0 && $ls->uses_casual_leave == 0)) {

            foreach ($leaves as $leave) {

                $used_leave_days = LeaveRequestDate::whereYear('date', $year)->whereHas('leave_request', function ($query) use ($user, $leave) {
                    $query->where('leave_requests.user_id', $user->id)
                        ->where('status', 1)
                        ->where('leave_type_id', $leave->id);
                })->count();

                $grade_leave_type=GradeLeaveType::where(['grade_id'=>$user->grade_id,'leave_type_id'=>$leave->id])->first();

                $length=$grade_leave_type?$grade_leave_type->length:$leave->length;
                if ($leave->gender == 'all') {
                    $leave_info[$leave->id]['name'] = $leave->name;
                    $leave_info[$leave->id]['entitled'] = $length;
                    $leave_info[$leave->id]['usage'] = $used_leave_days;
                    $leave_info[$leave->id]['balance'] = $length - $used_leave_days;
                } elseif ($leave->gender == $user->gender) {
                    $leave_info[$leave->id]['name'] = $leave->name;
                    $leave_info[$leave->id]['entitled'] = $length;
                    $leave_info[$leave->id]['usage'] = $used_leave_days;
                    $leave_info[$leave->id]['balance'] = $length - $used_leave_days;

                }
            }
        }
        $annual_leave_details=$leave_info[$ls->annual_leave_id];
        $leaveRequests=LeaveRequest::where('user_id',Auth::id())->withTrashed()->get();
        $my_pending_leave_approval_count=LeaveRequest::where(['status'=>0,'user_id'=>auth()->id()])->count();

        return view('admin.leave_requests.my_requests',compact('leave_info','ls','leaveRequests','leaves',
        'my_pending_leave_approval_count','annual_leave_details'));

    }

    public function leaveDetails(Request $request)
    {
        $leave_request = LeaveRequest::where('id', $request->leave_request_id)->withTrashed()->first();
        $previous_annual_leave_requests = LeaveRequest::where('user_id', $leave_request->user_id)->where('id', '!=', $leave_request->id)
            ->whereHas('dates', function ($query) use ($leave_request) {
                $query->whereYear('date', date('Y', strtotime($leave_request->start_date)))
                    ->orWhereYear('date', date('Y', strtotime($leave_request->end_date)));
            })->get();
        return view('admin.leave_requests.partials.leave_details', compact('leave_request', 'previous_annual_leave_requests'));
    }

    public function leaveBalance(Request $request)
    {

       return $balance=getLeaveBalance($request->user_id,$request->leave_type_id);

    }

    public function createLeaveRequest(Request $request)
    {
        $user_id=$request->filled('user_id')?$request->user_id:auth()->id();
        $user=User::find($user_id);
         $employees=User::where('id','!=',$user_id)->where('status','!=',2)->select(DB::raw("CONCAT(first_name,' ',last_name) AS fullname"),'id' )->get();
        $leave_types=LeaveType::all();
        $leave_setting=LeaveSetting::first();
       $holidays=Holiday::whereYear('date',date('Y'))->get();
        return view('admin.leave_requests.create',compact('employees','leave_types','leave_setting','holidays','user_id','user'));

    }

    public function employeeRequests(Request $request,$employee_id)
    {
        $leaveRequests=LeaveRequest::where('user_id',$employee_id)->get();
    }

    public function allRequests(Request $request)
    {
        $leaveRequests=LeaveRequest::get();
    }

    public function saveRequest(Request $request)
    {
        $request->validate([
            'leave_type_id' => ['required','numeric'],
            'start_date' => ['required_if:date_selection_type,range'],
            'end_date' => ['required_if:date_selection_type,range'],
            'selection' => ['required_if:date_selection_type,dates'],
            'replacement_id' => ['required','numeric'],
            'reason' => ['required'],
            'user_id' => ['required'],

        ]);
        $ls=LeaveSetting::first();
        if ($request->date_selection_type == 'range') {
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date));
            $dates_and_days = $this->LeaveDaysRange($request->start_date, $request->end_date);
            $length = $dates_and_days['days'];

            //range
        } elseif ($request->date_selection_type == 'dates') {
            $dates_and_days = $this->LeaveDaysSelection($request->selection);
            $start_date = date('Y-m-d', strtotime($dates_and_days['dates'][0]));
            $end_date = date('Y-m-d', strtotime(end($dates_and_days['dates'])));
            $length = $dates_and_days['days'];
            //selection
        }
        if($length>getLeaveBalance($request->user_id,$request->leave_type_id)){
            return response()->json(['success'=>false,'message' => "Leave Date Already Taken By You",
                'errors'=>['leave_balance'=>['The leave length is more than the allowed leave balance for this leave type']]]
                , 422);
        }

        $leave_request = LeaveRequest::where(['start_date' => $start_date,
            'end_date' => $end_date, 'user_id' => Auth::user()->id,
            'deleted_at'=>null])->first();
        if ($leave_request)
        {
            return response()->json(['message' => "Leave Date Already Taken By You"], 205);
        }

        $leave_request = LeaveRequest::create(['leave_type_id' => $request->leave_type_id, 'user_id' => $request->user_id, 'start_date' => $start_date,
            'end_date' => $end_date, 'reason' => $request->reason, 'workflow_id' => $ls->workflow_id,
            'paystatus' => 0, 'status' => 0, 'length' => $length, 'replacement_id' => $request->replacement_id,
            'balance' => $request->leaveremaining, 'requested_allowance' => $request->requested_allowance]);

        foreach ($dates_and_days['dates'] as $dd) {
            LeaveRequestDate::create(['leave_request_id' => $leave_request->id, 'date' => date('Y-m-d', strtotime($dd))]);
        }

        if ($request->file('absence_doc')) {
            $mime = $request->file('absence_doc')->getClientOriginalextension();
            if (!(in_array($mime, $this->allowed))): throw new \Exception("Invalid File Type"); endif;



                $path = $request->file('absence_doc')->store('leave');
                if (Str::contains($path, 'leave')) {
                    $filepath = Str::replaceFirst('leave', '', $path);
                } else {
                    $filepath = $path;
                }
                $leave_request->absence_doc = $filepath;
                $leave_request->save();

        }
        $leave_request->replacement->notify(new RelieveColleagueOnLeave($leave_request));
        if ($ls->require_replacement_approval == 1)
        {
            return response()->json(['success'=>true,'message' => 'Changes Saved Successfully'], 200);
        }

        $leave_request->update(['relieve_approved'=>1]);
        $this->startLeaveApproval($leave_request);
        return response()->json(['success'=>true,'message' => 'Changes Saved Successfully'], 200);

    }

    public function approveRequest(Request $request)
    {
        $leave_approval = Approval::find($request->leave_approval_id);
        $leave_request=LeaveRequest::find($leave_approval->approvable->id);
        if ($request->approval == 1) {
            $leave_approval->update([
                 'comments' => $request->comments, 'status' => 1, 'approver_id' => Auth::id()
            ]);
            $newposition = $leave_approval->stage->position + 1;
            $nextStage = WorkflowStage::where(['workflow_id' => $leave_approval->stage->workflow->id, 'position' => $newposition])->first();
            if ($nextStage)
            {
                if ($nextStage->type == 1)
                {
                    $newLeaveApproval=$leave_request->approvals()->create([
                        'stage_id' => $nextStage->id, 'comments' => '', 'status' => 0, 'approver_id' => $nextStage->user_id
                    ]);
                    $nextStage->user->notify(new ApproveLeaveRequest($leave_request));
                }
                elseif ($nextStage->type == 2)
                {
                    $newLeaveApproval=$leave_request->approvals()->create([
                        'stage_id' => $nextStage->id, 'comments' => '', 'status' => 0, 'approver_id' => 0
                    ]);
                    $role_users=User::where('role',$nextStage->role)->get();
                    foreach ($role_users as $user) {
                        $user->notify(new ApproveLeaveRequest($leave_request));
                    }
                }
                elseif ($nextStage->type == 3) {
                    $user_manager=User::where('id',$leave_request->user->manager_id)->first();
                    $newLeaveApproval=$leave_request->approvals()->create([
                        'stage_id' => $nextStage->id, 'comments' => '', 'status' => 0, 'approver_id' => 0
                    ]);
                    $user_manager->notify(new ApproveLeaveRequest($leave_request));


                }
                $leave_request->user->notify(new LeaveRequestPassedStage($leave_approval, $leave_approval->stage, $newLeaveApproval->stage));
            }else{
                $leave_request->update(['status'=>1]);
                $leave_request->user->notify(new LeaveRequestApproved($leave_approval->stage, $leave_approval));

//                Mail::to($leave_request->user)->send(new ShareLeaveAdvice($leave_request->id));

                    $leave_request->user->manager->notify(new LeaveRequestApprovedOthers($leave_approval));


            }

        }elseif ($request->approval == 2){
            $leave_approval->update([
                'comments' => $request->comments, 'status' => 2, 'approver_id' => Auth::id()
            ]);
            $leave_request->update(['status'=>2]);
            $leave_request->user->notify(new LeaveRequestRejected($leave_approval->stage, $leave_approval));
        }
        return response()->json(['success'=>true,'message' => 'Approval Saved Successfully'], 200);
    }

    public function getApprovals()
    {
        $user = User::find(Auth::id());
        $user_approvals = $this->userApprovals($user);
        $dr_approvals = $this->DRApprovals($user);
        $role_approvals = $this->roleApprovals($user);
        $old_approvals = Approval::hasMorph('approvable',
            LeaveRequest::class)->where('status', '!=',0)->where('approver_id',$user->id)->orderBy('id', 'asc')->get();

        return view('admin.leave_requests.approvals',compact('user','user_approvals','dr_approvals','role_approvals','old_approvals'));

    }
    public function getLeaveCancellationApprovals()
    {

        $user = User::find(Auth::id());
        $user_approvals = $this->userCancellationApprovals($user);
        $dr_approvals = $this->DRCancellationApprovals($user);
        $role_approvals = $this->roleCancellationApprovals($user);
         $old_approvals = Approval::hasMorph('approvable',
            LeaveRequestCancellation::class)->where('status', '!=',0)->where('approver_id',$user->id)->orderBy('id', 'asc')->get();

        return view('admin.leave_requests.cancellation_approvals',compact('user','user_approvals','dr_approvals','role_approvals','old_approvals'));

    }

    public function relieveApprovals()
    {

    }
    public function LeaveDaysRange($start_date, $end_date)
    {

        $lp = LeaveSetting::first();
        $dates = [];
        $start = new \DateTime($start_date);
        $end = new \DateTime($end_date);
        // otherwise the  end date is excluded (bug?)
        $end->modify('+1 day');

        $interval = $end->diff($start);

        // total days
        $days = $interval->days;

        // create an iterateable period of date (P1D equates to 1 day)
        $period = new \DatePeriod($start, new \DateInterval('P1D'), $end);

        // best stored as array, so you can add more than one
        $holidays = Holiday::whereYear('date', date('Y'))->pluck('date');//array('2012-09-07');

        foreach ($period as $dt) {
            $curr = $dt->format('D');
            $is_weekend = 0;
            $is_holiday = 0;

            // substract if Saturday or Sunday
            if (($curr == 'Sat' || $curr == 'Sun') && $lp->include_weekend == 0) {
                $days--;
                $is_weekend = 1;

            } elseif ($holidays->count() > 0 && $lp->include_holiday == 0) {
                foreach ($holidays as $holiday) {
                    if ($dt->format('m/d/Y') == $holiday) {
                        $days--;
                        $is_holiday = 1;
                    }
                }


            } else {

            }
            if ($is_weekend == 0 && $is_holiday == 0) {
                $dates[] = $dt->format('Y-m-d');
            }
            // $dates[]=$dt->format('Y-m-d');
        }


        return ['days' => $days, 'dates' => $dates];
    }
    public function LeaveDaysSelection($selection)
    {

        $ls = LeaveSetting::first();
        $holidays = Holiday::whereYear('date', date('Y'))->pluck('date')->toArray();//array('2012-09-07');

        $dates = [];
        $days = 0;
        if (!is_array($selection)) {
            $dates_array = explode(",", $selection);
        } else {
            $dates_array = $selection;
        }

        //sort
        // usort($dates_array,array("ClassName","cmp"));
        usort($dates_array, "static::cmp");

        foreach ($dates_array as $date_a) {
            $ld = new \DateTime($date_a);
            $curr = $ld->format('D');
            if ((($curr == 'Sat' || $curr == 'Sun') && $ls->include_weekend == 0)
                || ((count($holidays) > 0 && $ls->include_holiday == 0) && in_array($ld->format('m/d/Y'), $holidays))) {


            } else {
                $days++;
                $dates[] = $ld->format('Y-m-d');
            }
        }

        return ['days' => $days, 'dates' => $dates];

    }
    private static function cmp($a, $b)
    {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }

    public function leaveDaysRequested(Request $request)
    {

        if ($request->type == 'dates') {
            $dates_and_days = $this->LeaveDaysSelection($request->selection);
            return $length = $dates_and_days['days'];
        } elseif ($request->type == 'range') {
            $dates_and_days = $this->LeaveDaysRange($request->fromdate, $request->todate);
            return $length = $dates_and_days['days'];
        }

        // return $this->differenceBetweenDays($request->fromdate, $request->todate);
    }

    public function startLeaveApproval($leave_request)
    {
        $workflow = Workflow::where('id',  $leave_request->workflow_id)->first() ?? WorkFlow::first();
        $stage = WorkflowStage::where('workflow_id', $workflow->id)->first();
        if ($stage->type == 1)
        {
            $leave_request->approvals()->create([
                'stage_id' => $stage->id, 'comments' => '', 'status' => 0, 'approver_id' => $stage->user_id
            ]);
            $stage->user->notify(new ApproveLeaveRequest($leave_request));
        }
        elseif ($stage->type == 2)
        {
            $leave_request->approvals()->create([
                'stage_id' => $stage->id, 'comments' => '', 'status' => 0, 'approver_id' => 0
            ]);
            $role_users=User::where('role',$stage->role)->get();
                foreach ($role_users as $user) {
                    $user->notify(new ApproveLeaveRequest($leave_request));
                }
        }
        elseif ($stage->type == 3) {
            $user_manager=User::where('id',$leave_request->user->manager_id)->first();
            $leave_request->approvals()->create([
                'stage_id' => $stage->id, 'comments' => '', 'status' => 0, 'approver_id' => 0
            ]);
                    $user_manager->notify(new ApproveLeaveRequest($leave_request));


            }
        }
    public function userApprovals(User $user)
    {
        return $las = Approval::hasMorph('approvable',
            LeaveRequest::class)
            ->whereHas('stage',function ($query){
                $query->where('workflow_stages.type',1);
            })
            ->whereHas('stage.user', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->where('status', 0)->orderBy('id', 'asc')->get();

    }
    public function roleApprovals(User $user)
    {
        return $las = Approval::hasMorph('approvable',
            LeaveRequest::class)->whereHas('stage', function ($query) use ($user) {
            $query->where('workflow_stages.role', $user->role)
                ->where('workflow_stages.type', 2);
        })->where('status', 0)->orderBy('id', 'asc')->get();
    }

    public function DRApprovals(User $user)
    {
        return Approval::whereHasMorph(
            'approvable',
            LeaveRequest::class,function($query) use ($user) {
            $query->whereHas('user', function ($query) use ($user) {

                $query->where('users.manager_id', $user->id)->withoutGlobalScopes();
            });
        })->whereHas('stage',function ($query){
            $query->where('workflow_stages.type',3);
        })
                ->where('approvals.status',0)
            ->get();
    }
    public function leaveAdvice(Request $request)
    {

        $leave_request=LeaveRequest::find($request->leave_request_id);

         $approvals=$leave_request->approvals;
        $opciones_ssl=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $setting=Setting::first();
        $extencion = pathinfo(public_path('admin_assets/images/logo.png'), PATHINFO_EXTENSION);
        $img_base_64= base64_encode(file_get_contents(public_path('admin_assets/images/logo.png'),false, stream_context_create($opciones_ssl)));
        $image = 'data:image/' . $extencion . ';base64,' . $img_base_64;

        if ($leave_request->status===1) {
            $pdf = PDF::loadView('admin.leave_requests.partials.leave_advice', compact('leave_request','setting','approvals','image')); //load view page
            return $pdf->stream($leave_request->user->name.' leave-advice.pdf');
//            return view('emails.leave_advice_email',compact('leave_request','setting','approvals'))
//                ->attachData($pdf->stream(), $leave_request->user->name.' leave-advice.pdf', [
//                    'mime' => 'application/pdf',
//                ]);
        }
    }

    public function leaveRequestCalendar(Request $request)
    {
        return view('admin.leave_requests.all_requests_calendar');
    }
    public function leaveRequestCalendarJson(Request $request)
    {
        $user = Auth::user();
        $dispemp = [];
        $startdate = $request->start;
        $enddate = $request->end;
        $leave_plans = \App\LeavePlan::where(function ($query) use ($startdate, $enddate) {
            $query->whereBetween('start_date', [$startdate, $enddate])
                ->orWhereBetween('end_date', [$startdate, $enddate]);
        })->whereHas('user.job.department', function ($query) use ($user) {
            $query->where('departments.manager_id', $user->id);

        })->get();

        $colours = ['#67a8e4', '#f32f53', '#77c949', '#FFC1CC', '#ffbb44', '#f32f53', '#67a8e4'];
        $i = 0;
        foreach ($leave_plans as $leave_plan) {
            $begin = new \DateTime($leave_plan->start_date);
            $end = new \DateTime($leave_plan->end_date . '+1 days');
            $col = $colours[$i];
            $interval = \DateInterval::createFromDateString('1 day');
            $period = new \DatePeriod($begin, $interval, $end);

            foreach ($period as $dt) {

                $dispemp[] = [
                    'title' => $leave_plan->user->name,
                    'start' => $dt->format(" Y-m-d") . 'T' . '00:00:00',
                    'end' => $dt->format(" Y-m-d") . 'T' . '11:59:59',
                    'color' => '#67a8e4',
                    'id' => $leave_plan->id];
            }

            $i++;
        }

        if (isset($dispemp)):
            return response()->json($dispemp);
        else:
            $dispemp = ['title' => 'Nil', 'start' => date('Y-m-d')];
            return response()->json($dispemp);
        endif;


    }
    public function cancelLeaveRequest(Request $request)
    {
        $id = $request->leave_request_id;
        $leave_request = LeaveRequest::find($id);

        if ($leave_request ) {
            $leave_cancellation=LeaveRequestCancellation::create(['leave_request_id'=>$leave_request->id,
                'initiator_id'=>Auth::id(),'reason'=>$request->reason,'status'=>0]);
            $this->startLeaveCancellationApproval($leave_cancellation);


        }
        return response()->json(['success'=>true,'message' => 'Cancellation request Successful'], 200);
    }
    public function adjustHoliday($holiday_id)
    {
        $holiday=Holiday::find($holiday_id);

        if ($holiday) {
            $request_dates=LeaveRequestDate::where('date',date('Y-m-d',strtotime($holiday->date)))
                ->has('leave_request')->get();
            foreach($request_dates as $request_date){
                $leave_request = $request_date->leave_request;

                $selection = $leave_request->dates->pluck('date')->toArray();
                if ($leave_request) {
                    $new_selection = array_filter($selection, function ($item, $key) use ($request_date) {
                        //print_r($key);
                        return $item > $request_date->date;
                    }, ARRAY_FILTER_USE_BOTH);
                }
                if($leave_request->start_date == $request_date->date && $leave_request->end_date==$request_date->date) {

                    $leave_request->delete();
                }elseif($leave_request->end_date==$request_date->date && $leave_request->start_date!=$request_date->date){
                    $lastElement=end($new_selection);
                    $leave_request->end_date= $lastElement;
                    $leave_request->length -= 1;
                    $leave_request->save();
                }elseif($leave_request->start_date==$request_date->date&& $leave_request->end_date!=$request_date->date){

                    $firstElement = reset($new_selection);
                    $leave_request->start_date = $firstElement;
                    $leave_request->length -= 1;
                    $leave_request->save();
                }else{
                    $leave_request->length -= 1;
                }

                $request_date->delete();

                LeaveRequestAdjustment::firstOrCreate(['leave_request_id'=>$leave_request->id,'date'=>$request_date->date],
                    ['adjuster_id'=>Auth::id(),
                        'reason'=>'Holiday adjustment']);

            }
        }

        return  response()->json('success',200);

    }

    public function startLeaveCancellationApproval($leave_cancellation)
    {
        $workflow = Workflow::where('id',  $leave_cancellation->workflow_id)->first() ?? WorkFlow::first();
        $stage = WorkflowStage::where('workflow_id', $workflow->id)->first();
        if ($stage->type == 1)
        {
            $leave_cancellation->approvals()->create([
                'stage_id' => $stage->id, 'comments' => '', 'status' => 0, 'approver_id' => $stage->user_id
            ]);
            $stage->user->notify(new ApproveLeaveCancellationRequest($leave_cancellation));
        }
        elseif ($stage->type == 2)
        {
            $leave_cancellation->approvals()->create([
                'stage_id' => $stage->id, 'comments' => '', 'status' => 0, 'approver_id' => 0
            ]);
            $role_users=User::where('role',$stage->role)->get();
            foreach ($role_users as $user) {
                $user->notify(new ApproveLeaveCancellationRequest($leave_cancellation));
            }
        }
        elseif ($stage->type == 3) {
            $user_manager=User::where('id',$leave_cancellation->leave_request->user->manager_id)->first();
            $leave_cancellation->approvals()->create([
                'stage_id' => $stage->id, 'comments' => '', 'status' => 0, 'approver_id' => 0
            ]);
            $user_manager->notify(new ApproveLeaveCancellationRequest($leave_cancellation));


        }
    }
    public function approveCancellationRequest(Request $request)
    {
        $leave_cancellation_approval = Approval::find($request->leave_approval_id);
        $leave_request_cancellation=LeaveRequestCancellation::find($leave_cancellation_approval->approvable->id);
        if ($request->approval == 1) {
            $leave_cancellation_approval->update([
                'comments' => $request->comments, 'status' => 1, 'approver_id' => Auth::id()
            ]);
            $newposition = $leave_cancellation_approval->stage->position + 1;
            $nextStage = WorkflowStage::where(['workflow_id' => $leave_cancellation_approval->stage->workflow->id, 'position' => $newposition])->first();
            if ($nextStage)
            {
                if ($nextStage->type == 1)
                {
                    $newLeaveApproval=$leave_request_cancellation->approvals()->create([
                        'stage_id' => $nextStage->id, 'comments' => '', 'status' => 0, 'approver_id' => $nextStage->user_id
                    ]);
                    $nextStage->user->notify(new ApproveLeaveCancellationRequest($leave_request_cancellation));
                }
                elseif ($nextStage->type == 2)
                {
                    $newLeaveApproval=$leave_request_cancellation->approvals()->create([
                        'stage_id' => $nextStage->id, 'comments' => '', 'status' => 0, 'approver_id' => 0
                    ]);
                    $role_users=User::where('role',$nextStage->role)->get();
                    foreach ($role_users as $user) {
                        $user->notify(new ApproveLeaveCancellationRequest($leave_request_cancellation));
                    }
                }
                elseif ($nextStage->type == 3) {
                    $user_manager=User::where('id',$leave_request_cancellation->user->manager_id)->first();
                    $newLeaveApproval=$leave_request_cancellation->approvals()->create([
                        'stage_id' => $nextStage->id, 'comments' => '', 'status' => 0, 'approver_id' => 0
                    ]);
                    $user_manager->notify(new ApproveLeaveCancellationRequest($leave_request_cancellation));


                }

            }else{
                $leave_request_cancellation->update(['status'=>1]);
                $leave_request_cancellation->leave_request->update(['status'=>4]);
                $leave_request_cancellation->leave_request->delete();
                $leave_request_cancellation->initiator->notify(new LeaveRequestCancellationApproved($leave_cancellation_approval->stage, $leave_cancellation_approval));



            }

        }elseif ($request->approval == 2){
            $leave_cancellation_approval->update([
                'comments' => $request->comments, 'status' => 2, 'approver_id' => Auth::id()
            ]);
            $leave_request_cancellation->update(['status'=>2]);
            $leave_request_cancellation->initiator->notify(new LeaveRequestCancellationRejected($leave_cancellation_approval->stage, $leave_cancellation_approval));
        }
        return response()->json(['success'=>true,'message' => 'Approval Saved Successfully'], 200);
    }

    public function userCancellationApprovals(User $user)
    {
        return $las = Approval::hasMorph('approvable',
            LeaveRequestCancellation::class) ->whereHas('stage',function ($query){
            $query->where('workflow_stages.type',1);
        })->whereHas('stage.user', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })
            ->where('status', 0)->orderBy('id', 'asc')->get();

    }
    public function roleCancellationApprovals(User $user)
    {
        return $las = Approval::hasMorph('approvable',
            LeaveRequestCancellation::class)->whereHas('stage', function ($query) use ($user) {
            $query->where('workflow_stages.role', $user->role)
                ->where('workflow_stages.type', 2);;
        })->where('status', 0)->orderBy('id', 'asc')->get();
    }

    public function DRCancellationApprovals(User $user)
    {
        return Approval::whereHasMorph(
            'approvable',
            LeaveRequestCancellation::class,function($query) use ($user) {
                $query->whereHas('leave_request.user',function ($query) use ($user){


                        $query->where('users.manager_id', $user->id)->withoutGlobalScopes();

                });

        })->whereHas('stage',function ($query){
            $query->where('workflow_stages.type',3);
        })
            ->where('status',0)
            ->get();
    }





}
