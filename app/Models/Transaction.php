<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "description", "amount", "transaction_type_id", "method", "mosque_id", "user_id", "status_changed_by", "status_change_at", "status"
    ];

    public function mosque()
    {
        return $this->belongsTo(Mosque::class);
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
}
