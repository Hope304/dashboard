<?php

namespace App\Http\Controllers;

use App\dbr;
use App\Weather;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\PasswordResets;
use Mail;

class AdminController extends Controller
{
    public function getLogin()
    {
        return view('admin/login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required | email',
                'password' => 'required',
            ],
            [
                'email.required' => 'bạn chưa nhập email',
                'email.email' => 'bạn chưa nhập đúng định dạng email',
                'password.required' => 'bạn chưa nhập password',
            ]);

        if (Auth::attempt(['email' => strtolower($request->email), 'password' => $request->password])) {
            return redirect('admin/home');
        } else {
            return redirect('Login')->with('error', 'Sai tài khoản mật khẩu');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('Login');
    }

    public function getHome()
    {
        $time_now = now()->format('Y-m-d');

        $data = Weather::where('thoigian', $time_now)->get();
        if (count($data) > 0) {
            $time_ago = date('d-m-Y', strtotime('+1 days ago'));
            return view('admin/home', ['data' => $data, 'time' => now()->format('d-m-Y'), 'time_ago' => $time_ago]);
        } else {
            $time_ago = date('Y-m-d', strtotime('+1 days ago'));
            $data_ago = Weather::where('thoigian', $time_ago)->get();
            return view('admin/home', ['data' => $data_ago, 'time' => date('d-m-Y', strtotime('+1 days ago')), 'time_ago' => date('d-m-Y', strtotime('+2 days ago'))]);
        }

    }

    public function getProfile($id)
    {
        if (Auth::user()->id == $id) {
            $data = User::findOrFail($id);
            return view('admin/profile/info', ['tk' => $data]);
        } else {
            return redirect('admin/home');
        }
    }

    public function getEditProfile($id)
    {
        if (Auth::user()->id == $id) {
            $data = User::findOrFail($id);
            return view('admin/profile/editInfo', ['tk' => $data]);
        } else {
            return redirect('admin/home');
        }
    }

    public function postEditProfile($id, Request $request)
    {
        if (Auth::user()->id == $id) {
            $user = User::findOrFail($id);
            if ($request->email == $user->email) {
                $this->validate($request,
                    [
                        'name' => 'required',
                        'email' => 'required | email ',
                    ],
                    [
                        'name.required' => 'bạn chưa nhập tên',
                        'email.required' => 'bạn chưa nhập email',
                        'email.email' => 'bạn chưa nhập đúng định dạng email',
                    ]);
            } else {
                $this->validate($request,
                    [
                        'name' => 'required',
                        'email' => 'required | email | unique:users,email',
                    ],
                    [
                        'name.required' => 'bạn chưa nhập tên',
                        'email.required' => 'bạn chưa nhập email',
                        'email.email' => 'bạn chưa nhập đúng định dạng email',
                        'email.unique' => 'email đã tồn tại',
                    ]);
            }
            $user->name = $request->name;
            $user->email = strtolower($request->email);
            $user->save();
            return redirect('admin/profile/' . $id)->with('thongbao', 'Đổi thông tin thành công');
        } else {
            return redirect('admin/home');
        }
    }

    public function getEditPass($id)
    {
        if (Auth::user()->id == $id) {
            return view('admin/profile/editPass', ['id' => $id]);
        } else {
            return redirect('admin/home');
        }
    }

    public function postEditPass($id, Request $request)
    {
        if (Auth::user()->id == $id) {
            $user = User::findOrFail($id);
            $this->validate($request,
                [
                    'newpassword' => 'required',
                    'newpasswordAgain' => 'required | same:newpassword',
                ],
                [
                    'newpassword.required' => 'bạn chưa nhập mật khẩu mới',
                    'newpasswordAgain.required' => 'bạn chưa nhập xác nhận mật khẩu',
                    'newpasswordAgain.same' => 'Xác nhận mật khẩu không khớp',
                ]);
            $user->password = bcrypt($request->newpassword);
            $user->save();
            return redirect('admin/profile/changepass/' . $id)->with('thongbao', 'Thay đổi mật khẩu thành công');
        } else {
            return redirect('admin/home');
        }
    }

