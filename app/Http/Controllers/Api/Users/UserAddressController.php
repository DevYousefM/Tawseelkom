<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use App\Traits\ApiResponse;
use App\Traits\ErrorsResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserAddressController extends Controller
{
    use ApiResponse;
    use ErrorsResponse;
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "area_id" => "required|exists:areas,id",
            "desc" => "required|string|max:400",
            "is_default" => "nullable|boolean"
        ]);
        if ($validator->fails()) {
            return $this->apiResponse("errors", $this->errorsResponse($validator), "Validation Error", 422);
        }
        $user = auth("api")->user();
        $address = UserAddress::create([
            "user_id" => $user->id,
            "name" => $request->name,
            "area_id" => $request->area_id,
            "desc" => $request->desc,
            "is_default" => $request->is_default,
        ]);
        return $this->apiResponse("user_address", $address, "تم اضافة العنوان", 200);
    }
    public function user_addresses()
    {
        $user = auth("api")->user();
        return $this->apiResponse("user_addresses", $user->user_addresses, "عناويين المستخدم", 200);
    }
}
