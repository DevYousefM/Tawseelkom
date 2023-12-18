<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_order_id",
        "delivery_name",
        "delivery_username"
    ];
    public function user_order(): BelongsTo
    {
        return $this->belongsTo(UserOrder::class);
    }
    
}
