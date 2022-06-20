<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Predict extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'match_id', 'home_team_goals', 'away_team_goals', 'competition_id',
    ];

    public function competition(): HasMany
    {
        return $this->hasMany(Competition::class, 'competition_id', 'id');
    }
    public function schedule(): HasMany
    {
        return $this->hasMany(Schedule::class, 'match_id', 'id');
    }
}
