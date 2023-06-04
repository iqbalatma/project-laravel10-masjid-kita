<?php

namespace App\Models;

use App\Enums\StatusTransactionEnum;
use App\Enums\TableEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property string $description
 * @property string $amount
 * @property int $transaction_type_id
 * @property string $method
 * @property int $mosque_id
 * @property int $user_id
 * @property string $status
 * @property int|null $status_changed_by
 * @property string $status_change_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Mosque|null $mosque
 * @property-read \App\Models\User|null $status_changer
 * @property-read \App\Models\TransactionType|null $transaction_type
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\TransactionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereMosqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatusChangeAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatusChangedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction withoutTrashed()
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "code","description", "amount", "transaction_type_id", "method", "mosque_id", "user_id", "status_changed_by", "status_change_at", "status"
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = TableEnum::TRANSACTIONS->value;
    }

    /**
     * The "booted" method of the model.
     */
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (Transaction $model) {
            if ($model->isClean('user_id')) {
                $model->user_id = Auth::id();
            }
        });
    }


    /**
     * @return BelongsTo
     */
    public function mosque():BelongsTo
    {
        return $this->belongsTo(Mosque::class);
    }

    public function transaction_images():HasMany
    {
        return $this->hasMany(TransactionImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status_changer()
    {
        return $this->belongsTo(User::class, "status_changed_by");
    }

    public function transaction_type()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function scopeApproved($query)
    {
        return $query->where("status", StatusTransactionEnum::APPROVED->value);
    }
}
