<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDashResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $order = [
            "id" => $this->id,
            "recipient_name" => $this->recipient_name,
            "recipient_phone" => $this->recipient_phone,
            "sender_name" => $this->sender_name,
            "who_pay" => $this->who_pay,
            "from" => $this->from,
            "to" => $this->to,
            "shipment_type" => $this->shipment_type,
            "price" => $this->price . " KWD",
            "distance" => $this->distance . " Km",
            "payment_status" => $this->payment_status,
            "payment_id" => $this->payment_id,
            "status" => $this->status,
            "user" => [
                "name" => $this->user->name,
                "email" => $this->user->email,
                "country_code" => $this->user->country_code,
                "phone" => $this->user->phone,
            ],
            "details" => $this->details,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
        if ($this->delivery_order) {
            $order["delivery"] = [
                "delivery_name" => $this->delivery_order->delivery_name,
                "delivery_username" => $this->delivery_order->delivery_username,
            ];
        }
        return $order;
    }
}
