<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\LeaveSetting;
use App\Models\LeaveType;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $leave_types=[['name'=>'annual','gender'=>'all','length'=>20,'marital_status'=>'all'],
            ['name'=>'maternity','gender'=>'female','length'=>60,'marital_status'=>'all'],
            ['name'=>'exam','gender'=>'all','length'=>10,'marital_status'=>'all'],
            ['name'=>'paternity','gender'=>'male','length'=>10,'marital_status'=>'all'],
            ['name'=>'annual','gender'=>'study','length'=>365,'marital_status'=>'all']];
        $leave_setting=LeaveSetting::create(['workflow_id'=>1,'annual_leave_id'=>1,'uses_casual_leave'=>1,'casual_leave_length'=>5,
            'require_replacement_approval'=>1,'include_holiday'=>1,'include_weekend'=>1,'can_request_allowance'=>1,
            'probationer_applies'=>1]);
        $setting=Setting::create(['company_name'=>'University of Nigeria Nsukka']);
        foreach ($leave_types as $leave_type){
            LeaveType::create($leave_type);
        }

        \App\Models\Grade::factory(3)->create();
         \App\Models\User::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
