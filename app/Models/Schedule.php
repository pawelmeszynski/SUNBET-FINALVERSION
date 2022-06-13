<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'utcDate', 'status', 'matchday', 'stage', 'group', 'last_updated_at',
    ];
}
