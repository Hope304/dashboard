<?php

namespace App\Http\Controllers;

use App\Contact;
use App\receiveEmail;
use App\Weather;
use Illuminate\Http\Request;
use App\Hotspot;
use DB;
use App\verify_fire_point;
use Mail;

class APIController extends Controller
{
    public function capchayIFEE()
    {
        $time_now = now()->format('Y-m-d');

        $data = Weather::where('thoigian', $time_now)->get();
        $data_res = array();
        if (count($data) > 0) {
            foreach ($data as $dt) {
                $temp['_id'] = trim($dt->id);
                $temp['RAIN'] = trim($dt->luongmua);
                $temp['CAPCHAY'] = trim($dt->capncc);
                $temp['CHISOP'] = trim($dt->csp);
                $temp['date'] = trim($dt->thoigian);
                $temp['TEMP'] = trim($dt->nhietdo);
                $temp['HUMIDITY'] = trim($dt->doam);
                $temp['WIN_SPEED'] = trim($dt->tocdogio);
                $temp['WIN_DEG'] = trim($dt->huonggio);
                $temp['d'] = trim($dt->d);
                $temp['MATINH'] = trim(35);
                $temp['TINH'] = trim("Tỉnh Hà Nam");
                $temp['MAHUYEN'] = trim($dt->commune->district->mahuyen);
                $temp['HUYEN'] = trim($dt->commune->district->huyen);
                $temp['MAXA'] = trim($dt->maxa);
                $temp['XA'] = trim($dt->commune->xa);
                $temp['LON'] = trim($dt->commune->kd);
                $temp['LAT'] = trim($dt->commune->vd);
                array_push($data_res, $temp);
            }
            return $data_res;
        } else {
            $time_ago = date('Y-m-d', strtotime('+1 days ago'));
            $data_ago = Weather::where('thoigian', $time_ago)->get();
            foreach ($data_ago as $dt) {
                $temp['_id'] = trim($dt->id);
                $temp['RAIN'] = trim($dt->luongmua);
                $temp['CAPCHAY'] = trim($dt->capncc);
                $temp['CHISOP'] = trim($dt->csp);
                $temp['date'] = trim($dt->thoigian);
                $temp['TEMP'] = trim($dt->nhietdo);
                $temp['HUMIDITY'] = trim($dt->doam);
                $temp['WIN_SPEED'] = trim($dt->tocdogio);
                $temp['WIN_DEG'] = trim($dt->huonggio);
                $temp['d'] = trim($dt->d);
                $temp['MATINH'] = trim(35);
                $temp['TINH'] = trim("Tỉnh Hà Nam");
                $temp['MAHUYEN'] = trim($dt->commune->district->mahuyen);
                $temp['HUYEN'] = trim($dt->commune->district->huyen);
                $temp['MAXA'] = trim($dt->maxa);
                $temp['XA'] = trim($dt->commune->xa);
                $temp['LON'] = trim($dt->commune->kd);
                $temp['LAT'] = trim($dt->commune->vd);
                array_push($data_res, $temp);
            }
            return $data_res;
        }
    }

    public function hotspots()
    {
        $time_now = now()->format('Y-m-d');
        $data = Hotspot::where('acq_date', $time_now)->get();
        $data_res = array();

        if (count($data) > 0) {
            foreach ($data as $dt) {
                $temp['_id'] = trim($dt->id);
                $coordinates['coordinates'] = [$dt->longitude, $dt->latitude];
                $temp['geometry'] = $coordinates;
                $properties['SCAN'] = $dt->scan;
                $properties['BRIGHTNESS'] = $dt->brightness;
                $properties['TRACK'] = $dt->track;
                $properties['ACQ_DATE'] = $dt->acq_date;
                $properties['ACQ_TIME'] = $dt->acq_time;
                $properties['SATELLITE'] = $dt->satellite;
                $properties['CONFIDENCE'] = $dt->confidence;
                $properties['VERSION'] = $dt->version;
                $properties['BRIGHT_T31'] = $dt->bright_t31;
                $properties['DAYNIGHT'] = $dt->daynight;
                $properties['MATINH'] = 35;
                $properties['TINH'] = "Tỉnh Hà Nam";
                $properties['MAHUYEN'] = $dt->commune->district->mahuyen;
                $properties['HUYEN'] = trim($dt->commune->district->huyen);
                $properties['XA'] = trim($dt->commune->xa);
                $properties['MAXA'] = $dt->maxa;
                $properties['TIEUKHU'] = $dt->tk;
                $properties['KHOANH'] = $dt->khoanh;
                $properties['LO'] = $dt->lo;
                $properties['LDLR'] = $dt->ldlr;
                $properties['MALDLR'] = $dt->maldlr;
                $properties['CHURUNG'] = $dt->churung;
                $verify = verify_fire_point::where('id_diemchay', $dt->id)->first();
                if (isset($verify)) {
                    $properties['XACMINH'] = $verify->tt_xacminh;
                    $properties['KIEMDUYET'] = $verify->kiemduyet;
                } else {
                    $properties['XACMINH'] = 1;
                    $properties['KIEMDUYET'] = 0;
                }
                $temp['properties'] = $properties;
                array_push($data_res, $temp);
            }
            return $data_res;
        }
    }

