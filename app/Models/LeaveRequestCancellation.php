<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequestCancellation extends Model
{
    use HasFactory;
    protected $fillable=['leave_request_id','status','initiator_id','reason'];

    public function approvals()
    {
        return $this->MorphMany(Approval::class,'approvable');

    }
    public function leave_request()
    {
        return $this->belongsTo(LeaveRequest::class,'leave_request_id')->withTrashed();
    }

    public function initiator()
    {
        return $this->belongsTo(User::class,'initiator_id');
    }
}
