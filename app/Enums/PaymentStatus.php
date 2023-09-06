<?php

namespace App\Enums;

enum PaymentStatus:int
{
    case PENDING=0;
    case PAID=1;
    case CANCELLED=2;

    public function label(): string
    {
        return match($this) {
            static::PENDING => 'Pending' ,
            static::PAID => 'Delivered',
            static::CANCELLED => 'Cancelled',
        };
    }
    public function color(): string
    {
        return match($this) {
            static::PENDING => 'warning' ,
            static::PAID => 'success',
            static::CANCELLED => 'danger'
        };
    }
}
