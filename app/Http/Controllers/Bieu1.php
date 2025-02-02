<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\dbr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Bieu1 extends Controller
{

    public function getData($region, $regionCode)
    {
        $regionCol = $region;
        $regionCode = $regionCode;
        $name_json = $regionCol . "_" . $regionCode . ".json";

        if (Storage::exists('bieu1/'.$name_json)) {
            $file = File::get(storage_path('app/bieu1/' . $name_json));
            return view('web/bieu/bieu1', json_decode($file, true));
        } else {
            $rtn = $this->sumDtichBy3LR($regionCol, $regionCode, 1, 59);
            $rtr = $this->sumDtichBy3LR($regionCol, $regionCode, 60, 71);
            $trongChuaThanhRung = $this->sumDtichBy3LR($regionCol, $regionCode, 72, 77);
            $khoanhNuoiTaiSinh = $this->sumDtichBy3LR($regionCol, $regionCode, 78, 81);
            $dtichKhac = $this->sumDtichBy3LR($regionCol, $regionCode, 82, 93);

            $sum_rtn = array();
            for ($i = 0; $i < 14; $i++) {
                $total_rtn = $rtn[$i][0] + $rtn[$i][1] + $rtn[$i][2] + $rtn[$i][6];
                array_push($sum_rtn, $total_rtn);
            }

            $sum_rtr = array();
            for ($i = 0; $i < 14; $i++) {
                $total_rtr = $rtr[$i][0] + $rtr[$i][1] + $rtr[$i][2] + $rtr[$i][6];
                array_push($sum_rtr, $total_rtr);
            }

            $sum_trongChuaThanhRung = array();
            for ($i = 0; $i < 14; $i++) {
                $total_trongChuaThanhRung = $trongChuaThanhRung[$i][0] + $trongChuaThanhRung[$i][1] + $trongChuaThanhRung[$i][2] + $trongChuaThanhRung[$i][6];
                array_push($sum_trongChuaThanhRung, $total_trongChuaThanhRung);
            }

            $sum_khoanhNuoiTaiSinh = array();
            for ($i = 0; $i < 14; $i++) {
                $total_khoanhNuoiTaiSinh = $khoanhNuoiTaiSinh[$i][0] + $khoanhNuoiTaiSinh[$i][1] + $khoanhNuoiTaiSinh[$i][2] + $khoanhNuoiTaiSinh[$i][6];
                array_push($sum_khoanhNuoiTaiSinh, $total_khoanhNuoiTaiSinh);
            }

            $sum_dtichKhac = array();
            for ($i = 0; $i < 14; $i++) {
                $total_dtichKhac = $dtichKhac[$i][0] + $dtichKhac[$i][1] + $dtichKhac[$i][2] + $dtichKhac[$i][6];
                array_push($sum_dtichKhac, $total_dtichKhac);
            }

            $sum_dtichCoRung = array();
            for ($i = 0; $i < 14; $i++) {
                $total_dtichCoRung = $sum_rtn[$i] + $sum_rtr[$i];
                array_push($sum_dtichCoRung, $total_dtichCoRung);
            }

            $sum_dtichChuaCoRung = array();
            for ($i = 0; $i < 14; $i++) {
                $total_dtichChuaCoRung = $sum_trongChuaThanhRung[$i] + $sum_khoanhNuoiTaiSinh[$i] + $sum_dtichKhac[$i];
                array_push($sum_dtichChuaCoRung, $total_dtichChuaCoRung);
            }

            $sum_Total_Final = array();
            for ($i = 0; $i < 14; $i++) {
                $total_Final = $sum_dtichCoRung[$i] + $sum_dtichChuaCoRung[$i];
                array_push($sum_Total_Final, $total_Final);
            }

            $render_rtn = $this->reform($rtn);
            $render_rtr = $this->reform($rtr);
            $render_chuathanhrung = $this->reform($trongChuaThanhRung);
            $render_nuoitaisinh = $this->reform($khoanhNuoiTaiSinh);
            $render_dtichkhac = $this->reform($dtichKhac);

            $data['total'] = $sum_Total_Final;
            $data['tong_dtcorung'] = $sum_dtichCoRung;
            $data['rtn'] = $sum_rtn;
            $data['data_rtn'] = $render_rtn;
            $data['rungtrong'] = $sum_rtr;
            $data['data_rtr'] = $render_rtr;
            $data['tong_chuathanhrung'] = $sum_dtichChuaCoRung;
            $data['sum_dtchuathanhrung'] = $sum_trongChuaThanhRung;
            $data['data_chuathanhrung'] = $render_chuathanhrung;
            $data['sum_dtchuataisinh'] = $sum_khoanhNuoiTaiSinh;
            $data['data_taisinh'] = $render_nuoitaisinh;
            $data['sum_dtichkhac'] = $sum_dtichKhac;
            $data['data_dtichkhac'] = $render_dtichkhac;
            $res = ['total' => $sum_Total_Final, 'tong_dtcorung' => $sum_dtichCoRung, 'rtn' => $sum_rtn, 'data_rtn' => $render_rtn, 'rungtrong' => $sum_rtr, 'data_rtr' => $render_rtr, 'tong_chuathanhrung' => $sum_dtichChuaCoRung, 'sum_dtchuathanhrung' => $sum_trongChuaThanhRung, 'data_chuathanhrung' => $render_chuathanhrung, 'sum_dtchuataisinh' => $sum_khoanhNuoiTaiSinh, 'data_taisinh' => $render_nuoitaisinh, 'sum_dtichkhac' => $sum_dtichKhac, 'data_dtichkhac' => $render_dtichkhac];
            Storage::put('bieu1/' . $name_json, json_encode($res));
            return view('web/bieu/bieu1', $res);
        }
    }
    /*DashBoard*/
    public function getDashBoard($region, $regionCode)
    {
        $regionCol = $region;
        $regionCode = $regionCode;
        $name_json = $regionCol . "_" . $regionCode . ".json";

        // if (Storage::exists('bieu1/'.$name_json)) {
        //     $file = File::get(storage_path('app/bieu1/' . $name_json));
        //     return view('admin/dashboard/bieu1', json_decode($file, true));
        // } else {
        // }
        $rtn = $this->sumDtichBy3LR($regionCol, $regionCode, 1, 59);
        $rtr = $this->sumDtichBy3LR($regionCol, $regionCode, 60, 71);
        $trongChuaThanhRung = $this->sumDtichBy3LR($regionCol, $regionCode, 72, 77);
        $khoanhNuoiTaiSinh = $this->sumDtichBy3LR($regionCol, $regionCode, 78, 81);
        $dtichKhac = $this->sumDtichBy3LR($regionCol, $regionCode, 82, 93);

        $sum_rtn = array();
        for ($i = 0; $i < 14; $i++) {
            $total_rtn = $rtn[$i][0] + $rtn[$i][1] + $rtn[$i][2] + $rtn[$i][6];
            array_push($sum_rtn, $total_rtn);
        }

        $sum_rtr = array();
        for ($i = 0; $i < 14; $i++) {
            $total_rtr = $rtr[$i][0] + $rtr[$i][1] + $rtr[$i][2] + $rtr[$i][6];
            array_push($sum_rtr, $total_rtr);
        }

        $sum_trongChuaThanhRung = array();
        for ($i = 0; $i < 14; $i++) {
            $total_trongChuaThanhRung = $trongChuaThanhRung[$i][0] + $trongChuaThanhRung[$i][1] + $trongChuaThanhRung[$i][2] + $trongChuaThanhRung[$i][6];
            array_push($sum_trongChuaThanhRung, $total_trongChuaThanhRung);
        }

        $sum_khoanhNuoiTaiSinh = array();
        for ($i = 0; $i < 14; $i++) {
            $total_khoanhNuoiTaiSinh = $khoanhNuoiTaiSinh[$i][0] + $khoanhNuoiTaiSinh[$i][1] + $khoanhNuoiTaiSinh[$i][2] + $khoanhNuoiTaiSinh[$i][6];
            array_push($sum_khoanhNuoiTaiSinh, $total_khoanhNuoiTaiSinh);
        }

        $sum_dtichKhac = array();
        for ($i = 0; $i < 14; $i++) {
            $total_dtichKhac = $dtichKhac[$i][0] + $dtichKhac[$i][1] + $dtichKhac[$i][2] + $dtichKhac[$i][6];
            array_push($sum_dtichKhac, $total_dtichKhac);
        }

        $sum_dtichCoRung = array();
        for ($i = 0; $i < 14; $i++) {
            $total_dtichCoRung = $sum_rtn[$i] + $sum_rtr[$i];
            array_push($sum_dtichCoRung, $total_dtichCoRung);
        }

        $sum_dtichChuaCoRung = array();
        for ($i = 0; $i < 14; $i++) {
            $total_dtichChuaCoRung = $sum_trongChuaThanhRung[$i] + $sum_khoanhNuoiTaiSinh[$i] + $sum_dtichKhac[$i];
            array_push($sum_dtichChuaCoRung, $total_dtichChuaCoRung);
        }

        $sum_Total_Final = array();
        for ($i = 0; $i < 14; $i++) {
            $total_Final = $sum_dtichCoRung[$i] + $sum_dtichChuaCoRung[$i];
            array_push($sum_Total_Final, $total_Final);
        }

        $render_rtn = $this->reform($rtn);
        $render_rtr = $this->reform($rtr);
        $render_chuathanhrung = $this->reform($trongChuaThanhRung);
        $render_nuoitaisinh = $this->reform($khoanhNuoiTaiSinh);
        $render_dtichkhac = $this->reform($dtichKhac);

        $data['total'] = $sum_Total_Final;
        $data['tong_dtcorung'] = $sum_dtichCoRung;
        $data['rtn'] = $sum_rtn;
        $data['data_rtn'] = $render_rtn;
        $data['rungtrong'] = $sum_rtr;
        $data['data_rtr'] = $render_rtr;
        $data['tong_chuathanhrung'] = $sum_dtichChuaCoRung;
        $data['sum_dtchuathanhrung'] = $sum_trongChuaThanhRung;
        $data['data_chuathanhrung'] = $render_chuathanhrung;
        $data['sum_dtchuataisinh'] = $sum_khoanhNuoiTaiSinh;
        $data['data_taisinh'] = $render_nuoitaisinh;
        $data['sum_dtichkhac'] = $sum_dtichKhac;
        $data['data_dtichkhac'] = $render_dtichkhac;
        $res = ['total' => $sum_Total_Final, 'tong_dtcorung' => $sum_dtichCoRung, 'rtn' => $sum_rtn, 'data_rtn' => $render_rtn, 'rungtrong' => $sum_rtr, 'data_rtr' => $render_rtr, 'tong_chuathanhrung' => $sum_dtichChuaCoRung, 'sum_dtchuathanhrung' => $sum_trongChuaThanhRung, 'data_chuathanhrung' => $render_chuathanhrung, 'sum_dtchuataisinh' => $sum_khoanhNuoiTaiSinh, 'data_taisinh' => $render_nuoitaisinh, 'sum_dtichkhac' => $sum_dtichKhac, 'data_dtichkhac' => $render_dtichkhac];
        Storage::put('bieu1/' . $name_json, json_encode($res));
        return view('admin/dashboard/bieu1', compact('res'));
        // return $res ;
    }

    public function reform($arr)
    {
        $reform = array();
        for ($j = 0; $j < 7; $j++) {
            $data = array();
            for ($i = 0; $i < 14; $i++) {
                array_push($data, $arr[$i][$j]);
            }
            array_push($reform, $data);
        }
        return $reform;
    }

    public function sumDtichBy3LR($regionCol, $regionCode, $min, $max)
    {
        /* San Xuat */
        $data_rsx = $this->getLapDia('malr3', 3, 'maldlr', $min, $max, $regionCol, $regionCode);

        /* Dac Dung */
        $data_dd_vqg = $this->getLapDia('mamdsd', 5, 'maldlr', $min, $max, $regionCol, $regionCode); /* khu vuon quoc gia */
        $data_dd_kbt = $this->getLapDia('mamdsd', 6, 'maldlr', $min, $max, $regionCol, $regionCode); /* khu bao ton */
        $data_dd_knc = $this->getLapDia('mamdsd', 7, 'maldlr', $min, $max, $regionCol, $regionCode); /* khu nghien cuu khoa hoc */
        $data_dd_kcq = $this->getLapDia('mamdsd', 8, 'maldlr', $min, $max, $regionCol, $regionCode); /* khu canh quan */
        $data_dd_sum = array();
        for ($i = 0; $i < 7; $i++) {
            $total_dd = $data_dd_vqg[$i] + $data_dd_kbt[$i] + $data_dd_knc[$i] + $data_dd_kcq[$i];
            array_push($data_dd_sum, $total_dd);
        }

        /* PHONG HO */
        $data_ph_daunguon = $this->getLapDia('mamdsd', 1, 'maldlr', $min, $max, $regionCol, $regionCode); /* dau nguon */
        $data_ph_changio = $this->getLapDia('mamdsd', 3, 'maldlr', $min, $max, $regionCol, $regionCode); /* chan gio */
        $data_ph_chansong = $this->getLapDia('mamdsd', 2, 'maldlr', $min, $max, $regionCol, $regionCode); /* chan song */
        $data_ph_bvmt = $this->getLapDia('mamdsd', 4, 'maldlr', $min, $max, $regionCol, $regionCode); /* bao ve moi truong */
        $data_ph_sum = array();
        for ($i = 0; $i < 7; $i++) {
            $total_ph = $data_ph_daunguon[$i] + $data_ph_changio[$i] + $data_ph_chansong[$i] + $data_ph_bvmt[$i];
            array_push($data_ph_sum, $total_ph);
        }

        /* trong quy hoach */
        $data_tqh_sum = array();
        for ($i = 0; $i < 7; $i++) {
            $total_tqh = $data_rsx[$i] + $data_dd_sum[$i] + $data_ph_sum[$i];
            array_push($data_tqh_sum, $total_tqh);
        }

        /* Ngoai quy hoach */
        $data_nqh = $this->getLapDia('nqh', 1, 'maldlr', $min, $max, $regionCol, $regionCode);

        /* TOTAL */
        $data_total_sum = array();
        for ($i = 0; $i < 7; $i++) {
            $total = $data_tqh_sum[$i] + $data_nqh[$i];
            array_push($data_total_sum, $total);
        }

        $data = array();
        array_push($data, $data_total_sum);
        array_push($data, $data_tqh_sum);
        array_push($data, $data_dd_sum);
        array_push($data, $data_dd_vqg);
        array_push($data, $data_dd_kbt);
        array_push($data, $data_dd_knc);
        array_push($data, $data_dd_kcq);

        array_push($data, $data_ph_sum);
        array_push($data, $data_ph_daunguon);
        array_push($data, $data_ph_changio);
        array_push($data, $data_ph_chansong);
        array_push($data, $data_ph_bvmt);

        array_push($data, $data_rsx);

        array_push($data, $data_nqh);
        return $data;
    }


    public function getLapDia($ten, $ma, $rangeLdlr, $min, $max, $regionCol, $regionCode)
    {
        $trennuidat = dbr::where('lapdia', 1)
            ->where($regionCol, $regionCode)
            ->where($ten, $ma)
            ->whereBetween($rangeLdlr, [$min, $max])
            ->sum('dtich');
        $trennuida = dbr::where('lapdia', 2)
            ->where($regionCol, $regionCode)
            ->where($ten, $ma)
            ->whereBetween($rangeLdlr, [$min, $max])
            ->sum('dtich');

        $ngapman = dbr::where('lapdia', 3)
            ->where($regionCol, $regionCode)
            ->where($ten, $ma)
            ->whereBetween($rangeLdlr, [$min, $max])
            ->sum('dtich');

        $ngapphen = dbr::where('lapdia', 4)
            ->where($regionCol, $regionCode)
            ->where($ten, $ma)
            ->whereBetween($rangeLdlr, [$min, $max])
            ->sum('dtich');

        $ngapngot = dbr::where('lapdia', 5)
            ->where($regionCol, $regionCode)
            ->where($ten, $ma)
            ->whereBetween($rangeLdlr, [$min, $max])
            ->sum('dtich');

        $baicat = dbr::where('lapdia', 6)
            ->where($regionCol, $regionCode)
            ->where($ten, $ma)
            ->whereBetween($rangeLdlr, [$min, $max])
            ->sum('dtich');

        $ngapnuoc = $ngapman + $ngapphen + $ngapngot;
        $data = array();
        array_push($data, $trennuidat);
        array_push($data, $trennuida);
        array_push($data, $ngapnuoc);
        array_push($data, $ngapman);
        array_push($data, $ngapphen);
        array_push($data, $ngapngot);
        array_push($data, $baicat);
        return $data;
    }
}
