<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Area
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $countryCode
 * @property string|null $flag
 * @property int|null $parentAreaId
 * @property string|null $parentArea
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Competition[] $competition
 * @property-read int|null $competition_count
 * @method static \Illuminate\Database\Eloquent\Builder|Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area query()
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereParentArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereParentAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'countryCode', 'flag', 'parentAreaId', 'parentArea'
    ];

    public function competition()
    {
        return $this->hasMany(Competition::class, 'area_id', 'id');
    }
}
