<?php

namespace App\Http\Controllers;

use App\receiveEmail;
use Illuminate\Http\Request;
use App\Commune;
use App\Weather;
use App\dbr;
use App\Hotspot;
use App\verify_fire_point;
use Mail;

class AjaxController extends Controller
{
    public function getCommune(Request $request)
    {
        $mahuyen = $request->mahuyen;
        $maxa = $request->maxa;
        $data = Commune::where('mahuyen', $mahuyen)->get();
        $respond = "";
        foreach ($data as $dt) {
            if ($dt->maxa == $maxa) {
                $respond .= "<option value='" . $dt->maxa . "' selected>" . $dt->xa . "</option>";
            } else {
                $respond .= "<option value='" . $dt->maxa . "'>" . $dt->xa . "</option>";
            }
        }

        return $respond;
    }

    public function getWeatherCommune(Request $request)
    {
        $maxa = $request->maxa;
        $data = Weather::where('maxa', $maxa)->get();
        return $data;
    }

    public function getHotspot24h()
    {
        $now = now()->format('Y-m-d');
        $ago_date = date('Y-m-d', strtotime('+1 days ago'));
        $time = now()->format('H-i');
        $data_ago = Hotspot::where('acq_date', $ago_date)->where('acq_time', '>=', $time)->get();
        $data_now = Hotspot::where('acq_date', $now)->where('acq_time', '<=', $time)->get();
        $data = array();
        foreach ($data_ago as $dt) {
            $temp['id'] = $dt->id;
            $temp['huyen'] = $dt->commune->district->huyen;
            $temp['maxa'] = $dt->maxa;
            $temp['xa'] = $dt->commune->xa;
            $temp['tk'] = $dt->tk;
            $temp['khoanh'] = $dt->khoanh;
            $temp['lo'] = $dt->lo;
            $temp['longitude'] = $dt->longitude;
            $temp['latitude'] = $dt->latitude;
            $temp['brightness'] = $dt->brightness;
            $temp['scan'] = $dt->scan;
            $temp['track'] = $dt->track;
            $temp['acq_date'] = date("d-m-Y", strtotime($dt->acq_date));
            $temp['acq_time'] = $dt->acq_time;
            $temp['satellite'] = $dt->satellite;
            $temp['confidence'] = $dt->confidence;
            $temp['version'] = $dt->version;
            $temp['bright_t31'] = $dt->bright_t31;
            $temp['daynight'] = $dt->daynight;
            $tt_xacminh = verify_fire_point::where('id_diemchay', $dt->id)->orderBy('id', 'desc')->first();
            if (isset($tt_xacminh->tt_xacminh)) {
                $temp['ttxacminh'] = $tt_xacminh->tt_xacminh;
            } else {
                $temp['ttxacminh'] = 1;
            }
            if (isset($tt_xacminh->kiemduyet)) {
                $temp['kiemduyet'] = $tt_xacminh->kiemduyet;
            } else {
                $temp['kiemduyet'] = 0;
            }

            array_push($data, $temp);
        }
        foreach ($data_now as $dt) {
            $temp['id'] = $dt->id;
            $temp['huyen'] = $dt->commune->district->huyen;
            $temp['maxa'] = $dt->maxa;
            $temp['xa'] = $dt->commune->xa;
            $temp['tk'] = $dt->tk;
            $temp['khoanh'] = $dt->khoanh;
            $temp['lo'] = $dt->lo;
            $temp['longitude'] = $dt->longitude;
            $temp['latitude'] = $dt->latitude;
            $temp['brightness'] = $dt->brightness;
            $temp['scan'] = $dt->scan;
            $temp['track'] = $dt->track;
            $temp['acq_date'] = date("d-m-Y", strtotime($dt->acq_date));
            $temp['acq_time'] = $dt->acq_time;
            $temp['satellite'] = $dt->satellite;
            $temp['confidence'] = $dt->confidence;
            $temp['version'] = $dt->version;
            $temp['bright_t31'] = $dt->bright_t31;
            $temp['daynight'] = $dt->daynight;
            $tt_xacminh = verify_fire_point::where('id_diemchay', $dt->id)->orderBy('id', 'desc')->first();
            if (isset($tt_xacminh->tt_xacminh)) {
                $temp['ttxacminh'] = $tt_xacminh->tt_xacminh;
            } else {
                $temp['ttxacminh'] = 1;
            }
            if (isset($tt_xacminh->kiemduyet)) {
                $temp['kiemduyet'] = $tt_xacminh->kiemduyet;
            } else {
                $temp['kiemduyet'] = 0;
            }
            array_push($data, $temp);
        }
        return $data;
    }

