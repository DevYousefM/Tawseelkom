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
use Nafezly\Payments\Classes\TapPayment;

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
        $user = auth("api")->user();
        if (!$user) {
            return $this->apiResponse("error", "يجب تسجيل الدخول", "يجب تسجيل الدخول", 404);
        }
        $validator = Validator::make($request->all(), [
            "from_area_id" => "required|exists:areas,id",
            "to_area_id" => "required|exists:areas,id",
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

        $order_data = [
            "user_id" => $user->id,
            "from" => $route->fromArea->area,
            "to" => $route->toArea->area,
            "shipment_type" => $route->shipmentType->title,
            "price" => $route->price,
            "distance" => $route->distance,
            "who_pay" => $request->who_pay,
            "recipient_name" => $request->recipient_name,
            "recipient_phone" => $request->recipient_phone,
            "sender_name" => $user->name,
            "details" => $request->details ?? null
        ];
        // Store Data
        $order = UserOrder::create($order_data);
        $redirect_url = '';
        if ($request->who_pay === "المرسل") {
            $payment = new TapPayment();
            $response = $payment->setUserId($user->id)
                ->setUserFirstName($user->name)
                ->setUserLastName(" ")
                ->setUserEmail($user->email)
                ->setUserPhone($user->phone)
                ->setAmount($route->price)
                ->pay();
            $order->update([
                "payment_id" => $response["payment_id"],
            ]);
            $redirect_url =  $response["redirect_url"];
        }
        if ($redirect_url === "") {
            return $this->apiResponse("order",  $order, "User order created", 200);
        } else {
            $array = ["order" => $order, "redirect_url" => $redirect_url, "message" => "User order created", "status" => 200];
            return response()->json($array, 200);
        }
    }
    public function verifyPayment(Request $request)
    {
        $payment = new TapPayment();
        $response = $payment->verify($request);
        $msg = $response["message"];
        $status = $response["success"];
        $payment_db = UserOrder::where("payment_id", $response["payment_id"])->first();
        if ($response["success"]) {
            $payment_db->update(["payment_status" => "تم الدفع"]);
        }
        return redirect()->route("payment-status", ["status" => $status, "msg" => $msg]);
    }
    public function payment_status(Request $request)
    {
        $status = $request->query('status');
        $msg = $request->query('msg');
        return view("payment_status", compact("msg"), compact("status"));
    }
}
