<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','product_id','quantity','unit_price','total','discount'];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
