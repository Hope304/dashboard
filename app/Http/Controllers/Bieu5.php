<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\dbr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Bieu5 extends Controller
{
    public function getData($region, $regionCode)
    {
        $regionCol = $region;
        $regionCode = $regionCode;
        if ($regionCol == 'matinh') {
            $codeColRegion = 'mahuyen';
            $colRegion = 'huyen';
        } else {
            $codeColRegion = 'maxa';
            $colRegion = 'xa';
        }

        $name_json = $codeColRegion . "_" . $regionCode . ".json";
        if (Storage::exists('bieu5/'.$name_json)) {
            $file = File::get(storage_path('app/bieu5/' . $name_json));
            return view('web/bieu/bieu5', json_decode($file, true));
        } else {
            $district = dbr::select($codeColRegion, $colRegion)->where($regionCol, $regionCode)->distinct()->get();
            $data_final = array();


            for ($i = 0; $i < count($district); $i++) {
                $data = array();
                $huyen = $district[$i]->$colRegion;

                //theo nguon goc
                $rtn = dbr::where($codeColRegion, $district[$i]->$codeColRegion)->whereBetween('maldlr', [1, 59])->sum('dtich');
                $rtr = dbr::where($codeColRegion, $district[$i]->$codeColRegion)->whereBetween('maldlr', [60, 71])->sum('dtich');

                //theo 3lr
                $rdd = dbr::where($codeColRegion, $district[$i]->$codeColRegion)->where('malr3', 2)->sum('dtich');
                $rph = dbr::where($codeColRegion, $district[$i]->$codeColRegion)->where('malr3', 1)->sum('dtich');
                $rsx = dbr::where($codeColRegion, $district[$i]->$codeColRegion)->where('malr3', 3)->sum('dtich');

                //ngoai quy hoach
                $ngoaiquyhoach = dbr::where($codeColRegion, $district[$i]->$codeColRegion)->where('nqh', 1)->sum('dtich');

                $tong_nguongoc = $rdd + $rph + $rsx;
                $tong_dtich = $tong_nguongoc + $ngoaiquyhoach;

                array_push($data, $huyen);
                array_push($data, $tong_dtich);
                array_push($data, $tong_nguongoc);
                array_push($data, $rtn);
                array_push($data, $rtr);
                array_push($data, $rdd);
                array_push($data, $rph);
                array_push($data, $rsx);
                array_push($data, $ngoaiquyhoach);

                array_push($data_final, $data);
            }

            $tong_final = array();
            for ($i = 1; $i <= 8; $i++) {
                $tong = 0;
                for ($j = 0; $j < count($data_final); $j++) {
                    $tong += $data_final[$j][$i];
                }

                array_push($tong_final, $tong);
            }

            $res = ['tong' => $tong_final, 'data' => $data_final];
            Storage::put('bieu5/' . $name_json, json_encode($res));
            return view('web/bieu/bieu5', $res);
        }
    }
}