    public function getForgotPassword()
    {
        return view('admin/forgotPassword');
    }

    public function postForgotPassword(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required | email',
            ],
            [
                'email.required' => 'bạn chưa nhập email',
                'email.email' => 'bạn chưa nhập đúng định dạng email',
            ]);

        $email = strtolower($request->email);
        $check = User::where('email', $email)->first();
        if (isset($check)) {
            $new_reset = new PasswordResets();
            $new_reset->email = trim($email);
            $token = str_replace("/", "", bcrypt($email));
            $new_reset->token = $token;
            $new_reset->save();
            $subject = "Đặt lại mật khẩu tài khoản quản trị hệ thống giám sát rừng Hà Nam";
            Mail::send('sendMail.PasswordResets', ['token' => $token], function ($mess) use ($subject, $email) {
                $mess->to(trim($email));
                $mess->from('giamsatrunghanam@ifee.edu.vn', 'Hệ thống giám sát rừng tỉnh Hà Nam');
                $mess->subject($subject);
            });
            return redirect('ForgotPassword')->with('thongbao', 'Hệ thống đã gửi đường dẫn đặt lại mật khẩu. Vui lòng kiểm tra email. Trân trọng !');
        } else {
            return redirect('ForgotPassword')->with('error', 'Không tồn tại tài khoản này!');
        }
    }

    public function getFormReset($token)
    {
        $check = PasswordResets::where('token', $token)->first();
        if (isset($check)) {
            return view('admin/PasswordResets', ['token' => $token]);
        } else {
            return redirect('ForgotPassword')->with('error', 'Đường dẫn không tồn tại hoặc hết hạn. Vui lòng thực hiện lại đặt lại mật khẩu!');
        }
    }

    public function postFormReset($token, Request $request)
    {
        $this->validate($request,
            [
                'Password' => 'required',
                'RePassword' => 'required | same:Password',
            ],
            [
                'Password.required' => 'Mật khẩu mới không được để trống',
                'RePassword.required' => 'Xác nhận mật khẩu không được để trống',
                'RePassword.same' => 'Xác nhận mật khẩu không khớp',
            ]);

        $info = PasswordResets::where('token', $token)->first();
        $email = $info->email;
        $user = User::where('email', $email)->first();
        $user->password = bcrypt($request->Password);
        $user->save();
        $info->delete();
        return redirect('Login')->with('thongbao', 'Đặt lại mật khẩu thành công, vui lòng đăng nhập lại!');
    }

    public function getDieuchinhcapchay(){
        $time_now = now()->format('Y-m-d');
        if(Auth::user()->role == 'admin'){
            $data = Weather::select('mahuyen')->where('thoigian', $time_now)->distinct()->get();
        }else{
            $data = Weather::select('mahuyen')->where('mahuyen', Auth::user()->mahuyen)->where('thoigian', $time_now)->distinct()->get();
        }

        return view('admin/dieuchinhcapchay', [
            'data' => $data,
        ]);
    }

    public function postDieuchinhcapchay(Request $request){
        $mahuyen = $request->mahuyen;
        $capchay = $request->capchay;
        $csp=0;
        if($capchay == 1){
            $csp=0;
        }else if($capchay==2){
            $csp=1000;
        }else if($capchay==3){
            $csp=2500;
        }else if($capchay==4){
            $csp=5000;
        }else{
            $csp=10000;
        }

        $time_now = now()->format('Y-m-d');
        $data = Weather::where('mahuyen', $mahuyen)->where('thoigian', $time_now)->orderByDesc('id')->get();
        foreach($data as $item){
            $z=Weather::findOrFail($item->id);
            $z->capncc=$capchay;
            $z->csp=$csp;
            $z->save();
        }
        dbr::where('mahuyen', $mahuyen)->update(['capchay' => $capchay]);

        return redirect('/admin/home')->with('thongbao', 'Điều chỉnh cấp cháy thành công');
    }
}
