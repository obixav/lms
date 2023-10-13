<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;
    protected $fillable=['name','gender','length'];

    public function leave_types()
    {
        return $this->belongsToMany(LeaveType::class,'grade_leave_types','grade_id','leave_type_id');
    }
}
