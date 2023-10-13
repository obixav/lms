<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Grade;
use App\Models\GradeLeaveType;
use App\Models\Holiday;
use App\Models\LeaveSetting;
use App\Models\LeaveType;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Workflow;

class SettingService{

    public function viewSetting(){
        $setting=Setting::firstOrCreate([ 'email'=>'Richconceptunlimited@gmail.com'],['store_name'=>'Rich Concept Unlimited',
  'address'=>'Block C32 Alcobre Plaza, Opposite St. Patrick Church, Ojo L.G.A, Lagos state, Nigeria',
    'copyright'=>'','phone'=>'','facebook'=>'','instagram'=>'','maintenance_mode'=>0,'small_announcement'=>'','big_announcement'=>'','tax_rate'=>'',
            'discount_announcement'=>'']);

    return view('admin.settings.index',compact('setting'));
    }
    public function saveSetting($request){
        $mm=$request->input('maintenance_mode')=='on'?1:0;
        $setting=Setting::first();
        $setting->update(['company_name'=>$request->input('company_name'),
            'company_logo',  'email'=>$request->input('email'),'address'=>$request->input('address'),
            'phone'=>$request->input('phone'),'default_role'=>$request->input('default_role'),'maintenance_mode'=>$mm]
           );
        return response()->json(['success'=>true,'message'=>'Changes Saved Successfully'],200);
    }
    public function saveLeaveSetting($request){
        $include_holiday=$request->input('include_holiday')=='on'?1:0;
        $include_weekend=$request->input('include_weekend')=='on'?1:0;
        $can_request_allowance=$request->input('can_request_allowance')=='on'?1:0;
        $uses_casual_leave=$request->input('uses_casual_leave')=='on'?1:0;
        $require_replacement_approval=$request->input('require_replacement_approval')=='on'?1:0;
        $probationer_applies=$request->input('probationer_applies')=='on'?1:0;
        $setting=LeaveSetting::first();
        $setting->update(['workflow_id'=>$request->workflow_id,'annual_leave_id'=>$request->annual_leave_id,
                'uses_casual_leave'=>$uses_casual_leave,'casual_leave_length'=>$request->input('casual_leave_length'),
                'require_replacement_approval'=>$require_replacement_approval,
                'include_holiday'=>$include_holiday,'include_weekend'=>$include_weekend,
                'can_request_allowance'=>$can_request_allowance, 'probationer_applies'=>$probationer_applies]
        );
        return response()->json(['success'=>true,'message'=>'Changes Saved Successfully'],200);
    }

    public function saveHoliday($request){
        $holiday=Holiday::updateOrCreate(['id'=>$request->id],['name'=>$request->name,'date'=>date('Y-m-d',strtotime($request->date))]);
        return response()->json(['success'=>true,'message'=>'Changes Saved Successfully'],200);
    }
    public function saveGrade($request){
        $grade=Grade::updateOrCreate(['id'=>$request->id],['name'=>$request->name]);
        return response()->json(['success'=>true,'message'=>'Changes Saved Successfully'],200);
    }
    public function saveLeaveType($request){
        $lt=LeaveType::updateOrCreate(['id'=>$request->id],['name'=>$request->name,'gender'=>$request->gender,
            'length'=>$request->length]);
        return response()->json(['success'=>true,'message'=>'Changes Saved Successfully'],200);
    }
    public function saveGradeLeaveType($request){
        $glt=GradeLeaveType::updateOrCreate(['grade_id'=>$request->grade_id,'leave_type_id'=>$request->leave_type_id],
            ['grade_id'=>$request->grade_id,'leave_type_id'=>$request->leave_type_id,
            'length'=>$request->length]);
        return response()->json(['success'=>true,'message'=>'Changes Saved Successfully'],200);
    }



    public function saveWorkflow($request)
    {
//        $this->validate($request, ['name'=>'required']);
        if ($request->input('stagename')!==null) {
            $no_of_stages=count($request->input('stagename'));
        }

        if ($request->input('user_id')!==null) {
            $no_of_users=count($request->input('user_id'));
        }
        if ($request->input('role')!==null) {
            $no_of_roles=count($request->input('role'));
        }

        $no_of_users_used=0;
        $no_of_roles_used=0;
        $wf=Workflow::create(['name'=>$request->name]);

        if($no_of_stages>0){
            for ($i=0; $i <$no_of_stages ; $i++) {
                if ($request->type[$i]==1) {
                    $stage=$wf->stages()->create(['name'=>$request->stagename[$i],'position'=>$i,'user_id'=>$request->user_id[$no_of_users_used],'type'=>$request->type[$i]]);
                    $no_of_users_used++;
                }elseif ($request->type[$i]==2) {
                    $stage=$wf->stages()->create(['name'=>$request->stagename[$i],'position'=>$i,'type'=>$request->type[$i],'role'=>$request->role[$no_of_roles_used]]);
                    $no_of_roles_used++;
                }elseif($request->type[$i]==3){
                    $stage=$wf->stages()->create(['name'=>$request->stagename[$i],'position'=>$i,'type'=>$request->type[$i]]);

                }
            }
        }
        return response()->json(['success'=>true,'message' => 'Workflow Created Successfully'], 200);
    }
}

