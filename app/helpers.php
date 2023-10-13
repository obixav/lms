<?php

use App\Models\GradeLeaveType;
use App\Models\LeaveRequestDate;
use App\Models\User;

function truncate(string $text, int $length = 20): string {
    if (strlen($text) <= $length) {
        return $text;
    }
    $text = substr($text, 0, $length);
    $text = substr($text, 0, strrpos($text, " "));
    $text .= "...";
    return $text;
}

function company_info()
{
    return \App\Models\Setting::first();
}

 function generateInitials(string $name) : string
{
    $words = explode(' ', $name);
    if (count($words) >= 2) {
        return mb_strtoupper(
            mb_substr($words[0], 0, 1, 'UTF-8') .
            mb_substr(end($words), 0, 1, 'UTF-8'),
            'UTF-8');
    }
    return makeInitialsFromSingleWord($name);
}
 function makeInitialsFromSingleWord(string $name) : string
{
    preg_match_all('#([A-Z]+)#', $name, $capitals);
    if (count($capitals[1]) >= 2) {
        return mb_substr(implode('', $capitals[1]), 0, 2, 'UTF-8');
    }
    return mb_strtoupper(mb_substr($name, 0, 2, 'UTF-8'), 'UTF-8');
}
function getStatus(int $status):string{
    return $return_value = match ($status) {
        0 => 'Probation',
        1 => 'Confirmed',
        2 => 'Disengaged',
    };
}
function getStatusColor(int $status):string{
    return $return_value = match ($status) {
        0 => 'warning',
        1=> 'success',
       2 => 'danger',
    };
}
function getLeaveStatus(int $status):string{
    return $return_value = match ($status) {
        0 => 'Pending',
        1 => 'Approved',
        2 => 'Declined',
        4 => 'Cancelled',
    };
}
function getLeaveStatusColor(int $status):string{
    return $return_value = match ($status) {
        0 => 'warning',
        1=> 'success',
        2 => 'danger',
        4 => 'danger',
    };
}
function getLeaveUsage($user_id,$leave_type_id,$year='')
{
    $year=$year==''?date('Y'):$year;
    $leave_type=\App\Models\LeaveType::find($leave_type_id);
    $user=User::find($user_id);
    if ($leave_type->gender == 'all' ||$leave_type->gender == $user->sex) {
        return $used_leave_days = LeaveRequestDate::whereYear('date', $year)->whereHas('leave_request', function ($query) use ($user_id, $leave_type_id) {
            $query->where('leave_requests.user_id', $user_id)
                ->where('status', 1)
                ->where('leave_type_id', $leave_type_id);
        })->count();

    }else{
   return 0;
    }
}
function getLeaveBalance($user_id,$leave_type_id,$year='')
{
    $year=$year==''?date('Y'):$year;
    $user=User::find($user_id);
     $leave_type=\App\Models\LeaveType::find($leave_type_id);
    $grade_leave_type=GradeLeaveType::where(['grade_id'=>$user->grade_id,'leave_type_id'=>$leave_type_id])->first();

//    if(!is_null($grade_leave_type)){
//       return $length=$grade_leave_type->length;
//    }else{
//       return $length=$leave_type->length;
//    }

    $length=!is_null($grade_leave_type)?$grade_leave_type->length:$leave_type->length;

    $used_leave_days = LeaveRequestDate::whereYear('date', $year)->whereHas('leave_request', function ($query) use ($user_id, $leave_type_id) {
        $query->where('leave_requests.user_id', $user_id)
            ->where('status', 1)
            ->where('leave_type_id', $leave_type_id);
    })->count();
    if ($leave_type->gender == 'all' ||$leave_type->gender == $user->sex) {
        return $balance = $length - $used_leave_days;

    }else{
        return 0;
    }
}
//function resolveOrderStatus($status)
//{
//    return \App\Enums\Role::tryFrom($status)->label();
//}
//function resolveOrderStatusColor($status)
//{
//    return \App\Enums\Role::tryFrom($status)->color();
//}

