<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AreaController extends Controller
{

    public function index()
    {
        $areas = Area::all();
        return view("dashboard.pages.areas.index", ["areas" => $areas]);
    }
    public function create()
    {
        return view("dashboard.pages.areas.add");
    }
    public function store(Request $request)
    {
        $request->validate([
            "area" => "required|unique:areas",
        ]);

        Area::create([
            "area" => $request->area,
        ]);

        return redirect()->route('areas')->with('success', 'تم تسجيل المركز بنجاح!');
    }
    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view("dashboard.pages.areas.edit", ["area" => $area]);
    }
    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);

        $request->validate([
            "area" => ["required", Rule::unique("areas")->ignore($id)],
        ]);
        $area->update([
            "area" => $request->area,
        ]);
        return redirect()->back()->with('area_updated', 'تم تحديث بيانات المركز!');
    }
    public function delete($id)
    {
        $area = Area::find($id);
        $area->delete();
        return redirect()->route('areas')->with('success', 'تم حذف المركز بنجاح!');
    }
}
