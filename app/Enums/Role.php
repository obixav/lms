<?php

namespace App\Enums;

enum Role:string
{
    case EMPLOYEE='employee';
    case MANAGER='manager';
    case ADMIN='admin';

    public function label(): string
    {
        return match($this) {
            static::EMPLOYEE => 'Employee' ,
            static::MANAGER => 'Manager',
            static::ADMIN => 'Admin',
        };
    }
    public function color(): string
    {
        return match($this) {
            static::EMPLOYEE => 'warning' ,
            static::MANAGER => 'success',
            static::ADMIN => 'info',
        };
    }
}
