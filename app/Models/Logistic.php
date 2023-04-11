<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Logistic extends Authenticatable
{
    use HasFactory;
    
    public function setPasswordAttribute($value)
    {
        $this->attributes['password']=Hash::make($value);
    }
}


