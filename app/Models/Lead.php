<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = [
    'leader_id',
    'name',
    'lastname',
    'phone',
    'email',
    'age',
    'state',
    'school',
    'city'
    ];

    public function State(): HasOne
    {
        return $this->hasOne(States::class, 'id','state');
    }
    public function City(): HasOne
    {
        return $this->hasOne(City::class, 'id','city');
    }
}
