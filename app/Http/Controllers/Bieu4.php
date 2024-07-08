<?php

namespace App\Http\Controllers;

use App\dbr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Bieu4 extends Controller
{
    public function getData($region, $regionCode)
    {
        $regionCol = $region;
        $regionCode = $regionCode;

        $name_json = $regionCol . "_" . $regionCode . ".json";
        if (Storage::exists('bieu4/'.$name_json)) {
            $file = File::get(storage_path('app/bieu4/' . $name_json));
            return view('web/bieu/bieu4', json_decode($file, true));
        } else {
            $rtn_go = $this->sumDtichBy3LR($regionCol, $regionCode, 1, 56, 'mgolo');
            $rtr_go = $this->sumDtichBy3LR($regionCol, $regionCode, 60, 64, 'mgolo');
            $rtn_trenua = $this->sumDtichBy3LR($regionCol, $regionCode, 48, 59, 'mtnlo');
            $rtr_trenua = $this->sumDtichBy3LR($regionCol, $regionCode, 65, 71, 'mtnlo');

            $sum_rtn_go = array();
            for ($i = 0; $i < 11; $i++) {
                $total_rtn = $rtn_go[$i][0] + $rtn_go[$i][1] + $rtn_go[$i][2] + $rtn_go[$i][6];
                array_push($sum_rtn_go, $total_rtn);
            }

            $sum_rtr_go = array();
            for ($i = 0; $i < 11; $i++) {
                $total_rtr = $rtr_go[$i][0] + $rtr_go[$i][1] + $rtr_go[$i][2] + $rtr_go[$i][6];
                array_push($sum_rtr_go, $total_rtr);
            }

            $sum_rtn_trenua = array();
            for ($i = 0; $i < 11; $i++) {
                $total_trongChuaThanhRung = $rtn_trenua[$i][0] + $rtn_trenua[$i][1] + $rtn_trenua[$i][2] + $rtn_trenua[$i][6];
                array_push($sum_rtn_trenua, $total_trongChuaThanhRung);
            }

            $sum_rtr_trenua = array();
            for ($i = 0; $i < 11; $i++) {
                $total_khoanhNuoiTaiSinh = $rtr_trenua[$i][0] + $rtr_trenua[$i][1] + $rtr_trenua[$i][2] + $rtr_trenua[$i][6];
                array_push($sum_rtr_trenua, $total_khoanhNuoiTaiSinh);
            }


            $sum_go = array();
            for ($i = 0; $i < 11; $i++) {
                $total_dtichCoRung = $sum_rtn_go[$i] + $sum_rtr_go[$i];
                array_push($sum_go, $total_dtichCoRung);
            }

            $sum_trenua = array();
            for ($i = 0; $i < 11; $i++) {
                $total_dtichChuaCoRung = $sum_rtn_trenua[$i] + $sum_rtr_trenua[$i];
                array_push($sum_trenua, $total_dtichChuaCoRung);
            }

            $sum_Total_Final = array();
            for ($i = 0; $i < 11; $i++) {
                $total_Final = $sum_go[$i] + $sum_trenua[$i];
                array_push($sum_Total_Final, $total_Final);
            }

            $render_rtn_go = $this->reform($rtn_go);
            $render_rtr_go = $this->reform($rtr_go);
            $render_rtn_trenua = $this->reform($rtn_trenua);
            $render_rtr_trenua = $this->reform($rtr_trenua);
            $res = ['total' => $sum_Total_Final, 'tong_go' => $sum_go, 'rtn_go' => $sum_rtn_go, 'data_rtn_go' => $render_rtn_go, 'rtr_go' => $sum_rtr_go, 'data_rtr_go' => $render_rtr_go, 'tong_trenua' => $sum_trenua, 'rtn_trenua' => $sum_rtn_trenua, 'data_rtn_trenua' => $render_rtn_trenua, 'rtr_trenua' => $sum_rtr_trenua, 'data_rtr_trenua' => $render_rtr_trenua];
            Storage::put('bieu4/' . $name_json, json_encode($res));
            return view('web/bieu/bieu4', $res);
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

    public function sumDtichBy3LR($regionCol, $regionCode, $min, $max, $truluong)
    {
        $bql_rdd = $this->getDoiTuong('dtuong', 10, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $bql_rph = $this->getDoiTuong('dtuong', 4, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $dnnhanuoc = $this->getDoiTuong('dtuong', 5, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);

        // Doanh nghiep ngoai quoc doanh
        $ctyLN = $this->getDoiTuong('dtuong', 6, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $dntunhan = $this->getDoiTuong('dtuong', 7, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $DnQuocDoanh = array();
        for ($i = 0; $i < count($ctyLN); $i++) {
            $sum = $ctyLN[$i] + $dntunhan[$i];
            array_push($DnQuocDoanh, $sum);
        }

        $dnNuocNgoai = $this->getDoiTuong('dtuong', 8, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $HGD = $this->getDoiTuong('dtuong', 1, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $CD = $this->getDoiTuong('dtuong', 2, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $DvVuTrang = $this->getDoiTuong('dtuong', 11, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $TcKhac = $this->getDoiTuong('dtuong', 9, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $UBND = $this->getDoiTuong('dtuong', 3, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);

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


    public function getDoiTuong($ten, $ma, $rangeLdlr, $min, $max, $regionCol, $regionCode, $truluong)
    {
        $trennuidat = dbr::where('lapdia', 1)
            ->where($regionCol, $regionCode)
            ->where($ten, $ma)
            ->whereBetween($rangeLdlr, [$min, $max])
            ->sum($truluong);

        $trennuida = dbr::where('lapdia', 2)
            ->where($regionCol, $regionCode)
            ->where($ten, $ma)
            ->whereBetween($rangeLdlr, [$min, $max])
            ->sum($truluong);

        $ngapman = dbr::where('lapdia', 3)
            ->where($regionCol, $regionCode)
            ->where($ten, $ma)
            ->whereBetween($rangeLdlr, [$min, $max])
            ->sum($truluong);

        $ngapphen = dbr::where('lapdia', 4)
            ->where($regionCol, $regionCode)
            ->where($ten, $ma)
            ->whereBetween($rangeLdlr, [$min, $max])
            ->sum($truluong);

        $ngapngot = dbr::where('lapdia', 5)
            ->where($regionCol, $regionCode)
            ->where($ten, $ma)
            ->whereBetween($rangeLdlr, [$min, $max])
            ->sum($truluong);

        $baicat = dbr::where('lapdia', 6)
            ->where($regionCol, $regionCode)
            ->where($ten, $ma)
            ->whereBetween($rangeLdlr, [$min, $max])
            ->sum($truluong);

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
