<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "from_area_id" =>  (int) $this->from_area_id,
            "to_area_id" => (int) $this->to_area_id,
            "shipment_type_id" => (int) $this->shipment_type_id,
            "price" => $this->price,
            "distance" => $this->price,
        ];
    }
}
