<?php

namespace App\Enums;

enum OrderStatus:int
{
    case PENDING=0;
    case SHIPPED=3;
    case DELIVERED=1;
    case REJECTED=2;

    public function label(): string
    {
        return match($this) {
            static::PENDING => 'Pending' ,
            static::DELIVERED => 'Delivered',
            static::REJECTED => 'Rejected',
            static::SHIPPED => 'Shipped',
        };
    }
    public function color(): string
    {
        return match($this) {
            static::PENDING => 'warning' ,
            static::DELIVERED => 'success',
            static::REJECTED => 'danger',
            static::SHIPPED => 'info',
        };
    }
}
