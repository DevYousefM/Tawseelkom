<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "name",
        "to",
        "from",
        "recipient_phone",
        "desc",
        "is_default"
    ];
    public function from(): BelongsTo
    {
        return $this->belongsTo(Area::class, "from");
    }
    public function to(): BelongsTo
    {
        return $this->belongsTo(Area::class, "to");
    }
}
