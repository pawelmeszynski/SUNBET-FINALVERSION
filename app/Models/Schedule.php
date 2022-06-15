<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'utcDate', 'status', 'matchday', 'stage', 'group', 'last_updated_at','away_team_id','home_team_id',
    ];

    public function away_team()
    {
        return $this->hasMany(Team::class, 'id', 'away_team_id');
    }

    public function home_team()
    {
        return $this->hasMany(Team::class, 'id', 'home_team_id');
    }
}
