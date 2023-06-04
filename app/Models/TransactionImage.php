<?php

namespace App\Models;

use App\Enums\TableEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class TransactionImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["id", "image", "user_id", "transaction_id"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = TableEnum::TRANSACTION_IMAGES->value;
    }


    /**
     * The "booted" method of the model.
     */
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (TransactionImage $model) {
            if ($model->isClean('user_id')) {
                $model->user_id = Auth::id();
            }
        });
    }
}
