<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequest extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['leave_type_id','user_id','start_date','end_date','length',
        'absence_doc','replacement_id','status','requested_allowance','workflow_id',
        'reason'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class,'leave_type_id');
    }
    public function workflow()
    {
        return $this->belongsTo(Workflow::class,'workflow_id');
    }

    public function replacement()
    {
        return $this->belongsTo(User::class,'replacement_id');
    }

    public function approvals()
    {
        return $this->MorphMany(Approval::class,'approvable');
    }

    public function dates()
    {
        return $this->hasMany(LeaveRequestDate::class,'leave_request_id');
    }
    public function adjustments()
    {
        return $this->hasMany(LeaveRequestAdjustment::class,'leave_request_id');
    }
    public function cancellation()
    {
        return $this->hasOne(LeaveRequestCancellation::class,'leave_request_id');
    }
}
