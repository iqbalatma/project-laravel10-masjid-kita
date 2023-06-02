<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Subdistrict
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $district_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\District|null $district
 * @method static \Illuminate\Database\Eloquent\Builder|Subdistrict newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subdistrict newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subdistrict onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Subdistrict query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subdistrict whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subdistrict whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subdistrict whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subdistrict whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subdistrict whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subdistrict whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subdistrict whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subdistrict withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Subdistrict withoutTrashed()
 * @mixin \Eloquent
 */
class Subdistrict extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["code", "district_id", "name"];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
