<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable=['name'];

    public function leave_types()
    {
       return $this->belongsToMany(LeaveType::class,'grade_leave_types','grade_id','leave_type_id');
    }

    public function users()
    {
        return $this->hasMany(User::class,'grade_id');
    }
}
