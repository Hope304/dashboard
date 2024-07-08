<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\receiveEmail;
use App\District;

class receiveEmailController extends Controller
{
    public function getList()
    {
        $data = receiveEmail::all();
        return view('admin/receiveEmail/list', ['data' => $data]);
    }

    public function getAdd()
    {
        $district = District::all();
        return view('admin/receiveEmail/add', ['district' => $district]);
    }

    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'unit' => 'required',
                'phone' => 'required | numeric',
                'position' => 'required',
                'email' => 'required | email | unique:receive_email,email',
                'commune' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập họ tên',
                'unit.required' => 'Bạn chưa nhập đơn vị',
                'phone.required' => 'Bạn chưa nhập số điện thoại',
                'phone.numeric' => 'Số điện thoại không hợp lệ',
                'position.required' => 'Bạn chưa nhập chức vụ',
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Bạn chưa nhập đúng định dạng email',
                'email.unique' => 'Email đã tồn tại',
                'commune.required' => 'Bạn chưa chọn xã',
            ]);

        $add = new receiveEmail();
        $add->name = $request->name;
        $add->unit = $request->unit;
        $add->phone = $request->phone;
        $add->position = $request->position;
        $add->email = trim(strtolower($request->email));
        $add->maxa = $request->commune;
        if ($request->regHostpot == 'on') {
            $add->hotspot = 1;
        } else {
            $add->hotspot = 0;
        }
        if ($request->regVerify == 'on') {
            $add->verification = 1;
        } else {
            $add->verification = 0;
        }
        if ($request->regFirelevel == 'on') {
            $add->firelevel = 1;
        } else {
            $add->firelevel = 0;
        }

        $add->save();
        return redirect('admin/receiveEmail/list')->with('thongbao', 'Đăng ký dịch vụ thành công!');
    }

    public function getEdit($id)
    {
        $district = District::all();
        $data = receiveEmail::findOrFail($id);
        return view('admin/receiveEmail/edit', ['district' => $district, 'data' => $data]);
    }

    public function postEdit($id, Request $request)
    {
        $data = receiveEmail::findOrFail($id);
        echo $data->email;
        echo $request->email;
        if (trim($data->email) == trim(strtolower($request->email))) {
            $this->validate($request,
                [
                    'name' => 'required',
                    'unit' => 'required',
                    'phone' => 'required | numeric',
                    'position' => 'required',
                    'commune' => 'required',
                ],
                [
                    'name.required' => 'Bạn chưa nhập họ tên',
                    'unit.required' => 'Bạn chưa nhập đơn vị',
                    'phone.required' => 'Bạn chưa nhập số điện thoại',
                    'phone.numeric' => 'Số điện thoại không hợp lệ',
                    'position.required' => 'Bạn chưa nhập chức vụ',
                    'commune.required' => 'Bạn chưa chọn xã',
                ]);
        } else {
            $this->validate($request,
                [
                    'name' => 'required',
                    'unit' => 'required',
                    'phone' => 'required | numeric',
                    'position' => 'required',
                    'email' => 'required | email | unique:receive_email,email',
                    'commune' => 'required',
                ],
                [
                    'name.required' => 'Bạn chưa nhập họ tên',
                    'unit.required' => 'Bạn chưa nhập đơn vị',
                    'phone.required' => 'Bạn chưa nhập số điện thoại',
                    'phone.numeric' => 'Số điện thoại không hợp lệ',
                    'position.required' => 'Bạn chưa nhập chức vụ',
                    'email.required' => 'Bạn chưa nhập email',
                    'email.email' => 'Bạn chưa nhập đúng định dạng email',
                    'email.unique' => 'Email đã tồn tại',
                    'commune.required' => 'Bạn chưa chọn xã',
                ]);
        }
        $data->name = $request->name;
        $data->unit = $request->unit;
        $data->phone = $request->phone;
        $data->position = $request->position;
        $data->email = $request->email;
        $data->maxa = $request->commune;
        if ($request->regHostpot == 'on') {
            $data->hotspot = 1;
        } else {
            $data->hotspot = 0;
        }
        if ($request->regVerify == 'on') {
            $data->verification = 1;
        } else {
            $data->verification = 0;
        }
        if ($request->regFirelevel == 'on') {
            $data->firelevel = 1;
        } else {
            $data->firelevel = 0;
        }

        $data->save();
        return redirect('admin/receiveEmail/list')->with('thongbao', 'Sửa thông tin đăng ký thành công!');
    }

    public function getDelete($id)
    {
        $data = receiveEmail::findOrFail($id);
        $data->delete();
        return redirect('admin/receiveEmail/list')->with('thongbao', 'Xoá thông tin thành công!');
    }
}
