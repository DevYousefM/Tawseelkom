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
            "from" => "required|exists:areas,id",
            "to" => "required|exists:areas,id",
            "recipient_phone" => "required",
            "desc" => "required|string|max:400",
            "is_default" => "nullable|boolean"
        ]);
        if ($validator->fails()) {
            return $this->apiResponse("errors", $this->errorsResponse($validator), "Validation Error", 422);
        }
        $user = auth("api")->user();
        if ($request->is_default) {
            $is_default_exist = $user->user_addresses()->where("is_default", 1)->first();
            $is_default_exist && $is_default_exist->update([
                "is_default" => 0,
            ]);
        }
        $address = UserAddress::create([
            "user_id" => $user->id,
            "name" => $request->name,
            "from" => (int) $request->from,
            "to" => (int) $request->to,
            "desc" => $request->desc,
            "recipient_phone" => $request->recipient_phone,
            "is_default" => $request->is_default ?? 0,
        ]);
        $address->load(['from', 'to']);

        return $this->apiResponse("user_address", $address, "تم اضافة العنوان", 200);
    }
    public function user_addresses()
    {
        $user = auth("api")->user();
        return $this->apiResponse("user_addresses", $user->user_addresses()->with(['from', 'to'])->get(), "عناويين المستخدم", 200);
    }
}
