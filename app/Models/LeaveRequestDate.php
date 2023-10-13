<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequestDate extends Model
{
    use HasFactory;
    protected $fillable=['leave_request_id','date'];

    public function leave_request()
    {
        return $this->belongsTo(LeaveRequest::class,'leave_request_id');
    }
}
