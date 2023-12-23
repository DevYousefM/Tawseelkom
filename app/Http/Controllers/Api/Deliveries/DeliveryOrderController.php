<?php

namespace App\Http\Controllers\Api\Deliveries;

use App\Http\Controllers\Controller;
use App\Models\DeliveryOrder;
use App\Models\UserOrder;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $orders = UserOrder::where("status", "قيد المراجعة")->get();
        return $this->apiResponse("orders", $orders, "الطلبات", 200);
    }
    public function taken_orders()
    {
        $delivery = auth("api_delivery")->user();
        $taken_orders = DeliveryOrder::whereHas("user_order", function ($query) {
            $query->where("status", "استلم المندوب الطلب");
        })->where("delivery_username", $delivery->username)->with("user_order")->get();
        return $this->apiResponse("taken_orders", $taken_orders, "طلبات المندوب", 200);
    }
    public function update_order($id)
    {
        $delivery = auth("api_delivery")->user();
        $check_order = DeliveryOrder::where("user_order_id", $id)->where("delivery_username", $delivery->username)->get();
        if ($check_order) {
            $delivery_order = DeliveryOrder::find($id);
            $delivery_order->user_order->update([
                "status" => "تم التسليم",
            ]);
            return $this->apiResponse("success", "تم تحديث حالة الطلب", "تم تحديث حالة الطلب بنجاح", 200);
        } else {
            return $this->apiResponse("error", "الطلب غير موجود", "الطلب غير موجود", 404);
        }
    }
    public function completed_orders()
    {
        $delivery = auth("api_delivery")->user();
        $delivery_orders = DeliveryOrder::whereHas("user_order", function ($query) {
            $query->where("status", "تم التسليم");
        })->where("delivery_username", $delivery->username)->get();
        return $this->apiResponse("completed_orders", $delivery_orders, "طلبات المندوب", 200);
    }
    public function take_order($id)
    {
        $check_order = UserOrder::find($id);
        if (!$check_order)
            return $this->apiResponse("error", "هذا الطلب غير موجود", "هذا الطلب غير موجود", 404);
        if ($check_order->status === "استلم المندوب الطلب")
            return $this->apiResponse("error", "هذا الطلب تم استلامه بالفعل", "هذا الطلب تم استلامه بالفعل", 404);

        $delivery = auth("api_delivery")->user();
        $order_id = $id;
        $delivery_order = DeliveryOrder::create([
            "delivery_name" => $delivery->name,
            "delivery_username" => $delivery->username,
            "user_order_id" => $order_id,
        ]);
        $check_order->update([
            "status" => "استلم المندوب الطلب",
        ]);
        return $this->apiResponse("delivery_order", $delivery_order->with("user_order")->get(), "تم تسجيل الطلب بنجاح", 200);
    }
}
