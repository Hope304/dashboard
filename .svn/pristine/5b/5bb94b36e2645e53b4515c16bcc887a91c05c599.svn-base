<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\verify_fire_point;

class verifyFirePointController extends Controller
{
    public function getList()
    {
        $data = verify_fire_point::orderBy('id', 'desc')->get();
        return view('admin/verify/list', ['data' => $data]);
    }

    public function getView($id)
    {
        $data = verify_fire_point::findOrFail($id);
        return view('admin/verify/view', ['data' => $data]);
    }

    public function getVerify($id)
    {
        $data = verify_fire_point::findOrFail($id);
        $data->kiemduyet = 1;
        $id_diemchay = $data->id_diemchay;
        $data->save();

        $delete = verify_fire_point::where('id_diemchay', $id_diemchay)->where('kiemduyet', 0)->get();
        foreach ($delete as $dt)
        {
            $del = verify_fire_point::findOrFail($dt->id);
            $del->delete();
        }

        return redirect('admin/notification/list')->with('thongbao', 'Kiểm duyệt thành công!');
    }

    public function getDelete($id)
    {
        $data = verify_fire_point::findOrFail($id);
        $data->delete();
        return redirect('admin/notification/list')->with('thongbao', 'Xoá bản ghi thành công!');
    }
}