    public function getHotSpotInfo(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $data = Hotspot::whereBetween('acq_date', [$from, $to])->get();
        $data_res = array();

        if (count($data) > 0) {
            foreach ($data as $dt) {
                $temp['_id'] = trim($dt->id);
                $coordinates['coordinates'] = [$dt->longitude, $dt->latitude];
                $temp['geometry'] = $coordinates;
                $properties['SCAN'] = $dt->scan;
                $properties['BRIGHTNESS'] = $dt->brightness;
                $properties['TRACK'] = $dt->track;
                $properties['ACQ_DATE'] = $dt->acq_date;
                $properties['ACQ_TIME'] = $dt->acq_time;
                $properties['SATELLITE'] = $dt->satellite;
                $properties['CONFIDENCE'] = $dt->confidence;
                $properties['VERSION'] = $dt->version;
                $properties['BRIGHT_T31'] = $dt->bright_t31;
                $properties['DAYNIGHT'] = $dt->daynight;
                $properties['MATINH'] = 35;
                $properties['TINH'] = "Tỉnh Hà Nam";
                $properties['MAHUYEN'] = $dt->commune->district->mahuyen;
                $properties['HUYEN'] = trim($dt->commune->district->huyen);
                $properties['XA'] = trim($dt->commune->xa);
                $properties['MAXA'] = $dt->maxa;
                $properties['TIEUKHU'] = $dt->tk;
                $properties['KHOANH'] = $dt->khoanh;
                $properties['LO'] = $dt->lo;
                $properties['LDLR'] = $dt->ldlr;
                $properties['MALDLR'] = $dt->maldlr;
                $properties['CHURUNG'] = $dt->churung;
                $verify = verify_fire_point::where('id_diemchay', $dt->id)->first();
                if (isset($verify)) {
                    $properties['XACMINH'] = $verify->tt_xacminh;
                    $properties['KIEMDUYET'] = $verify->kiemduyet;
                } else {
                    $properties['XACMINH'] = 1;
                    $properties['KIEMDUYET'] = 0;
                }
                $temp['properties'] = $properties;
                array_push($data_res, $temp);
            }

            return $data_res;
        }
    }

    public function verificationFireForm(Request $request)
    {
        $data = new verify_fire_point();
        if ($request->fire == '3') {
            $data->id_diemchay = $request->dataId;
            $data->mota = $request->mota;
            $data->nguoixacminh = $request->username;
            $data->dienthoai = $request->userphone;
            $data->kiemduyet = 0;
            if ($request->hasFile('hinhanh')) {
                $file = $request->file('hinhanh');
                $duoi = $file->getClientOriginalExtension();
                if ($duoi == 'jpg' || $duoi == 'png' || $duoi == 'jpeg' || $duoi == 'JPG' || $duoi == 'PNG' || $duoi == 'JPEG')
                {
                    $name = $file->getClientOriginalName();
                    while (file_exists('admin/images/verify/' . $name)) {
                        $name = rand()."_".$name;
                    }
                    $file->move('admin/images/verify/', $name);
                    $data->hinhanh = $name;
                }
                else{
                    return 0;
                }
            } else {
                $data->hinhanh = "";
            }
            $data->ngayxacminh = now()->format('Y-m-d H:i:s');;
            $data->tt_xacminh = $request->fire;
        } else {
            $data->id_diemchay = $request->dataId;
            $data->mota = $request->mota;
            $data->huongphoi = $request->huongphoi;
            $data->dtdamchay = $request->dtdamchay;
            $data->khoangcach = $request->khoangcach;
            if($request->daptat == '0')
            {
                $data->tt_damchay = "Chưa dập tắt";
            }
            else {
                $data->tt_damchay = "Đã dập tắt";
            }

            $data->nguoixacminh = $request->username;
            $data->dienthoai = $request->userphone;
            $data->kiemduyet = 0;
            if ($request->hasFile('hinhanh')) {
                $file = $request->file('hinhanh');
                $duoi = $file->getClientOriginalExtension();
                if ($duoi == 'jpg' || $duoi == 'png' || $duoi == 'jpeg' || $duoi == 'JPG' || $duoi == 'PNG' || $duoi == 'JPEG')
                {
                    $name = $file->getClientOriginalName();
                    while (file_exists('admin/images/verify/' . $name)) {
                        $name = rand()."_".$name;
                    }
                    $file->move('admin/images/verify/', $name);
                    $data->hinhanh = $name;
                }
                else{
                    return 0;
                }
            } else {
                $data->hinhanh = "";
            }
            $data->ngayxacminh = now()->format('Y-m-d H:i:s');;
            $data->tt_xacminh = $request->fire;
        }
        $data->save();
        $info = Hotspot::findOrFail($request->dataId);
        $getEmails = receiveEmail::select('email')->where('verification', 1)->get();
		$trimEmail = array();
		foreach($getEmails as $item)
		{
			array_push($trimEmail, trim($item->email));
		}
        $subject = "Kiểm duyệt báo cháy";
		Mail::send('sendMail.mailVerify', ['info'=>$info], function ($mess) use ($subject, $trimEmail) {
			$mess->to($trimEmail);
			$mess->from('giamsatrunghanam@ifee.edu.vn', 'Hệ thống giám sát rừng tỉnh Hà Nam');
			$mess->subject($subject);
		});
        return 1;
    }

    public function listContact($role)
    {
		if($role == 1)
		{
			$data = Contact::orderBy('mahuyen')->get();
		}
		else {
			$data = Contact::where('mahuyen', $role)->get();
		}

        $data_res = array();

        if (count($data) > 0) {
            foreach ($data as $dt) {
                $temp['id'] = trim($dt->id);
				if(isset($dt->district->huyen))
				{
					$temp['huyen'] = trim($dt->district->huyen);
				} else {
					$temp['huyen'] = '';
				}
				
                $temp['name'] = trim($dt->name);
                $temp['position'] = trim($dt->position);
                $temp['department'] = trim($dt->department);
                $temp['phone'] = trim($dt->phone);
                $temp['email'] = trim($dt->email);
                array_push($data_res, $temp);
            }
            return $data_res;
        } else
            return 0;
    }
}
