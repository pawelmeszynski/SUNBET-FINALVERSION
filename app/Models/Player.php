<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'position', 'dateOfBirth', 'nationality', 'team_id',
    ];
    protected $casts = [
        'dateOfBirth' => 'date',
    ];

    public function teams()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
}
