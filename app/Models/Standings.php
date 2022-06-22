<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Standings
 *
 * @property int $id
 * @property string $stage
 * @property string $type
 * @property string $group
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
 * @property-read int|null $teams_count
 * @method static \Illuminate\Database\Eloquent\Builder|Standings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Standings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Standings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Standings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standings whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standings whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standings whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Standings whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Standings extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage', 'group', 'type',
    ];

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'standing_team',
            'standing_id',
            'team_id');
    }
}
