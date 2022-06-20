<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'shortName', 'tla', 'crest', 'address', 'website', 'founded', 'clubColors', 'venue', 'away_team_id','home_team_id',
    ];
    public function competition()
    {
        return $this->belongsToMany(Competition::class, 'competition_team', 'competition_id', 'team_id');
    }
    public function standings(): BelongsToMany
    {
        return $this->belongsToMany(Standings::class, 'standing_team', 'team_id','standing_id');
    }
//    public function schedule(): BelongsTo
//    {
//        return $this->belongsTo(Schedule::class, 'home_team_id','id', );
//    }
//    public function schedule(): BelongsTo
//    {
//        return $this->belongsTo(Schedule::class, 'away_team_id','id', );
//    }
}
