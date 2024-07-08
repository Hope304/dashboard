<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function getDashBoard(){
        return view("admin/dashboard/view");
    }
}
