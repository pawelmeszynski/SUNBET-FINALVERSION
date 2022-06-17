<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'shortName', 'tla', 'crest', 'address', 'website', 'founded', 'clubColors', 'venue'
    ];
    public function competition()
    {
        return $this->belongsToMany(Competition::class, 'competition_team', 'competition_id', 'team_id');
    }
    public function standings(): BelongsToMany
    {
        return $this->belongsToMany(Standings::class, 'standing_team', 'team_id','standing_id');
    }
}
