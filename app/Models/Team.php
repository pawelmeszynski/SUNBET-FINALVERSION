<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','ext_id', 'name', 'shortName', 'tla', 'crest', 'address', 'website', 'founded', 'clubColors', 'venue'
    ];
}
