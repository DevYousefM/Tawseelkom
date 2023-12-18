<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::all();
        return view("dashboard.pages.deliveries.index", ["deliveries" => $deliveries]);
    }
    public function create()
    {
        return view("dashboard.pages.deliveries.add");
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:deliveries|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Delivery::create([
            "name" => $request->name,
            "username" => $request->username,
            "password" => bcrypt($request->password)
        ]);
        return redirect()->route('deliveries')->with('success', 'تم تسجيل المندوب بنجاح!');
    }
    public function edit($id)
    {
        $delivery = Delivery::findOrFail($id);
        return view("dashboard.pages.deliveries.edit", ["delivery" => $delivery]);
    }
    public function update_information(Request $request, $id)
    {
        $delivery = Delivery::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', Rule::unique('deliveries')->ignore($delivery->id), 'max:255'],
        ]);
        $delivery->update([
            "name" => $request->name,
            "username" => $request->username,
        ]);
        return redirect()->back()->with('info_updated', 'تم تحديث بيانات المندوب!');
    }
    public function update_password(Request $request, $id)
    {
        $delivery = Delivery::findOrFail($id);

        $check_pass = Hash::check($request->old_password, $delivery->password);
        if (!$check_pass)
            return redirect()->back()->with('old_password', 'كلمة المرور القديمة غير صحيحة!');

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $delivery->update([
            "password" => bcrypt($request->password),
        ]);
        return redirect()->back()->with('pass_updated', 'تم تحديث كلمة المرور');
    }
    public function delete($id)
    {
        $delivery = Delivery::find($id);
        if ($delivery)
            $delivery->delete();
        return redirect()->route("deliveries")->with('success', 'تم حذف المندوب');
    }
}
