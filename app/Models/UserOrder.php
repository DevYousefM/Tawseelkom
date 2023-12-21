<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "from",
        "to",
        "shipment_type",
        "price",
        "distance",
        "who_pay",
        "payment_status",
        "payment_id",
        "status",
        "recipient_name",
        "recipient_phone",
        "sender_name",
        "details"
    ];
    public function delivery_order(): HasOne
    {
        return $this->hasOne(DeliveryOrder::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
