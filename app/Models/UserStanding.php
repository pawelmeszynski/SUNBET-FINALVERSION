<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStanding extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id','points',
    ];

    public function users()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
