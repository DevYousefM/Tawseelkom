<?php

namespace App\Http\Controllers\Api\Deliveries;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryResource;
use App\Models\Delivery;
use App\Traits\ApiResponse;
use App\Traits\ErrorsResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponse;
    use ErrorsResponse;
    public function profile()
    {
        $delivery = auth("api_delivery")->user();
        return $this->apiResponse("delivery", DeliveryResource::make($delivery), "User registered and logged in successfully", 200);
    }
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|exists:deliveries,username',
            'password' => "required",
        ]);
        if ($validator->fails()) {
            return $this->apiResponse("errors", $this->errorsResponse($validator), "Validation Error", 422);
        }

        $credentials = ["username" => $request->username, "password" => $request->password];

        $check_delivery = Delivery::where("username", $request->username)->first();

        if (!Hash::check($request->password, $check_delivery->password)) {
            return $this->apiResponse('errors', ["password" => "كلمة المرور غير صحيحة"], 'Invalid email or password', 401);
        }

        return $this->auth_user($credentials, $request);
    }
    protected function auth_user($credentials, $request)
    {
        $token = auth("api_delivery")->attempt($credentials);
        if (!$token) {
            return $this->apiResponse("errors", null, "Unauthorized", 401);
        }
        $delivery = auth("api_delivery")->user();
        $deliveryData = DeliveryResource::make($delivery)->toArray($request);
        return $this->apiResponse("delivery", array_merge(["access_token" => $token], $deliveryData), "User registered and logged in successfully", 200);
    }
    public function logout()
    {
        auth("api_delivery")->logout();
        return response()->json(["message" => "Logout Success", "status" => 200], 200);
    }
    public function delete_profile(){
        $delivery = auth("api_delivery")->user();
        if (!$delivery) {
            return $this->apiResponse("errors", "هذا الحساب غير موجود", "هذا الحساب غير موجود", 404);
        }
        $delivery->delete();
        return $this->apiResponse("delivery", $delivery, "تم حذف حساب المندوب", 200);
    }
}
