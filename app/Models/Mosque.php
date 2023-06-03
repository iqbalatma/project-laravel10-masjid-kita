<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Mosque
 *
 * @property int $id
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 * @property string|null $area_wide
 * @property string $balance
 * @property string $donation
 * @property string $contribution
 * @property string $infaq
 * @property string $zakat
 * @property string $debt
 * @property int $village_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property-read int|null $user_count
 * @method static \Database\Factories\MosqueFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereAreaWide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereContribution($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereDebt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereDonation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereInfaq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereVillageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque whereZakat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Mosque withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @mixin \Eloquent
 */
class Mosque extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "latitude",
        "longitude",
        "area_wide",
        "village_id",
        "balance",
        "claim",
        "debt",
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
