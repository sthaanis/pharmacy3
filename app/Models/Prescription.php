<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function pharmacist(){
        return $this->belongsTo(Pharmacist::class);
    }
}
