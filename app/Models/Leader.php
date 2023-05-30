<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    use HasFactory;
    protected $fillable = [
        'leader_name',
        'leader_phone',
        'school_name',
        'state_id',
        'city_id',
        'body'
        ];
}
