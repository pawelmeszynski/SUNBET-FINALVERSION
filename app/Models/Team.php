<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Team
 *
 * @property int $id
 * @property string $name
 * @property string|null $shortName
 * @property string|null $tla
 * @property string|null $crest
 * @property string|null $address
 * @property string|null $website
 * @property int|null $founded
 * @property string|null $clubColors
 * @property string|null $venue
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Competition[] $competition
 * @property-read int|null $competition_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Standings[] $standings
 * @property-read int|null $standings_count
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereClubColors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCrest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereFounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereTla($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereVenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereWebsite($value)
 * @mixin \Eloquent
 */
class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'shortName',
        'tla',
        'crest',
        'address',
        'website',
        'founded',
        'clubColors',
        'venue',
        'away_team_id',
        'home_team_id',
    ];

    public function competition()
    {
        return $this->belongsToMany(Competition::class,
            'competition_team',
            'team_id',
            'competition_id');
    }

    public function standings(): BelongsToMany
    {
        return $this->belongsToMany(Standings::class,
            'standing_team',
            'team_id',
            'standing_id');
    }
}
