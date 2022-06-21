<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Schedule
 *
 * @property int $id
 * @property int|null $home_team_id
 * @property int|null $away_team_id
 * @property string $utc_date
 * @property string|null $status
 * @property int|null $matchday
 * @property string|null $stage
 * @property string|null $group
 * @property string|null $last_updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $home
 * @property int $away
 * @property int $points_calculated
 * @property-read \App\Models\Team|null $awayTeam
 * @property-read \App\Models\Team|null $homeTeam
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Predict[] $predicts
 * @property-read int|null $predicts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereAway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereAwayTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereHomeTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereLastUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereMatchday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule wherePointsCalculated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereUtcDate($value)
 * @mixin \Eloquent
 */
class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'utcDate', 'status', 'matchday', 'stage', 'group', 'last_updated_at','away_team_id','home_team_id','home','away',
    ];

    public function awayTeam(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Team::class, 'id', 'away_team_id');
    }

    public function homeTeam(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Team::class, 'id', 'home_team_id');
    }
    public function predicts()
    {
        return $this->hasMany(Predict::class, 'match_id', 'id');
    }
}
