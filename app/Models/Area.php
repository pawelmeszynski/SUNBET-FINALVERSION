<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'ext_id', 'name', 'countryCode', 'flag', 'parentAreaId', 'parentArea', 'area_id'
    ];

    public function competition()
    {
        return $this->hasMany(Competition::class, 'area_id', 'ext_id');
    }
}