    public function getHistoryHotspot(Request $request)
    {
        $start = $request->startDate;
        $end = $request->endDate;
        $data = Hotspot::whereBetween('acq_date', [$start, $end])->get();
        $data_res = array();
        foreach ($data as $dt) {
            $temp['id'] = $dt->id;
            $temp['huyen'] = $dt->commune->district->huyen;
            $temp['maxa'] = $dt->maxa;
            $temp['xa'] = $dt->commune->xa;
            $temp['tk'] = $dt->tk;
            $temp['khoanh'] = $dt->khoanh;
            $temp['lo'] = $dt->lo;
            $temp['longitude'] = $dt->longitude;
            $temp['latitude'] = $dt->latitude;
            $temp['brightness'] = $dt->brightness;
            $temp['scan'] = $dt->scan;
            $temp['track'] = $dt->track;
            $temp['acq_date'] = date("d-m-Y", strtotime($dt->acq_date));
            $temp['acq_time'] = $dt->acq_time;
            $temp['satellite'] = $dt->satellite;
            $temp['confidence'] = $dt->confidence;
            $temp['version'] = $dt->version;
            $temp['bright_t31'] = $dt->bright_t31;
            $temp['daynight'] = $dt->daynight;
            $tt_xacminh = verify_fire_point::where('id_diemchay', $dt->id)->orderBy('id', 'desc')->first();
            if (isset($tt_xacminh->tt_xacminh)) {
                $temp['ttxacminh'] = $tt_xacminh->tt_xacminh;
            } else {
                $temp['ttxacminh'] = 1;
            }
            if (isset($tt_xacminh->kiemduyet)) {
                $temp['kiemduyet'] = $tt_xacminh->kiemduyet;
            } else {
                $temp['kiemduyet'] = 0;
            }
            array_push($data_res, $temp);
        }

        return $data_res;
    }

    public function postVerifyHotspot($id, Request $request)
    {
        $data = new verify_fire_point();
        $this->validate(
            $request,
            [
                'mota' => 'required',
                'username' => 'required',
                'userphone' => 'required',
            ],
            [
                'mota.required' => 'Vui lòng nhập mô tả',
                'username.required' => 'Vui lòng nhập họ tên người xác minh',
                'userphone.required' => 'Vui lòng nhập điện thoại người xác minh',
            ]
        );
        if ($request->fire == 3) {
            $data->id_diemchay = $id;
            $data->mota = $request->mota;
            $data->nguoixacminh = $request->username;
            $data->dienthoai = $request->userphone;
            $data->kiemduyet = 0;
            if ($request->hasFile('hinhanh')) {
                $file = $request->file('hinhanh');
                $duoi = $file->getClientOriginalExtension();
                if ($duoi == 'jpg' || $duoi == 'png' || $duoi == 'jpeg' || $duoi == 'JPG' || $duoi == 'PNG' || $duoi == 'JPEG') {
                    $name = $file->getClientOriginalName();
                    while (file_exists('admin/images/verify/' . $name)) {
                        $name = rand() . "_" . $name;
                    }
                    $file->move('admin/images/verify/', $name);
                    $data->hinhanh = $name;
                } else {
                    return redirect('CanhBaoChayRung')->with('loiupload', 'Chỉ hỗ trợ ảnh định dạng jpg, png, jpeg.');
                }
            } else {
                $data->hinhanh = "";
            }
            $data->ngayxacminh = now()->format('Y-m-d H:i:s');;
            $data->tt_xacminh = $request->fire;
        } else {
            $data->id_diemchay = $id;
            $data->mota = $request->mota;
            $data->huongphoi = $request->huongphoi;
            $data->dtdamchay = $request->dtdamchay;
            $data->khoangcach = $request->khoangcach;
            if ($request->handle == 0) {
                $data->tt_damchay = "Chưa dập tắt";
            } else {
                $data->tt_damchay = "Đã dập tắt";
                $data->tgdaptat = $request->time_handle;
            }
            
            $data->nguoixacminh = $request->username;
            $data->dienthoai = $request->userphone;
            $data->kiemduyet = 0;
            if ($request->hasFile('hinhanh')) {
                $file = $request->file('hinhanh');
                $duoi = $file->getClientOriginalExtension();
                if ($duoi == 'jpg' || $duoi == 'png' || $duoi == 'jpeg' || $duoi == 'JPG' || $duoi == 'PNG' || $duoi == 'JPEG') {
                    $name = $file->getClientOriginalName();
                    while (file_exists('admin/images/verify/' . $name)) {
                        $name = rand() . "_" . $name;
                    }
                    $file->move('admin/images/verify/', $name);
                    $data->hinhanh = $name;
                } else {
                    return redirect('CanhBaoChayRung')->with('loiupload', 'Chỉ hỗ trợ ảnh định dạng jpg, png, jpeg.');
                }
            } else {
                $data->hinhanh = "";
            }
            $data->ngayxacminh = now()->format('Y-m-d H:i:s');;
            $data->tt_xacminh = $request->fire;
        }
        $data->save();

        $info = Hotspot::findOrFail($id);
        $getEmails = receiveEmail::select('email')->where('verification', 1)->get();
        $trimEmail = array();
        foreach ($getEmails as $item) {
            array_push($trimEmail, trim($item->email));
        }
        $subject = "Kiểm duyệt báo cháy";
        Mail::send('sendMail.mailVerify', ['info' => $info], function ($mess) use ($subject, $trimEmail) {
            $mess->to($trimEmail);
            $mess->from('giamsatrunghanam@ifee.edu.vn', 'Hệ thống giám sát rừng tỉnh Hà Nam');
            $mess->subject($subject);
        });

        return redirect('CanhBaoChayRung')->with('thongbao', 'Xác minh điểm cháy thành công!');
    }
}
