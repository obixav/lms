<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id','tracking_id','status','payment_status','payment_channel','amount',
        'tax','total_after_discount','total_payable','payment_ref'];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function order_lines()
    {
        return $this->hasMany(OrderLine::class,'order_id');
    }
}
