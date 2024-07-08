<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotspot;

class HotspotController extends Controller
{
    public function getList()
    {
        $data = Hotspot::all();
        return view('admin/hotspot/list', ['data' => $data]);
    }

    public function getView($id)
    {
        $data = Hotspot::findOrFail($id);
        return view('admin/hotspot/view', ['data' => $data]);
    }

    public function getDelete($id)
    {
        $data = Hotspot::findOrFail($id);
        $data->delete();
        return redirect('admin/hotspot/list')->with('thongbao', 'Xoá điểm cháy thành công!');
    }
}
