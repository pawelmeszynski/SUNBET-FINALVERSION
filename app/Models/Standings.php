<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Standings extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage', 'group', 'type',
    ];

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'standing_team', 'standing_id','team_id');
    }
}
