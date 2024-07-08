<?php

namespace App\Http\Controllers;

use App\Data_BU;
use App\History_BU;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackUpController extends Controller
{
    public function getDanhSach()
    {
        $data = History_BU::orderByDesc('id')->get();
        return view('admin/backup/danhsach', ['data' => $data]);
    }

    public function getKhoiPhuc($id)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(600);

        /* Khôi phục */
        $info = History_BU::findOrFail($id);
        $backup_id = $info->backup_id;

        DB::table('hanam_dbr')->truncate();

        DB::table('hanam_dbr')->insertUsing(
            [
                'gid', 'tt', 'id', 'matinh', 'mahuyen', 'maxa', 'xa', 'tk', 'khoanh', 'lo', 'thuad', 'tobando', 'ddanh', 'dtich', 'dientichch', 'nggocr', 'ldlr', 'maldlr', 'sldlr', 'namtr', 'captuoi', 'ktan', 'nggocrt', 'thanhrung', 'mgo', 'mtn', 'mgolo', 'mtnlo', 'lapdia', 'malr3', 'mdsd', 'mamdsd', 'dtuong', 'churung', 'machur', 'trchap', 'quyensd', 'thoihansd', 'khoan', 'nqh', 'nguoink', 'nguoitrch', 'mangnk', 'mangtrch', 'ngsinh', 'kd', 'vd', 'capkd', 'capvd', 'locu', 'vitrithua', 'tinh', 'huyen', 'geom'
            ],
            function ($query) use ($backup_id) {
                $query
                    ->select([
                        'gid', 'tt', 'id', 'matinh', 'mahuyen', 'maxa', 'xa', 'tk', 'khoanh', 'lo', 'thuad', 'tobando', 'ddanh', 'dtich', 'dientichch', 'nggocr', 'ldlr', 'maldlr', 'sldlr', 'namtr', 'captuoi', 'ktan', 'nggocrt', 'thanhrung', 'mgo', 'mtn', 'mgolo', 'mtnlo', 'lapdia', 'malr3', 'mdsd', 'mamdsd', 'dtuong', 'churung', 'machur', 'trchap', 'quyensd', 'thoihansd', 'khoan', 'nqh', 'nguoink', 'nguoitrch', 'mangnk', 'mangtrch', 'ngsinh', 'kd', 'vd', 'capkd', 'capvd', 'locu', 'vitrithua', 'tinh', 'huyen', 'geom'
                    ])
                    ->from('data_backup')
                    ->where('backup_id', $backup_id);
            }
        );

        return back()->with('success', "Khôi phục dữ liệu thành công");
    }

    public function getXoa($id)
    {
        $data = History_BU::findOrFail($id);
        Data_BU::where('backup_id', $data->backup_id)->delete();
        $data->delete();

        return back()->with('success', "Xóa sao lưu thành công");
    }
}
