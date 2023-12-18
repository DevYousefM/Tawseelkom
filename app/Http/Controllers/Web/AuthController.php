<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\returnSelf;

class AuthController extends Controller
{
  public function index()
  {
    return view("dashboard.dashboard");
  }
  public function login_form()
  {
    return view("dashboard.pages.login");
  }
  public function login(Request $request)
  {
    $request->validate([
      'username' => 'required',
      'password' => 'required',
    ]);

    $credentials = $request->only("username", "password");

    $admin = Admin::where("username", $request->username)->first();

    if (!$admin)
      return redirect()->route('login')->with("username_error", "اسم المستخدم غير موجود");

    if ($admin)
      if (!Hash::check($request->password, $admin->password))
        return redirect()->route('login')->with("password_error", "كلمة المرور غير صحيحة");

    if (Auth::attempt($credentials)) {
      return redirect()->route("dashboard");
    }

    return abort(505);
  }
  public function logout()
  {
    Auth::logout();
    return redirect()->route('login');
  }
  public function profile()
  {
    $admin = auth()->user();
    return view("dashboard.pages.Admin.profile", ["admin" => $admin]);
  }
  public function update_information(Request $request, $id)
  {
    $admin = Admin::findOrFail($id);
    $request->validate([
      'name' => 'required|string|max:255',
      'username' => ['required', 'string', Rule::unique('deliveries')->ignore($admin->id), 'max:255'],
    ]);
    $admin->update([
      "name" => $request->name,
      "username" => $request->username,
    ]);
    return redirect()->back()->with('info_updated', 'تم تحديث بيانات الأدمن!');
  }
  public function update_password(Request $request, $id)
  {
    $admin = Admin::findOrFail($id);

    $check_pass = Hash::check($request->old_password, $admin->password);
    if (!$check_pass)
      return redirect()->back()->with('old_password', 'كلمة المرور القديمة غير صحيحة!');

    $request->validate([
      'password' => 'required|string|min:6|confirmed',
    ]);

    $admin->update([
      "password" => bcrypt($request->password),
    ]);
    return redirect()->back()->with('pass_updated', 'تم تحديث كلمة المرور');
  }
}
