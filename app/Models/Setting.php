<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable=['store_name','email','address','copyright','phone','facebook','instagram','maintenance_mode',
        'small_announcement','big_announcement','tax_rate',
        'discount_announcement'];
}
