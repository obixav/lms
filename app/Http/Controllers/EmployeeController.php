<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use App\Enums\Role;
use App\Models\Grade;
use App\Models\LeaveRequest;
use App\Models\LeaveRequestCancellation;
use App\Models\LeaveSetting;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $leave_settings=LeaveSetting::first();

        $my_cancelled_leave_approval_count=LeaveRequest::where(['user_id'=>auth()->id()])->onlyTrashed()->count();
        if(auth()->user()->role=='admin')
        {

            $employees_count=User::where('role','employee')->count();
            $managers_count=User::where('role','manager')->count();
            $pending_leave_approval_count=LeaveRequest::where('status',0)->count();
            $recent_leave_requests=LeaveRequest::orderBy('id','desc')->get();
            $cancelled_leave_count=LeaveRequestCancellation::where('status',0)->count();

            $my_pending_leave_approval_count=LeaveRequest::where(['status'=>0,'user_id'=>auth()->id()])->count();
            $my_direct_report_count=User::where('manager_id',auth()->id())->count();
            return view('admin.dashboard',compact('employees_count','managers_count',
                'pending_leave_approval_count','my_pending_leave_approval_count','my_direct_report_count','leave_settings',
            'my_cancelled_leave_approval_count','recent_leave_requests','cancelled_leave_count'));
        }
        if(auth()->user()->role=='manager')
        {
            $my_direct_report_count=User::where('manager_id',auth()->id())->count();
            $my_pending_leave_approval_count=LeaveRequest::where(['status'=>0,'user_id'=>auth()->id()])->count();
            $pending_leave_approval_count=LeaveRequest::where('status',0)->whereHas('user',function($query){
                $query->whereHas('manager',function ($query){
                    $query->where('users.id',auth()->id());
                });

            })->count();
            return view('admin.dashboard',compact('my_direct_report_count','my_pending_leave_approval_count',
            'pending_leave_approval_count','leave_settings','my_cancelled_leave_approval_count'));
        }
        if(auth()->user()->role=='employee')
        {

            $my_pending_leave_approval_count=LeaveRequest::where(['status'=>0,'user_id'=>auth()->id()])->count();

            return view('admin.dashboard',compact('my_pending_leave_approval_count','leave_settings','my_cancelled_leave_approval_count'));
        }

        $my_pending_leave_approval_count=LeaveRequest::where(['status'=>0,'user_id'=>auth()->id()])->count();

        return view('admin.dashboard',compact('my_pending_leave_approval_count','leave_settings','my_cancelled_leave_approval_count'));


    }
    public function createEmployee(Request $request)
    {
         $grades=Grade::all();
         $roles=Role::cases();
        $genders=Gender::cases();
        $managers=User::where('role','!=','employee')->where('status','!=',2)->select(DB::raw("CONCAT(first_name,' ',last_name) AS fullname"),'id' )->get();
        return view('admin.employees.create',compact('grades','roles','genders','managers'));
    }

    public function saveEmployee(Request $request)
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email','unique:User'],
            'phone' => ['required'],
            'role' => ['required'],
            'grade_id' => ['required'],
            'staff_id' => ['required'],
            'manager_id' => ['required'],
            'hiredate' => ['required'],
            'dob' => ['required'],
            'gender' => ['required'],
            'status' => ['required'],

        ]);
        $user=User::updateOrCreate([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'address'=>$request->address,
            'role'=>$request->role,
            'grade_id'=>$request->grade_id,
            'staff_id'=>$request->staff_id,
            'manager_id'=>$request->manager_id,
            'hiredate'=>date('Y-m-d',strtotime($request->hiredate)),
            'dob'=>date('Y-m-d',strtotime($request->dob)),
            'gender'=>$request->gender,
            'status'=>$request->status,
            'password'=>bcrypt('password')]);
        redirect(url('employees'));
    }
    public function listEmployees(Request $request)
    {

        $employees = User::where('id', '<>', 0);
        if ($request->filled('q')) {
            $q = $request->input('q');

            $employees->where(function ($query) use ($q) {
                $query->where('first_name', 'like', '%' . $q . '%')
                    ->orWhere('last_name',  'like', '%' . $q . '%')
                    ->orWhere('phone',  'like', '%' . $q . '%')
                    ->orWhere('staff_id',  'like', '%' . $q . '%')
                    ->orWhere('email',  'like', '%' . $q . '%');
            });
        }
        if ($request->filled('status') && $request->status!='') {
            $status = $request->input('status');

            $employees->where('status',$status);
        }
        if ($request->filled('role') && $request->role!='') {
            $role = $request->input('role');

            $employees->where('role',$role);
        }
        $employees=  $employees->paginate(10);
        return view('admin.employees.list',compact('employees'));
    }
    public function viewEmployee(Request $request,$employee_id)
    {
        $grades=Grade::all();
        $managers=User::where('role','!=','employee')->get();
        $employee=User::find($employee_id);
        return view('admin.employees.details',compact('grades','managers','employee'));
    }
    public function myProfile(Request $request,)
    {
        $employee=Auth::user();
        $grades=Grade::all();
        $managers=User::where('role','!=','employee')->get();
//        $employee=User::find($employee_id);
        return view('admin.employees.details',compact('grades','managers','employee'));
    }
    public function clearNotifications(Request $request)
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();

    }
    public function clearNotification(Request $request)
    {
        $notification = Auth::user()->notifications()->where('id',request()->notification_id)->first();

        if($notification != null){
            $notification->markAsRead();
            return response()->json(['status'=>'success']);
        }
    }
    function employeeSearch(Request $request)
    {

        if($request->q==""){
            return "";
        }
        else{
            $name=User::where('first_name', 'like', '%' . $request->q . '%')
                ->orWhere('last_name', 'like', '%' . $request->q . '%')
                ->orWhere('staff_id', 'like', '%' . $request->q . '%')
                ->orWhere('email', 'like', '%' . $request->q . '%')
                ->select(DB::raw("CONCAT(first_name, ' ', last_name) AS text"),'id' )
                ->get();
        }


        return $name;
    }

}
