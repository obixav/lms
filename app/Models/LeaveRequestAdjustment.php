<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequestAdjustment extends Model
{
    use HasFactory;
    protected $fillable=['leave_request_id','date','adjuster_id','reason'];
    public function leave_request()
    {
        return $this->belongsTo(LeaveRequest::class,'leave_request_id')->withTrashed();
    }
    public function adjuster()
    {
        return $this->belongsTo(User::class,'adjuster_id');
    }
}
