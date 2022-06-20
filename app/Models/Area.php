<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'countryCode', 'flag', 'parentAreaId', 'parentArea'
    ];

    public function competition()
    {
        return $this->hasMany(Competition::class, 'area_id', 'id');
    }
}
