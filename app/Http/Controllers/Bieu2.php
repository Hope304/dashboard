<?php

namespace App\Http\Controllers;

use App\dbr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Bieu2 extends Controller
{
    public function getData($region, $regionCode)
    {
        $regionCol = $region;
        $regionCode = $regionCode;

        $name_json = $regionCol . "_" . $regionCode . ".json";
        if (Storage::exists('bieu2/'.$name_json)) {
            $file = File::get(storage_path('app/bieu2/' . $name_json));
            return view('web/bieu/bieu2', json_decode($file, true));
        } else {
            $rtn_go = $this->sumDtichBy3LR($regionCol, $regionCode, 1, 56, 'mgolo');
            $rtr_go = $this->sumDtichBy3LR($regionCol, $regionCode, 60, 64, 'mgolo');
            $rtn_trenua = $this->sumDtichBy3LR($regionCol, $regionCode, 48, 59, 'mtnlo');
            $rtr_trenua = $this->sumDtichBy3LR($regionCol, $regionCode, 65, 71, 'mtnlo');

            $sum_rtn_go = array();
            for ($i = 0; $i < 14; $i++) {
                $total_rtn = $rtn_go[$i][0] + $rtn_go[$i][1] + $rtn_go[$i][2] + $rtn_go[$i][6];
                array_push($sum_rtn_go, $total_rtn);
            }

            $sum_rtr_go = array();
            for ($i = 0; $i < 14; $i++) {
                $total_rtr = $rtr_go[$i][0] + $rtr_go[$i][1] + $rtr_go[$i][2] + $rtr_go[$i][6];
                array_push($sum_rtr_go, $total_rtr);
            }

            $sum_rtn_trenua = array();
            for ($i = 0; $i < 14; $i++) {
                $total_trongChuaThanhRung = $rtn_trenua[$i][0] + $rtn_trenua[$i][1] + $rtn_trenua[$i][2] + $rtn_trenua[$i][6];
                array_push($sum_rtn_trenua, $total_trongChuaThanhRung);
            }

            $sum_rtr_trenua = array();
            for ($i = 0; $i < 14; $i++) {
                $total_khoanhNuoiTaiSinh = $rtr_trenua[$i][0] + $rtr_trenua[$i][1] + $rtr_trenua[$i][2] + $rtr_trenua[$i][6];
                array_push($sum_rtr_trenua, $total_khoanhNuoiTaiSinh);
            }


            $sum_go = array();
            for ($i = 0; $i < 14; $i++) {
                $total_dtichCoRung = $sum_rtn_go[$i] + $sum_rtr_go[$i];
                array_push($sum_go, $total_dtichCoRung);
            }

            $sum_trenua = array();
            for ($i = 0; $i < 14; $i++) {
                $total_dtichChuaCoRung = $sum_rtn_trenua[$i] + $sum_rtr_trenua[$i];
                array_push($sum_trenua, $total_dtichChuaCoRung);
            }

            $sum_Total_Final = array();
            for ($i = 0; $i < 14; $i++) {
                $total_Final = $sum_go[$i] + $sum_trenua[$i];
                array_push($sum_Total_Final, $total_Final);
            }

            $render_rtn_go = $this->reform($rtn_go);
            $render_rtr_go = $this->reform($rtr_go);
            $render_rtn_trenua = $this->reform($rtn_trenua);
            $render_rtr_trenua = $this->reform($rtr_trenua);

            $res = ['total' => $sum_Total_Final, 'tong_go' => $sum_go, 'rtn_go' => $sum_rtn_go, 'data_rtn_go' => $render_rtn_go, 'rtr_go' => $sum_rtr_go, 'data_rtr_go' => $render_rtr_go, 'tong_trenua' => $sum_trenua, 'rtn_trenua' => $sum_rtn_trenua, 'data_rtn_trenua' => $render_rtn_trenua, 'rtr_trenua' => $sum_rtr_trenua, 'data_rtr_trenua' => $render_rtr_trenua];
            Storage::put('bieu2/' . $name_json, json_encode($res));
            return view('web/bieu/bieu2', $res);
        }


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

    public function sumDtichBy3LR($regionCol, $regionCode, $min, $max, $truluong)
    {
        /* San Xuat */
        $data_rsx = $this->getLapDia('malr3', 3, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);

        /* Dac Dung */
        $data_dd_vqg = $this->getLapDia('mamdsd', 5, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $data_dd_kbt = $this->getLapDia('mamdsd', 6, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $data_dd_knc = $this->getLapDia('mamdsd', 7, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $data_dd_kcq = $this->getLapDia('mamdsd', 8, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $data_dd_sum = array();
        for ($i = 0; $i < 7; $i++) {
            $total_dd = $data_dd_vqg[$i] + $data_dd_kbt[$i] + $data_dd_knc[$i] + $data_dd_kcq[$i];
            array_push($data_dd_sum, $total_dd);
        }

        /* PHONG HO */
        $data_ph_daunguon = $this->getLapDia('mamdsd', 1, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $data_ph_changio = $this->getLapDia('mamdsd', 3, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $data_ph_chansong = $this->getLapDia('mamdsd', 2, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
        $data_ph_bvmt = $this->getLapDia('mamdsd', 4, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);
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
        $data_nqh = $this->getLapDia('nqh', 1, 'maldlr', $min, $max, $regionCol, $regionCode, $truluong);

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


    public function getLapDia($ten, $ma, $rangeLdlr, $min, $max, $regionCol, $regionCode, $truluong)
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
