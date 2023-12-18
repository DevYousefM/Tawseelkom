<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Route;
use App\Models\UserOrder;
use App\Traits\ApiResponse;
use App\Traits\ErrorsResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserOrderController extends Controller
{
    use ApiResponse;
    use ErrorsResponse;
    public function index()
    {
        $user = auth("api")->user();
        $user_orders = UserOrder::where("user_id", $user->id)->get();
        return $this->apiResponse("orders", $user_orders, "طلبات المستخدم", 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "from_area_id" => "required|exists:areas,id",
            "to_areas_id" => "required|exists:area,id",
            "shipment_type_id" => "required|exists:shipment_types,id",
            "who_pay" => "required|in:المرسل,المستلم",
            "recipient_name" => "required|string",
            "recipient_phone" => "required",
            "details" => "nullable|string"
        ]);
        if ($validator->fails()) {
            return $this->apiResponse("errors", $this->errorsResponse($validator), "Validation Error", 422);
        }
        // Route data
        $route = Route::where("from_area_id", $request->from_area_id)->where("to_area_id", $request->to_area_id)->where("shipment_type_id", $request->shipment_type_id)->first();

        if (!$route) {
            return $this->apiResponse("error", "المسار غير موجود", "المسار غير موجود", 404);
        }

        $user = auth("api")->user();
        $order_data = [
            "user_id" => $user->id,
            "from" => $route->fromArea->area,
            "to" => $route->toArea->area,
            "shipment_type" => $route->shipmentType->title,
            "price" => $route->price,
            "who_pay" => $request->who_pay,
            "recipient_name" => $request->recipient_name,
            "recipient_phone" => $request->recipient_phone,
            "sender_name" => $user->name,
            "details" => $request->details ?? null
        ];
        // Store Data
        $order = UserOrder::create($order_data);
        return $this->apiResponse("order", $order_data, "User order created", 201);
    }
}
