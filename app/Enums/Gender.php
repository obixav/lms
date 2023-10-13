<?php

namespace App\Enums;

enum Gender:string
{
    case MALE='male';
    case FEMALE='female';

    public function label(): string
    {
        return match($this) {
            static::MALE => 'Male' ,
            static::FEMALE => 'Female',
        };
    }
    public function color(): string
    {
        return match($this) {
            static::MALE => 'warning' ,
            static::FEMALE => 'success',
        };
    }
}
