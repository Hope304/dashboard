<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function getList()
    {
        $myID = Auth::user()->id;
        $data = User::where('id', "<>", $myID)->get();
        return view('admin/users/list', ['taikhoan' => $data]);
    }

    public function getAdd()
    {
        return view('admin/users/add');
    }

    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required | email | unique:users,email',
                'password' => 'required',
                'passwordAgain' => 'required | same:password',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên',
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Bạn chưa nhập đúng định dạng email',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu nhập lại không đúng',
            ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = strtolower($request->email);
        $user->password = bcrypt($request->password);
        if($request->role == 'admin'){
            $user->role='admin';
        }else if($request->role=='user'){
            $user->role='user';
        }else{
            $user->mahuyen=$request->role;
        }
        $user->save();
        return redirect('admin/users/list')->with('thongbao', 'Thêm tài khoản thành công!');
    }

    public function getEdit($id)
    {
        $data = User::findOrFail($id);
        return view('admin/users/edit', ['tk' => $data]);
    }

    public function postEdit($id, Request $request)
    {
        $user = User::findOrFail($id);
        if ($request->email == $user->email) {
            $this->validate($request,
                [
                    'name' => 'required',
                    'email' => 'required | email',
                ],
                [
                    'name.required' => 'Bạn chưa nhập tên',
                    'email.required' => 'Bạn chưa nhập email',
                    'email.email' => 'Bạn chưa nhập đúng định dạng email',
                ]);
        } else {
            $this->validate($request,
                [
                    'name' => 'required',
                    'email' => 'required | email | unique:users,email',
                ],
                [
                    'name.required' => 'Bạn chưa nhập tên',
                    'email.required' => 'Bạn chưa nhập email',
                    'email.email' => 'Bạn chưa nhập đúng định dạng email',
                    'email.unique' => 'Email đã tồn tại',
                ]);
        }
        if ($request->changepass == 1) {
            $this->validate($request,
                [
                    'password' => 'required',
                ],
                [
                    'password.required' => 'Bạn chưa nhập mật khẩu mới',
                ]);
            $user->password = bcrypt($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->role == 'admin'){
            $user->role='admin';
        }else if($request->role=='user'){
            $user->role='user';
        }else{
            $user->mahuyen=$request->role;
        }
        $user->save();
        return redirect('admin/users/list/')->with('thongbao', 'Sửa thông tin thành công');
    }

    public function getDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('admin/users/list')->with('thongbao', 'Xoá tài khoản thành công!');
    }
}
