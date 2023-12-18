<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Route extends Model
{
    use HasFactory;
    protected $fillable = ["from_area_id", "to_area_id", "shipment_type_id", "price"];

    public function fromArea(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
    public function toArea(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
    public function shipmentType(): BelongsTo
    {
        return $this->belongsTo(ShipmentType::class);
    }
}
