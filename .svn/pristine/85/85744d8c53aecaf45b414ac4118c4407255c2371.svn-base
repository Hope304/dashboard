<?php

namespace App\Http\Controllers;

use App\dbr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Bieu3 extends Controller
{
    public function getData($region, $regionCode)
    {
        $regionCol = $region;
        $regionCode = $regionCode;

        $name_json = $regionCol . "_" . $regionCode . ".json";
        if (Storage::exists('bieu3/'.$name_json)) {
            $file = File::get(storage_path('app/bieu3/' . $name_json));
            return view('web/bieu/bieu3', json_decode($file, true));
        } else {
            $rtn = $this->sumDtichBy3LR($regionCol, $regionCode, 1, 59);
            $rtr = $this->sumDtichBy3LR($regionCol, $regionCode, 60, 71);
            $trongChuaThanhRung = $this->sumDtichBy3LR($regionCol, $regionCode, 72, 77);
            $khoanhNuoiTaiSinh = $this->sumDtichBy3LR($regionCol, $regionCode, 78, 81);
            $dtichKhac = $this->sumDtichBy3LR($regionCol, $regionCode, 82, 93);

            $sum_rtn = array();
            for ($i = 0; $i < 11; $i++) {
                $total_rtn = $rtn[$i][0] + $rtn[$i][1] + $rtn[$i][2] + $rtn[$i][6];
                array_push($sum_rtn, $total_rtn);
            }

            $sum_rtr = array();
            for ($i = 0; $i < 11; $i++) {
                $total_rtr = $rtr[$i][0] + $rtr[$i][1] + $rtr[$i][2] + $rtr[$i][6];
                array_push($sum_rtr, $total_rtr);
            }

            $sum_trongChuaThanhRung = array();
            for ($i = 0; $i < 11; $i++) {
                $total_trongChuaThanhRung = $trongChuaThanhRung[$i][0] + $trongChuaThanhRung[$i][1] + $trongChuaThanhRung[$i][2] + $trongChuaThanhRung[$i][6];
                array_push($sum_trongChuaThanhRung, $total_trongChuaThanhRung);
            }

            $sum_khoanhNuoiTaiSinh = array();
            for ($i = 0; $i < 11; $i++) {
                $total_khoanhNuoiTaiSinh = $khoanhNuoiTaiSinh[$i][0] + $khoanhNuoiTaiSinh[$i][1] + $khoanhNuoiTaiSinh[$i][2] + $khoanhNuoiTaiSinh[$i][6];
                array_push($sum_khoanhNuoiTaiSinh, $total_khoanhNuoiTaiSinh);
            }

            $sum_dtichKhac = array();
            for ($i = 0; $i < 11; $i++) {
                $total_dtichKhac = $dtichKhac[$i][0] + $dtichKhac[$i][1] + $dtichKhac[$i][2] + $dtichKhac[$i][6];
                array_push($sum_dtichKhac, $total_dtichKhac);
            }

            $sum_dtichCoRung = array();
            for ($i = 0; $i < 11; $i++) {
                $total_dtichCoRung = $sum_rtn[$i] + $sum_rtr[$i];
                array_push($sum_dtichCoRung, $total_dtichCoRung);
            }

            $sum_dtichChuaCoRung = array();
            for ($i = 0; $i < 11; $i++) {
                $total_dtichChuaCoRung = $sum_trongChuaThanhRung[$i] + $sum_khoanhNuoiTaiSinh[$i] + $sum_dtichKhac[$i];
                array_push($sum_dtichChuaCoRung, $total_dtichChuaCoRung);
            }

            $sum_Total_Final = array();
            for ($i = 0; $i < 11; $i++) {
                $total_Final = $sum_dtichCoRung[$i] + $sum_dtichChuaCoRung[$i];
                array_push($sum_Total_Final, $total_Final);
            }

            $render_rtn = $this->reform($rtn);
            $render_rtr = $this->reform($rtr);
            $render_chuathanhrung = $this->reform($trongChuaThanhRung);
            $render_nuoitaisinh = $this->reform($khoanhNuoiTaiSinh);
            $render_dtichkhac = $this->reform($dtichKhac);
            $res = ['total' => $sum_Total_Final, 'tong_dtcorung' => $sum_dtichCoRung, 'rtn' => $sum_rtn, 'data_rtn' => $render_rtn, 'rungtrong' => $sum_rtr, 'data_rtr' => $render_rtr, 'tong_chuathanhrung' => $sum_dtichChuaCoRung, 'sum_dtchuathanhrung' => $sum_trongChuaThanhRung, 'data_chuathanhrung' => $render_chuathanhrung, 'sum_dtchuataisinh' => $sum_khoanhNuoiTaiSinh, 'data_taisinh' => $render_nuoitaisinh, 'sum_dtichkhac' => $sum_dtichKhac, 'data_dtichkhac' => $render_dtichkhac];
            Storage::put('bieu3/' . $name_json, json_encode($res));
            return view('web/bieu/bieu3', $res);
        }


    }

    public function reform($arr)
    {
        $reform = array();
        for ($j = 0; $j < 7; $j++) {
            $data = array();
            for ($i = 0; $i < 11; $i++) {
                array_push($data, $arr[$i][$j]);
            }
            array_push($reform, $data);
        }
        return $reform;
    }

    public function sumDtichBy3LR($regionCol, $regionCode, $min, $max)
    {
        /* San Xuat */
        $bql_rdd = $this->getDoiTuong('dtuong', 10, 'maldlr', $min, $max, $regionCol, $regionCode);
        $bql_rph = $this->getDoiTuong('dtuong', 4, 'maldlr', $min, $max, $regionCol, $regionCode);
        $dnnhanuoc = $this->getDoiTuong('dtuong', 5, 'maldlr', $min, $max, $regionCol, $regionCode);

        // Doanh nghiep ngoai quoc doanh
        $ctyLN = $this->getDoiTuong('dtuong', 6, 'maldlr', $min, $max, $regionCol, $regionCode);
        $dntunhan = $this->getDoiTuong('dtuong', 7, 'maldlr', $min, $max, $regionCol, $regionCode);
        $DnQuocDoanh = array();
        for ($i = 0; $i < count($ctyLN); $i++) {
            $sum = $ctyLN[$i] + $dntunhan[$i];
            array_push($DnQuocDoanh, $sum);
        }

        $dnNuocNgoai = $this->getDoiTuong('dtuong', 8, 'maldlr', $min, $max, $regionCol, $regionCode);
        $HGD = $this->getDoiTuong('dtuong', 1, 'maldlr', $min, $max, $regionCol, $regionCode);
        $CD = $this->getDoiTuong('dtuong', 2, 'maldlr', $min, $max, $regionCol, $regionCode);
        $DvVuTrang = $this->getDoiTuong('dtuong', 11, 'maldlr', $min, $max, $regionCol, $regionCode);
        $TcKhac = $this->getDoiTuong('dtuong', 9, 'maldlr', $min, $max, $regionCol, $regionCode);
        $UBND = $this->getDoiTuong('dtuong', 3, 'maldlr', $min, $max, $regionCol, $regionCode);

        $tong = array();
        for ($i = 0; $i < 7; $i++) {
            $total = $bql_rdd[$i] + $bql_rph[$i] + $dnnhanuoc[$i] + $DnQuocDoanh[$i] + $dnNuocNgoai[$i] + $HGD[$i] + $CD[$i] + $DvVuTrang[$i] + $TcKhac[$i] + $UBND[$i];
            array_push($tong, $total);
        }

        $data = array();
        array_push($data, $tong);
        array_push($data, $bql_rdd);
        array_push($data, $bql_rph);
        array_push($data, $dnnhanuoc);
        array_push($data, $DnQuocDoanh);
        array_push($data, $dnNuocNgoai);
        array_push($data, $HGD);
        array_push($data, $CD);
        array_push($data, $DvVuTrang);
        array_push($data, $TcKhac);
        array_push($data, $UBND);
        return $data;
    }


    public function getDoiTuong($ten, $ma, $rangeLdlr, $min, $max, $regionCol, $regionCode)
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
