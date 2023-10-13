<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveSetting extends Model
{
    use HasFactory;
    protected $fillable=['workflow_id','annual_leave_id','uses_casual_leave','casual_leave_length',
        'require_replacement_approval','include_holiday','include_weekend','can_request_allowance',
        'probationer_applies'];
}
