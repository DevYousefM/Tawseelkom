<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use App\Traits\ErrorsResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponse;
    use ErrorsResponse;

    public function register(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users'],
            'country_code' => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return $this->apiResponse("errors", $this->errorsResponse($validator), "Validation Error", 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country_code' => $request->country_code,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard("api")->login($user);
        return $this->auth_user(['email' => $request->email, 'password' => $request->password],  $request);
    }
    public function login(Request $request): JsonResponse
    {

        if (empty($request->phone) && empty($request->email)) {
            return $this->apiResponse("errors", "يجب ادخال البريد الالكتروني او رقم الهاتف", "Validation Error", 422);
        }
        $validator = Validator::make($request->all(), [
            'password' => ['required'],
        ]);
        if ($validator->fails()) {
            return $this->apiResponse("errors", $this->errorsResponse($validator), "Validation Error", 422);
        }

        $loginField = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? "email" : "phone";
        $credentials = [$loginField => $request->input($loginField), "password" => $request->password];

        $check_user = User::where($loginField, $request->input($loginField))->first();

        if (!$check_user) {
            return $this->apiResponse(
                'errors',
                ["$loginField" => __("site.$loginField") . " غير موجود"],
                'User not found',
                404
            );
        }
        if (!Hash::check($request->password, $check_user->password)) {
            return $this->apiResponse('errors', ["password" => "كلمة المرور غير صحيحة"], 'Invalid email or password', 401);
        }

        return $this->auth_user($credentials, $request);
    }
    protected function auth_user($credentials, $request)
    {
        $token = auth("api")->attempt($credentials);
        if (!$token) {
            return $this->apiResponse("errors", null, "Unauthorized", 401);
        }
        $user = auth("api")->user();
        $userData = UserResource::make($user)->toArray($request);
        return $this->apiResponse("user", array_merge(["access_token" => $token], $userData), "User registered and logged in successfully", 201);
    }
    public function logout()
    {
        auth("api")->logout();
        return response()->json(["message" => "Logout Success", "status" => 200], 200);
    }
}
