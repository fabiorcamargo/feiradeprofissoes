<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'slug',
        'body'
    ];
    public function Leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
    
}
