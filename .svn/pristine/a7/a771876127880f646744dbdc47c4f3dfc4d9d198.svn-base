<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\District;
use Auth;
class ContactController extends Controller
{
    public function getList()
    {
        $data = Contact::all();

        return view('admin/contact/list', ['data' => $data]);
    }

    public function getAdd()
    {
		$district = District::all();
        return view('admin/contact/add', ['district' => $district]);
    }

    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'position' => 'required',
                'department' => 'required',
                'phone' => 'required | numeric',
                'email' => 'required | email | unique:contact,email',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên',
                'position.required' => 'Bạn chưa nhập chức vụ',
                'department.required' => 'Bạn chưa nhập phòng ban',
                'phone.required' => 'Bạn chưa nhập số điện thoại',
                'phone.numeric' => 'Định dạng điện thoại không đúng',
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Bạn chưa nhập đúng định dạng email',
                'email.unique' => 'Email đã tồn tại',
            ]);

        $data = new Contact();
		if(isset($request->mahuyen))
		{
			$data->mahuyen = trim($request->mahuyen);
		}
		else {
			$data->mahuyen = Auth::user()->mahuyen;
		}
        $data->name = trim($request->name);
        $data->position = trim($request->position);
        $data->department = trim($request->department);
        $data->phone = trim($request->phone);
        $data->email = trim(strtolower($request->email));
        $data->save();
        return redirect('admin/contact/list')->with('thongbao', 'Thêm liên hệ thành công!');
    }

    public function getEdit($id)
    {
		$district = District::all();
        $data = Contact::findOrFail($id);
        return view('admin/contact/edit', ['tk' => $data, 'district' => $district]);
    }

    public function postEdit($id, Request $request)
    {
        $data = Contact::findOrFail($id);
        if ($request->email == trim($data->email)) {
            $this->validate($request,
                [
                    'name' => 'required',
                    'position' => 'required',
                    'department' => 'required',
                    'phone' => 'required | numeric',
                    'email' => 'required | email ',
                ],
                [
                    'name.required' => 'Bạn chưa nhập tên',
                    'position.required' => 'Bạn chưa nhập chức vụ',
                    'department.required' => 'Bạn chưa nhập phòng ban',
                    'phone.required' => 'Bạn chưa nhập số điện thoại',
                    'phone.numeric' => 'Định dạng điện thoại không đúng',
                    'email.required' => 'Bạn chưa nhập email',
                    'email.email' => 'Bạn chưa nhập đúng định dạng email',
                ]);
        } else {
            $this->validate($request,
                [
                    'name' => 'required',
                    'position' => 'required',
                    'department' => 'required',
                    'phone' => 'required | numeric',
                    'email' => 'required | email | unique:contact,email',
                ],
                [
                    'name.required' => 'Bạn chưa nhập tên',
                    'position.required' => 'Bạn chưa nhập chức vụ',
                    'department.required' => 'Bạn chưa nhập phòng ban',
                    'phone.required' => 'Bạn chưa nhập số điện thoại',
                    'phone.numeric' => 'Định dạng điện thoại không đúng',
                    'email.required' => 'Bạn chưa nhập email',
                    'email.email' => 'Bạn chưa nhập đúng định dạng email',
                    'email.unique' => 'Email đã tồn tại',
                ]);
        }
		if (isset($request->mahuyen)) {
            $data->mahuyen = $request->mahuyen;
        }
        $data->name = trim($request->name);
        $data->position = trim($request->position);
        $data->department = trim($request->department);
        $data->phone = trim($request->phone);
        $data->email = trim(strtolower($request->email));
        $data->save();
        return redirect('admin/contact/list/')->with('thongbao', 'Sửa thông tin thành công');
    }

    public function getDelete($id)
    {
        $data = Contact::findOrFail($id);
        $data->delete();
        return redirect('admin/contact/list')->with('thongbao', 'Xoá liên hệ thành công!');
    }
}
