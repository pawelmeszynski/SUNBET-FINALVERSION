<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Competition
 *
 * @property int $id
 * @property int|null $area_id
 * @property int|null $team_id
 * @property string|null $name
 * @property string|null $code
 * @property string|null $type
 * @property string|null $emblem
 * @property string|null $plan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Area|null $area
 * @property-read \App\Models\Predict|null $predict
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
 * @property-read int|null $teams_count
 * @method static \Illuminate\Database\Eloquent\Builder|Competition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Competition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Competition query()
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereEmblem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition wherePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'ext_id', 'name', 'code', 'type', 'emblem', 'plan','area_id'
    ];

    public function area()
    {
        return $this->hasOne(Area::class, 'id', 'area_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class,'competition_team','team_id','competition_id');
    }
    public function predict()
    {
        return $this->hasOne(Predict::class, 'id', 'competition_id');
    }

}
