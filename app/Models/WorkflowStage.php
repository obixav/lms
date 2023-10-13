<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowStage extends Model
{
    use HasFactory;
    protected $fillable=['workflow_id','name','position','type','user_id','role','manager_id'];

    public function workflow()
    {
        return $this->belongsTo(Workflow::class,'workflow_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
