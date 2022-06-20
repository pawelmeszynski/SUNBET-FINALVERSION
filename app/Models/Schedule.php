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

    public function awayTeam(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Team::class, 'id', 'away_team_id');
    }

    public function homeTeam(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Team::class, 'id', 'home_team_id');
    }
    public function predict()
    {
        return $this->hasOne(Predict::class, 'id', 'match_id');
    }
}
