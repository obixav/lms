<?php

namespace App\Models;

use App\Http\Requests\DesignRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable=['name','phone','email','password'];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function design_requests()
    {
        return $this->hasMany(DesignRequest::class,'customer_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class,'customer_id');
    }
}
