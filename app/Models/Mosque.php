<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
