<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'ext_id', 'name', 'code', 'type', 'emblem', 'plan','area_id'
    ];
    public function area()
    {
        return $this->hasOne(Area::class, 'ext_id', 'area_id');
    }
    public function team()
    {
        return $this->belongsToMany(Team::class, 'competition_team', 'team_id', 'competition_id');
    }

}
