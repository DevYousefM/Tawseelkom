<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "from",
        "to",
        "shipment_type",
        "price",
        "who_pay",
        "payment_status",
        "status",
        "recipient_name",
        "recipient_phone",
        "sender_name",
        "details"
    ];
    
}
