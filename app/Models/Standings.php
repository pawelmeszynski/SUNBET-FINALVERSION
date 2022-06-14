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
}
