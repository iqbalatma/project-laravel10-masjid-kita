<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Village
 *
 * @property int $id
 * @property string $name
 * @property string $postcode
 * @property int $subdistrict_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Subdistrict|null $subdistrict
 * @method static \Database\Factories\VillageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Village newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Village newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Village onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Village query()
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereSubdistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Village withoutTrashed()
 * @mixin \Eloquent
 */
class Village extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "postcode",
        "subdistrict_id"
    ];

    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class);
    }
}
