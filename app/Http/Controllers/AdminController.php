<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use App\Enums\Role;
use App\Http\Requests\SaveSettingRequest;
use App\Models\Customer;
use App\Models\Grade;
use App\Models\GradeLeaveType;
use App\Models\Holiday;
use App\Models\LeaveSetting;
use App\Models\LeaveType;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\User;
use App\Models\Workflow;
use App\Models\WorkflowStage;
use App\Services\ClientService;
use App\Services\TeamMemberService;
use App\Services\ProductService;
use App\Services\ProjectService;
use App\Services\ServiceService;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{

    function settings(Request $request, SettingService $settingService)
    {
        $setting=Setting::first();
        $roles=Role::cases();
        return view('admin.settings.index',compact('setting','roles'));
    }
    function saveSettings(SaveSettingRequest $saveSettingRequest, SettingService $settingService)
    {
        return $settingService->saveSetting($saveSettingRequest);
    }
    function workflows(Request $request, SettingService $settingService)
    {
        $workflows=Workflow::all();
        $roles=Role::cases();
        $users=User::where('status','!=',2)->get();
        $managers=User::where('role','!=','employee')->where('status','!=',2)->select(DB::raw("CONCAT(first_name,' ',last_name) AS fullname"),'id' )->get();
        return view('admin.settings.workflows',compact('workflows','roles','users','managers'));
    }
    function saveWorkflows(Request $request, SettingService $settingService)
    {
        return $settingService->saveWorkflow($request);
    }


    public function leaveSettings()
    {
        $workflows=Workflow::all();
        $leave_types=LeaveType::all();
        $leave_setting=LeaveSetting::first();
        return view('admin.settings.leave_settings',compact('leave_setting','workflows','leave_types'));
    }
    function saveLeaveSettings(Request $request, SettingService $settingService)
    {
        return $settingService->saveLeaveSetting($request);
    }

    public function holidays()
    {
        $holidays=Holiday::all();
        $leave_setting=LeaveSetting::first();
        return view('admin.settings.holidays',compact('holidays','leave_setting'));
    }
    function saveHolidays(Request $request, SettingService $settingService)
    {
        return $settingService->saveHoliday($request);
    }

    public function leaveTypes()
    {
        $leave_types=LeaveType::all();
        $genders=Gender::cases();
        return view('admin.settings.leave_types',compact('leave_types','genders'));
    }
    function saveLeaveTypes(Request $request, SettingService $settingService)
    {
        return $settingService->saveLeaveType($request);
    }
    function saveGradeLeaveTypes(Request $request, SettingService $settingService)
    {
        return $settingService->saveGradeLeaveType($request);
    }
    public function grades()
    {
        $grades=Grade::all();
        $leave_types=LeaveType::all();
        $grade_leave_types=GradeLeaveType::all();
        return view('admin.settings.grades',compact('grades','grade_leave_types','leave_types'));
    }
    function saveGrades(Request $request, SettingService $settingService)
    {
        return $settingService->saveGrade($request);
    }



    function tagSearch(Request $request)
    {

        if($request->q==""){
            return "";
        }
       else{
        $name=Tag::where('name','LIKE','%'.$request->q.'%')
                        ->select('name as id','name as text')
                        ->get();
            }


        return $name;
    }
}
