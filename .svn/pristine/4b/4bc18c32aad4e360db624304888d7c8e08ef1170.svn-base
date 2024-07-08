<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Commune;
use App\Weather;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpWord\Element\TextRun;
use Mail;
use App\dbr;
use App\receiveEmail;
use DateTime;
use DateTimeZone;
use DB;
use App\Hotspot;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use Webklex\PHPIMAP\ClientManager;
use App\BienCanhBaoChay;
use DOMDocument;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [];

    public function getIndex()
    {
        set_time_limit(600);
        $listCommune = Commune::all();
        $now_check = Date('Y-m-d');
        $date_ago = date('Y-m-d', strtotime(' -1 day'));
        foreach ($listCommune as $list) {

            $check = Weather::where('maxa', $list->maxa)->where('thoigian', $now_check)->get();
            if (count($check) == 0) {
                $data['maxa'] = $list->maxa;
                $data['mahuyen'] = $list->mahuyen;
                /* Key WetherAPI: d49e926c1ad54c6da4511634233101 */
                $url_now = "http://api.weatherapi.com/v1/history.json?key=edcfdbfb15b14f45b9464743230505&q=" . trim($list->vd) . "," . trim($list->kd) . "&dt=" . $now_check;
                $data_weather = $this->execute($url_now);
                $sum_luongmua_0h_13h = 0;
                for ($i = 0; $i < 14; $i++) {
                    if (isset($data_weather->forecast->forecastday[0]->hour[$i]->precip_mm)) {
                        $sum_luongmua_0h_13h += $data_weather->forecast->forecastday[0]->hour[$i]->precip_mm;
                    }
                }

                $sum_luongmua_13h_0h_ago = 0;
                $url_ago = "http://api.weatherapi.com/v1/history.json?key=edcfdbfb15b14f45b9464743230505&q=" . trim($list->vd) . "," . trim($list->kd) . "&dt=" . $date_ago;
                $data_weather_ago = $this->execute($url_ago);

                for ($i = 14; $i < 25; $i++) {
                    if (isset($data_weather_ago->forecast->forecastday[0]->hour[$i]->precip_mm)) {
                        $sum_luongmua_13h_0h_ago += $data_weather_ago->forecast->forecastday[0]->hour[$i]->precip_mm;
                    }
                }

                $data['luongmua'] = $sum_luongmua_13h_0h_ago + $sum_luongmua_0h_13h;
                $data['thoigian'] = $now_check;
                if (isset($data_weather->forecast->forecastday[0])) {
                    $data['nhietdo'] = $data_weather->forecast->forecastday[0]->hour[13]->temp_c;
                    $data['doam'] = $data_weather->forecast->forecastday[0]->hour[13]->humidity;
                    $data['tocdogio'] = $data_weather->forecast->forecastday[0]->hour[13]->wind_kph;
                    $data['huonggio'] = $data_weather->forecast->forecastday[0]->hour[13]->wind_degree;
                    $E = 6.1 * pow(10, ((7.6 * $data_weather->forecast->forecastday[0]->hour[13]->temp_c) / (242 + $data_weather->forecast->forecastday[0]->hour[13]->temp_c)));
                    $d = (100 - $data_weather->forecast->forecastday[0]->hour[13]->humidity) / 100 * $E;
                    $data['csp'] = 0;
                    $data['capncc'] = 1;
                    $data['d'] = $d;
                    Weather::insert($data);
                }
            }
        }
        $this->updateDaily($listCommune);
    }

    public function updateDaily($listCommune)
    {
        foreach ($listCommune as $list) {
            $maxa = $list->maxa;
            $this->calculateWarningLevel($maxa);
        }
    }


    public function calculateWarningLevel($maxa)
    {
        $dateTime = date('Y-m-d');
        $date_ago = date('Y-m-d', strtotime(' -1 day'));

        $Data_New = Weather::where('maxa', $maxa)->where('thoigian', $dateTime)->first();

        if (isset($Data_New)) {
            $Data_Old = Weather::where('maxa', $maxa)->where('id', '<', $Data_New->id)->orderBy('id', 'desc')->first();
            if (isset($Data_Old)) {
                $old_p = $Data_Old->csp;
            } else {
                $old_p = 0;
            }

            $now_p = $Data_New->nhietdo * $Data_New->d;
            $p = $old_p + $now_p;

            if ($p >= 0 && $p <= 1000) {
                $level = 1;
            } else if ($p > 1000 && $p < 2500) {
                $level = 2;
            } else if ($p > 2500 && $p < 5000) {
                $level = 3;
            } else if ($p > 5000 && $p < 10000) {
                $level = 4;
            } else {
                $level = 5;
            }

            $infoUpdate = Weather::where('maxa', $maxa)->where('thoigian', $dateTime)->first();

            $dateTimeAgo = "'" . date('Y-m-d', strtotime(' +1 day')) . "'";
            $dateAgo = Weather::where('maxa', $maxa)->where('thoigian', $dateTimeAgo)->first();

            // Tinh ngay khong mua lien tiep
            if (isset($dateAgo)) {
                $dayRain3Xa = $dateAgo->dayrain3;

                if ($infoUpdate->luongmua > 0 && $infoUpdate->luongmua < 5) {
                    $dayRain3Xa =  $dayRain3Xa + 1;
                } else {
                    $dayRain3Xa = 0;
                }
            } else {
                $dayRain3Xa = 0;
            }

            if ($infoUpdate->luongmua >= 5 || $dayRain3Xa >= 3) {
                $infoUpdate->csp = 0;
                $infoUpdate->capncc = 1;
            } else {
                $infoUpdate->csp = $p;
                $infoUpdate->capncc = $level;
            }

            $infoUpdate->save();
        }
    }

    public function execute($url)
    {
        $curl = curl_init();
        $data = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        );
        curl_setopt_array($curl, $data);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }
	
	public function pushNotification($url, $dataPost = [], $method = 'POST')
    {
        $result = false;
        try {
            $client = new Client();
            $result = $client->request($method, $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'key=AAAAJc1t7_k:APA91bFYJkx6oU1_mQb3KC6vaSfJr8Vlls5uHOUD4cqa55Pmjko3gfkheFoDKPS2AFlvJZXUa-lKJxQlN_E-0FXFmcutfbhvbgVXVdEI4fwiOMr7Tcm2UToiVGbom5qPh52lVC5KZ1FG',
                ],
                'json' => $dataPost,
                'timeout' => 300,
            ]);
            $result = $result->getStatusCode() == Response::HTTP_OK;
        } catch (Exception $e) {
            Log::debug($e);
        }

        return $result;
    }

    public function sendEmail()
    {
        $time_now = now()->format('Y-m-d');
        $data = Weather::where('thoigian', $time_now)->orderBy('maxa')->get();
        $fileName = 'Temp_HaNam_' . $time_now . '.xlsx';
        $lb_A2 = 'DỮ LIỆU KHÍ TƯỢNG VÀ CẤP NGUY CƠ CHÁY TỈNH HÀ NAM NGÀY ' . Date('d-m-Y');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hệ thống giám sát, cảnh báo cháy rừng Hà Nam - Công ty CPTM Xuân Mai Green');
        $sheet->setCellValue('A2', $lb_A2);
        $sheet->setCellValue('A3', 'Mã huyện');
        $sheet->setCellValue('B3', 'Huyện');
        $sheet->setCellValue('C3', 'Mã xã');
        $sheet->setCellValue('D3', 'Xã');
        $sheet->setCellValue('E3', 'Thời gian');
        $sheet->setCellValue('F3', 'Nhiệt độ');
        $sheet->setCellValue('G3', 'Độ ẩm');
        $sheet->setCellValue('H3', 'Tốc độ gió');
        $sheet->setCellValue('I3', 'Hướng gió');
        $sheet->setCellValue('J3', 'Lượng mưa');
        $sheet->setCellValue('K3', 'Chỉ số P');
        $sheet->setCellValue('L3', 'Cấp nguy cơ cháy');
        for ($i = 0; $i < count($data); $i++) {
            $mahuyen = $data[$i]->commune->district->mahuyen;
            $huyen = $data[$i]->commune->district->huyen;
            $maxa = $data[$i]->maxa;
            $xa = $data[$i]->commune->xa;
            $tg = $data[$i]->thoigian;
            $nd = $data[$i]->nhietdo;
            $da = $data[$i]->doam;
            $tdg = $data[$i]->tocdogio;
            $hg = $data[$i]->huonggio;
            $lm = $data[$i]->luongmua;
            $csp = number_format($data[$i]->csp, 2, ",", ".");
            $capncc = $data[$i]->capncc;
            $sheet->setCellValue('A' . ($i + 4), $mahuyen);
            $sheet->setCellValue('B' . ($i + 4), $huyen);
            $sheet->setCellValue('C' . ($i + 4), $maxa);
            $sheet->setCellValue('D' . ($i + 4), $xa);
            $sheet->setCellValue('E' . ($i + 4), $tg);
            $sheet->setCellValue('F' . ($i + 4), $nd);
            $sheet->setCellValue('G' . ($i + 4), $da);
            $sheet->setCellValue('H' . ($i + 4), $tdg);
            $sheet->setCellValue('I' . ($i + 4), $hg);
            $sheet->setCellValue('J' . ($i + 4), $lm);
            $sheet->setCellValue('K' . ($i + 4), $csp);
            $sheet->setCellValue('L' . ($i + 4), $capncc);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('public/weather/' . $fileName);

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load("public/weather/" . $fileName);
        $sheet = $spreadsheet->getSheet(0);
        $sheet->getStyle("A1:L1")->getFont()->setItalic(true);
        $sheet->mergeCells("A1:D1");
        $sheet->mergeCells("A2:L2");
        $nb = 1;
        foreach ($sheet->getRowIterator() as $row) {
            $nb++;
        }

        $sheet->getStyle('A3:L3')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('D8E4BC');

        $sheet->getStyle("K3:K$nb")
            ->getFont()
            ->getColor()->setARGB('7030A0');

        $sheet->getStyle("L3:L$nb")
            ->getFont()
            ->getColor()->setARGB('ff0000');

        $sheet->getColumnDimension("A")->setWidth(20);
        $sheet->getColumnDimension("B")->setWidth(35);
        $sheet->getColumnDimension("C")->setWidth(15);
        $sheet->getColumnDimension("D")->setWidth(35);
        $sheet->getColumnDimension("E")->setWidth(20);
        $sheet->getColumnDimension("F")->setWidth(18);
        $sheet->getColumnDimension("G")->setWidth(15);
        $sheet->getColumnDimension("H")->setWidth(15);
        $sheet->getColumnDimension("I")->setWidth(15);
        $sheet->getColumnDimension("J")->setWidth(20);
        $sheet->getColumnDimension("K")->setWidth(18);
        $sheet->getColumnDimension("L")->setWidth(25);

        $final = $nb - 1;
        $sheet->getStyle("A1:L1")->getAlignment()->setHorizontal('left');
        $sheet->getStyle("A2:L3")->getAlignment()->setHorizontal('center');
        $sheet->getStyle("A3:L$final")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('222d32'));
        $sheet->getStyle("A1:L3")->getFont()->setBold(true);
        $sheet->getStyle("A1:L$nb")->getFont()->setSize(13)->setName('Times New Roman');
        $sheet->getStyle("A4:A$nb")->getAlignment()->setHorizontal('center');
        $sheet->getStyle("B4:B$nb")->getAlignment()->setHorizontal('left');
        $sheet->getStyle("C4:C$nb")->getAlignment()->setHorizontal('center');
        $sheet->getStyle("D4:D$nb")->getAlignment()->setHorizontal('left');
        $sheet->getStyle("E4:E$nb")->getAlignment()->setHorizontal('center');
        $sheet->getStyle("F4:K$nb")->getAlignment()->setHorizontal('right');
        $sheet->getStyle("A1:L$nb")->getAlignment()->setVertical('center');
        $sheet->getStyle("L4:L$nb")->getAlignment()->setHorizontal('center');
        $fileName_final = 'HaNam_' . $time_now . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save("public/weather/" . $fileName_final);

        $subject = "Số liệu KT các mức cảnh báo cấp độ cháy rừng " . now()->format('d-m-Y');
        $Emails = receiveEmail::select('email')->where('firelevel', 1)->get();
        $trimEmail = array();
        foreach ($Emails as $item) {
            array_push($trimEmail, trim($item->email));
        }

        Mail::send('sendMail.mail', [], function ($mess) use ($subject, $fileName_final, $trimEmail) {
            $mess->to($trimEmail);
            $mess->to(['lesydoanh@ifee.edu.vn', 'phamquangduong@ifee.edu.vn', 'tranvanhai@ifee.edu.vn']);
            $mess->from('giamsatrunghanam@ifee.edu.vn', 'Hệ thống giám sát rừng tỉnh Hà Nam');
            $mess->subject($subject);
            $mess->attach('public/weather/' . $fileName_final);
        });

        return "SUCCESS";
    }

    public function updateDBR()
    {
        set_time_limit(0);
        $time_now = Date('Y-m-d');
        $data = Weather::select('maxa', 'capncc')->where('thoigian', $time_now)->get();

        $raw = "UPDATE hanam_dbr SET capchay = (CASE";
        foreach ($data as $item) {
            if ($item->capncc > 1) {
                $cap_fix = $item->capncc - 1;
            } else {
                $cap_fix = 1;
            }

            if ($item->capncc == 5) {
                $cap_fix_rt = 5;
            } else {
                $cap_fix_rt = $item->capncc + 1;
            }

            $raw .= " WHEN maxa = " . $item->maxa . " and maldlr >= 1 and maldlr <=13 THEN " . $cap_fix;
            $raw .= " WHEN maxa = " . $item->maxa . " and (sldlr like '%Thông%' or sldlr like '%thông%') THEN " . $cap_fix_rt;
            $raw .= " WHEN maxa = " . $item->maxa . " and (sldlr like '%Thong%' or sldlr like '%thong%') THEN " . $cap_fix_rt;
            $raw .= " WHEN maxa = " . $item->maxa . " and maldlr = 92 THEN 1";
            $raw .= " WHEN maxa = " . $item->maxa . " and lapdia >=3 and lapdia <=5 THEN 1";
			$raw .= " WHEN maxa = " . $item->maxa . " THEN " . $item->capncc;
        }
        $raw .= " END)";
        DB::update($raw);
        return "SUCCESS";
    }

    public function getHotspot()
    {
        set_time_limit(600);
        $push_data = array();
        $cm = new ClientManager($options = []);
        $client = $cm->make([
            'host' => 'imap.googlemail.com',
            'port' => 993,
            'encryption' => 'ssl',
            'validate_cert' => true,
            'username' => 'giamsatrunghanam@ifee.edu.vn',
            'password' => 'Hanam@123456',
            'protocol' => 'imap',
        ]);
        try {
            $client->connect();
            $Folder = $client->getFolder("INBOX");
            $Message = $Folder->query()->from('noreply@nasa.gov')->UNSEEN()->get();
            foreach ($Message as $msg) {
                $msg->setFlag(['Seen']);
                $attachments = $msg->getAttachments();
                foreach ($attachments as $attachment) {
                    if ($attachment->getExtension() == 'txt') {
                        $content = $attachment->getAttributes()['content'];
                        $data_str = trim($content);
                        $data_array = str_getcsv($data_str, "\n");
                        for ($i = 1; $i < count($data_array); $i++) {
                            $hotSpot = str_getcsv($data_array[$i], ",");
                            array_push($push_data, $hotSpot);
                        }
                    }
                }
            }

            $tableName = "hanam_dbr";
            for ($i = 0; $i < count($push_data); $i++) {
                set_time_limit(600);
                $lat = $push_data[$i][0];
                $lon = $push_data[$i][1];
                $dt_convert = $this->convertDateTime($push_data[$i][5] . " " . $push_data[$i][6]);
                $acq_date = explode(" ", $dt_convert)[0];
                $acq_time = explode(" ", $dt_convert)[1];

                $data = DB::select("select gid,maxa,xa,huyen,tk,khoanh,lo,ldlr,maldlr,churung from " . $tableName . " where ST_Intersects(" . $tableName . ".geom, 'SRID=4326;POINT(" . $lon . " " . $lat . ")'::geography)");
                if (count($data) > 0) {
                    $checkExsit = Hotspot::where('latitude', $lat)->where('longitude', $lon)->where('acq_date', $acq_date)->where('acq_time', $acq_time)->get();
                    if (count($checkExsit) == 0) {
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
                        $getEmails = receiveEmail::select('email')->where('hotspot', 1)->get();
                        $trimEmail = array();
                        foreach ($getEmails as $item) {
                            array_push($trimEmail, trim($item->email));
                        }
                        $subject = "Cảnh báo phát hiện điểm nguy cơ cháy";
                        Mail::send('sendMail.mailHotspot', ['lat' => $push_data[$i][0], 'lon' => $push_data[$i][1], 'lo' => $data[0]->lo, 'khoanh' => $data[0]->khoanh, 'tk' => $data[0]->tk, 'churung' => $data[0]->churung, 'xa' => $data[0]->xa, 'huyen' => $data[0]->huyen], function ($mess) use ($subject, $trimEmail) {
                            $mess->to($trimEmail);
                            $mess->to(['lesydoanh@ifee.edu.vn', 'phamquangduong@ifee.edu.vn', 'tranvanhai@ifee.edu.vn']);
                            $mess->from('giamsatrunghanam@ifee.edu.vn', 'Hệ thống giám sát rừng tỉnh Hà Nam');
                            $mess->subject($subject);
                        });
						
						/* Push Notification to App Mobile */
                        $maxid = Hotspot::max('id');
                        $dt = Hotspot::findOrFail($maxid);
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
                        $properties['XACMINH'] = 1;
                        $properties['KIEMDUYET'] = 0;
                        $temp['properties'] = $properties;
						
						$url = 'https://fcm.googleapis.com/fcm/send';
                        $body = 'Hệ thống giám sát rừng Hà Nam vừa phát hiện một điểm cảnh báo cháy tại ' . trim($dt->commune->xa) . ' ' . trim($dt->commune->district->huyen) . ' lô ' . $dt->lo . '. Đề nghị quý cơ quan truy cập http://giamsatrunghanam.ifee.edu.vn/CanhBaoChayRung để kiểm chứng, xác minh.';
                        $data = [
                            'to' => '/topics/hanamffw',
                            'notification' => [
                                'title' => 'Cảnh báo phát hiện điểm cháy!!!',
                                'body' => $body,
                            ],
                            'data' => $temp,
                            'apns' => [
                                'payload' => [
                                    'aps' => [
                                        'mutable-content' => 1,
                                    ],
                                ]
                            ]
                        ];

                        $this->pushNotification($url, $data);
                    }
                }
            }

            return "Success";
        } catch (\Exception $e) {
            return "Connect Fail";
        }
    }

    public function convertDateTime($date, $format = 'Y-m-d H:i')
    {
        $tz1 = 'UTC';
        $tz2 = 'Asia/Ho_Chi_Minh'; // UTC +7

        $d = new DateTime($date, new DateTimeZone($tz1));
        $d->setTimeZone(new DateTimeZone($tz2));

        return $d->format($format);
    }

    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function () {
            $this->getIndex();
            $this->updateDBR();
        })->dailyAt('12:26');

        $schedule->call(function () {
            $this->getIndex();
            $this->updateDBR();
        })->dailyAt('12:46');

        $schedule->call(function () {
            $this->sendEmail();
        })->dailyAt('13:15');

        $schedule->call(function () {
            $this->getHotspot();
        })->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
