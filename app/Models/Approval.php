<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;
    protected $fillable=['stage_id','approver_id','comments','status'];

    public function approvable()
    {
        return $this->morphTo();
    }

    public function stage()
    {
        return $this->belongsTo(WorkflowStage::class,'stage_id');
    }
    public function approver()
    {
        return $this->belongsTo(User::class,'approver_id');
    }
}
