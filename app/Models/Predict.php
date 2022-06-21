<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Predict
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $match_id
 * @property int|null $home_team_goals
 * @property int|null $away_team_goals
 * @property int|null $competition_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Competition[] $competition
 * @property-read int|null $competition_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Schedule[] $schedule
 * @property-read int|null $schedule_count
 * @method static \Illuminate\Database\Eloquent\Builder|Predict newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Predict newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Predict query()
 * @method static \Illuminate\Database\Eloquent\Builder|Predict whereAwayTeamGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Predict whereCompetitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Predict whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Predict whereHomeTeamGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Predict whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Predict whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Predict whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Predict whereUserId($value)
 * @mixin \Eloquent
 */
class Predict extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'match_id', 'home_team_goals', 'away_team_goals', 'competition_id',
    ];

    public function competition(): HasMany
    {
        return $this->hasMany(Competition::class, 'competition_id', 'id');
    }
    public function schedule(): HasMany
    {
        return $this->hasMany(Schedule::class, 'match_id', 'id');
    }
}
