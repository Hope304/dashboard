<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use DateTimeZone;
use App\dbr;
use DB;
use App\Hotspot;
use GuzzleHttp\Client;
use App\receiveEmail;

class GetHotspotController extends Controller
{
    public function getHotspot()
    {
        $listAPI = $this->getAPIList();
        $push_data = array();
        foreach ($listAPI as $file_url) {
            $listDataHotspot = $this->getData($file_url);
            if(isset($listDataHotspot))
            {
                $data =  str_replace('"', '', trim(json_encode($listDataHotspot)));

                $spData = explode('\n', $data);

                if(count($spData) > 1){
                    for($i = 1; $i < count($spData); $i++)
                    {
                        $hotSpot = explode(',', $spData[$i]);
                        if (count($hotSpot) == 13){
                            $d = $this->convertDateTime($hotSpot[5]." ".$hotSpot[6]);
                            // $time_now = date('Y-m-d H:i', strtotime('+6 hour ago'));
                            $time_now = "2021-08-02 18:00";
                            if($d >= $time_now && $hotSpot[0] > 19.840352 && $hotSpot[0] <20.483628 && $hotSpot[1] > 105.460510 && $hotSpot[1] <106.221313)
                            {
                                array_push($push_data,$hotSpot);
                            }
                        }
                    }
                }
            }
        }

        $tableName = "ninhbinh_dbr_2020";
        for($i = 0; $i < count($push_data); $i++){
            $lat = $push_data[$i][0];
            $lon = $push_data[$i][1];
            $dt_convert = $this->convertDateTime($push_data[$i][5]." ".$push_data[$i][6]);
            $acq_date = explode(" ",$dt_convert)[0];
            $acq_time = explode(" ",$dt_convert)[1];

            $data = DB::select("select gid,maxa,tk,khoanh,lo,ldlr, maldlr, churung from ".$tableName." where ST_Intersects(".$tableName.".geom, 'SRID=4326;POINT(".$lon." ".$lat.")'::geography)");
            if(count($data) > 0){
                $checkExsit = Hotspot::where('latitude', $lat)->where('longitude', $lon)->where('acq_date', $acq_date)->where('acq_time', $acq_time)->get();
                if(count($checkExsit) == 0){
                    $new = new Hotspot();
                    $new->maxa = $data[0]->maxa;
                    $new->tk = $data[0]->tk;
                    $new->khoanh = $data[0]->khoanh;
                    $new->lo = $data[0]->lo;
                    $new->ldlr = $data[0]->ldlr;
                    $new->maldlr = $data[0]->maldlr;
                    $new->churung = $data[0]->churung;
                    $new->longitude = $push_data[$i][1];
                    $new->latitude = $push_data[$i][0];
                    $new->brightness = $push_data[$i][2];
                    $new->scan = $push_data[$i][3];
                    $new->track = $push_data[$i][4];
                    $new->acq_date = $acq_date;
                    $new->acq_time = $acq_time;
                    $new->satellite = $push_data[$i][7];
                    $new->confidence = $push_data[$i][8];
                    $new->version = $push_data[$i][9];
                    $new->bright_t31 = $push_data[$i][10];
                    $new->daynight = $push_data[$i][11];
                    $new->save();

                    /* Send Email */
                }
            }
            set_time_limit(180);
        }

        return "Success";
    }

    public function convertDateTime($date, $format = 'Y-m-d H:i')
    {
        $tz1 = 'UTC';
        $tz2 = 'Asia/Ho_Chi_Minh'; // UTC +7

        $d = new DateTime($date, new DateTimeZone($tz1));
        $d->setTimeZone(new DateTimeZone($tz2));

        return $d->format($format);
    }


    public function getData($url)
    {
        $curl = curl_init();
        $array_option = [
            CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_POSTFIELDS => "{}",
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE),
            CURLOPT_HTTPHEADER => ['Authorization: Bearer a2hvY2RpY29uMTIzOmEyaHZZMlJwWTI5dU1USXpRR2R0WVdsc0xtTnZiUT09OjE2MjcwMTAxNDQ6NjIwMjc5ZmYxYzU5NmI3MzJjMTI4ZTMxOTM3MTQzOTAzMGRkMDY2ZQ']
        ];
        curl_setopt_array($curl, $array_option);
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        set_time_limit(180);
        if ($httpCode == 200) {
            return $response;
        }
    }


    public function getAPIList()
    {
        $toDayNum = $this->getJulianDay();
        $year = date("Y");
        $listAPI = [
            "https://nrt4.modaps.eosdis.nasa.gov/api/v2/content/archives/FIRMS/c6/SouthEast_Asia/MODIS_C6_SouthEast_Asia_MCD14DL_NRT_" . $year . $toDayNum . ".txt",
            "https://nrt4.modaps.eosdis.nasa.gov/api/v2/content/archives/FIRMS/modis-c6.1/SouthEast_Asia/MODIS_C6_1_SouthEast_Asia_MCD14DL_NRT_" . $year . $toDayNum . ".txt",
            "https://nrt4.modaps.eosdis.nasa.gov/api/v2/content/archives/FIRMS/noaa-20-viirs-c2/SouthEast_Asia/J1_VIIRS_C2_SouthEast_Asia_VJ114IMGTDL_NRT_" . $year . $toDayNum . ".txt",
            "https://nrt4.modaps.eosdis.nasa.gov/api/v2/content/archives/FIRMS/suomi-npp-viirs-c2/SouthEast_Asia/SUOMI_VIIRS_C2_SouthEast_Asia_VNP14IMGTDL_NRT_" . $year . $toDayNum . ".txt",
            "https://nrt4.modaps.eosdis.nasa.gov/api/v2/content/archives/FIRMS/viirs/SouthEast_Asia/VIIRS_I_SouthEast_Asia_VNP14IMGTDL_NRT_" . $year . $toDayNum . ".txt",
            "https://nrt4.modaps.eosdis.nasa.gov/api/v2/content/archives/FIRMS/c6/SouthEast_Asia/MODIS_C6_SouthEast_Asia_MCD14DL_NRT_" . $year . ($toDayNum - 1) . ".txt",
            "https://nrt4.modaps.eosdis.nasa.gov/api/v2/content/archives/FIRMS/modis-c6.1/SouthEast_Asia/MODIS_C6_1_SouthEast_Asia_MCD14DL_NRT_" . $year . ($toDayNum - 1) . ".txt",
            "https://nrt4.modaps.eosdis.nasa.gov/api/v2/content/archives/FIRMS/noaa-20-viirs-c2/SouthEast_Asia/J1_VIIRS_C2_SouthEast_Asia_VJ114IMGTDL_NRT_" . $year . ($toDayNum - 1) . ".txt",
            "https://nrt4.modaps.eosdis.nasa.gov/api/v2/content/archives/FIRMS/suomi-npp-viirs-c2/SouthEast_Asia/SUOMI_VIIRS_C2_SouthEast_Asia_VNP14IMGTDL_NRT_" . $year . ($toDayNum - 1) . ".txt",
            "https://nrt4.modaps.eosdis.nasa.gov/api/v2/content/archives/FIRMS/viirs/SouthEast_Asia/VIIRS_I_SouthEast_Asia_VNP14IMGTDL_NRT_" . $year . ($toDayNum - 1) . ".txt"
        ];
        return $listAPI;
    }

    public function getJulianDay()
    {
        $date = new DateTime();
        return $date->format('z') + 1;
    }
}
