<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeLeaveType extends Model
{
    use HasFactory;
    protected $fillable=['grade_id','leave_type_id','length'];
    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class,'leave_type_id');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class,'grade_id');
    }
}
