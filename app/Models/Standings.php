<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standings extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage', 'group', 'type',
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'standing_team', 'team_id','standing_id');
    }
}
