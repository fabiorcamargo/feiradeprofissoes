<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

        public function Leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
    public function State(): HasOne
    {
        return $this->hasOne(States::class, 'id','state_id');
    }
    public function City(): HasOne
    {
        return $this->hasOne(City::class, 'id','city_id');
    }
}
