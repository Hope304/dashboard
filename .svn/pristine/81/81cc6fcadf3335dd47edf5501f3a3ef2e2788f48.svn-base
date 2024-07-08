<?php

namespace App\Http\Controllers;

use App\dbr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Bieu6 extends Controller
{
    public function getData($region, $regionCode)
    {
        $regionCol = $region;
        $regionCode = $regionCode;

        $name_json = $regionCol . "_" . $regionCode . ".json";
        if (Storage::exists('bieu6/'.$name_json)) {
            $file = File::get(storage_path('app/bieu6/' . $name_json));
            return view('web/bieu/bieu6', json_decode($file, true));
        } else {
            $district = dbr::select('sldlr')->where($regionCol, $regionCode)->where('sldlr', '<>', '')->distinct()->get();

            $data_final = array();
            for ($i = 0; $i < count($district); $i++) {
                $data = array();
                $loai = $district[$i]->sldlr;

                //cap tuoi
                $c1 = dbr::where('sldlr', $district[$i]->sldlr)->where('captuoi', 1)->whereBetween('maldlr', [60, 71])->sum('dtich');
                $c2 = dbr::where('sldlr', $district[$i]->sldlr)->where('captuoi', 2)->whereBetween('maldlr', [60, 71])->sum('dtich');
                $c3 = dbr::where('sldlr', $district[$i]->sldlr)->where('captuoi', 3)->whereBetween('maldlr', [60, 71])->sum('dtich');
                $c4 = dbr::where('sldlr', $district[$i]->sldlr)->where('captuoi', 4)->whereBetween('maldlr', [60, 71])->sum('dtich');
                $c5 = dbr::where('sldlr', $district[$i]->sldlr)->where('captuoi', 5)->whereBetween('maldlr', [60, 71])->sum('dtich');

                $tong_dttr = $c1 + $c2 + $c3 + $c4 + $c5;

                //dtich chua thanh rung
                $tong_dtctr = dbr::where('sldlr', $district[$i]->sldlr)->whereBetween('maldlr', [72, 81])->sum('dtich');;
                // tong dtich rung trong

                $tong_dtich = $tong_dttr + $tong_dtctr;

                array_push($data, $loai);
                array_push($data, $tong_dtich);
                array_push($data, $tong_dttr);
                array_push($data, $c1);
                array_push($data, $c2);
                array_push($data, $c3);
                array_push($data, $c4);
                array_push($data, $c5);
                array_push($data, $tong_dtctr);

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
            Storage::put('bieu6/' . $name_json, json_encode($res));
            return view('web/bieu/bieu6', $res);
        }
    }
}
