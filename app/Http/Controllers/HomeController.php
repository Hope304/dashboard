<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Mail;

class HomeController extends Controller
{
    public function getHome()
    {
        return view('web/trangchu');
    }

    public function getGioiThieu()
    {
        return view('web/gioithieu');
    }

    public function getCanhBaoChayRung()
    {
        return view('web/canhbaochayrung');
    }

    public function getCanhBaoChayRung_iframe()
    {
        return view('web/canhbaochayrung_iframe');
    }

    public function getGiamSatRung()
    {
        return view('web/giamsatrung');
    }

    public function getThongKeBaoCao()
    {
        return view('web/thongkebaocao');
    }

    public function getHDSD()
    {
        // $url = 'https://view.officeapps.live.com/op/embed.aspx?src=https://giamsatrunghanam.xuanmaijsc.vn/hdsd/SoTay_HDSD_HaNamFFW.pdf&embedded=true';
        // return redirect()->to($url);
        return redirect('hdsd/SoTay_HDSD_HaNamFFW.pdf');
    }

    public function DownloadHTR()
    {
        return view('web/download_htr');
    }

    public function PluginQGIS()
    {
        return view('web/pluginQGIS');
    }

    public function DownloadAppMobile()
    {
        return view('web/download_app');
    }

    public function getLienHe()
    {
        return view('web/lienhe');
    }

    public function postLienHe(Request $request)
    {
        $this->validate(
            $request,
            [
                'Name' => 'required',
                'Email' => 'required | email',
                'Message' => 'required',
            ],
            [
                'Name.required' => 'Họ và tên không được để trống',
                'Email.required' => 'Email không được để trống',
                'Email.email' => 'Email không đúng định dạng',
                'Message.required' => 'Tin nhắn không được để trống',
            ]
        );

        $name = $request->Name;
        $subject = "Trao đổi, góp ý hệ thống giám sát rừng Hà Nam";
        $email = $request->Email;
        $content = $request->Message;
        $getTime = now()->format('H:i:s d-m-Y');

        Mail::send('sendMail.Contact', [
            'name' => $name,
            'email' => $email,
            'content' => $content,
            'timeRespond' => $getTime
        ], function ($mess) use ($request, $subject) {
            $mess->to('info@ifee.edu.vn');
            $mess->from('dichvu2@ifee.edu.vn');
            $mess->subject($subject);
        });

        return redirect('LienHe')->with('thongbao', 'Gửi liên hệ thành công!');
    }
}
