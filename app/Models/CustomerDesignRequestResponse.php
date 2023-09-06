<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDesignRequestResponse extends Model
{
    use HasFactory;
    protected $fillable=['customer_design_id','file'];
}
